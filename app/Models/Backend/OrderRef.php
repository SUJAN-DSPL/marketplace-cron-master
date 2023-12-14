<?php

declare(strict_types=1);

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

final class OrderRef extends Model
{
    protected $connection = 'backend_mysql';

    public $timestamps = false;

    protected $primaryKey = 'ref_id';

    protected $table = 'order_ref_no';

    protected $fillable = [
        'ref_id',
    ];
}
