<?php

namespace Database\Seeders;

use App\Models\CronType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    public function run(): void
    {
        $this->call([
            AllocationSeeder::class,
            CronStatusSeeder::class,
            CronTypeSeeder::class,
            FrequencySeeder::class
        ]);
    }
}
