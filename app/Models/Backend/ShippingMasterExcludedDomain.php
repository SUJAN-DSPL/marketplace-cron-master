<?php

declare(strict_types=1);

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

final class ShippingMasterExcludedDomain extends Model
{
    protected $connection = 'backend_mysql';

    public $timestamps = false;

    protected $primaryKey = 'smed_id';

    protected $table = 'shipping_master_excluded_domains';

    protected $fillable = [];
}
