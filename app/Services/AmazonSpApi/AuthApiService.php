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
            config("amazon_sp_api.lwa_clinet_id"),
            config("amazon_sp_api.lwa_clinet_secret"),
        );

        $this->spApiHost = config("amazon_sp_api.host");
    }

    public function getAuthToken(
        string $lwaRefreshToken,
        string $lwaClientId,
        string $lwaClientSecret
    ) {
        try {
            $response =  Http::post(
                config("amazon_sp_api.auth_token_host") . "/auth/o2/token",
                [
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $lwaRefreshToken,
                    'client_id' => $lwaClientId,
                    'client_secret' => $lwaClientSecret
                ]
            );

            $resposeData = $response->json();
            return $resposeData['access_token'];
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function fetch()
    {
        return  Http::withHeaders(['x-amz-access-token' => $this->authToken]);
    }

    // * common helper methods

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

    public function tryCatch(callable $callBack)
    {
        try {
            return $callBack();
        } catch (\Throwable $th) {
            $errorMethod = $th->getTrace()[0]['function'] ?? 'N/A';
            $errorLine = $th->getLine();
            $errorClass = $th->getFile();
            $errorMessage = $th->getMessage();

            dump("Error in method: $errorMethod");
            dump("line: $errorLine");
            dump("class: $errorClass");
            dump("error message: $errorMessage");

            throw new BadRequestException($th->getMessage() ?? "internal server error");
        }
    }
}
