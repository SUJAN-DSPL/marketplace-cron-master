<?php

namespace Database\Seeders;

use App\Models\CronType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CronTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'id' => 1,
                'name' => 'external'
            ],
            [
                'id' => 2,
                'name' => 'internal'
            ],
            [
                'id' => 3,
                'name' => 'affiliate'
            ],
            [
                'id' => 4,
                'name' => 'google'
            ],
            [
                'id' => 5,
                'name' => 'warehouse'
            ],
            [
                'id' => 6,
                'name' => 'customer'
            ],
        ];

        foreach ($types as $type) {
            CronType::query()->updateOrCreate($type, ['id' => $type['id']]);
        }
    }
}
