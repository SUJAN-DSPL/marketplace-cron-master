<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class MpOrderProcessing extends Model
{
    public $timestamps = false;

    protected $table = 'mp_order_processing';

    protected $fillable = [
        'order_id',
        'paid_by',
        'paid_date',
        'pre_auth_date',
        'dispatch_by',
        'courier_id',
        'dispatched_date',
        'archive_date',
        'decline_date',
        'chargeback_date',
        'lost_chargeback_date',
        'won_chargeback_date',
        'approve_refund_date',
        'modified_date',
        'op_archive_decline_details',
        'op_charge_back_details',
        'op_other_details',
    ];

    protected $casts = [
        'op_archive_decline_details' => 'json',
        'op_charge_back_details' => 'json',
        'op_other_details' => 'json',
    ];

    public function orderMaster(): BelongsTo
    {
        return $this->belongsTo(
            related: MpOrderMaster::class,
            foreignKey: 'order_id',
            ownerKey: 'order_id',
            relation: 'orderProcessing'
        );
    }
}
