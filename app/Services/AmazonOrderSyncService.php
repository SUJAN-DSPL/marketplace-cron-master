<?php

declare(strict_types=1);

namespace App\Services;


use Exception;
use App\Models\AmazonOrder;
use App\Models\Backend\Stock;
use App\Models\MpOrderMaster;
use App\Models\Backend\Domain;
use App\Models\Backend\Country;
use App\Models\Backend\Currency;
use App\Services\ShippingService;
use App\Models\Backend\ProductsMaster;
use App\Services\MpOrderMasterService;
use App\Models\Backend\AmazonProductMap;
use App\Enums\CronJob\AmazonOrderStatusEnum;

class AmazonOrderSyncService
{
    protected $mpOrderMasterService;
    protected $exchangeRate;
    protected $country;
    protected $domainId;
    protected $shippingDetail;

    public function __construct(public AmazonOrder $order)
    {
        $this->mpOrderMasterService = new mpOrderMasterService();

        // reuseable properties

        $this->domainId = AmazonProductMap::getOrderDomainIdFromAsin($order->order_items[0]['ASIN'], $order->marketplace_id);
        $this->exchangeRate = Currency::getExchangeRateFromDomain($this->domainId);
        $this->country = Country::getCountry(
            country_code: $order->order_meta_data['ShippingAddress']['CountryCode'] ?? '',
            domain_id: $this->domainId
        );

        $this->shippingDetail = (new ShippingService())->getShippingDetailsByChannel(
            $order->order_meta_data['FulfillmentChannel'],
            $order->order_meta_data['IsPrime'],
            $order->order_meta_data['ShipmentServiceLevelCategory'],
            $this->country?->countryDomain->cntryd_id,
            (float) $order->order_meta_data['OrderTotal']['Amount']
        );
    }

    public function sync(): null|MpOrderMaster
    {
        if ($orderMaster =  MpOrderMaster::query()->where(
            'transaction_id',
            $this->order->order_meta_data['AmazonOrderId']
        )->first()) return $orderMaster;

        $orderMasterData = $this->prepareOrderMasterData($this->order);

        $orderDetailsData = $this->prepareOrderDetailsData($this->order);

        if (count($orderDetailsData) != count($this->order->order_items)){
            dump("don't have product mapping");
            return null;
        }

        $orderProcessingData = $this->prepareOrderProcessingData($this->order);

        $orderMaster = $this->mpOrderMasterService->saveOrder($orderMasterData);
        $this->mpOrderMasterService->saveOrderDetails($orderDetailsData);
        $this->mpOrderMasterService->saveOrderProcessing($orderProcessingData);

        return $orderMaster;
    }

    // * sub methods

