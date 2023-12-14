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
		notifyOnSlack("hello");
	}
}
