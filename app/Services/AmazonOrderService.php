<?php

namespace App\Services;

use App\Models\AmazonOrder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class AmazonOrderService
{
    const MODEL = AmazonOrder::class;

    public function __construct(public $amazonOrder = null)
    {
    }

    public function createOrders(array $orders): void
    {
        DB::table('amazon_orders')->upsert($orders, 'amazon_order_id');
    }

    public function getLasCreateOrder(): AmazonOrder|null
    {
        return self::MODEL::query()->orderBy('purchase_date', 'desc')->first();
    }

    public function getOrdersBetween(array $purchaseDateRange)
    {
        return self::MODEL::query()->whereBetween('purchase_date', $purchaseDateRange)->get();
    }
}
