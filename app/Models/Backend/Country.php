<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Country extends Model
{
    protected $connection = 'backend_mysql';

    public $timestamps = false;

    protected $table = 'countries';

    protected $primaryKey = 'country_id';

    public function countryDomain(): HasOne
    {
        return $this->hasOne(
            related: CountryDomain::class,
            foreignKey: 'cntryd_cntry_id',
            localKey: 'country_id'
        );
    }

    // * helper methods

    public static function getCountry(string $country_code, int $domain_id): ?Country
    {
        return self::with(relations: [
            'countryDomain' => fn ($q) => $q->select([
                'cntryd_id', 'cntryd_cntry_id', 'cntryd_domain_id', 'cntryd_ship_id',
            ])->where('cntryd_domain_id', $domain_id),
        ])->whereCountryCode($country_code)
            ->first(['country_id', 'name', 'country_code', 'country_id']) ?? null;
    }

    public static function getCountryIdFromCountryCode(string $country_code): ?int
    {
        return self::whereCountryCode($country_code)->value('country_id') ?? 0;
    }

    public static function getCountryIdFromCode(string $countryCode = ''): mixed
    {
        return Country::where([
            'country_code' => $countryCode,
            'country_status' => 'Y',
        ])->first()->value('country_id') ?? 0;
    }
}
