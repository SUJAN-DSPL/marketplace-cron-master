<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FailedRefundEventList extends Model
{
    use HasFactory;

    protected $fillable = [
        'refund_event_list_id',
        'exception'
    ];

    // * relations

    public function refundEventList()
    {
        return $this->belongsTo(RefundEventList::class);
    }

    // * mutators

    public function setExceptionAttribute($value)
    {
        return $this->attributes['exception'] = json_encode([
            'message' => $value->getMessage(),
            'trace' => $value->getTraceAsString(),
        ]);
    }
}
