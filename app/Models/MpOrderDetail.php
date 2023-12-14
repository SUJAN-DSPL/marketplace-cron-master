<?php

namespace App\Models;

use App\Services\MpOrderMasterService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class MpOrderDetail extends Model
{
    public $timestamps = false;

    protected $table = 'mp_order_details';

    protected $fillable = [
        'order_id',
        'status',
        'product_id',
        'product_master_id',
        'pattr_id',
        'primary_cat_id',
        'ls_dom_cat_id',
        'ebay_lineitem_id',
        'supplier_id',
        'order_details',
    ];

    protected $casts = [
        'order_details' => 'json',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            (new MpOrderMasterService($model->orderMaster))->updateCostPriceTotal();
        });

        static::updated(function ($model) {
            (new MpOrderMasterService($model->orderMaster))->updateCostPriceTotal();
        });
    }

    public function orderMaster(): BelongsTo
    {
        return $this->belongsTo(
            related: MpOrderMaster::class,
            foreignKey: 'order_id',
            ownerKey: 'order_id',
            relation: 'orderDetails'
        );
    }
}
