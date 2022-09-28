<?php

namespace App\Http\Controllers\API;

use Bmatovu\MtnMomo\Exceptions\CollectionRequestException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class MoMoAPI
{

    public function getToken()
    {

        //get the uuid

        //   // $user_id = '2fd1bafb-c339-4fa1-9120-8b3f273c3100';
        //   // $api_key = 'ded4ecdb630747d89e793079d07a6132';
        //Double comment above added by Lesly - (Was already comment - I just doubled)

        // $user_id = '8465753f-30cd-4f54-95f4-fb087fe0a974';
        // $api_key = '6c465030814d46958f14fa92f06a13aa';
        // single comment above added by me. (Minesec API credentials)

        $user_id = '4143629f-ce1d-40a0-bfba-ff5459994cd0';
        $api_key = '014e348ff77c4afa921cd3e54c703588';

        $token_url = 'https://ericssonbasicapi1.azure-api.net/collection/token/';
        $client = new Client();
        try {
            $response = $client->request('POST', $token_url, [
                'headers' => [
                    'Authorization' => 'Basic ' . base64_encode($user_id . ':' . $api_key),
                    'Ocp-Apim-Subscription-Key' => 'bafb0c8076434928b36d83699e8fd2bd'
                ],
                'json' => [
                    'grant_type' => 'client_credentials',
                ],
            ]);

            $data = json_decode($response->getBody(), true);

            return $data['access_token'];

        } catch (RequestException $ex) {
            throw new CollectionRequestException('Unable to get token.', 0, $ex);
        }

    }

    // transaction request

    public function requestPayment($token, $partyId, $amount, $payerMessage = '', $payeeNote = '')
    {
        $momoTransactionId = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            random_int(0, 0xffff), random_int(0, 0xffff),

            // 16 bits for "time_mid"
            random_int(0, 0xffff),

            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            random_int(0, 0x0fff) | 0x4000,

            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            random_int(0, 0x3fff) | 0x8000,

            // 48 bits for "node"
            random_int(0, 0xffff), random_int(0, 0xffff), random_int(0, 0xffff)
        );
        $environment = 'mtncameroon';
        $transaction_url = 'https://ericssonbasicapi1.azure-api.net/collection/v1_0/requesttopay';
        $transactionId = random_int(100000, 900000);
        $currency = 'XAF';
        $partyIdType = 'MSISDN';
        $client = new Client();

        $headers = [
            'X-Reference-Id' => $momoTransactionId,
            'X-Target-Environment' => $environment,
            'Authorization' => 'Bearer ' . $token,
            'X-Callback-Url' => 'https://schoolpay.cm/callback.php',
            'Content-Type' => 'application/json',
            'Ocp-Apim-Subscription-Key' => 'bafb0c8076434928b36d83699e8fd2bd'
        ];

        try {
            $client->request('POST', $transaction_url, [
                'headers' => $headers,
                'json' => [
                    'amount' => $amount,
                    'currency' => $currency,
                    'externalId' => $transactionId,
                    'payer' => [
                        'partyIdType' => $partyIdType,
                        'partyId' => $partyId,
                    ],
                    'payerMessage' => $payerMessage,
                    'payeeNote' => $payeeNote,
                ],

                'verify' => false,
                'connect_timeout' => '259',
                'timeout ' => '259'
            ]);

            return $momoTransactionId;
        } catch (RequestException $ex) {
            throw new CollectionRequestException('Request to pay transaction - unsuccessful.', 0, $ex);
        }
    }

    //get transaction status
    public function getTransactionStatus($momoTransactionId, $token)
    {
        $environment = 'mtncameroon';
        $transactionStatus_url = 'https://ericssonbasicapi1.azure-api.net/collection/v1_0/requesttopay/{momoTransactionId}';
        $transactionStatus_url = str_replace('{momoTransactionId}', $momoTransactionId, $transactionStatus_url);
        $client = new Client();

        try {
            $response = $client->request('GET', $transactionStatus_url, [
                'headers' => [
                    'X-Target-Environment' => $environment,
                    'Authorization' => 'Bearer ' . $token,
                    'Ocp-Apim-Subscription-Key' => 'bafb0c8076434928b36d83699e8fd2bd'
                ],
                'connect_timeout' => '259',
                'timeout ' => '259',
                'verify' => false
            ]);
            //return json_decode($response);

            return json_decode($response->getBody(), true);
        } catch (RequestException $ex) {
            throw new CollectionRequestException('Unable to get transaction status.', 0, $ex);
        }
    }

    //get account balance
    public function getAccountBalance()
    {
        $client = new Client();
        $accountBalance_url = 'https://ericssonbasicapi1.azure-api.net/collection/v1_0/account/balance';
        $environment = 'mtncameroon';
        try {
            $response = $client->request('GET', $accountBalance_url, [
                'headers' => [
                    'X-Target-Environment' => $environment,
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (RequestException $ex) {
            throw new CollectionRequestException('Unable to get account balance.', 0, $ex);
        }
    }

//check if number is a momo number

    public function isActive($token, $partyId)
    {
        $partyIdType = 'MSISDN';
        $environment = 'mtncameroon';
        $client = new Client();
        $accountStatus_url = 'https://ericssonbasicapi1.azure-api.net/collection/v1_0/accountholder/{partyIdType}/{partyId}/active';

        $patterns = $replacements = [];

        $patterns[] = '/(\{\bpartyIdType\b\})/';
        $replacements[] = strtolower($partyIdType);

        $patterns[] = '/(\{\bpartyId\b\})/';
        $replacements[] = urlencode($partyId);

        $accountStatusUri = preg_replace($patterns, $replacements, $accountStatus_url);

        try {
            $response = $client->request('GET', $accountStatusUri, [
                'headers' => [
                    'X-Target-Environment' => $environment,
                    'Authorization' => 'Bearer ' . $token,
                    'Ocp-Apim-Subscription-Key' => 'bafb0c8076434928b36d83699e8fd2bd'
                ],
            ]);

            $body = json_decode($response->getBody(), true);

            return (bool)$body['result'];
        } catch (RequestException $ex) {
            throw new CollectionRequestException('Unable to get user account information.', 0, $ex);
        }
    }

}




