<?php

declare(strict_types=1);

namespace App\Models\Amazon;

use Illuminate\Database\Eloquent\Model;

final class AmazonApiCall extends Model
{
    protected $connection = 'live_site';

    public $timestamps = false;

    protected $primaryKey = 'apc_id';

    protected $table = 'amazon_api_calls';

    protected $fillable = [
        'apc_marketplace_id',
        'apc_ReportType',
        'apc_ReportName',
        'apc_Acknowledged',
        'apc_ReportId',
        'apc_ReportRequestId',
        'apc_reportDocumentId',
        'apc_AvailableDate',
        'apc_added_date',
        'apc_Updated_date',
        'apc_Ordered',
        'apc_live_status',
        'old_live_status',
        'apc_is_updated',
    ];
}
