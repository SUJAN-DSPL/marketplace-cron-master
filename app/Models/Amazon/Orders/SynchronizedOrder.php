<?php

namespace App\Models\Amazon\Orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SynchronizedOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id'
    ];
}
