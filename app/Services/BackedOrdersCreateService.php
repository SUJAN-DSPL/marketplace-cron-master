<?php

namespace App\Services;

use App\Models\MpOrderMaster;
use Illuminate\Support\Facades\DB;
use App\Models\Backend\OrderMaster;

class BackedOrdersCreateService
{

    public function __construct(protected MpOrderMaster $amazonOrder)
    {
    }

    public function create()
    {
        if (OrderMaster::query()->where('order_id', $this->amazonOrder->order_id)->exists()) return;

        DB::transaction(function () {
            $newOrder = $this->createOrder($this->amazonOrder);

            $this->createOrderDetails($newOrder, $this->amazonOrder->orderDetails);

            $this->createOrderProcessing($newOrder, $this->amazonOrder->orderProcessing);
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
            $data = array_merge(
                $orderDetail->toArray(),
                $orderDetail->order_details
            );
            unset($data['id']);
            $orderMaster->orderDetails()->create($data);
        });
    }

    public function createOrderProcessing(OrderMaster $orderMaster,  $orderProcessing)
    {
        $orderProcessing->each(function ($processing) use ($orderMaster) {
            $data =  array_merge(
                $processing->toArray(),
                $processing->op_archive_decline_details,
                $processing->op_charge_back_details,
                $processing->op_other_details,
            );
            unset($data['id']);
            $orderMaster->orderProcessing()->create();
        });
    }
}
