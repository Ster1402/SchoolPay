<?php
 namespace App\Http\Controllers\API;
 use GuzzleHttp\Client;

 class MoMoAPI{

//show guzzle
//show uuid generator
// get access token


 public function getToken(){

    $user_id = 'xxxxxxxxxxxxxxxxxxxxxxxxx';
    $api_key = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
    $token_url = 'https://ericssonbasicapi1.azure-api.net/collection/token/';

    $client = new Client();

    try {
        $response = $client->request('POST', $token_url, [
            'headers' => [
                'Authorization' => 'Basic '.base64_encode($user_id.':'.$api_key),
                'Ocp-Apim-Subscription-Key' => 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'
            ],
            'json' => [
                'grant_type' => 'client_credentials',
            ],
        ]);

       $data =  json_decode($response->getBody(), true);

       return $data['access_token'];

    } catch (RequestException $ex) {
        throw new CollectionRequestException('Unable to get token.', 0, $ex);
    }

 }

    // transaction request

        public function requestPayment($token, $partyId, $amount, $payerMessage = '', $payeeNote = '')
 {
    $momoTransactionId =   sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
    // 32 bits for "time_low"
    mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

    // 16 bits for "time_mid"
    mt_rand( 0, 0xffff ),

    // 16 bits for "time_hi_and_version",
    // four most significant bits holds version number 4
    mt_rand( 0, 0x0fff ) | 0x4000,

    // 16 bits, 8 bits for "clk_seq_hi_res",
    // 8 bits for "clk_seq_low",
    // two most significant bits holds zero and one for variant DCE1.1
    mt_rand( 0, 0x3fff ) | 0x8000,

    // 48 bits for "node"
    mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
);
     $environment = 'mtncameroon';
     $transaction_url = 'https://ericssonbasicapi1.azure-api.net/collection/v1_0/requesttopay';
     $transactionId = rand(0,9);
     $currency = 'XAF';
     $partyIdType = 'MSISDN';
     $client = new Client();


     $headers = [
         'X-Reference-Id' => $momoTransactionId,
         'X-Target-Environment' => $environment,
         'Authorization' => 'Bearer ' . $token,
          'X-Callback-Url' => 'xxxxxxxxxxxxxxxxxxxxxxxxxxxx',
         'Content-Type' => 'application/json',
         'Ocp-Apim-Subscription-Key' => 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'

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
 public function getTransactionStatus($momoTransactionId , $token)
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
                 'Ocp-Apim-Subscription-Key' => 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'
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

    public function isActive($token, $partyId, $partyIdType = null)
    {
        $partyIdType = 'MSISDN';
        $environment = 'mtncameroon';
        $client = new Client();
        $accountStatus_url = 'https://ericssonbasicapi1.azure-api.net/collection/v1_0/accountholder/{partyIdType}/{partyId}/active';

        if (is_null($partyIdType)) {
            $partyIdType = $partyIdType;
        }

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
                 'X-Target-Environment' => $environment,
                 'Authorization' => 'Bearer ' . $token,
                 'Ocp-Apim-Subscription-Key' => 'xxxxxxxxxxxxxxxxxxxxx'
                ],
            ]);

            $body = json_decode($response->getBody(), true);

            return (bool) $body['result'];
        } catch (RequestException $ex) {
            throw new CollectionRequestException('Unable to get user account information.', 0, $ex);
        }
    }


}



?>
