<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;


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

        $datetime = now()->toDateTimeString();

        $client = new Client();

        $sms = "Paiement des droits universitaires ($universityRight) de l'étudiant $studentName ($registerNumber) effectué par $payerPhoneNumber le $datetime.\nMontant: $amount , Frais: 100 FCFA.\n\nInstitut universitaire:$schoolName.";

        $response = $client->request('POST',
            'https://smsvas.com/bulk/public/index.php/api/v1/sendsms',
            [
                'form_params' => [
                    'username' => 'makaebenezer@yahoo.fr',
                    'password' => 'ecoleenspd2022',
                    'senderid' => 'SchoolPay',
                    'sms' => $sms,
                    'mobiles' => self::getPhoneNumbers($studentPhoneNumber, $payerPhoneNumber)
                ]
            ]
        );

    }

}
