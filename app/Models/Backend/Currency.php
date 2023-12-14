<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $connection = 'backend_mysql';
    protected $table = 'currencies';
    protected $primaryKey = 'currency_id';
    public $timestamps = false;

    // * helpers

    public static function convertIntoGBP($currencyName, $amount)
    {
        return round((self::where('currency_name', $currencyName)->first()->exchange_rate * $amount), 2);
    }

    public static function getExchangeRateFromDomain(int $domainId): int|float
    {
        return self::join('domains as d', 'currencies.currency_id', '=', 'd.currency_id')
            ->select('currencies.exchange_rate')
            ->where('d.id', $domainId)
            ->value('currencies.exchange_rate');
    }

    public static function getCurrencyFromId(int $currency_id): ?Currency
    {
        return self::find($currency_id) ?? null;
    }
}
