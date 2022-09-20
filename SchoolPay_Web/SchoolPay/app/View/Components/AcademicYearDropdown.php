<?php

namespace App\View\Components;

use App\Models\AcademicYear;
use Illuminate\View\Component;

class AcademicYearDropdown extends Component
{

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $academicYears = AcademicYear::orderByDesc('period')->get();

        $currentAcademicYear = AcademicYear::firstWhere('period',
            str_replace("-", " - ", request('academicYear') ?? "")
        );
        return view('components.academic-year-dropdown', [
            'academicYears' => $academicYears,
            'currentAcademicYear' => $currentAcademicYear,
        ]);
    }
}
