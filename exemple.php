<?php
require_once 'vendor/autoload.php';
use MoalaSDK\MoalaClient;

$base_url = "https://api.moala.africa";
$appKey  = "a0263e22-f42a-4f5d-945b-ac4670a598939";
$secretKey = "c0fd3d1b2ff54056920bc4670a598939";
$partnerId = 'c4670a598939';

$client = new MoalaClient($base_url, $appKey, $secretKey);

$balance = $client->balance();
print_r($balance);

$kyc = $client->kyc("697040926", "PAIEMENTMARCHAND_ORANGE_CM");
print_r($kyc);

$cashin = $client->cashin("697040926", "CASHIN_ORANGE_CM", 99, $partnerId);
print_r($cashin);

$cashout = $client->cashout("697040926", "PAIEMENTMARCHAND_ORANGE_CM", 100, $partnerId);
print_r($cashout);

$transaction = $client->checkTransaction($partnerId);
print_r($transaction);