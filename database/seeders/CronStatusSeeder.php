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
                'label' => 'Draft',
                'color' => '#9ca3af',
                'description' => 'Previous cron still running',
            ],
            [
                'id' => 2,
                'label' => 'Running',
                'color' => '#6d28d9',
                'description' => 'Cron is running',
            ],
            [
                'id' => 3,
                'label' => 'Completed',
                'color' => '#4ade80',
                'description' => 'Cron has been Completed'
            ],
            [
                'id' => 4,
                'label' => 'Failed',
                'color' => "#f87171",
                'description' => 'Cron has been Failed'
            ]
        ];

        foreach ($statuses as $status) {
            CronStatus::query()->updateOrCreate(['id' => $status['id']], $status);
        }
    }
}
