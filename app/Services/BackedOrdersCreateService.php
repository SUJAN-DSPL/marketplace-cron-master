<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\Backend\OrderMaster;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Amazon\Orders\OrderMaster as MpOrderMaster;
use Carbon\Carbon;

class BackedOrdersCreateService
{
    public function createOrders(Collection $amazonOrders)
    {
        $amazonOrders->each(function (MpOrderMaster $amazonOrder) {

            if (OrderMaster::query()->where('order_id', $amazonOrder->order_id)->exists()) return;

            DB::transaction(function () use ($amazonOrder) {
                $newOrder = $this->createOrder($amazonOrder);

                $this->createOrderDetails($newOrder, $amazonOrder->orderDetails);

                $this->createOrderProcessing($newOrder, $amazonOrder->orderProcessing);

                $this->markAsSynchronized($amazonOrder);
            });
        });
    }

    public function createOrder(MpOrderMaster $amazonOrder): OrderMaster
    {
        $data = array_merge(
            $amazonOrder->toArray(),
            $amazonOrder->order_master_details,
            $amazonOrder->address_details,
            $amazonOrder->vat_details,
            $amazonOrder->refunds_details
        );

        unset($data['id']);

        $order = OrderMaster::query()->create($data);

        return $order;
    }

    public function createOrderDetails(OrderMaster $orderMaster,  $amazonOrderDetails)
    {
        $amazonOrderDetails->each(function ($orderDetail) use ($orderMaster) {
            $orderMaster->orderDetails()->create(
                array_merge($orderDetail->toArray(), $orderDetail->order_details)
            );
        });
    }

    public function createOrderProcessing(OrderMaster $orderMaster,  $orderProcessing)
    {
        $orderProcessing->each(function ($processing) use ($orderMaster) {
            $orderMaster->orderProcessing()->create(
                array_merge(
                    $processing->toArray(),
                    $processing->op_archive_decline_details,
                    $processing->op_charge_back_details,
                    $processing->op_other_details,
                )
            );
        });
    }

    public function markAsSynchronized(MpOrderMaster $amazonOrder)
    {
        return $amazonOrder->synchronizedOrder()->create([]);
    }
}
