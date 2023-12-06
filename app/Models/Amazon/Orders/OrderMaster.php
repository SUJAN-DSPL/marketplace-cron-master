<?php

namespace App\Models\Amazon\Orders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class OrderMaster extends Model
{
    public $timestamps = false;

    protected $table = 'mp_order_masters';

    protected $fillable = [
        'order_id',
        'order_date',
        'master_order_id',
        'parent_order_id',
        'void_order_id',
        'current_status',
        'domain_id',
        'payment_gateway_master_id',
        'tracking_number',
        'courier_id',
        'transaction_id',
        'currency_id_customer',
        'csr_id',
        'cust_id',
        'del_country_id',
        'bill_country_id',
        'source',
        'shipping_site_id',
        'shipping_master_id',
        'source_site_id',
        'paneu_vat_cm_id',
        'del_master_country_id',
        'ebay_order_id',
        'order_master_details',
        'vat_details',
        'refunds_details',
        'address_details',
    ];

    protected $casts = [
        'order_master_details' => 'json',
        'vat_details' => 'json',
        'refunds_details' => 'json',
        'address_details' => 'json',
    ];

    // * scopes

    public function scopeWithoutSynchronizedOrder($query)
    {
        $query->doesnthave('synchronizedOrder');
    }

    // * Relations 

    public function synchronizedOrder()
    {
        return $this->hasOne(SynchronizedOrder::class, 'order_id', 'order_id');
    }

    public function orderDetails(): HasMany
    {
        return $this->hasMany(
            related: OrderDetail::class,
            foreignKey: 'order_id',
            localKey: 'order_id'
        );
    }

    public function orderProcessing(): HasMany
    {
        return $this->hasMany(
            related: OrderProcessing::class,
            foreignKey: 'order_id',
            localKey: 'order_id'
        );
    }
}
