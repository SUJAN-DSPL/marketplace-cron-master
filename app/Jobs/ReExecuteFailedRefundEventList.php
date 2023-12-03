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

			$financialEvent = (new FinanceApiService())
				->getFinancesByOrderId("206-3183805-6934746")["RefundEventList"][0];

			$newArray["amazon_order_id"] = $financialEvent['AmazonOrderId'];
			$newArray['seller_order_id'] = $financialEvent['SellerOrderId'];
			$newArray['marketplace_name'] = $financialEvent['MarketplaceName'];
			$newArray['posted_date'] = Carbon::parse($financialEvent['PostedDate']);
			$newArray['shipment_item_adjustment_list'] = $financialEvent['ShipmentItemAdjustmentList'];
			$newArray['created_at'] = Carbon::now();
			$newArray['updated_at'] = Carbon::now();

			$refundEventList = RefundEventList::create($newArray);

			(new BackendOrderUpdateService())->syncRefundDataToBackend($refundEventList);
			$refundEventList->delete();
		});
	}
}
