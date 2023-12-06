<?php

namespace App\Models\Amazon\MarketPlace;

use App\Models\Domain;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

final class AmazonProductMap extends Model
{
    protected $connection = 'live_site';

    public $timestamps = false;

    protected $table = 'amazon_product_map';

    protected $primaryKey = 'azp_id';

    protected $fillable = [
        'azp_account_id',
        'azp_marketplace_id',
        'azp_product_name',
        'azp_product_status',
        'azp_amazon_data',
        'azp_asin',
        'azp_ean',
        'azp_fnsku',
        'azp_product_sku',
        'azp_domain_id',
        'azp_prod_id',
        'azp_stock_code',
        'azp_stock_code_old',
        'azp_prod_quantity',
        'azp_product_channel',
        'azp_product_stock_qty',
        'azp_inbound_qty',
        'azp_available_qty',
        'azp_fc_transfer_qty',
        'azp_fc_processing_qty',
        'azp_unfulfillable_qty',
        'azp_max_shipment_qty',
        'azp_product_price',
        'azp_product_regular_price',
        'azp_status',
        'azp_live_status',
        'azp_domain_suitability',
        'azp_created_by',
        'azp_updated_by',
        'azp_created_date',
        'azp_modified_date',
        'azp_product_old_status',
        'azp_is_pan_eu',
        'azp_is_original',
        'azp_stock_discontinue',
        'azp_out_stock_date',
        'azp_in_stock_date',
        'azp_in_out_stoc_date',
    ];

    public function domainDetail(): HasOne
    {
        return $this->hasOne(
            related: Domain::class,
            foreignKey: 'id',
            localKey: 'azp_domain_id'
        );
    }
}
