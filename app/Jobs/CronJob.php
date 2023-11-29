<?php

namespace App\Jobs;

use App\Models\Scheduler;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
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
        try {
            $this->execute();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    abstract public function execute();
}
