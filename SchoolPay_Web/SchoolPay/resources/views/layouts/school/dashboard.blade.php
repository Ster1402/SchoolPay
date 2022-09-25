<x-app-layout>

    <x-aside-menu>

        @if(request()->routeIs('school.student.*'))
            <li>
                <x-aside-menu-link href="{{ route('school.student.index') }}"
                                   :active="request()->routeIs('school.student.index')"
                                   icon="user-group">
                    {{ __("Afficher étudiants") }}
                </x-aside-menu-link>
            </li>
            <li>
                <x-aside-menu-link href="{{ route('school.student.create') }}"
                                   :active="request()->routeIs('school.student.create')"
                                   icon="user-add">
                    {{ __("Ajouter étudiant") }}
                </x-aside-menu-link>
            </li>
        @elseif(request()->routeIs('school.university-right.*'))
            <li>
                <x-aside-menu-link href="{{ route('school.university-right.config') }}"
                                   :active="request()->routeIs('school.university-right.config')"
                                   icon="date">
                    {{ __("Configurer") }}
                </x-aside-menu-link>
            </li>
            <li>
                <x-aside-menu-link href="{{ route('school.university-right.history') }}"
                                   :active="request()->routeIs('school.university-right.history')"
                                   icon="history">
                    {{ __("Historique") }}
                </x-aside-menu-link>
            </li>
        @endif

    </x-aside-menu>

    <div class=" mr-4 w-full h-fit-content">
        <div class=" w-full flex justify-between p-4 bg-white mt-2 rounded-xl border-l-2 border-b-2 border-[#ffc371]">

            {{ $title }}

        </div>

        {{ $slot }}

        @if(session()->has('success'))
            <x-toast type="success"
                     :message="session('success')"/>
        @endif

        @if(session()->has('danger'))
            <x-toast type="error"
                     :message="session('danger')"/>
        @endif

        @if(session()->has('warning'))
            <x-toast type="error"
                     :message="session('warning')"/>
        @endif

    </div>

</x-app-layout>
