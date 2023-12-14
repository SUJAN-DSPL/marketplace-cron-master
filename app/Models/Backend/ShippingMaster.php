<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

final class ShippingMaster extends Model
{
    protected $connection = 'backend_mysql';

    protected $table = 'shipping_master';

    protected $primaryKey = 'shipping_master_id';

    public $timestamps = false;
}
