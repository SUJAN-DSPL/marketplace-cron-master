<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $connection = 'backend_mysql';
    protected $table = "order_details";

    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'prod_refund_amazon_vat',
        'prod_refund_amazon_vat_lc',
        'product_code'
    ];

    // * Relations 

    public function OrderMaster()
    {
        return $this->belongsTo(OrderMaster::class, 'order_id');
    }
}
