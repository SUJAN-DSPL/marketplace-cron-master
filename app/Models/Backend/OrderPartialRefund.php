<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPartialRefund extends Model
{
    use HasFactory;

    const STATUS_YES = "Y";

    protected $connection = 'backend_mysql';

    protected $table = 'order_partial_refund';

    protected $primaryKey = 'opr_id';

    public $timestamps = false;

    protected $fillable = [
        'opr_order_id',
        'opr_refund_exchange_rate',
        'opr_refund_reason',
        'opr_refund_amount',
        'opr_refund_status',
        'opr_refund_gateway',
        'opr_refund_by',
        'opr_refund_date',
        'opr_archive_refund_date',
        'opr_archive_refund_by',
        'opr_approve_refund_by',
        'opr_approve_refund_date',
        'opr_refund_amount_requested'
    ];
}
