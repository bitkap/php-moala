<?php

namespace MoalaSDK;

$config = require 'config.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use BaseHandle\BaseHandle;

class MoalaClient extends BaseHandle{
    protected $httpClient;
    protected $appKey;
    protected $secretKey;
    protected $base_uri;

    public function __construct(string $base_url, string $appKey, string $secretKey)
    {
        $this->base_uri = $base_url;
        $this->appKey = $appKey;
        $this->secretKey = $secretKey;
        $this->httpClient = new Client([
            'base_uri' => $this->base_uri
        ]);
    }

    public function balance()
    {
        try {
            $LACCESS_SIGN = $this->generateHmacSha256Hex(time()."GET/v1/api/balance", $this->secretKey );
            $response = $this->httpClient->get('v1/api/balance', [
                'headers' => [
                    'LP-ACCESS-SIGN' => $LACCESS_SIGN,
                    'LP-ACCESS-KEY' => $this->appKey ,
                    'Content-Type' => 'application/json',
                    'LP-ACCESS-TIMESTAMP' => ''.time(),
                ],
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            return [
                'error' => $e->getMessage()
            ];
        }
    }

    public function checkTransaction($partnerId)
    {
        try {
            $LACCESS_SIGN = $this->generateHmacSha256Hex(time()."GET/v1/api/transaction/check/".$partnerId, $this->secretKey );
            $response = $this->httpClient->get('/v1/api/transaction/check/'.$partnerId, [
                'headers' => [
                    'LP-ACCESS-SIGN' => $LACCESS_SIGN,
                    'LP-ACCESS-KEY' => $this->appKey ,
                    'Content-Type' => 'application/json',
                    'LP-ACCESS-TIMESTAMP' => ''.time(),
                ],
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            return [
                'error' => $e->getMessage()
            ];
        }
    }

    public function kyc(string $phoneNumber, string $serviceCode)
    {
        try {
            $LACCESS_SIGN = $this->generateHmacSha256Hex(time()."GET/v1/api/kyc/".$serviceCode."/".$phoneNumber, $this->secretKey );
            $response = $this->httpClient->get('/v1/api/kyc/'.$serviceCode."/".$phoneNumber, [
                'headers' => [
                    'LP-ACCESS-SIGN' => $LACCESS_SIGN,
                    'LP-ACCESS-KEY' => $this->appKey ,
                    'Content-Type' => 'application/json',
                    'LP-ACCESS-TIMESTAMP' => ''.time(),
                ],
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            return [
                'error' => $e->getMessage()
            ];
        }
    }

    public function cashout(string $phoneNumber, string $serviceCode, int $amount, $partnerId)
    {
        try {
            $data   = ["amount"=>$amount,"transactionType" => "deposit","serviceCode"=>$serviceCode,"phoneNumber"=>$phoneNumber,"partnerId"=>$partnerId];
            $LACCESS_SIGN = $this->generateHmacSha256Hex(time()."POST/v1/api/transaction/payment".json_encode($data), $this->secretKey ); 

            $response = $this->httpClient->post('/v1/api/transaction/payment', [
                'headers' => [
                    'LP-ACCESS-SIGN' => $LACCESS_SIGN,
                    'LP-ACCESS-KEY' => $this->appKey ,
                    'Content-Type' => 'application/json',
                    'LP-ACCESS-TIMESTAMP' => ''.time(),
                ],
                'json' => $data 
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            return [
                'error' => $e->getMessage()
            ];
        }
    }

    public function cashin(string $phoneNumber, string $serviceCode, int $amount, $partnerId)
    {
        try {
            $data = ["amount"=>$amount,"transactionType" => "withdrawal","serviceCode"=>$serviceCode,"phoneNumber"=>$phoneNumber,"partnerId"=>$partnerId];
            $LACCESS_SIGN = $this->generateHmacSha256Hex(time()."POST/v1/api/transaction/withdrawal".json_encode($data), $this->secretKey ); 

            $response = $this->httpClient->post('/v1/api/transaction/withdrawal', [
                'headers' => [
                    'LP-ACCESS-SIGN' => $LACCESS_SIGN,
                    'LP-ACCESS-KEY' => $this->appKey ,
                    'Content-Type' => 'application/json',
                    'LP-ACCESS-TIMESTAMP' => ''.time(),
                ],
                'json' => $data 
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            return [
                'error' => $e->getMessage()
            ];
        }
    }
}

?>