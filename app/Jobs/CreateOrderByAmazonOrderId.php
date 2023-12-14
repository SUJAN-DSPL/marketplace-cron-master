<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Models\AmazonOrder;
use App\Services\AmazonOrderSyncService;
use App\Services\BackedOrdersCreateService;
use App\Services\AmazonSpApi\OrderApiService;

class CreateOrderByAmazonOrderId extends CronJob
{
	/**
	 * Execute the job.
	 */

	public function execute()
	{
		$response = (new OrderApiService())->getOrderById("303-8473481-9413132");

		$amazonOrder = AmazonOrder::firstOrCreate(
			['amazon_order_id' => $response->order['AmazonOrderId']],
			[
				'amazon_order_id' => $response->order['AmazonOrderId'],
				'order_status' => $response->order['OrderStatus'],
				'marketplace_id' => $response->order['MarketplaceId'],
				'purchase_date' => Carbon::parse($response->order['PurchaseDate']),
				'last_update_date' => Carbon::parse($response->order['LastUpdateDate']),
				'order_meta_data' => $response->order,
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			]
		);

		$amazonOrder = $this->saveOrderItems($amazonOrder);

		$orderMaster = (new  AmazonOrderSyncService($amazonOrder))->sync();

		(new BackedOrdersCreateService($orderMaster))->create();
	}

	public function saveOrderItems(AmazonOrder $amazonOrder): AmazonOrder
	{
		$amazonOrder->order_items = (new OrderApiService())
			->getOrderItems($amazonOrder->amazon_order_id)
			->orderItems;

		$amazonOrder->save();
		$amazonOrder->refresh();

		return $amazonOrder;
	}
}
