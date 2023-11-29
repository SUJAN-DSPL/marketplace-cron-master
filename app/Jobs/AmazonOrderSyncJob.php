<?php

namespace App\Jobs;

use App\Models\AmazonOrder;
use App\Services\AmazonOrderService;
use App\Services\AmazonSpApi\OrderApiService;

class AmazonDataSyncJob extends CronJob
{
    const PROGRAM_START_DATE = "2023-11-26T13:40:00Z";

    /**
     * Execute the job.
     */

    public function execute()
    {
        $this->collectAndSaveAmazonOrder();
    }

    public function collectAndSaveAmazonOrder()
    {
        $data = null;
        $lastCreatedOrder = (new AmazonOrderService())->getLasCreateOrder();
        $createAfterTimeStamp = $lastCreatedOrder->purchase_date ?? self::PROGRAM_START_DATE;
        $marketPlaceId = "A1F83G8C2ARO7P";

        do {
            $data = (new OrderApiService())
                ->getOrders($marketPlaceId, $createAfterTimeStamp, nextToken: $data?->nextToken);
            (new AmazonOrderService())->createOrdersFromResponse($data->orders);
            
            dump("new Orders", count($data->orders));
        } while ($data?->nextToken);
    }
}
