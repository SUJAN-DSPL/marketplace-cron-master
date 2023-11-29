<?php

namespace App\Services\AmazonSpApi;

use Symfony\Component\HttpFoundation\Exception\BadRequestException;


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
        try {
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
        } catch (\Throwable $th) {
            //throw $th;
            throw new BadRequestException($th->getMessage() ?? "internal server error");
        }
    }

    public function getOrderById(string $orderId)
    {
        try {
            $response = $this->fetch()->get($this->spApiHost . "/orders/v0/orders/$orderId");
            return $response->json();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
