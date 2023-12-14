<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Models\Amazon\Orders\SynchronizedOrder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Arr;

class AmazonOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'amazon_order_id',
        'order_status',
        'marketplace_id',
        'purchase_date',
        'last_update_date',
        'order_meta_data',
        'order_items'
    ];

    protected $casts = [
        "order_meta_data" => "array",
        "order_items" => "array",
    ];

    protected $dates = [
        'purchase_date',
    ];

    // * scopes

    public function scopeUnSynchronizedOrders($query)
    {
        $query->doesnthave('synchronizedOrder');
    }

    public function scopeUnmappedAmazonOrderItem($query)
    {
        $query->doesnthave('unmappedAmazonOrderItem');
    }

    // * Relations

    public function refundEventLists()
    {
        return $this->hasMany(RefundEventList::class, 'amazon_order_id', 'amazon_order_id');
    }

    public function shipmentEventLists()
    {
        return $this->hasMany(ShipmentEventList::class, 'amazon_order_id', 'amazon_order_id');
    }

    public function synchronizedOrder()
    {
        return $this->hasOne(SynchronizedOrder::class, 'amazon_order_id', 'amazon_order_id');
    }

    public function unmappedAmazonOrderItem()
    {
        return $this->hasOne(UnmappedAmazonOrderItem::class, 'amazon_order_id', 'amazon_order_id');
    }

    // * Accessors

    public function getLastUpdateDateAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d\TH:i:s\Z');
    }

    // * helper methods

    public function markAsSynchronized()
    {
        return $this->synchronizedOrder()->create([]);
    }

    public function markAsUnmappedAmazonOrderItem($ASIN, $sellerSKU)
    {
        return $this->unmappedAmazonOrderItem()->firstOrCreate(
            ['amazon_order_id' => $this->amazon_order_id],
            ['ASIN' => $ASIN, 'seller_SKU' => $sellerSKU]
        );
    }
}
