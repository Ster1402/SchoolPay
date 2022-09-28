<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\SmsController;
use App\Models\Payment;
use App\Models\Student;
use Carbon\Carbon;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PaymentController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $student = Student::with('discipline')
            ->firstWhere('user_id', auth()->user()->id);

        $universityRights = [
            'discharge-all' => 'Scolarité - Totalité',
            'discharge-first-part' => 'Scolarité - première tranche',
            'discharge-second-part' => 'Scolarité - seconde tranche',
            'medicalVisit' => 'Visite Médicale',
        ];

        return view('Students.payments.payment', [
            'student' => $student,
            'universityRights' => $universityRights,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'student_id' => ['required', Rule::exists('students', 'id')],
            'registerNumber' => ['required', Rule::exists('students', 'registerNumber')],
            'academic_year_id' => ['required', Rule::exists('academic_years', 'id')],
            'payerName' => ['required', 'min:3', 'max:255'],
            'payerIDCard' => ['required', 'integer', 'min:100'],
            'payerPhoneNumber' => ['required', 'min:9', 'max:9', 'starts_with:6'],
            'type' => ['required'],
            'amount' => ['required', 'integer', 'min:5000']
        ]);

        //On vérifie qu'il n'as pas déjà payé
        $student = Student::find($attributes['student_id']);

        if($student->hasPaid($attributes['type'])){
            return redirect()->back()->with('success', 'Vous avez déjà payé ces droits!');
        }

        /*TODO: Effectuer le paiement ici*/

        $payAt = Carbon::now()->toDateTimeString();

        $attributes['payAt'] = $payAt;

        Payment::create($attributes);

        $studentPhoneNumber = $student->phoneNumber;
        $schoolName = $student->discipline->school->user->name;

        $universityRights = [
            'discharge-all' => 'Scolarité - Totalité',
            'discharge-first-part' => 'Scolarité - première tranche',
            'discharge-second-part' => 'Scolarité - seconde tranche',
            'medicalVisit' => 'Visite Médicale',
        ];

        $type = $attributes['type'];
        $typeName = $universityRights[$type];

        //Sending confirmation message
        try{
            SmsController::sendSms($studentPhoneNumber,
                $attributes['payerPhoneNumber'],
                $schoolName,
                $attributes['registerNumber'],
                $student->user->name,
                $typeName,
                $attributes['amount']
            );
        }catch (GuzzleException $ex) {
            //Logs exception
        }

        return redirect()->back()->with('success', 'Paiement effectué avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    public function history(){
       return view('Students.payments.history');
    }
}
