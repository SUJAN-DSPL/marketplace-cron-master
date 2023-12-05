<?php

namespace App\Services\AmazonSpApi;

use Carbon\Carbon;

class OrderApiService extends AuthApiService
{
    public function getOrders(
        $marketPlaceId,
        $createdAfter,
        $createdBefore = null,
        $orderStatuses = null,
        $maxResultPerPage = null,
        string $nextToken = null
    ) {
        $response = $this->fetch()->withQueryParameters([
            'MarketplaceIds' => !$nextToken ? $marketPlaceId : null,
            'CreatedAfter' => !$nextToken ? $createdAfter : null,
            'CreatedBefore' => !$nextToken ? $createdBefore : null,
            'OrderStatuses' => !$nextToken ? $orderStatuses : null,
            'MaxResultPerPage' => !$nextToken ? $maxResultPerPage : null,
            'NextToken' => $nextToken,
        ])->get($this->spApiHost . "/orders/v0/orders");


        if ($response->getStatusCode() != 200) $this->throwAmazonError($response);

        $orders = $response->json()['payload']['Orders'];

        $isIssetNextToken = isset($response->json()['payload']['NextToken']);
        $nextToken = $isIssetNextToken ? $response->json()['payload']['NextToken'] : null;

        return $this->response(['orders' => $orders, 'nextToken' => $nextToken]);
    }

    public function getOrderItems($orderId)
    {
        $response = $this->fetch()->withUrlParameters([
            'endpoint' => $this->spApiHost,
            'orderId' => $orderId,
        ])->get('{+endpoint}//orders/v0/orders/{orderId}/orderItems');

        if ($response->getStatusCode() != 200) $this->throwAmazonError($response);

        $orderItems = $response['payload']['OrderItems'];

        return $this->response(['orderItems' => $orderItems]);
    }

    public function getOrderById(string $orderId)
    {
        $response = $this->fetch()->withUrlParameters([
            'endpoint' => $this->spApiHost,
            'orderId' => $orderId,
        ])->get('{+endpoint}//orders/v0/orders/{orderId}');

        if ($response->getStatusCode() != 200) $this->throwAmazonError($response);

        return $response->json()['payload'];
    }
}
