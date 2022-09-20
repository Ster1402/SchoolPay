@props(['active' => false])


@php
    $classes = $active ? "block py-2 px-4 font-medium hover:bg-blue-500 bg-blue-500 text-white"
                        : "block py-2 px-4 font-medium hover:bg-blue-500 hover:text-white"
@endphp

<a {{ $attributes->merge(['class' => $classes]) }} >
    {{ $slot }}
</a>
