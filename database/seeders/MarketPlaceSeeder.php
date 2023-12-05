<?php

namespace Database\Seeders;

use App\Models\MarketPlace;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarketPlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $marketPlaces = [
            'ATVPDKIKX0DER' => 'Amazon.com',
            'A2EUQ1WTGCTBG2' => 'Amazon.ca',
            'A1F83G8C2ARO7P' => 'Amazon.co.uk',
            'A1PA6795UKMFR9' => 'Amazon.de',
            'A1RKKUPIHCS9HS' => 'Amazon.es',
            'A13V1IB3VIYZZH' => 'Amazon.fr',
            'APJ6JRA9NG5V4' => 'Amazon.it',
            'A1805IZSGTT6HS' => 'Amazon.nl',
            'A2Q3Y263D00KWC' => 'Amazon.br',
            'A2NODRKZP88ZB9' => 'Amazon.se',
            'A1C3SOZRARQ6R3' => 'Amazon.pl',
        ];

        foreach ($marketPlaces as $marketPlaceId => $domain) {
            MarketPlace::query()->updateOrCreate(['market_place_id' => $marketPlaceId], [
                'market_place_id' => $marketPlaceId,
                'domain' => $domain
            ]);
        }
    }
}
