<?php

declare(strict_types=1);

namespace App\Contracts;

interface ProductContract
{
    public function getMatchingProducts(
        array $order,
        array $items,
        string $sellerAcId,
        string $marketPlaceId
    );
}
