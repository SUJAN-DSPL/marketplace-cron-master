<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\MpOrderMaster;
use App\Models\MpOrderProcessing;


final class MpOrderMasterService
{
    const MODEL = MpOrderMaster::class;

    public function __construct(
        protected null|MpOrderMaster $orderMaster = null
    ) {
    }

    public function saveOrder(array $orderMasterData): MpOrderMaster
    {
        $this->orderMaster = self::MODEL::query()->firstOrCreate([
            'order_id' => $orderMasterData['order_id'],
        ], $orderMasterData);

        return $this->orderMaster;
    }

    public function saveOrderDetails(array $orderDetailsData): void
    {
        array_walk($orderDetailsData, function ($orderDetail) {
            $this->orderMaster->orderDetails()->create($orderDetail);
        });
    }

    public function saveOrderProcessing(array $orderProcessData): MpOrderProcessing
    {
        return $this->orderMaster->orderProcessing()->firstOrCreate([
            'order_id' => $this->orderMaster->order_id
        ], $orderProcessData);
    }

    public function updateCostPriceTotal(): void
    {
        $cpTotal = $this->orderMaster->orderDetails()->pluck('order_details')->sum(function ($detail) {
            return $detail['cost_price'] * $detail['product_qty'];
        });

        $this->orderMaster->update([
            'order_master_details' => array_merge(
                $this->orderMaster->order_master_details,
                ['costprice_total' =>  round($cpTotal, 2)]
            )
        ]);
    }
}
