# Moala SDK for PHP

The Moala SDK for PHP enables developers to easily integrate Moala API functionality into their PHP applications. This SDK supports several operations such as balance checks, transactions checks, KYC checks, cashout, and cash-in.

## Prerequisites

- PHP 7.2 or higher
- Composer to manage dependencies

## Installation

You can install the SDK via Composer. Add the SDK to your project using the following command:

bash
```composer require bitkap/php-moala ```

## Configuration
To use the SDK, you need an API key and a secret key supplied by Moala. Here's how to configure and initialize the SDK:

```
use MoalaSDK\MoalaClient;

$base_url = "https://api.moala.africa";
$appKey = "cfa3a138-47c3-4f86-9fda";
$secretKey = "cfa3a138-47c3-4f86-9fda-d4dds3434";

$client = new MoalaClient($base_url, $appKey, $secretKey);
```

# Use

## Checking the scale
```
$balance = $client->balance();
print_r($balance);
```

## Transaction verification
```
$transaction = $client->checkTransaction($partnerId);
print_r($transaction);
```

## KYC verification
```
$kyc = $client->kyc($phoneNumber, $serviceCode);
print_r($kyc);
```

## Make a cashin
```
$cashin = $client->cashin($phoneNumber, $serviceCode, $amount, $partnerId);
print_r($cashin);
```

## Make a cashout
```
$cashout = $client->cashout($phoneNumber, $serviceCode, $amount, $partnerId);
print_r($cashout);
```

# Error handling
Each method can raise an exception in the event of a query error. Errors are returned as an array containing the error message.

# Support
If you have any questions or problems, please open an issue in our [GitHub repository](https://github.com/bitkap/php-moala/issues).

# Contribution
Contributions to this project are welcome. You can contribute by improving the code, documentation or reporting bugs.
