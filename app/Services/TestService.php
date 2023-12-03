<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\RefundEventList;
use App\Notifications\SlackNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use App\Services\AmazonSpApi\OrderApiService;
use App\Services\AmazonSpApi\FinanceApiService;


class TestService
{
    public static function test()
    {
        // $this->log->saveLog(['cron_status_id' => CronStatus::RUNNING]);

        $response = tryCatch(function(){

        });

        ($response->onSuccess)(function () {
            // $this->log->saveLog(['cron_status_id' => CronStatus::COMPLETED]);
            // $message = "{$this->scheduler->name} completed successfully";
            // $this->notify($message);
        });

        ($response->onFailure)(function ($exception) {
            // dump("failed");
            // $this->log->saveLog([
            //     'cron_status_id' => CronStatus::FAILED,
            //     'exception' => $exception
            // ]);

            // $message = "{$this->scheduler->name} had been failed";
            // $this->notify($message);
        });
       
    }
}
