<?php

namespace App\Listeners;

use App\Services\AmazonOrderService;
use Illuminate\Queue\InteractsWithQueue;
use App\Services\BackedOrdersCreateService;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateAmazonOrdersToBackendListener implements ShouldQueue
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
            $purchaseDateRange = $event->purchaseDateRange;

            $amazonOrders = (new AmazonOrderService())->getOrdersBetween($purchaseDateRange);

            if (!$amazonOrders->count()) return;

            (new BackedOrdersCreateService())->createOrders($amazonOrders);
        }, type: self::class);
    }
}
