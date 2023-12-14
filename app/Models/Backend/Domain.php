<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

final class Domain extends Model
{
    protected $connection = 'backend_mysql';

    public $timestamps = false;

    protected $table = 'domains';

    // * helper methods

    public static function getCurrencyIdFromDomain(int $domainId): int
    {
        return self::where('id', $domainId)->value('currency_id');
    }
}
