<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class MoMoController extends Controller
{
    //Class to communicate with MoMo API
    public static function makePayment(Request $request): bool
    {
        $attributes = $request->validate([
            'student_id' => ['required', Rule::exists('students', 'id')],
            'registerNumber' => ['required', Rule::exists('students', 'registerNumber')],
            'payerName' => ['required', 'min:3', 'max:255'],
            'payerIDCard' => ['required', 'integer', 'min:100'],
            'payerPhoneNumber' => ['required', 'min:9', 'max:9', 'starts_with:6'],
            'type' => ['required'],
            'amount' => ['required', 'integer']
        ]);

        $student = Student::firstWhere('user_id', Auth::id());
        $school = $student->discipline->school;
        $amount = $attributes['amount'];
        $payerPhoneNumber = $attributes['payerPhoneNumber'];
        $charge = 0;
        // get the charges based on the amount paid
        if ($amount <= 10000) {
            $charge = 200;
        } elseif (($amount > 10000) && ($amount <= 30000)) {
            $charge = 300;
        } elseif ($amount > 30000) {
            $charge = 500;
        }

        $date_of_payment = now();

        $means = 'MTNC';
        $channel_used = 'SchoolPay WEB';

        // call the mobile money API
        $mtn_momo = new MoMoAPI();

        //check if number is active
        $tel = '237' . $payerPhoneNumber;
        //get token
        $token = $mtn_momo->getToken();

        //do a request payment
        //  $amt = $amount; TODO: Make the real payment + charge
        $amt = 1;
        $payment = $mtn_momo->requestPayment($token, $tel, $amt);
        request('transactionID', $payment);
        //check if payment response is 200 first
        $payment_status_raw = $mtn_momo->getTransactionStatus($payment, $token);
        $payment_status = $payment_status_raw['status'];
        $payer_details = $payment_status_raw['payer'];
        // $tel = $payer_details['partyId'];
        // $amount = $payment_status_raw['amount'];

        //while response status is pending do this
        while ($payment_status === 'PENDING') {
            // check status again
            $payment_status_raw = $mtn_momo->getTransactionStatus($payment, $token);
            $payment_status = $payment_status_raw['status'];
        }

        return ($payment_status === 'SUCCESSFUL');

    }
}
