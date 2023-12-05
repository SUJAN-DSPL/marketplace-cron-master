<?php

namespace App\Jobs;

use App\Models\Scheduler;
use App\Models\CronStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use App\Notifications\MailNotification;
use App\Notifications\SlackNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Notification;

abstract class CronJob
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $log;

    /**
     * Create a new job instance.
     */
    public function __construct(public null|Scheduler $scheduler = null)
    {
        $this->log = $this->scheduler ? $this->scheduler->initLog() : null;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->log->saveLog(['cron_status_id' => CronStatus::RUNNING]);

        $response = tryCatch(fn () => $this->execute(), type: $this->scheduler->cron_job_class);

        ($response->onSuccess)(function () {
            $this->log->saveLog(['cron_status_id' => CronStatus::COMPLETED]);
            $message = "{$this->scheduler->name} completed successfully";
            $this->notify($message);
        });

        ($response->onFailure)(function ($exception) {
            $this->log->saveLog([
                'cron_status_id' => CronStatus::FAILED,
                'exception' => $exception
            ]);

            $message = "{$this->scheduler->name} had been failed";
            $this->notify($message);

            throw $exception;
        });
    }

    public function notify($message)
    {
        $emails = $this->scheduler->notifiable_emails ?? [];

        array_walk($emails, function ($email) use ($message) {
            Notification::route("mail", $email)->notify(new MailNotification($message));
        });

        if (!$this->scheduler->notify_on_slack) return;

        Notification::route('slack', env('SLACK_WEBHOOK_URL'))->notify(new SlackNotification($message));
    }

    abstract public function execute();
}
