<?php

declare(strict_types=1);

namespace App\Models\Amazon;

use Illuminate\Database\Eloquent\Model;

final class AmazonBusinessSalesTraficChildAsinReport extends Model
{
    protected $connection = 'live_site';

    public $timestamps = false;

    protected $primaryKey = 'abstr_id';

    protected $table = 'amazon_business_sales_trafic_child_asin_report';

    protected $fillable = [
        'abstr_date',
        'abstr_market_id',
        'abstr_product_id',
        'abstr_parentAsin',
        'abstr_childAsin',
        'abstr_unitsOrdered',
        'abstr_unitsOrderedB2B',
        'abstr_orderedProductSales',
        'abstr_orderedProductSalesB2B',
        'abstr_gbp_orderedProductSales',
        'abstr_gbp_orderedProductSalesB2B',
        'abstr_totalOrderItems',
        'abstr_totalOrderItemsB2B',
        'abstr_sessions',
        'abstr_sessionPercentage',
        'abstr_buyBoxPercentage',
        'abstr_pageViews',
        'abstr_pageViewsPercentage',
        'abstr_date_updated',
    ];
}
