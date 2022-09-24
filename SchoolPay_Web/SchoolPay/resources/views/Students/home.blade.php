<x-app-layout>

    <div class="w-full">
        <div id="default-carousel" class="h-full relative" data-carousel="slide">
            <!-- Carousel wrapper -->
            <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                <!-- Item 1 -->
                <div
                    class="bg bg-item-student-1 duration-700 ease-linear absolute inset-0 transition-all transform translate-x-0 z-20"
                    data-carousel-item="">
                <span
                    class="item w-full h-full px-10 flex justify-center items-center absolute text-center text-2xl font-semibold text-white -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 sm:text-3xl text-white">
                    <p>Payer rapidement et en toute simplicité vos <strong
                            class="color-logo">droits universitaires</strong>.</p>
                </span>
                </div>
                <!-- Item 2 -->
                <div
                    class="bg bg-item-student-2 duration-700 ease-linear absolute inset-0 transition-all transform translate-x-full z-10"
                    data-carousel-item="">
                <span
                    class="item w-full h-full px-10 flex justify-center items-center absolute text-center text-2xl font-semibold text-white -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 sm:text-3xl text-white">
                    <p>
                        Conserver des <strong class="color-logo">reçus numériques</strong> de tous vos paiements effectués dans la plateforme.
                    </p>
                </span>
                </div>
                <!-- Item 3 -->
                <div
                    class="bg bg-item-student-2 duration-700 ease-linear absolute inset-0 transition-all transform -translate-x-full z-10"
                    data-carousel-item="">
                <span
                    class="item w-full h-full px-10 flex justify-center items-center absolute text-center text-2xl font-semibold text-white -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 sm:text-3xl text-white">
                    <p>
                        Recevez en temps réelle les <strong class="color-logo">notifications</strong>
                    sur la période de paiement des <strong class="color-logo">droits universitaires</strong>
                    fournis par votre école.
                    </p>
                </span>
                </div>
                <!-- Slider indicators -->
                <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2">
                    <button type="button" class="w-3 h-3 rounded-full bg-white  " aria-current="true"
                            aria-label="Slide 1" data-carousel-slide-to="0"></button>
                    <button type="button"
                            class="w-3 h-3 rounded-full bg-white/50  /50 hover:bg-white dark:hover:bg-gray-800"
                            aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                    <button type="button"
                            class="w-3 h-3 rounded-full bg-white/50  /50 hover:bg-white dark:hover:bg-gray-800"
                            aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
                </div>

            </div>

            <div class="w-full flex justify-center mt-10 mb-4">
                <a href="#">
                    <x-button class="bg-gradient-logo font-bold text-gray-100">
                        {{ __('Payer vos droits universitaires') }}
                    </x-button>
                </a>
            </div>

            <!-- Slider controls -->
            <button type="button"
                    class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                    data-carousel-prev="">
        <span
            class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30  /30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 text-white" fill="none"
                 stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path
                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            <span class="sr-only">Previous</span>
        </span>
            </button>
            <button type="button"
                    class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                    data-carousel-next="">
        <span
            class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30  /30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 text-white" fill="none"
                 stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path
                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <span class="sr-only">Next</span>
        </span>
            </button>
        </div>

    </div>

</x-app-layout>