    public function prepareOrderMasterData(AmazonOrder $order): array
    {
        $items = collect(value: $order->order_items);
        $orderDetails = $order->order_meta_data;

        $shippingCharge = $items->sum(callback: fn ($item) => ($item['ShippingPrice']['Amount'] ?? 0) - ($item['ShippingDiscount']['Amount'] ?? 0));
        $TotalPrice = $items->sum(callback: fn ($item) => (($item['ItemPrice']['Amount'] ?? 0) + ($item['GiftWrapPrice']['Amount'] ?? 0)) - ($item['PromotionDiscount']['Amount'] ?? 0));
        $ShippingTax = $items->sum(callback: fn ($item) => (($item['ShippingTax']['Amount'] ?? 0) - ($item['ShippingDiscountTax']['Amount'] ?? 0)));
        $ItemVat = $items->sum(callback: fn ($item) => (($item['ItemTax']['Amount'] ?? 0) + ($item['GiftWrapTax']['Amount'] ?? 0)));

        $data['order_id'] = MpOrderMaster::generateNewOrderNo();
        $data['order_date'] = now()->format('Y-m-d h:i:s');
        $data['master_order_id'] = 0;
        $data['parent_order_id'] = 0;
        $data['void_order_id'] = 0;
        // FUTURE SCOPE FOR MFN ORDERS HISTORIC IS STATIC FOR AFN ORDERS
        $data['current_status'] = AmazonOrderStatusEnum::HISTORIC->value;
        $data['domain_id'] = $this->domainId;
        $data['payment_gateway_master_id'] = 39;
        $data['tracking_number'] = 'Amazon Dispatch';
        $data['transaction_id'] = $orderDetails['AmazonOrderId'];
        $data['currency_id_customer'] = Domain::getCurrencyIdFromDomain($this->domainId);
        $data['csr_id'] = 201;
        $data['cust_id'] = 0;

        $data['del_country_id'] = $this->country?->countryDomain->cntryd_id ?? 0;
        $data['bill_country_id'] = $this->country?->countryDomain->cntryd_id ?? 0;
        $data['source'] = '';
        $data['shipping_site_id'] = $this->shippingDetail->shipping_master_id;
        $data['courier_id'] = $this->shippingDetail->sm_courier_id;
        $data['shipping_master_id'] = $this->shippingDetail->shipping_master_id;
        $data['source_site_id'] = 0;
        $data['paneu_vat_cm_id'] = $data['del_country_id'];
        $data['del_master_country_id'] = Country::getCountryIdFromCountryCode($orderDetails['ShippingAddress']['CountryCode'] ?? "");
        $data['ebay_order_id'] = 0;

        $currency = Currency::getCurrencyFromId($data['currency_id_customer']);

        $data['order_master_details'] = [
            'referral' => '',
            'ip_address' => '',
            'courier_name' => $this->shippingDetail->sm_name,
            'promo_code' => '',
            'currency' => $currency?->currency_name ?? '',
            'sub_total' => $TotalPrice,
            'order_total_amazon' => $orderDetails['OrderTotal']['Amount'] ?? 0,
            'order_total' => $orderDetails['OrderTotal']['Amount'] ?? 0,
            'costprice_total' => 0, //* update on create order details 
            'equi_pound' => round(num: ($TotalPrice / $this->exchangeRate), precision: 2),
            'exchange_rate' => $this->exchangeRate,
            'shipping_name' => $this->shippingDetail->sm_name,
            'shipping_charge' => $shippingCharge,
            'shipping_cost' => 0,
            'order_total_customer' =>  $orderDetails['OrderTotal']['Amount'] ?? 0,
            'exchange_rate_customer' => $this->exchangeRate,
            'currency_symbol_customer' => $currency?->currency_symbol ?? '',
            'currency_name_customer' => $currency?->currency_name ?? '',
            'company_for_vat' => 0,
            'other_status' => 0,
            'discount_type' => 'FIXED',
            'discount' => 0,
            'additional_added_amount' => 0,
            'transaction_released' => 'N',
            'packaging_cost' => 0.00,
            'awaiting_dispatch' => 0,
            'claim_status' => '',
            'special_offer_order' => '',
            'order_channel' => 'AMAZON',
            'is_free_order' => 'N',
            'ebay_order_status' => 0,
        ];

        $data['vat_details'] = [
            'vat' => 0,
            'vat_lc' => 0,
            'vat_amazon' => round(num: ($ItemVat / $this->exchangeRate), precision: 2),
            'vat_amazon_lc' => $ItemVat,
            'shipping_vat_lc' => $ShippingTax,
            'shipping_vat' => ($ShippingTax / $this->exchangeRate),
            'amazon_shipping_vat' => $ShippingTax,
        ];

        $data['refunds_details'] = [
            'refund_from' => 0,
            'refund_vat' => 0,
            'refund_vat_lc' => 0,
            'refund_vat_amazon' => 0,
            'refund_vat_amazon_lc' => 0,
            'refund_shipping_vat' => 0,
            'refund_shipping_vat_lc' => 0,
        ];

        $nameInfo = $this->getNames(fullName: $orderDetails['ShippingAddress']['Name'] ?? '');

        $data['address_details'] = [
            'email' => MpOrderMaster::EMAIL_ARRAY[$this->domainId],
            'date_of_birth' => MpOrderMaster::DATE_OF_BIRTH,
            'gender' => 'Male',
            'del_title' => 'Mr',
            'del_firstname' => $nameInfo['firstname'],
            'del_lastname' => $nameInfo['lastname'],
            'del_add1' => $orderDetails['ShippingAddress']['AddressLine1'] ?? '',
            'del_add2' => $orderDetails['ShippingAddress']['AddressLine2'] ?? '',
            'del_city' => $orderDetails['ShippingAddress']['City'] ?? '',
            'del_state' => $orderDetails['ShippingAddress']['StateOrRegion'] ?? '',
            'del_country' => $this->country->name,
            'del_zipcode' => $orderDetails['ShippingAddress']['PostalCode'] ?? '',
            'del_phone' => $orderDetails['ShippingAddress']['Phone'] ?? '',
            'del_mobile' => '',
            'del_office' => '',
            'del_house_no' => '',
            'del_mobile2' => '',
            'bill_title' => 'Mr',
            'bill_firstname' => $nameInfo['firstname'],
            'bill_lastname' => $nameInfo['lastname'],
            'bill_add1' => $orderDetails['ShippingAddress']['AddressLine1'] ?? '',
            'bill_add2' => $orderDetails['ShippingAddress']['AddressLine2'] ?? '',
            'bill_city' => $orderDetails['ShippingAddress']['City'] ?? '',
            'bill_state' => $orderDetails['ShippingAddress']['StateOrRegion'] ?? '',
            'bill_country' => $this->country->name,
            'bill_zipcode' => $orderDetails['ShippingAddress']['PostalCode'] ?? '',
            'bill_phone' => $orderDetails['ShippingAddress']['Phone'] ?? '',
            'bill_mobile' => '',
            'bill_office' => '',
            'bill_house_no' => '',
        ];

        return $data;
    }

