<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProcessing extends Model
{
    use HasFactory;

    protected $connection = 'backend_mysql';

    protected $table = 'order_processing';

    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'refund_by',
        'refund_reason',
        'refund_date',
        'refund_exchange_rate',
        'refund_amount',
        'refund_gateway',
        'archive_refund_date',
        'archive_refund_by',
        'approve_refund_by',
        'approve_refund_date',
    ];
}
