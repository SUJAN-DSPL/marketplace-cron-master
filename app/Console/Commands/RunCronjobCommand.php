<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RunCronjobCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:cronjob {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $className = "App\\Jobs\\$name"; // Construct the full class name

        if (class_exists($className)) {
            $this->info("Cronjob {$name} is running");
            $cronJob = new $className(); // Instantiate the class
            $cronJob->execute(); // Call the execute method
        } else {
            return $this->error("Cronjob $name not found.");
        }

        $this->info("Cronjob {$name} assigned task has been completed");
    }
}
