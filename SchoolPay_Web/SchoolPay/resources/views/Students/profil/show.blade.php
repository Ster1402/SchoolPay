<x-dashboard-layout-student>

    <x-slot name="title">
        <h1 class="font-extrabold text-3xl p-2 color-blue">
            {{ __('Informations personnelles') }},
        </h1>
    </x-slot>

    <div
        class="w-full bg-transparent mt-4 rounded-lg border-l-2 border-r-2 border-b-2 border-[#ffc371] p-4 text-white space-y-4">

        <div class="flex space-x-2 items-center justify-start items-center">
            <h4 class="text-xl font-bold text-white mr-4">Nom et prénoms : </h4>
            <p>{{ $student->user->name }}</p>
        </div>

        <div class="flex space-x-2 items-center justify-start">
            <h4 class="text-xl font-bold text-white mr-4">Matricule : </h4>
            <p>{{ $student->registerNumber }}</p>
        </div>

        <div class="flex space-x-2 items-center justify-start">
            <h4 class="text-xl font-bold text-white mr-4">Date de naissance : </h4>
            <p>{{ $student->birthday }}</p>
        </div>

        <div class="flex space-x-2 items-center justify-start items-center">
            <h4 class="text-xl font-bold text-white mr-4">Nom utilisateur : </h4>
            <p>{{ $student->user->username }}</p>
        </div>

        <div class="flex space-x-2 items-center justify-start">
            <h4 class="text-xl font-bold text-white mr-4">Numéro de téléphone : </h4>
            <p>{{ $student->phoneNumber }}</p>
        </div>

        <div class="flex space-x-2 items-center justify-start">
            <h4 class="text-xl font-bold text-white mr-4">Etablissement : </h4>
            <p>{{ $student->discipline->school->user->name }}</p>
        </div>

        <div class="flex space-x-2 items-center justify-start">
            <h4 class="text-xl font-bold text-white mr-4">Filière : </h4>
            <p>{{ $student->discipline->name }}</p>
        </div>

    </div>

</x-dashboard-layout-student>
