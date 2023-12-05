<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'order_meta_data' => "array",
        "order_items" => "array",
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
