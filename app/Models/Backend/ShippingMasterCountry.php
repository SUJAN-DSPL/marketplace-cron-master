<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

final class ShippingMasterCountry extends Model
{
    protected $connection = 'backend_mysql';

    protected $table = 'shipping_master_countries';

    protected $primaryKey = 'smc_id';

    public $timestamps = false;
}
