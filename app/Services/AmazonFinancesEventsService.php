<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\RefundEventList;
use App\Models\ShipmentEventList;
use Illuminate\Support\Facades\DB;

class AmazonFinancesEventsService
{

    public function createShipmentEventListsFromResponse(array $shipmentEventLists)
    {
        $shipmentEventLists = array_map(function ($list) {
            $newArray["amazon_order_id"] = $list['AmazonOrderId'];
            $newArray['seller_order_id'] = $list['SellerOrderId'];
            $newArray['marketplace_name'] = $list['MarketplaceName'];
            $newArray['posted_date'] = Carbon::parse($list['PostedDate']);
            $newArray['shipment_item_list'] = json_encode($list['ShipmentItemList']);
            $newArray['created_at'] = Carbon::now();
            $newArray['updated_at'] = Carbon::now();
            return $newArray;
        }, $shipmentEventLists);

        DB::table('shipment_event_lists')->upsert($shipmentEventLists, 'amazon_order_id');
    }

    public function createRefundEventListsFromResponse(array $refundEventLists)
    {
        $refundEventLists = array_map(function ($list) {
            $newArray["amazon_order_id"] = $list['AmazonOrderId'];
            $newArray['seller_order_id'] = $list['SellerOrderId'];
            $newArray['marketplace_name'] = $list['MarketplaceName'];
            $newArray['posted_date'] = Carbon::parse($list['PostedDate']);
            $newArray['shipment_item_adjustment_list'] = json_encode($list['ShipmentItemAdjustmentList']);
            $newArray['created_at'] = Carbon::now();
            $newArray['updated_at'] = Carbon::now();
            return $newArray;
        }, $refundEventLists);

        DB::table('refund_event_lists')->upsert($refundEventLists, 'amazon_order_id');
    }

    public function getLastShipmentEventList()
    {
        return ShipmentEventList::query()->orderBy('posted_date', 'desc')->first();
    }

    public function getLastRefundEventList()
    {
        return RefundEventList::query()->orderBy('posted_date', 'desc')->first();
    }

    public function getFirstRefundEventList()
    {
        return RefundEventList::query()->orderBy('posted_date', 'asc')->first();
    }

    public function getRefundEventListsBetween(array $dateRange)
    {
        return RefundEventList::query()->whereBetween('posted_date', $dateRange)->get();
    }
}