    public function prepareOrderDetailsData(AmazonOrder $order): array
    {
        $orderDetails = collect($order->order_items)->map(callback: function ($item) use ($order) {

            $mapData = AmazonProductMap::getProductMapData($order->marketplace_id, $item['ASIN']);

            if (empty($mapData) && !isset($mapData['azp_prod_id'])) {
                $message = 'Product with ASIN ' . $item['ASIN'] . ' - ' . $item['SellerSKU'] . ' not matched for seller ' . $order->mws_seller_id . ' in marketplace ';
                $subject = "Missing Product Map Data";
                // notifyOnMail(env("ADMIN_EMAIL"), $message, $subject);
                notifyOnSlack($message);
                $this->order->markAsUnmappedAmazonOrderItem($item['ASIN'], $item['SellerSKU']);
                return null;
            }

            $productData = (array) ProductsMaster::getProductData($mapData['azp_prod_id']);

            if (empty($productData)) {
                $message = 'Product with ASIN ' . $item['ASIN'] . ' - ' . $item['SellerSKU'] . ' not matched for seller ' . $order->mws_seller_id . ' in marketplace ';
                $subject = "Missing Product Map Data";
                // notifyOnMail(env("ADMIN_EMAIL"), $message, $subject);
                notifyOnSlack($message);
                $this->order->markAsUnmappedAmazonOrderItem($item['ASIN'], $item['SellerSKU']);
                return null;
            }

            $productMasterIds = $productData['product_master_id'];

            $orderQuantity = (!empty($mapData['azp_prod_quantity'])) ? $mapData['azp_prod_quantity'] * $item['QuantityOrdered'] : $item['QuantityOrdered'];
            $shippingCharge = ($item['ShippingPrice']['Amount'] ?? 0) - ($item['ShippingDiscount']['Amount'] ?? 0);
            $ShippingTax = $item["ShippingDiscountTax"]['Amount'] ?? 0;
            $TotalPrice = $item['ItemPrice']['Amount'];
            $ItemVat = $item['ItemTax']['Amount'];

            $detailData['status'] = 1;
            $detailData['product_id'] = 0;
            $detailData['product_master_id'] = $productMasterIds;
            $detailData['pattr_id'] = 0;
            $detailData['primary_cat_id'] = ProductsMaster::getCategoryIdFromDomainAndProductMasterId($this->domainId, $productMasterIds);
            $detailData['ls_dom_cat_id'] = 0;
            $detailData['ebay_lineitem_id'] = 0;
            $detailData['supplier_id'] = $productData['pm_supplierid'];
            $totalPrice = ($item['ItemPrice']['Amount'] ?? 0) * ($item['QuantityOrdered'] ?? 0);
            $detailData['order_details'] = [
                'product_name' => $productData['prod_master_name'] ?? $mapData['azp_product_name'],
                'product_qty' => $orderQuantity,
                'size' => '',
                'color' => '',
                'cost_price' => round((Stock::getUnitPriceFromStock($mapData['azp_stock_code']) / $this->exchangeRate) * $orderQuantity, 2),
                'selling_price' => ($TotalPrice / $orderQuantity),
                'total_price' => $totalPrice,
                'unit_equi_pound' => round(num: ($totalPrice / $this->exchangeRate), precision: 2),
                'amazon_selling_price' => ($item['ItemPrice']['Amount'] ?? 0),
                'product_code' => $mapData['azp_stock_code'], //stock code
                'is_pack' => match ($productData['type']) {
                    'P', 'PP', 'PA', 'PPA' => 'Yes',
                    default => 'No'
                },
                'in_stock' => 'Yes',
                'reusable' => '',
                'prod_returned_date' => '',
                'prod_return_qty' => '',
                'resend' => '',
                'vat_inclusive' => 'Y',
                'is_special_offer' => 'N',
                'shipping_charge' => $shippingCharge,
                'prod_vat' => round(($ItemVat / $this->exchangeRate), 2),
                'prod_vat_lc' => $ItemVat,
                'prod_vat_amazon' => round(($ItemVat / $this->exchangeRate), 2),
                'prod_vat_amazon_lc' => $ItemVat,
                'vat_per' => '',
                'prod_refund_qty' => '',
                'ship_vat' => round(($ShippingTax / $this->exchangeRate), 2),
                'ship_vat_lc' => $ShippingTax,
                'prod_ship' => '',
                'other_vat_charge' => '',
                'prod_refund_amount' => '',
                'prod_refund_vat' => '',
                'prod_refund_amazon_vat' => '',
                'prod_refund_amazon_vat_lc' => '',
                'prod_refund_shipping_vat' => '',
                'vat_category' => '',
                'prod_return_reuse_qty' => '',
                'prod_return_reuse_cp' => '',
                'returnreason' => '',
                'returned_by' => '',
            ];

            return $detailData;
        });

        $orderDetails = $orderDetails->reject(fn ($detail) => !$detail);

        return array_values($orderDetails->toArray());
    }

