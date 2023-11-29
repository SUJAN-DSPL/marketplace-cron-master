<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;

abstract class CronJob
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $scheduler;

    /**
     * Create a new job instance.
     */
    public function __construct($scheduler = null)
    {
        $this->scheduler = $scheduler;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // try catch is a custom helper method
        tryCatch(fn () => $this->execute());
    }

    abstract public function execute();
}
