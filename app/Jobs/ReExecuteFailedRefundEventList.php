<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Models\RefundEventList;
use App\Models\FailedRefundEventList;
use App\Services\BackendOrderUpdateService;
use App\Services\AmazonSpApi\FinanceApiService;


class ReExecuteFailedRefundEventList extends CronJob
{
	const MAX_ORDER = 1;
	/**
	 * Execute the job.
	 */

	public function execute()
	{
		FailedRefundEventList::query()->take(self::MAX_ORDER)->each(function ($list) {
			
		});
	}
}
