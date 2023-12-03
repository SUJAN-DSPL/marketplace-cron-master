<?php

namespace Database\Seeders;

use App\Models\CronStatus;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CronStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            [
                'id' => 1,
                'label' => 'draft',
                'description' => 'Previous cron still running',
            ],
            [
                'id' => 2,
                'label' => 'Running',
                'description' => 'Cron is running',
            ],
            [
                'id' => 3,
                'label' => 'Completed',
                'description' => 'Cron has been Completed'
            ],
            [
                'id' => 4,
                'label' => 'Failed',
                'description' => 'Cron has been Failed'
            ]
        ];

        foreach ($statuses as $status) {
            CronStatus::query()->updateOrCreate($status, ['id' => $status['id']]);
        }
    }
}
