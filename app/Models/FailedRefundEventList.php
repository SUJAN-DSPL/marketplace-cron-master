<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FailedRefundEventList extends Model
{
    use HasFactory;

    protected $fillable = [
        'refund_event_list_id',
        'exception',
        'exceptional_class',
        'exceptional_method'
    ];

    // * relations

    public function refundEventList()
    {
        return $this->belongsTo(RefundEventList::class);
    }
}
