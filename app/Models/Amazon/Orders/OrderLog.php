<?php

declare(strict_types=1);

namespace App\Models\Amazon\Orders;

use Illuminate\Database\Eloquent\Model;

final class OrderLog extends Model
{
    protected $connection = 'live_site';

    public $timestamps = false;

    protected $primaryKey = 'id';

    protected $table = 'order_log';

    protected $fillable = [
        'order_id',
        'order_status',
        'description',
        'date',
        'processed_by',
        'processed_by_supp',
        'type',
        'order_suspended_reason',
    ];
}
