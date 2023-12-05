<?php

namespace App\Console;

use App\Jobs\TestCronJob;
use App\Models\Scheduler;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */

    protected function schedule(Schedule $schedule): void
    {
        Scheduler::query()->active()->each(function ($scheduler) use ($schedule) {
            $className =  $scheduler->cron_job_class;
            $schedule =  $schedule->job(new $className($scheduler));

            foreach ($scheduler->frequencies as $frequency) {
                $params = json_decode($frequency->pivot->frequency_params);
                $schedule->{$frequency->method}(...$params);
            }

            $schedule->withoutOverlapping(120)->onOneServer();
        });

        // $schedule->job(new TestCronJob(Scheduler::first()))->everySecond()->withoutOverlapping(120)->onOneServer();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
