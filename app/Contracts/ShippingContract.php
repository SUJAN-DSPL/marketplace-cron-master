<?php

declare(strict_types=1);

namespace App\Contracts;

use App\Models\Backend\ShippingMaster;

interface ShippingContract
{
    public function getCountryBaseShippingIds(
        int $countryId,
        int $domainId
    ): array;

    public function getCountryBaseShippingCost(
        int $countryId,
        int $shippingId,
        int $currencyId
    ): float|int;

    public function getShippingDetailsByChannel(
        string $channel,
        bool $isPrime,
        string $shipmentServiceLevelCategory,
        int $countryId,
        int|float $orderTotal,
    ): ShippingMaster;
}
