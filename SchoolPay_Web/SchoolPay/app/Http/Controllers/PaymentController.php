<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Student;
use Illuminate\Http\Request;

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
            'discharge-all' => 'Quitus - Totalité',
            'discharge-first-part' => 'Quitus - première tranche',
            'discharge-second-part' => 'Quitus - seconde tranche',
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
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
