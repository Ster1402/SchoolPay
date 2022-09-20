<?php

namespace App\View\Components;

use App\Models\Discipline;
use App\Models\School;
use Auth;
use Illuminate\View\Component;

class DisciplineDropdown extends Component
{

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $school = School::firstWhere('user_id', Auth::user()->id);

        $currentDiscipline = Discipline::firstWhere('slug', request("discipline"));

        return view('components.discipline-dropdown', [
            'disciplines' => $school->disciplines,
            'currentDiscipline' => $currentDiscipline,
        ]);
    }
}
