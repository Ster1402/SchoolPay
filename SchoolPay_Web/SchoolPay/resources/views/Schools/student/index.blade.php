<x-dashboard-layout-school>

    <x-slot name="title">
        <h1 class="font-extrabold text-3xl p-2 color-blue">
            {{ __("Liste des étudiants, année académique $currentAcademicYear") }}
        </h1>

        <div>
            {{-- Téléchargement de la liste des étudiants --}}
            <a href="{{ route('school.student.download-list') }}">
                <x-button title="Vous pouvez appliquer des filtres pour réduire la liste"
                          class="bg-gradient-logo text-sm font-bold text-white">
                    {{ __('Télécharger la liste') }}
                </x-button>
            </a>
        </div>
    </x-slot>

    <div class="space-y-2 mb-10 flex items-center justify-center lg:space-y-0 lg:space-x-4 mt-4">
        <h2 class="w-full text-gray-400 text-center mx-4">Filtrer par</h2>
        <!--  Discipline -->
        <div class="relative w-full flex bg-gray-100 hover:bg-gray-300 lg:inline-flex rounded-xl py-1">
            <div
                class="flex-1 sm:w-full appearance-none items-center justify-content-center bg-transparent pl-3 text-sm font-semibold text-left">
                <x-discipline-dropdown/>
            </div>
        </div>

        <!--  Payment state -->
        <div class="relative w-full flex bg-gray-100 hover:bg-gray-300 lg:inline-flex rounded-xl py-1">
            <div
                class="flex-1 sm:w-full appearance-none items-center justify-content-center bg-transparent pl-3 text-sm font-semibold text-left">
                <x-payment-state-dropdown/>
            </div>
        </div>

        <!--  Academic Year -->
        <div class="relative w-full flex bg-gray-100 hover:bg-gray-300 lg:inline-flex rounded-xl py-1">
            <div
                class="flex-1 sm:w-full appearance-none items-center justify-content-center bg-transparent pl-3 text-sm font-semibold text-left">
                <x-academic-year-dropdown/>
            </div>
        </div>

        <!-- Search -->
        <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl px-3 py-1">
            <form method="GET" action="">

                @if(request('discipline') ?? false)
                    <input type="hidden" name="status" value="{{ request('discipline') }}"/>
                @endif

                @if(request('status') ?? false)
                    <input type="hidden" name="status" value="{{ request('status') }}"/>
                @endif

                @if(request('academicYear') ?? false)
                    <input type="hidden" name="academicYear" value="{{ request('academicYear') }}"/>
                @endif

                <input type="text" name="search" placeholder="Rechercher"
                       value="{{ request('search') ?? '' }}"
                       class="bg-transparent border-none placeholder-gray-400 font-semibold text-sm"/>
            </form>
        </div>

    </div>

    <x-student-table/>

</x-dashboard-layout-school>
