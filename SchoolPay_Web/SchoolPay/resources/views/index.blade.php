<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SchoolPay</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="icon" href="{{ asset("favicon.ico") }}">
    <link rel="stylesheet" href="{{ asset("css/app.css") }}"/>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

</head>
<body class="antialiased">

<div class="bg-gradient">
    <header class="w-full flex justify-between fixed top-0 px-2 border-b-2 border-[#ffc371] py-4">
        <div class="w-max-content text-center">
            <a href="{{ route('home') }}">
                <x-application-logo class="text-center w-32 h-8"/>
            </a>
        </div>
        <div class="flex items-center justify-between">
            <p class="text-sm text-gray-200 mr-2">
                {{ __("Vous possédez déjà un compte ? ") }}
            </p>
            <a href="{{ route('login') }}">
                <x-button class="bg-gradient-logo">{{ __('Se connecter') }}</x-button>
            </a>
        </div>
    </header>

    <main class=" min-h-screen flex flex-col justify-center w-full h-full py-8">
        <div class="mx-auto w-max-content text-center mb-6">
            <x-application-logo class="text-center w-64 h-24"/>
        </div>
        <div class="w-full flex justify-center mb-4">
            <p class="text-3xl font-bold w-[450px] text-white text-center">
                Plateforme de paiement en ligne des droits universitaires :<br>
                <strong class="color-logo">Scolarité</strong> & <strong class="color-logo">Visite Médicale</strong>
            </p>
        </div>
        <div class="w-full flex justify-center">
            <p class="text-xl font-bold w-[550px] text-gray-300 text-center leading-7">
                Les institutions d'enseignement supérieur ont la possibilité de s'identifier sur la plateforme
                pour permettre à leur étudiant d'utiliser le service
                <strong class="color-logo">SchoolPay</strong> pour s'acquiter de
                leurs droits universitaires.<br><br>
                <a href="{{ route('register') }}">
                    <x-button class="bg-gradient-logo">{{ __('Rejoignez-Nous') }}</x-button>
                </a>
            </p>
        </div>
    </main>
</div>

</body>
</html>
