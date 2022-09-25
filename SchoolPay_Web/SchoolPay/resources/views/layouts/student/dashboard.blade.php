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
                                   icon="user">
                    {{ __("Afficher") }}
                </x-aside-menu-link>
            </li>
            <li>
                <x-aside-menu-link href="{{ route('student.profil.student.edit', ['student' => $student->id]) }}"
                                   :active="request()->routeIs('student.profil.student.edit', ['student' => $student->id])"
                                   icon="edit">
                    {{ __("Modifier") }}
                </x-aside-menu-link>
            </li>
            <li>
                <x-aside-menu-link href="{{ route('student.profil.student.destroy', ['student' => $student->id]) }}"
                                   :active="request()->routeIs('student.profil.student.destroy', ['student' => $student->id])"
                                    icon="remove"
                >
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

</x-app-layout>
