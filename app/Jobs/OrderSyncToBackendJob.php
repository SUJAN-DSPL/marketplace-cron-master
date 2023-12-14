<?php

namespace App\Jobs;

use App\Models\AmazonOrder;
use App\Services\AmazonOrderSyncService;
use App\Services\BackedOrdersCreateService;
use App\Services\AmazonSpApi\OrderApiService;

class OrderSyncToBackendJob extends CronJob
{
	const MAX_ORDER = 1000;

	/**
	 * Execute the job.
	 */

	public function execute()
	{
		AmazonOrder::query()->unSynchronizedOrders()->unmappedAmazonOrderItem()
			->take(self::MAX_ORDER)->each(function (AmazonOrder $amazonOrder) {
				dump($amazonOrder->id);
				
				$amazonOrder = $this->saveOrderItems($amazonOrder);

				$orderMaster = (new  AmazonOrderSyncService($amazonOrder))->sync();

				if (!$orderMaster) return;

				(new BackedOrdersCreateService($orderMaster))->create();

				$amazonOrder->markAsSynchronized();

				dump("done");
			});
	}

	public function saveOrderItems(AmazonOrder $amazonOrder): AmazonOrder
	{
		if ($amazonOrder->order_items) return $amazonOrder;

		$amazonOrder->order_items = (new OrderApiService())
			->getOrderItems($amazonOrder->amazon_order_id)
			->orderItems;

		$amazonOrder->save();
		$amazonOrder->refresh();

		return $amazonOrder;
	}
}
