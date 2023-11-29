<?php

namespace App\Services;

use App\Models\AmazonOrder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class AmazonOrderService
{
    const MODEL = AmazonOrder::class;

    public function __construct(public $amazonOrder = null)
    {
    }

    public function createOrdersFromResponse(array $orders)
    {
        $orders = array_map(function ($order) {
            $newArray["buyer_info"] = json_encode($order['BuyerInfo']);
            $newArray["amazon_order_id"] = $order['AmazonOrderId'];
            $newArray["earliest_ship_date"] = Carbon::parse($order['EarliestShipDate']);
            $newArray["sales_channel"] = $order['SalesChannel'];
            $newArray["order_status"] = $order['OrderStatus'];
            $newArray["number_of_items_shipped"] = $order['NumberOfItemsShipped'];
            $newArray["order_type"] = $order['OrderType'];
            $newArray["is_premium_order"] = boolval($order['IsPremiumOrder']);
            $newArray["is_prime"] = boolval($order['IsPrime']);
            $newArray["fulfillment_channel"] = $order['FulfillmentChannel'];
            $newArray["number_of_items_unshipped"] = $order['NumberOfItemsUnshipped'];
            $newArray["has_regulated_items"] = boolval($order['HasRegulatedItems']);
            $newArray["is_replacement_order"] = boolval($order['IsReplacementOrder']);
            $newArray["is_sold_by_AB"] = boolval($order['IsSoldByAB']);
            $newArray["latest_ship_date"] = Carbon::parse($order['LatestShipDate']);
            $newArray["ship_service_level"] = $order['ShipServiceLevel'];
            $newArray["is_ISPU"] = boolval($order['IsISPU']);
            $newArray["marketplace_id"] = $order['MarketplaceId'];
            $newArray["purchase_date"] = Carbon::parse($order['PurchaseDate']);
            $newArray["shipping_address"] = isset($order['ShippingAddress']) ? json_encode($order['ShippingAddress']) : null;
            $newArray["is_access_point_order"] = boolval($order['IsAccessPointOrder']);
            $newArray["seller_order_id"] = $order['SellerOrderId'];
            $newArray["payment_method"] = $order['PaymentMethod'];
            $newArray["is_business_order"] = boolval($order['IsBusinessOrder']);
            $newArray["order_total"] = isset($order['OrderTotal']) ? json_encode($order['OrderTotal']) : null;
            $newArray["payment_method_details"] = json_encode($order['PaymentMethodDetails']);
            $newArray["is_global_express_enabled"] = boolval($order['IsGlobalExpressEnabled']);
            $newArray["last_update_date"] = Carbon::parse($order['LastUpdateDate']);
            $newArray["shipment_service_level_category"] = $order['ShipmentServiceLevelCategory'];
            $newArray["is_IBA"] = isset($order['IsIBA']) ? boolval($order['IsIBA']) : false;
            $newArray['created_at'] = Carbon::now();
            $newArray['updated_at'] = Carbon::now();
            return $newArray;
        }, $orders);

        DB::table('amazon_orders')->upsert($orders, 'amazon_order_id');
    }

    public function getLasCreateOrder(): AmazonOrder|null
    {
        return self::MODEL::query()->orderBy('purchase_date', 'desc')->first();
    }
}
