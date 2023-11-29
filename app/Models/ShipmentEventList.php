<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShipmentEventList extends Model
{
    use HasFactory;

    public $fillable = [
        'amazon_order_id',
        'seller_order_id',
        'marketplace_name',
        'posted_date',
        'shipment_item_list',
    ];

    public $casts = [
        'shipment_item_list' => 'array',
    ];

    protected $dates = [
        'posted_date',
    ];

    // * Relations

    public function amazonOrder()
    {
        return $this->belongsTo(AmazonOrder::class, 'amazon_order_id', 'amazon_order_id');
    }

    // * Accessors

    public function getPostedDateAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d\TH:i:s\Z');
    }
}
