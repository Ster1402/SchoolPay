<?php

namespace App\View\Components;

use App\Models\Student;
use Illuminate\View\Component;

class DashboardLayoutStudent extends Component
{

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $student = Student::with('discipline')
            ->firstWhere('user_id', auth()->user()->id);
        return view('layouts.student.dashboard', [
            'student' => $student
        ]);
    }
}
