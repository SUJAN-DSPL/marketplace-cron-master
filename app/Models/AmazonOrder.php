<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AmazonOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'buyer_info',
        'amazon_order_id',
        'earliest_ship_date',
        'sales_channel',
        'order_status',
        'number_of_items_shipped',
        'order_type',
        'is_premium_order',
        'is_prime',
        'fulfillment_channel',
        'number_of_items_unshipped',
        'has_regulated_items',
        'is_replacement_order',
        'is_sold_by_AB',
        'latest_ship_date',
        'ship_service_level',
        'is_ISPU',
        'marketplace_id',
        'purchase_date',
        'shipping_address',
        'is_access_point_order',
        'seller_order_id',
        'payment_method',
        'is_business_order',
        'order_total',
        'payment_method_details',
        'is_global_express_enabled',
        'last_update_date',
        'shipment_service_level_category',
        'is_IBA',
    ];

    protected $casts = [
        "buyer_info" => "array",
        "shipping_address" => "array",
        'order_total' => "array",
        "payment_method_details" => "array",
    ];

    protected $dates = [
        'purchase_date',
    ];

    // * Relations

    public function refundEventLists()
    {
        return $this->hasMany(RefundEventList::class, 'amazon_order_id', 'amazon_order_id');
    }

    public function shipmentEventLists()
    {
        return $this->hasMany(ShipmentEventList::class, 'amazon_order_id', 'amazon_order_id');
    }

    // * Accessors
    
    public function getPurchaseDateAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d\TH:i:s\Z');
    }
}
