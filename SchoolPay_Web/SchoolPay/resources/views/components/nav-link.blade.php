@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 pb-2 border-b-2 border-[#ffc371] hover:border-[#ffc371] text-sm font-medium leading-5 text-gray-900 hover:text-blue focus:outline-none  transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 pb-2 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-900 hover:text-blue hover:border-[#ffc371] focus:outline-none transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
