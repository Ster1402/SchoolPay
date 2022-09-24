@props(['type' => 'submit'])

<button type="{{ $type }}"
    {{ $attributes->merge(["class" => "mt-6 ml-2 text-gray-400 hover:text-white border border-2 border-[#ffc371]
focus:ring-4 focus:outline-none font-bold rounded-lg text-sm w-full sm:w-auto px-6 py-2
text-center"]) }}
>
    {{ $slot }}
</button>
