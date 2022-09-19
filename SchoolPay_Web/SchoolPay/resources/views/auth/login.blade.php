<x-guest-layout>
    <header class="w-full flex justify-between fixed top-0 px-2 border-b-2 border-[#ffc371] py-4">
        <div class="w-max-content text-center">
            <a href="{{ route('home') }}">
                <x-application-logo class="text-center w-32 h-8"/>
            </a>
        </div>
        <div class="flex items-center justify-between">
            <p class="text-sm text-gray-200 mr-2">
                {{ __("Vous êtes un établissement désirant vous inscrire ? ") }}
            </p>
            <a href="{{ route('register') }}">
                <x-button class="bg-gradient-logo">{{ __('Rejoignez-Nous') }}</x-button>
            </a>
        </div>
    </header>

    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-48 h-20"/>
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')"/>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors"/>

        <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
            <div>
                <x-label for="username" :value="__('Nom d\'utilisateur')"/>

                <x-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')"
                         required autofocus/>
            </div>

            <div class="mt-4 space-x-8 flex">
                <div class="flex items-center">
                    <x-input checked id="school" type="radio" class="w-4 h-4" name="category" value="school"/>
                    <label for="school" class="ml-2 text-sm font-medium text-white">Je suis un établissement</label>
                </div>
                <div class="flex items-center">
                    <x-input checked id="student" type="radio" class="mr-2 w-4 h-4" name="category" value="student"/>
                    <label for="student" class="ml-2 text-sm font-medium text-white">Je suis un étudiant</label>
                </div>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Mot de passe')"/>

                <x-input id="password" class="block mt-1 w-full"
                         type="password"
                         name="password"
                         required autocomplete="current-password"/>
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           name="remember">
                    <span class="ml-2 text-sm text-white">{{ __('Se souvenir de moi') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-[#061161] hover:text-gray-900"
                       href="{{ route('password.request') }}">
                        {{ __('Mot de passe oublié?') }}
                    </a>
                @endif

                <x-button class="ml-3">
                    {{ __('Se connecter') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
