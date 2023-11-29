<?php

namespace App\Services;

use App\Models\RefundEventList;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Services\AmazonSpApi\OrderApiService;
use App\Services\AmazonSpApi\FinanceApiService;

class TestService
{
    public static function createData()
    {
        $newArray["amazon_order_id"] = "123456789";
        $newArray['seller_order_id'] = "123456789";
        $newArray['marketplace_name'] = "dfdfdfdfdf";
        $newArray['posted_date'] = Carbon::now();
        $newArray['shipment_item_adjustment_list'] = json_encode([]);
        $newArray['created_at'] = Carbon::now();
        $newArray['updated_at'] = Carbon::now();

        RefundEventList::upsert([$newArray],['amazon_order_id'],['amazon_order_id']);
    }
}
