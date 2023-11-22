<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TestService
{

    public static function getData()
    {
        $url = "https://tortuga-prod-eu.s3-eu-west-1.amazonaws.com/32a49383-edac-4043-848b-d99742cd6937.amzn1.tortuga.4.eu.T15NYE114Y0TD7?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Date=20231121T200632Z&X-Amz-SignedHeaders=host&X-Amz-Expires=300&X-Amz-Credential=AKIAX2ZVOZFBB4YFXXHU%2F20231121%2Feu-west-1%2Fs3%2Faws4_request&X-Amz-Signature=5966a5b193f12181112a32d56ed366a45ffc14702b7a299b8a5e263f568f852f";

        $response = Http::get($url);

        if ($response->getStatusCode() !== 200) {
            return 'Call to download content was unsuccessful';
        }

        $content = (string)$response->getBody();

        $rows = explode("\n", $content);
        dd($rows[1]);

        // Create an empty array to store the data
        $dataArray = [];

        // Process each row
        foreach ($rows as $row) {
            // Split the row into columns using tabs as the delimiter
            $columns = array_filter(preg_split('/\t+/', $row));;

            // Create a collection for each row and add it to the data array
            $dataArray[] = $columns;
        }

        // Output the array
        dump($dataArray[0]);
        dd($dataArray[1]);

        // $content = gzdecode($content);


    }
}
