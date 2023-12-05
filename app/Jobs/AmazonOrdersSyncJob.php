<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Models\MarketPlace;
use App\Services\AmazonOrderService;
use App\Events\AmazonOrdersCreatedEvent;
use App\Services\AmazonSpApi\OrderApiService;

class AmazonOrdersSyncJob extends CronJob
{
    const INITIAL_CREATE_AFTER_TIMESTAMP = "2023-11-26T13:40:00Z";

    /**
     * Execute the job.
     */

    public function execute()
    {
        MarketPlace::all()->each(function ($marketPlace) {
            $lastCreatedOrder = (new AmazonOrderService())->getLasCreateOrder();

            $createdAfter = $lastCreatedOrder->purchase_date ?? self::INITIAL_CREATE_AFTER_TIMESTAMP;

            $marketPlaceId = $marketPlace->market_place_id;

            $data = null;

            do {
                $data = $this->getAmazonOrders($marketPlaceId, $createdAfter, nextToken: $data?->nextToken);

                (new AmazonOrderService())->createOrders($data->orders);

                $this->fireAmazonOrdersCreatedEvent($data->orders);
            } while ($data?->nextToken);
        });
    }

    public function getAmazonOrders($marketPlaceId, $createdAfter, $nextToken)
    {
        $orderService = new OrderApiService();
        $data =  $orderService->getOrders($marketPlaceId, $createdAfter, nextToken: $nextToken);

        $data->orders = array_map(function ($order) use ($orderService) {
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

    public function fireAmazonOrdersCreatedEvent(array $orders): void
    {
        if (!count($orders)) return;

        $purchaseDateRange = [
            Carbon::parse($orders[0]['purchase_date'])->format('Y-m-d H:i:s'),
            Carbon::parse(array_pop($orders)['purchase_date'])->format('Y-m-d H:i:s'),
        ];

        event(new AmazonOrdersCreatedEvent($purchaseDateRange));
    }
}
