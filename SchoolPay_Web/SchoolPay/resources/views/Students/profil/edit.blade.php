<x-dashboard-layout-student>

    <x-slot name="title">
        <h1 class="font-extrabold text-3xl p-2 color-blue">
            {{ __('Informations personnelles') }},
        </h1>
    </x-slot>

    <div class="w-full bg-transparent mt-4 rounded-lg border-l-2 border-r-2 border-b-2 border-[#ffc371] p-4">
        <form method="POST" action="{{ route("student.profil.student.update", ['student' => $student->id]) }}">
            @csrf

            <div class="grid md:grid-cols-2 md:gap-6">
                <x-form-input name="name"
                              value="{{ $student->user->name }}"
                              label="{{ __('Nom et prénoms') }}"
                />

                <x-form-input name="username"
                              value="{{ $student->user->username }}"
                              label="{{ __('Nom utilisateur') }}"
                />
            </div>

            <x-form-input name="old_password"
                          type="password"
                          value=""
                          label="{{ __('Ancien mot de passe') }}"
            />

            <div class="grid md:grid-cols-2 md:gap-6">
                <x-form-input name="new_password"
                              type="password"
                              value=""
                              label="{{ __('Nouveau mot de passe') }}"
                />
                <x-form-input name="confirm_new_password"
                              type="password"
                              value=""
                              label="{{ __('Confirmer le nouveau mot de passe') }}"
                />
            </div>

            <x-form-input name="tel"
                          value="{{ $student->phoneNumber }}"
                          label="{{ __('Numéro de téléphone') }}"
            />

            <div class="w-full flex justify-center">
                <x-form-button class="hover-bg-logo px-6 text-white">
                    Modifier
                </x-form-button>
            </div>

        </form>

    </div>


</x-dashboard-layout-student>
