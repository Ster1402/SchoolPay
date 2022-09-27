<x-dashboard-layout-student>

    <x-slot name="title">
        <h1 class="font-extrabold text-2xl p-2 color-blue">
            {{ $student->discipline->school->user->name }}, <u>Banque :</u> {{ $student->discipline->school->account->bank->name }}
        </h1>
    </x-slot>

    <div class="w-full bg-transparent mt-4 rounded-lg border-l-2 border-r-2 border-b-2 border-[#ffc371] p-4">
        <form method="POST" action="{{ route("student.payments.store") }}">
            @csrf

            <div class="grid md:grid-cols-2 md:gap-6">
                <input type="hidden" name="student_id" value="{{ $student->id }}"/>
                <input type="hidden" name="academic_year_id" value="8"/>
                <x-form-input name="registerNumber"
                              value="{{ $student->registerNumber }}"
                              label="{{ __('Matricule') }}"
                />
                <x-form-input name="name"
                              value="{{ $student->user->name }}"
                              label="{{ __('Nom et prénoms (étudiants)') }}"
                />
            </div>

            <div class="grid md:grid-cols-3 md:gap-6">
                <x-form-input name="payerName"
                              label="{{ __('Nom et prénoms (payeur)') }}"
                />

                <x-form-input name="payerIDCard"
                              label="{{ __('Numéro de CNI (payeur)') }}"
                />

                <x-form-input name="payerPhoneNumber"
                              label="{{ __('Numéro de téléphone (MTN-MoMo)') }}"
                />
            </div>

            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="w-full bg-transparent text-gray-300">
                    <x-form-select class="color-logo"
                                   name="type">

                        <x-slot name="label">Droits universitaire</x-slot>

                        @foreach($universityRights as $key => $universityRight)
                            <option class="p-2" value="{{ $key }}">
                                {{ ucwords($universityRight) }}
                            </option>
                        @endforeach
                    </x-form-select>
                </div>
                <x-form-input name="amount"
                              type="integer"
                              value="50000"
                              label="{{ __('Montant') }}"
                />
            </div>

            <div class="w-full flex justify-center">
                <x-form-button class="hover-bg-logo px-6 text-white">
                    Confirmer
                </x-form-button>
            </div>
        </form>
    </div>

</x-dashboard-layout-student>
