<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmazonMwsAccountPanEu extends Model
{
    use HasFactory;

    protected $connection = 'backend_mysql';
    protected $table = 'amazon_mws_accounts_pan_eu';

    public $timestamps = false;
   
    // * Accessors

    public function getMwsDomainIdsAttribute()
    {
        return $this->mws_domain_id;
    }


    // * helpers

    public static function getMarketIdByDomainId($domainId)
    {
        $marketId = self::query()
            ->where('mws_domain_id', "LIKE", "%$domainId,%")
            ->first()
            ?->mws_marketplace_id;

        $marketId = $marketId ?? AmazonMwsAccountPanEu::query()
            ->where('mws_domain_id', "LIKE", "%$domainId%")
            ->first()
            ?->mws_marketplace_id;

        return $marketId;
    }
}
