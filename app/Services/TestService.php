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
    public static function createData()
    {
        Notification::route('slack', env('SLACK_WEBHOOK_URL'))->notify(new SlackNotification("hello world"));
    }
}
