<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeCronJobCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:cronjob {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a Cron job file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $template = "<?php\n\nnamespace App\Jobs;\n\nclass {$name} extends CronJob\n{\n\t/**\n\t * Execute the job.\n\t */\n\n\tpublic function execute()\n\t{\n\t\t// put your code here\n\t}\n}";

        $filename = app_path("Jobs/{$name}.php");

        if (File::exists($filename)) {
            $this->error("{$name}.php already exists!");
        } else {
            File::put($filename, $template);
            $this->info("{$name}.php created successfully!");
        }
    }
}
