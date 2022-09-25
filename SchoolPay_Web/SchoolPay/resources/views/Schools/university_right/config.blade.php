<x-dashboard-layout-school>
    <x-slot name="title">
        <h1 class="font-extrabold text-3xl p-2 color-blue">
            @php
                $currentAcademicYear = (string)\Carbon\Carbon::now()->year;
                $currentAcademicYear .= " - ".(\Carbon\Carbon::now()->year + 1);
            @endphp
            {{ __("Configurer la période de paiements autorisées, $currentAcademicYear") }}
        </h1>
    </x-slot>

    <form method="POST" action="" class="mb-4">

        <div class="overflow-x-auto mt-4 mb-1 w-full sm:rounded-lg">
            <table class="w-full border border-gray-100 text-sm text-left text-gray-500 text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="py-4 px-3 text-center">
                        Niveau
                    </th>
                    <th scope="col" class="py-4 px-3 text-center">
                        Date début
                    </th>
                    <th scope="col" class="py-4 px-3 text-center">
                        Tranche - 1
                    </th>
                    <th scope="col" class="py-4 px-3 text-center">
                        Tranche - 2
                    </th>
                    <th scope="col" class="py-4 px-3 text-center">
                        Visite médicale
                    </th>
                </tr>
                </thead>
                <tbody>
                @for($level=1; $level<=5; $level++)
                    <x-table-config-row :level="$level"/>
                @endfor
                </tbody>

            </table>

        </div>

        <div class="w-full flex justify-center">
            <x-form-button class="hover-bg-logo px-10 text-white">
                Configurer
            </x-form-button>
        </div>
    </form>
</x-dashboard-layout-school>
