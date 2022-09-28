<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;


class SmsController extends Controller
{

    public static function getPhoneNumbers($student, $payer)
    {
        return $student === $payer ? "237$student" : "237$student,237$payer";
    }

    public static function sendSms($studentPhoneNumber,
                                   $payerPhoneNumber,
                                   $schoolName,
                                   $registerNumber,
                                   $studentName,
                                   $universityRight,
                                   $amount
    )
    {

        $datetime = Carbon::now()->toDateTimeString();
        $username = 'makaebenezer@yahoo.fr';
        $SendSms_url = 'https://smsvas.com/bulk/public/index.php/api/v1/sendsms';
        $password = 'ecoleenspd2022';
        $senderid = 'SchoolPay';
        $mobiles = self::getPhoneNumbers($studentPhoneNumber, $payerPhoneNumber);
        $sms = "Paiement des droits universitaires ({$universityRight}) de l'étudiant {$studentName} ({$registerNumber}) effectué par {$payerPhoneNumber} le {$datetime}.\nMontant: {$amount} , Frais: 100 FCFA.\n\nInstitut universitaire: {$schoolName}.";

        $client = new Client([
            "base_uri" => $SendSms_url
        ]);

        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];

        try {
            $response = $client->request('POST', $SendSms_url, [
                'headers' => $headers,
                'json' => [
                    'username' => $username,
                    'password' => $password,
                    'senderid' => $senderid,
                    'sms' => $sms,
                    'mobiles' => $mobiles,
                ],
            ]);

        } catch (RequestException $ex) {
        }

    }

}
