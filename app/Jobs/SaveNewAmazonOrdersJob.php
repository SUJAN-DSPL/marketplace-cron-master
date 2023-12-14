<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Models\MarketPlace;
use App\Services\AmazonOrderService;
use App\Services\AmazonSpApi\OrderApiService;

class SaveNewAmazonOrdersJob extends CronJob
{
    const INITIAL_LAST_UPDATED_AFTER = "2023-12-13T12:00:00Z";

    /**
     * Execute the job.
     */

    public function execute()
    {
        MarketPlace::all()->each(function ($marketPlace) {
            dump($marketPlace->market_place_id);
            
            $lastCreatedOrder = (new AmazonOrderService())->getLasUpdatedOrder();

            $lastUpdatedAfter = $lastCreatedOrder->last_update_date ?? self::INITIAL_LAST_UPDATED_AFTER;

            $marketPlaceId = $marketPlace->market_place_id;

            $data = null;

            $runTime = 0;

            do {
                if ($runTime == 1) break;

                $data = $this->getAmazonOrders($marketPlaceId, $lastUpdatedAfter, nextToken: $data?->nextToken);

                (new AmazonOrderService())->createOrders($data->orders);

                $runTime = $runTime + 1;

            } while ($data?->nextToken);
        });
    }

    public function getAmazonOrders($marketPlaceId, $lastUpdatedAfter, $nextToken)
    {
        $orderService = new OrderApiService();

        $data = $orderService->getOrders(
            marketPlaceId: $marketPlaceId,
            lastUpdatedAfter: $lastUpdatedAfter,
            orderStatuses: ["Shipped", "Unshipped", "PartiallyShipped"],
            nextToken: $nextToken
        );

        $data->orders = array_map(function ($order) {
            return [
                'amazon_order_id' => $order['AmazonOrderId'],
                'order_status' => $order['OrderStatus'],
                'marketplace_id' => $order['MarketplaceId'],
                'purchase_date' => Carbon::parse($order['PurchaseDate']),
                'last_update_date' => Carbon::parse($order['LastUpdateDate']),
                'order_meta_data' => json_encode($order),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }, $data->orders);

        return $data;
    }
}
