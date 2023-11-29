<?php

namespace Database\Seeders;

use App\Models\Allocation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AllocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            [
                'id' => 1,
                'name' => 'Website',
            ],
            [
                'id' => 2,
                'name' => 'MarketPlace'
            ],
        ];

        foreach ($statuses as $status) {
            Allocation::query()->updateOrCreate($status, ['id' => $status['id']]);
        }
    }
}
