<?php

namespace App\Services;

use App\Models\FailedRefundEventList;

class FailedRefundEventListService
{
    const MODEL = FailedRefundEventList::class;

    public function addException(
        $refundEventListId,
        $exception,
        $exceptionalClass,
        $exceptionalMethod
    ): void {
        self::MODEL::query()->create([
            'refund_event_list_id' => $refundEventListId,
            'exception' => $exception,
            'exceptional_class' => $exceptionalClass,
            'exceptional_method' => $exceptionalMethod
        ]);
    }
}
