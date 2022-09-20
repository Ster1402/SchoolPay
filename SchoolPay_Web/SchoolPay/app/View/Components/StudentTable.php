<?php

namespace App\View\Components;

use App\Models\School;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;
use function PHPUnit\Framework\isNull;

class StudentTable extends Component
{

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $school = School::firstWhere('user_id', Auth::user()->id);

        if ($school === null){
            abort(404);
        }

        $students = Student::whereHas('discipline', static function ($query) use($school) {
           $query->where('school_id', $school->id);
        })->with('discipline')->filter(request(['discipline', 'status', 'academicYear', 'search']));

        return view('components.student-table', [
            'students' => $students->paginate(5),
        ]);
    }
}
