<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SchoolUniversityRightController extends Controller
{
    public function config(){
        return view('Schools.university_right.config');
    }

    public function history(){
        return view('Schools.university_right.history');
    }
}
