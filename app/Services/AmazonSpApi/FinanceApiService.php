<?php

namespace App\Services\AmazonSpApi;

use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class FinanceApiService extends AuthApiService
{
    const FINANCIAL_EVENT_NAMES = [
        "ShipmentEventList",

        // "ShipmentSettleEventList",
        // "ServiceFeeEventList",
        // "AdjustmentEventList",
        // "RemovalShipmentEventList",

        "RefundEventList",
        "RetrochargeEventList",
        "RentalTransactionEventList",
        "ServiceFeeEventList"
    ];

    public function getFinancialEventsData(
        array $financialEventNames,
        string $postedAfter = null,
        string $postedBefore = null,
        string $nextToken = null
    ) {
        $this->validateFinancialEventNames($financialEventNames);

        $response = $this->fetch()->withQueryParameters([
            'PostedAfter' => !$nextToken ? $postedAfter : null,
            'postedBefore' => !$nextToken ? $postedBefore : null,
            'NextToken' => $nextToken,
        ])->get($this->spApiHost . "/finances/v0/financialEvents");

        if ($response->getStatusCode() != 200) $this->throwAmazonError($response);

        $financialEvents = $response->json()['payload']['FinancialEvents'];
        $financialEvents = array_intersect_key($financialEvents, array_flip($financialEventNames));

        $isSetNextToken = isset($response->json()['payload']['NextToken']);
        $nextToken = $isSetNextToken ? $response->json()['payload']['NextToken'] : null;

        return $this->response(['nextToken' => $nextToken, 'financialEvents' => $financialEvents]);
    }

    public function getFinancesByOrderId(string $orderId)
    {
        $response = $this->fetch()->withUrlParameters([
            'endpoint' => $this->spApiHost,
            'orderId' => $orderId,
        ])->get('{+endpoint}/finances/v0/orders/{orderId}/financialEvents');

        if ($response->getStatusCode() != 200) $this->throwAmazonError($response);

        return $response->json()['payload']["FinancialEvents"];
    }

    // * helpers methods 

    public function validateFinancialEventNames(array $names): void
    {
        if (count(array_intersect(self::FINANCIAL_EVENT_NAMES, $names)) !== count($names)) {
            throw new BadRequestException('Invalid Financial Event Name');
        }
    }
}
