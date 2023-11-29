<?php

use Carbon\Carbon;
use App\Notifications\MailNotification;
use App\Notifications\SlackNotification;
use Illuminate\Support\Facades\Notification;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

if (!function_exists('tryCatch')) {

    function tryCatch(callable $callBack, array $errorNotifyChannels = ["slack", "mail"], $type = "schedule")
    {
        try {
            return $callBack();
        } catch (\Throwable $th) {
            $errorMethod1 = $th->getTrace()[0]['function'] ?? 'N/A';
            $errorMethod2 = $th->getTrace()[1]['function'] ?? 'N/A';
            $errorMethod3 = $th->getTrace()[2]['function'] ?? 'N/A';
            $errorLine = $th->getLine();
            $errorClass = $th->getFile();
            $message = $th->getMessage() ?? "internal server error";
            $timestamp = Carbon::now()->format('Y-m-d H:i:s');

            $errorMessage = "---------------------New Error ($timestamp)-------------------------- \n
            Hello, Our Application got a new error message \n
            Error: $message, \n
            Location : $errorClass \n
            Method : $errorMethod1() <= $errorMethod2() <= $errorMethod3() \n
            Line No : $errorLine \n
            Type : $type \n
            Timestamp : $timestamp";

            if (in_array("slack", $errorNotifyChannels)) {
                Notification::route('slack', env('SLACK_WEBHOOK_URL'))->notify(new SlackNotification($errorMessage));
            }

            if (in_array("mail", $errorNotifyChannels)) {
                Notification::route('mail', env("ADMIN_EMAIL"))->notify(new MailNotification($errorMessage));
            }

            throw new BadRequestException($errorMessage);
        }
    }
}
