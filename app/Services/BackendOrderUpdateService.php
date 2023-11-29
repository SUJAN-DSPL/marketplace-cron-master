<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Number;
use App\Models\Backend\Currency;
use App\Models\Backend\OrderMaster;
use App\Models\Backend\AmazonProductMap;
use App\Models\Backend\OrderPartialRefund;
use App\Models\Backend\AmazonMwsAccountPanEu;

class BackendOrderUpdateService
{
    public function updateWithAmazonRefundEventLists($refundEventLists) // * main method
    {
        $refundEventLists->each(function ($list) {
            // $order = OrderMaster::where("order_id", "334429855")->first();

            $order = $this->getOrderFromTransactionId($list->amazon_order_id);

            if (!$order || $order->current_status == OrderMaster::REFUND_STATUS_ID) return;

            $orderMarketPlaceId = AmazonMwsAccountPanEu::getMarketIdByDomainId($order->domain_id);

            $this->updateOrderByAdjustmentList(
                $order,
                $list->shipment_item_adjustment_list
            );

            $this->updateOrderDetailsByAdjustmentList(
                $order,
                $orderMarketPlaceId,
                $list->shipment_item_adjustment_list
            );

            $this->updateOrderProcessingByAdjustmentList(
                $order,
                $list->shipment_item_adjustment_list
            );

            $this->createOrderPartialByAdjustmentList(
                $order,
                $list->shipment_item_adjustment_list
            );

            $this->createLogEntry(
                $order,
                $list->shipment_item_adjustment_list
            );
        });

        dump(
            $refundEventLists->first()->posted_date,
            $refundEventLists->reverse()->first()->posted_date
        );
    }

    // * sub methods

    public function updateOrderByAdjustmentList(OrderMaster $order, array $lists)
    {
        $totalRefundTaxAmount = $this->getTotalRefundTaxAmount($lists);

        $currencyCode = $order->currency_name_customer;

        $refundVatAmazonLc = Currency::convertIntoGBP($currencyCode, $totalRefundTaxAmount);

        $order->update([
            'current_status' => OrderMaster::REFUND_STATUS_ID,
            'refund_from' => 0, // * doubt
            'refund_vat_amazon_lc' => $refundVatAmazonLc,
            'refund_vat_amazon' => $totalRefundTaxAmount
        ]);
    }

    public function updateOrderDetailsByAdjustmentList(
        OrderMaster $order,
        string $orderMarketPlaceId,
        array $lists
    ) {
        array_walk($lists, function ($list) use ($order, $orderMarketPlaceId) {

            $refundTaxDetails = array_filter($list['ItemChargeAdjustmentList'], fn ($d) => $d["ChargeType"] == "Tax")[0];

            $refundTaxCurrencyCode = $refundTaxDetails['ChargeAmount']['CurrencyCode'];

            $refundTaxAmount = abs($refundTaxDetails['ChargeAmount']['CurrencyAmount']);

            $prodRefundAmazonVat =  Currency::convertIntoGBP($refundTaxCurrencyCode, $refundTaxAmount);

            $refundableItemsStockCode = $this->getStockCodeByAmazonSkU($list["SellerSKU"], $orderMarketPlaceId);

            $order->orderDetails()->where('product_code', $refundableItemsStockCode)
                ->update([
                    "prod_refund_amazon_vat" => round($prodRefundAmazonVat),
                    "prod_refund_amazon_vat_lc" => $refundTaxAmount,
                ]);
        });
    }

    public function updateOrderProcessingByAdjustmentList(OrderMaster $order, array $lists)
    {
        $totalRefundableAmount = $this->getTotalRefundableAmount($lists);
        $currencyCode = $order->currency_name_customer;
        $exchangeRate = Currency::where('currency_name', $currencyCode)->first()->exchange_rate;

        $order->orderProcessing->update([
            'refund_by' => OrderMaster::REFUND_BY_AMAZON_ID,
            'refund_reason' => 'Amazon FBA Refund',
            'refund_date' => Carbon::now(),
            'refund_exchange_rate' => $exchangeRate,
            'refund_amount' => Currency::convertIntoGBP($currencyCode, $totalRefundableAmount),
            'refund_gateway' => 'Amazon Sub Sales',
            'archive_refund_date' => Carbon::now(),
            'archive_refund_by ' => OrderMaster::REFUND_BY_AMAZON_ID,
            'approve_refund_by' => OrderMaster::REFUND_BY_AMAZON_ID,
            'approve_refund_date' => Carbon::now(),
        ]);
    }

    public function createOrderPartialByAdjustmentList(OrderMaster $order, array $lists)
    {
        $totalRefundableAmount = $this->getTotalRefundableAmount($lists);

        $currencyCode = $order->currency_name_customer;

        $exchangeRate = Currency::where('currency_name', $currencyCode)->first()->exchange_rate;

        $order->orderPartialRefund()->updateOrCreate(
            ['opr_order_id' => $order->order_id],
            [
                'opr_refund_exchange_rate' => $exchangeRate,
                'opr_refund_reason' => 'Amazon FBA Refund',
                'opr_refund_amount' => Currency::convertIntoGBP($currencyCode, $totalRefundableAmount),
                'opr_refund_status' => OrderPartialRefund::STATUS_YES,
                'opr_refund_gateway' => 'Amazon Sub Sales',
                'opr_refund_by' => OrderMaster::REFUND_BY_AMAZON_ID,
                'opr_refund_date' => Carbon::now(),
                'opr_archive_refund_date' => Carbon::now(),
                'opr_archive_refund_by' => OrderMaster::REFUND_BY_AMAZON_ID,
                'opr_approve_refund_by' => OrderMaster::REFUND_BY_AMAZON_ID,
                'opr_approve_refund_date' => Carbon::now(),
                'opr_refund_amount_requested' => 0 // * doubt
            ]
        );
    }

    public function createLogEntry(OrderMaster $order, array $lists)
    {
        $totalRefundableAmount = $this->getTotalRefundableAmount($lists);

        $description =
            "SP-API Order has been refunded,
            Reason:Amazon Refund ,
             Amount: " . Number::currency($totalRefundableAmount, in: $order->currency_name_customer);

        $order->orderLog()->create([
            'order_status' => OrderMaster::REFUND_STATUS_ID,
            'description' => $description,
            'date' => Carbon::now(),
            'processed_by' => OrderMaster::REFUND_BY_AMAZON_ID
        ]);
    }


    // *  helpers

    public function getTotalRefundableAmount(array $adjustmentLists)
    {
        return array_sum(array_map(function ($list) {
            return  array_sum(array_map(
                fn ($d) => abs($d["ChargeAmount"]["CurrencyAmount"]),
                $list['ItemChargeAdjustmentList']
            ));
        }, $adjustmentLists));
    }

    public function getTotalRefundTaxAmount(array $adjustmentLists)
    {
        return  array_sum(array_map(function ($list) {
            $taxDetails =  array_filter($list['ItemChargeAdjustmentList'], fn ($d) => $d["ChargeType"] == "Tax")[0];
            return abs($taxDetails["ChargeAmount"]["CurrencyAmount"]);
        }, $adjustmentLists));
    }

    public function getStockCodeByAmazonSkU(string $amazonProductSKU, string $amazonMarketplaceId)
    {
        return AmazonProductMap::query()
            ->where('azp_product_sku', $amazonProductSKU)
            ->where('azp_marketplace_id', $amazonMarketplaceId)
            ->first()
            ->azp_stock_code;
    }

    public function getOrderFromTransactionId($transactionId): OrderMaster|null
    {
        return OrderMaster::query()->where('transaction_id', $transactionId)->first();
    }
}
