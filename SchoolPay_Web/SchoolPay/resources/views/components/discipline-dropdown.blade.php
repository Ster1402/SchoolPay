<x-dropdown-menu id="discipline">

    <!-- Trigger -->
    <x-slot name="trigger">
        {{ isset($currentDiscipline) ? ucwords($currentDiscipline->name) : __("Discipline") }}
    </x-slot>

    <!-- Links -->
    <li>
        <x-dropdown-menu-link href="{{ route('school.student.index').'?'.http_build_query(request()->except('discipline', 'page')) }}"
                              :active=" request('discipline') === null ">
            {{ __("Tous") }}
        </x-dropdown-menu-link>
    </li>

    @foreach($disciplines as $discipline)
        <li>
            <x-dropdown-menu-link :active="request('discipline') === $discipline->slug"
                                  href="{{ route('school.student.index').'?discipline='. $discipline->slug .'&'. http_build_query(request()->except('discipline', 'page')) }}">
                {{ ucwords($discipline->name) }}
            </x-dropdown-menu-link>
        </li>
    @endforeach

</x-dropdown-menu>
