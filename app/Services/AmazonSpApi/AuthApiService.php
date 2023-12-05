<?php

namespace App\Services\AmazonSpApi;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class AuthApiService
{
    public $authToken;
    public $spApiHost;

    public function __construct()
    {
        $this->authToken = $this->getAuthToken(
            config("amazon_sp_api.lwa_refresh_token"),
            config("amazon_sp_api.lwa_client_id"),
            config("amazon_sp_api.lwa_client_secret"),
        );

        $this->spApiHost = config("amazon_sp_api.host");
    }

    public function getAuthToken(
        string $lwaRefreshToken,
        string $lwaClientId,
        string $lwaClientSecret
    ) {

        $response =  Http::post(
            config("amazon_sp_api.auth_token_host") . "/auth/o2/token",
            [
                'grant_type' => 'refresh_token',
                'refresh_token' => $lwaRefreshToken,
                'client_id' => $lwaClientId,
                'client_secret' => $lwaClientSecret
            ]
        );

        if ($response->getStatusCode() != 200) {
            throw new BadRequestException($response->json()['error_description']);
        }

        $responseData = $response->json();
        return $responseData['access_token'];
    }

    // * common helper methods

    public function fetch()
    {
        return  Http::withHeaders(['x-amz-access-token' => $this->authToken]);
    }

    public function getEncodeURIComponent(string $data)
    {
        return str_replace('+', '%20', rawurlencode($data));
    }

    public function response(array $data)
    {
        return (object)$data;
    }

    public function throwAmazonError(Response $response)
    {
        throw new BadRequestException($response->json()['errors'][0]['message']);
    }
}
