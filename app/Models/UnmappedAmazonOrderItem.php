<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnmappedAmazonOrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'amazon_order_id',
        'ASIN',
        'seller_SKU'
    ];
}
