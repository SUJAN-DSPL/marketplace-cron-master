<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use App\Services\AmazonFinancesEventsService;
use App\Services\BackendRefundedOrdersUpdateService;

class UpdateRefundedOrdersToBackendListener implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        tryCatch(function () use ($event) {
            $postedDateRange = $event->postedDateRange;

            $refundEventLists = (new AmazonFinancesEventsService())->getRefundEventListsBetween($postedDateRange);

            if (!$refundEventLists->count()) return;

            (new BackendRefundedOrdersUpdateService())->updateOrders($refundEventLists);
        }, type: self::class);
    }
}
