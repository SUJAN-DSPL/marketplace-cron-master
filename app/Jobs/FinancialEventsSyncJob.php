<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Events\UpdateBackendOrdersEvent;
use App\Services\AmazonFinancesEventsService;
use App\Services\AmazonSpApi\FinanceApiService;

class FinancialEventsSyncJob extends CronJob
{
	const INITIAL_POSTED_DATE = "2023-11-25T07:40:00Z";
	const MAX_NUM_OF_API_CALL = "100";

	/**
	 * Execute the job.
	 */

	public function execute()
	{
		$lastShipmentEvent = (new AmazonFinancesEventsService())->getLastShipmentEventList();
		$postedAfterTimeStamp = $lastShipmentEvent?->posted_date ?? Self::INITIAL_POSTED_DATE;
		$eventNames = ["ShipmentEventList", 'RefundEventList'];

		$data = null;
		$totalNoOfApiCall = 0;

		do {
			if ($totalNoOfApiCall == self::MAX_NUM_OF_API_CALL) break;

			$data = (new FinanceApiService())
				->getFinancialEventsData($eventNames, $postedAfterTimeStamp, nextToken: $data?->nextToken);

			(new AmazonFinancesEventsService())->createShipmentEventListsFromResponse($data->financialEvents["ShipmentEventList"]);
			(new AmazonFinancesEventsService())->createRefundEventListsFromResponse($data->financialEvents["RefundEventList"]);

			$this->fireUpdateBackendOrderEvent($data->financialEvents["RefundEventList"]);
		} while ($data?->nextToken);
	}

	public function fireUpdateBackendOrderEvent($refundEventList)
	{
		if (!count($refundEventList)) return;

		$postedDateRange = [
			Carbon::parse($refundEventList[0]['PostedDate'])->format('Y-m-d H:i:s'),
			Carbon::parse(array_pop($refundEventList)['PostedDate'])->format('Y-m-d H:i:s'),
		];

		dump($postedDateRange);

		event(new UpdateBackendOrdersEvent($postedDateRange));
	}
}