<?php

declare(strict_types=1);

namespace App\Models\Amazon\Orders;

use Illuminate\Database\Eloquent\Model;

final class OrderPackage extends Model
{
    public $timestamps = false;

    protected $primaryKey = 'id';

    protected $table = 'mp_order_package';

    protected $fillable = [
        'order_id',
        'order_detail_id',
        'product_name',
        'site_product_name',
        'product_code',
        'quantity',
        'in_stock',
        'reusable',
        'prod_returned_date',
        'prod_return_qty',
        'cost_price',
        'status',
        'supplier_id',
        'pack_vat',
        'pack_vat_lc',
        'pack_vat_per',
        'pack_prod_price',
        'pack_ship_vat',
        'pack_ship_vat_lc',
        'pack_ship',
        'pack_other_vat_charge',
        'pack_refund_amount',
        'pack_refund_qty',
        'pack_refund_vat',
        'pack_refund_shipping_vat',
        'vat_category',
        'pack_return_reuse_qty',
        'pack_return_reuse_cp',
    ];
}
