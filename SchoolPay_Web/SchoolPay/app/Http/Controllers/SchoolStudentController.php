<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Discipline;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SchoolStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $currentAcademicYear = (string)Carbon::now()->year;
        $currentAcademicYear .= " - " . (Carbon::now()->year + 1);
        if (request('academicYear')) {
            $currentAcademicYear = request('academicYear');
        }

        return view('schools.student.index', [
            'currentAcademicYear' => $currentAcademicYear,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('schools.student.create', [
            'disciplines' => Discipline::orderBy('name')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'registerNumber' => ['required', Rule::unique('students', 'registerNumber'), 'min:5', 'max:255'],
            'name' => ['required', 'min:3'],
            'username' => ['required', Rule::unique('users', 'username')],
            'discipline_id' => ['required', Rule::exists('disciplines', 'id'),],
            'birthday' => ['required', 'date'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', 'min:5', 'max:255'],
        ]);

        $attributes['category_id'] = Category::firstWhere('name', 'student')->id;

        $attributes['user_id'] = User::create($attributes)->id;

        Student::create($attributes);

        return redirect()
            ->back()
            ->with('success', 'Student create successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
