<x-dropdown-menu id="status">

    <!-- Trigger -->
    <x-slot name="trigger">
        {{ isset($currentStatus) ? ucwords($currentStatus->name) : __("Status de paiement") }}
    </x-slot>

    <!-- Links -->
    <li>
        <x-dropdown-menu-link href="{{ route('school.student.index').'?'.http_build_query(request()->except('status', 'page')) }}"
                              :active=" request('status') === null ">
            {{ __("Tous") }}
        </x-dropdown-menu-link>
    </li>

    @foreach($status_arr as $status)
        <li>
            <x-dropdown-menu-link :active="request('status') === $status->slug"
                                  href="{{ route('school.student.index').'?status='. $status->slug .'&'. http_build_query(request()->except('status', 'page')) }}">
                {{ ucwords($status->name) }}
            </x-dropdown-menu-link>
        </li>
    @endforeach

</x-dropdown-menu>
