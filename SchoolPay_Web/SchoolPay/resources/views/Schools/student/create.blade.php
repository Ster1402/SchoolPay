<x-dashboard-layout-school>

    <x-slot name="title">
        <h1 class="font-extrabold text-3xl p-2 color-blue">
            {{ __("Ajouter un étudiant, ") }}
        </h1>

        <div>
            {{-- Téléchargement de la liste des étudiants --}}
            <a href="{{ route('school.student.import-list') }}">
                <x-button title="Vous pouvez appliquer des filtres pour réduire la liste"
                          class="bg-gradient text-sm font-bold text-white">
                    {{ __('Importer le fichier des étudiants') }}
                </x-button>
            </a>
        </div>

    </x-slot>

    <div class="w-full bg-gray-800 rounded-lg border-l-2 border-b-2 border-[#ffc371] mt-2 p-4">
        <form method="POST" action="{{ route("school.student.store") }}">
            @csrf

            <div class="grid md:grid-cols-3 md:gap-6">
                <x-form-input name="register_number"
                              label="{{ __('Matricule') }}"
                />
                <x-form-input name="name"
                              label="{{ __('Nom et prénoms') }}"
                />
                <x-form-input type="date"
                              name="birthday"
                              label="{{ __('Date de naissance') }}"
                />
            </div>

            <x-form-input type="email"
                          name="email"
                          label="{{ __('Email') }}"
            />

            <x-form-input name="username">
                {{ __('Nom utilisateur') }}
            </x-form-input>

            <div class="grid md:grid-cols-2 md:gap-6">
                <x-form-input type="password"
                              name="password"
                              label="{{ __('Mot de passe') }}"/>

                <x-form-input type="password"
                              name="password_confirmation"
                              label="{{ __('Confirmer le mot de passe') }}"/>
            </div>

            <x-form-select name="discipline_id">
                <x-slot name="label">Filière</x-slot>
                @foreach($disciplines as $discipline)
                    <option class="p-2" value="{{ $discipline->id }}">
                        {{ ucwords($discipline->name) }}
                    </option>
                @endforeach
            </x-form-select>

            <div class="w-full flex justify-end">
                <x-form-button class="bg-gradient text-white " type="reset">
                    Reset
                </x-form-button>

                <x-form-button class="bg-gradient text-white">
                    Create
                </x-form-button>
            </div>
        </form>
    </div>

</x-dashboard-layout-school>
