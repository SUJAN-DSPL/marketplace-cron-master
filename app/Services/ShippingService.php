<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Backend\Currency;
use App\Contracts\ShippingContract;
use App\Models\Backend\ShippingMaster;
use App\Models\Backend\AmazonShippingRule;
use App\Models\Backend\ShippingMasterCountry;
use App\Models\Backend\ShippingMasterExcludedDomain;

final class ShippingService implements ShippingContract
{
    public function getCountryBaseShippingIds(
        int $countryId,
        int $domainId
    ): array {
        $shippingMasterExcludedDomains = ShippingMasterExcludedDomain::where('smed_dom_id', $domainId)
            ->pluck('smed_sm_id', 'smed_id')
            ->toArray();

        return ShippingMasterCountry::join('shipping_master', 'shipping_master_countries.smc_shipping_master_id', '=', 'shipping_master.shipping_master_id')
            ->whereNotIn('shipping_master_id', $shippingMasterExcludedDomains)
            ->select(['smc_id', 'smc_shipping_master_id'])
            ->where([
                'smc_country_id' => $countryId,
                'sm_status' => 'Y',
            ])
            ->groupBy('shipping_master_id')
            ->pluck('smc_shipping_master_id', 'smc_id')
            ->toArray();
    }

    public function getCountryBaseShippingCost(
        int $countryId,
        int $shippingId,
        int $currencyId
    ): float|int {
        $shippingMasterCountry = ShippingMasterCountry::select(['smc_cost', 'smc_shipping_master_id'])
            ->where('smc_country_id', $countryId)
            ->where('smc_shipping_master_id', $shippingId)
            ->first();

        $exchangeRate = Currency::select('exchange_rate')
            ->where('currency_id', $currencyId)
            ->first();

        if (!empty($shippingMasterCountry)) {
            return $shippingMasterCountry->smc_cost / $exchangeRate->exchange_rate;
        }

        return 0;
    }

    public function getShippingDetailsByChannel(
        string $channel,
        bool $isPrime,
        string $shipmentServiceLevelCategory,
        int $countryId,
        int|float $orderTotal,
    ): ShippingMaster {
        if ($isPrime) {
            $rulePrimeOrder = ['0,2'];
        } else {
            $rulePrimeOrder = ['0,1'];
        }

        $amazonShippingRule = AmazonShippingRule::whereIn('rule_prime_order', $rulePrimeOrder)
            ->where('rule_order_type', $channel)
            ->when(
                $channel == 'AFN',
                fn ($q) => $q->where('rule_country_id', 'All')
                    ->where('rule_shipping_type', 'All'),
            )
            ->when(
                $channel == 'MFN',
                fn ($q) => $q->whereRaw("FIND_IN_SET($countryId,rule_country_id)")
                    ->where('rule_shipping_type', $shipmentServiceLevelCategory)
                    ->where('rule_amount_greater_than', '<', $orderTotal),
            )->first(['rule_shipping_id']);

        $shippingMaster = ShippingMaster::find($amazonShippingRule->rule_shipping_id, ['shipping_master_id', 'sm_courier_id', 'sm_name']);

        return $shippingMaster;
    }
}
