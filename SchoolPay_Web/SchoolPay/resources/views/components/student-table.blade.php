<div class="overflow-x-auto w-full sm:rounded-lg mb-4">
    <table class="w-full border border-gray-100 text-sm text-left text-gray-500 text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
        <tr>
            <th scope="col" class="py-4 px-3">
                Matricule
            </th>
            <th scope="col" class="py-4 px-3">
                Nom et prénoms
            </th>
            <th scope="col" class="py-4 px-3">
                Filière
            </th>
            <th scope="col" class="py-4 px-3">
                Tranche - 1
            </th>
            <th scope="col" class="py-4 px-3">
                Tranche - 2
            </th>
            <th scope="col" class="py-4 px-3">
                Visite Médicale
            </th>
            <th scope="col" class="py-4 px-3">
            </th>
        </tr>
        </thead>
        <tbody>
        @if(count($students) === 0)
            <td colspan="8" class="py-4 px-3 text-gray-200 text-center">
                Aucun étudiants disponible.
            </td>
        @else
            @foreach($students as $student)
                <x-table-student-row :student="$student"/>
            @endforeach
        @endif
        </tbody>

    </table>

    <div class="mt-4 w-full rounded-lg">
        {{ $students->links() }}
    </div>
</div>

