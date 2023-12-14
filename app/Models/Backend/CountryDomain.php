<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

final class CountryDomain extends Model
{
    protected $connection = 'backend_mysql';

    public $timestamps = false;

    protected $table = 'country_domain';

    protected $primaryKey = 'cntryd_id';
}
