<x-app-layout>

    <x-aside-menu>

        @if(request()->routeIs('school.student'))
            <li>
                <x-aside-menu-link href="{{ route('school.student.index') }}"
                                   :active="request()->routeIs('school.student.index')"
                                   icon="user-group"
                >
                    {{ __("Afficher étudiants") }}
                </x-aside-menu-link>
            </li>
            <li>
                <x-aside-menu-link href="{{ route('school.student.create') }}"
                                   :active="request()->routeIs('school.student.create')"
                                   icon="user-add"
                >
                    {{ __("Ajouter un étudiant") }}
                </x-aside-menu-link>
            </li>
        @else
            {{-- Link for University right management --}}
        @endif

    </x-aside-menu>

    <div class=" mr-4 w-full h-fit-content">
        <div class=" w-full flex justify-between p-4 bg-white mt-2 rounded-xl border-l-2 border-b-2 border-[#ffc371]">

            {{ $title }}

        </div>

        {{ $slot }}
        
        @if(session()->has('new-student'))
            <x-toast type="success"
                     :message="session('new-student')"/>
        @endif

        @if(session()->has('update-student'))
            <x-toast type="success"
                     :message="session('update-student')"/>
        @endif

        @if(session()->has('delete-student'))
            <x-toast type="success"
                     :message="session('delete-student')"/>
        @endif

    </div>

</x-app-layout>
