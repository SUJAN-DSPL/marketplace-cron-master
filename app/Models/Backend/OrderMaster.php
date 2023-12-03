<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderMaster extends Model
{
    use HasFactory;

    const REFUND_STATUS_ID = 12;
    const REFUND_BY_AMAZON_ID = 201;
    const ORDER_FROM_HISTORIC_ID = 10;

    protected $connection = 'backend_mysql';
    protected $table = 'order_master';

    public $timestamps = false;

    protected $fillable = [
        'current_status',
        'refund_from',
        'refund_vat_amazon_lc',
        'refund_vat_amazon'
    ];

    // * Relations 

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'order_id');
    }

    public function orderProcessing()
    {
        return $this->hasOne(OrderProcessing::class, 'order_id', 'order_id');
    }

    public function orderPartialRefund()
    {
        return $this->hasOne(OrderPartialRefund::class, 'opr_order_id', 'order_id');
    }

    public function orderLog()
    {
        return $this->hasMany(OrderLog::class, 'order_id', 'id');
    }
}
