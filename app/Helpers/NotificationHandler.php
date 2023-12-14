<?php

use App\Notifications\MailNotification;
use App\Notifications\SlackNotification;
use Illuminate\Support\Facades\Notification;

if (!function_exists('notifyOnMail')) {

    function notifyOnMail($email, $message, $subject = null)
    {
        $subject = $subject ?? " Message from " . config("app.name");

        try {
            Notification::route('mail', $email)->notify(new MailNotification($subject, $message));
        } catch (\Throwable $th) {
            dump($th->getMessage());
        }
    }
}


if (!function_exists('notifyOnSlack')) {

    function notifyOnSlack($message)
    {
        try {
            Notification::route('slack', config('slack.webhook_url'))->notify(new SlackNotification($message));
        } catch (\Throwable $th) {
            dump($th->getMessage());
        }
    }
}
