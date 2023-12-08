<?php

namespace App\Jobs;

use App\Models\Amazon\Orders\OrderMaster;
use App\Services\BackedOrdersCreateService;

class OrderSyncToBackendJob extends CronJob
{
	const MAX_ORDER = 1000;

	/**
	 * Execute the job.
	 */

	public function execute()
	{
		$amazonOrders = OrderMaster::query()->withoutSynchronizedOrder()->take(self::MAX_ORDER)->get();
		(new BackedOrdersCreateService())->createOrders($amazonOrders);
	}
}
