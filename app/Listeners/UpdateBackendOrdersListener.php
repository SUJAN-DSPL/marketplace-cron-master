<?php

namespace App\Listeners;

use App\Services\BackendOrderService;
use Illuminate\Queue\InteractsWithQueue;
use App\Services\BackendOrderUpdateService;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Services\AmazonFinancesEventsService;

class UpdateBackendOrdersListener implements ShouldQueue
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
        try {
            $postedDateRange = $event->postedDateRange;

            $afterRefundEventLists = (new AmazonFinancesEventsService())
                ->getRefundEventListsBetween($postedDateRange);

            if (!$afterRefundEventLists->count()) return;

            (new BackendOrderUpdateService())
                ->updateWithAmazonRefundEventLists($afterRefundEventLists);
        } catch (\Throwable $th) {
            //throw $th;
            dump($th->getMessage());
        }
    }
}
