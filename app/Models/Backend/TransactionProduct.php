<?php

declare(strict_types=1);

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

final class TransactionProduct extends Model
{
    protected $connection = 'backend_mysql';

    public $timestamps = false;

    protected $primaryKey = 'id';

    protected $table = 'transaction_product';

    protected $fillable = [];
}