    public function prepareOrderProcessingData(AmazonOrder $order): array
    {
        $processingData['paid_by'] = 201;
        $processingData['paid_date'] = now()->format(format: 'Y-m-d h:i:s');
        $processingData['pre_auth_date'] = "0000-00-00 00:00:00";
        $processingData['dispatch_by'] = 201;
        $processingData['courier_id'] = $this->shippingDetail->sm_courier_id;
        $processingData['dispatched_date'] = now()->format(format: 'Y-m-d h:i:s');
        $processingData['archive_date'] = null;
        $processingData['decline_date'] = null;
        $processingData['chargeback_date'] = null;
        $processingData['lost_chargeback_date'] = null;
        $processingData['won_chargeback_date'] = null;
        $processingData['approve_refund_date'] = "0000-00-00 00:00:00";
        $processingData['modified_date'] = now()->format(format: 'Y-m-d h:i:s');
        $processingData['op_archive_decline_details'] = [
            'archive_by' => '',
            'archive_from' => '',
            'archive_reason_id' => '',
            'archive_reason' => '',
            'archive_payment' => 'N',
            'decline_by' => '',
            'decline_from' => '',
            'decline_reason' => '',
        ];

        $processingData['op_charge_back_details'] = [
            'reminded_by' => '',
            'reminder_date' => '',
            'chargeback_by' => '',
            'chargeback_reason' => '',
            'chargeback_amount' => '',
            'chargeback_tracking_no' => '',
            'chargeback_file_name' => '',
            'chargeback_from' => '',
            'resend_by' => '',
            'resend_date' => '',
            'returned_by' => '',
            'returned_date' => '',
            'deleted_by' => '',
            'deleted_date' => '',
            'won_chargeback_by' => '',
            'won_chargeback_reason' => '',
            'lost_chargeback_by' => '',
            'lost_chargeback_reason' => '',
        ];

        $processingData['op_other_details'] = [
            'weight_kg' => '',
            'order_type' => '',
            'suspended_by' => '',
            'suspended_date' => '',
            'suspended_reason' => '',
            'suspended_from' => '',
            'approve_refund_by' => '',
            'archive_email_sent_date' => '',
            'dispatch_outof_stock_date_by' => '',
            'dispatch_outof_stock_from' => '',
            'dispatch_outof_stock_date' => '',
            'refund_amount_requested' => '',
            'void_from' => '',
            'void_by' => '',
            'void_date' => '',
            'claim_invoice_no' => '',
            'unresolved_historic_by' => '',
            'unresolved_historic_from' => '',
            'delivery_problem_by' => '',
            'delivery_problem_resolved_by' => '',
            'delivery_problem_date' => '',
            'delivery_problem_reason' => '',
            'delivery_problem_from' => '',
            'delivery_problem_reason_id' => '',
            'resources_fee' => '',
            'fulfillment_fee' => '',
            'postage_fee' => '',
            'amazon_ppc_fee' => '',
            'removal_charges' => '',
            'amount_remitted' => '',
            'amount_received' => '',
            'amazon_comm' => '',
            'amazon_original_comm' => '',
        ];

        return $processingData;
    }


    // * helper method

    public function getNames(string $fullName = ''): array
    {
        $output = ['firstname' => '', 'lastname' => ''];
        $input = explode(separator: ' ', string: $fullName);
        $len = count(value: $input);

        if (round(num: $len / 2) == 1) {
            $firstHalf = array_slice(array: $input, offset: (int) round(num: $len / 2));
            $secondHalf = '';
        } else {
            $firstHalf = array_slice(array: $input, offset: 0, length: (int) round(num: $len / 2));
            $secondHalf = array_slice($input, (int) round(num: $len / 2));
        }

        $output['firstname'] = (!empty($firstHalf)) ? implode(separator: ' ', array: $firstHalf) : '.';
        $output['lastname'] = (!empty($secondHalf)) ? implode(separator: ' ', array: $secondHalf) : '.';

        return $output;
    }
}
