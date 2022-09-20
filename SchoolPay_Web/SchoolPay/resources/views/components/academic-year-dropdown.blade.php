<x-dropdown-menu id="academicYear">

    <!-- Trigger -->
    <x-slot name="trigger">
        {{ isset($currentAcademicYear) ? ucwords($currentAcademicYear->period) : __("Année académique") }}
    </x-slot>

    <!-- Links -->
    <li>
        <x-dropdown-menu-link href="{{ route('school.student.index').'?'.http_build_query(request()->except('academicYear', 'page')) }}"
                              :active=" request('academicYear') === null ">
            {{ __("Année en cours") }}
        </x-dropdown-menu-link>
    </li>

    @foreach($academicYears as $academicYear)
        <li>
            <x-dropdown-menu-link :active="request('academicYear') === $academicYear->slug"
                                  href="{{ route('school.student.index').'?academicYear='. $academicYear->slug .'&'. http_build_query(request()->except('academicYear', 'page')) }}">
                {{ ucwords($academicYear->period) }}
            </x-dropdown-menu-link>
        </li>
    @endforeach

</x-dropdown-menu>
