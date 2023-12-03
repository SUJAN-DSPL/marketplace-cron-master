<?php

namespace App\Jobs;

use App\Models\CronLog;
use GuzzleHttp\Exception\BadResponseException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class TestCronJob extends CronJob
{
	/**
	 * Execute the job.
	 */

	public function execute()
	{
		throw new BadRequestException("hello world!");

		// try {
		// 	throw new BadRequestException("hello world!");
		// } catch (\Throwable $th) {
		// 	//throw $th;
		// 	CronLog::create([
		// 		'scheduler_id' => $this->scheduler->uuid,
		// 		'cron_status_id' => 1,
		// 		'exception' => $th
		// 	]);
		// }
	}
}
