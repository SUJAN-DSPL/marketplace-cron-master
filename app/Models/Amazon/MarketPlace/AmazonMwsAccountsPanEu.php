<?php

namespace App\Models\Amazon\MarketPlace;

use Illuminate\Database\Eloquent\Model;

final class AmazonMwsAccountsPanEu extends Model
{
    protected $connection = 'live_site';

    public $timestamps = false;

    protected $table = 'amazon_mws_accounts_pan_eu';

    protected $primaryKey = 'mws_id';

    protected $fillable = [
        'mws_id',
        'mws_domain_id',
        'mws_account_name',
        'marketplace_emails',
        'mws_seller_id',
        'mws_access_key',
        'mws_secret_key',
        'mws_auth_token',
        'lwa_client_id',
        'lwa_client_secret',
        'lwa_refresh_token',
        'aws_access_key_id',
        'aws_secret_access_key',
        'role_arn',
        'endpoint',
        'mws_status',
        'mws_created_by',
        'mws_updated_by',
        'mws_created_date',
        'mws_modified_date',
        'mws_dom_group_id',
        'mws_reporting_status',
        'mws_is_pan_eu',
        'mws_show_projection',
        'mws_is_fbm_listing',
        'cron_product_sync_status',
        'cron_inventory_report_status',
        'cron_amazon_refund',
        'cron_asin_price_status',
        'cron_order_sync_status',
        'cron_order_sync_back_date_status',
        'cron_sp_api_business_ST_report',
        'cron_finance_data_report',
        'mws_projection_for_days',
    ];
}
