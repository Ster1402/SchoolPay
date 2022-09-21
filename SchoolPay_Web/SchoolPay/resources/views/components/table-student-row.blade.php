@props(['student'])

<tr {{$attributes->merge(["class" => "border-b bg-gray-800 border-white hover:bg-gradient-logo"])}}>

    <th scope="row" class="py-4 px-3 font-medium whitespace-nowrap text-white">
        {{ $student->registerNumber }}
    </th>
    <th scope="row" class="py-4 px-3 font-medium whitespace-nowrap text-white">
        {{ $student->user->name }}
    </th>
    <td class="py-4 px-3">
        {{ ucwords($student->discipline->name) }}
    </td>
    <td class="py-4 px-3">
        {{ $student->hasPaidDischargeFirstPart ? __('Payé') : __("Non payé") }}
    </td>
    <td class="py-4 px-3">
        {{ $student->hasPaidDischargeSecondPart ? __('Payé') : __("Non payé") }}
    </td>
    <td class="py-4 px-3">
        {{ $student->hasPaidMedicalVisitPart ? __('Payé') : __("Non payé") }}
    </td>

    <td class="flex items-center py-4 px-3 space-x-3">
        <form method="GET" action="{{ route("school.student.show", ['student' => $student->id])}}">
            @csrf
            <button type="submit"
                    class="py-4 font-medium color-logo hover:underline pr-3">
                Info
            </button>
        </form>
        <form method="GET" action="{{ route("school.student.edit", ['student' => $student->id])}}">
            @csrf
            <button type="submit"
                    class="py-4 font-medium color-logo hover:underline">
                Edit
            </button>
        </form>
    </td>
</tr>
