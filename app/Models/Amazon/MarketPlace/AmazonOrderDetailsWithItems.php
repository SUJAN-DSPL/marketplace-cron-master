<?php

namespace App\Models\Amazon\MarketPlace;

use App\Models\SynchronizedOrder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string mws_seller_id
 */
final class AmazonOrderDetailsWithItems extends Model
{
    protected $table = 'mp_amazon_order_details_with_items';

    protected $fillable = [
        'order_id',
        'order_details',
        'order_items',
        'order_status',
        'order_market_place_id',
        'mws_seller_id',
    ];

    protected $casts = [
        'order_details' => 'json',
        'order_items' => 'json',
    ];

}
