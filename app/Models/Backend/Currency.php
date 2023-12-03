<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $connection = 'backend_mysql';
    protected $table = 'currencies';

    public $timestamps = false;

    // * helpers

    public static function convertIntoGBP($currencyName, $amount)
    {
        return round((self::where('currency_name', $currencyName)->first()->exchange_rate * $amount), 2);
    }
}
