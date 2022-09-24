<x-app-layout>

    <x-aside-menu>

        @if(request()->routeIs('student.payments.*'))
            <li>
                <x-aside-menu-link href="{{ route('student.payments.create') }}"
                                   :active="request()->routeIs('student.payments.create')"
                                   icon="home">
                    {{ __("Droits universitaires") }}
                </x-aside-menu-link>
            </li>
            <li>
                <x-aside-menu-link href="{{ route('student.payments.history') }}"
                                   :active="request()->routeIs('student.payments.history')"
                                   icon="history">
                    {{ __("Historique") }}
                </x-aside-menu-link>
            </li>
        @elseif(request()->routeIs('student.profil.*'))
            <li>
                <x-aside-menu-link href="{{ route('student.profil.student.index') }}"
                                   :active="request()->routeIs('student.profil.student.index')"
                                   icon="date">
                    {{ __("Afficher") }}
                </x-aside-menu-link>
            </li>
            <li>
                <x-aside-menu-link href="{{ route('student.profil.student.edit') }}"
                                   :active="request()->routeIs('student.profil.student.edit')"
                                   icon="history">
                    {{ __("Modifier") }}
                </x-aside-menu-link>
            </li>
            <li>
                <x-aside-menu-link href="{{ route('student.profil.student.destroy') }}"
                                   :active="request()->routeIs('student.profil.student.destroy')"
                                   icon="history">
                    {{ __("Supprimer le compte") }}
                </x-aside-menu-link>
            </li>
        @endif

    </x-aside-menu>

    <div class=" mr-4 w-full h-fit-content">
        <div class=" w-full flex justify-between p-4 bg-white mt-2 rounded-xl border-l-2 border-b-2 border-[#ffc371]">

            {{ $title }}

        </div>

        {{ $slot }}

    </div>

</x-app-layout>
