<?php

declare(strict_types=1);

namespace App\Models\Backend;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

final class Stock extends Model
{
    protected $connection = 'backend_mysql';

    public $timestamps = false;

    protected $primaryKey = 'stockid';

    protected $table = 'stock';

    protected $fillable = [];

    // * helper method

    public static function getUnitPriceFromStock(string $stockCode): int|float
    {
        return self::where('productid', $stockCode)->value('unit_price') ?? 0;
    }
}
