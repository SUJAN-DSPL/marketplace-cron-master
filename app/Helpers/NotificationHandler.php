<?php

use App\Notifications\MailNotification;
use App\Notifications\SlackNotification;
use Illuminate\Support\Facades\Notification;

if (!function_exists('notifyOnMail')) {

    function notifyOnMail($email, $message)
    {
        try {
            Notification::route('mail', $email)->notify(new MailNotification($message));
        } catch (\Throwable $th) {
            dump($th->getMessage());
        }
    }
}


if (!function_exists('notifyOnSlack')) {

    function notifyOnSlack($message)
    {
        try {
            Notification::route('slack', env('SLACK_WEBHOOK_URL'))->notify(new SlackNotification($message));
        } catch (\Throwable $th) {
            dump($th->getMessage());
        }
    }
}
