@props(['icon' => "none",
        'subMenu' => false,
        'iconValue' => '',
        'active' => false,
])

@php
    $classes = $subMenu ? "aside-menu-link text-left flex items-center p-2 py-4 ml-4 pl-11 w-auto text-base font-normal rounded-lg transition duration-75 group hover:text-white text-gray-900"
                        : "aside-menu-link text-left flex items-center p-2 py-4 text-base font-normal rounded-lg text-gray-900 hover:text-white";

    $classes .= $active ? " bg-gradient-logo text-white " : " bg-gray-100 text-gray-900 "

@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    <x-icon :name="$icon" :color="$active ? 'text-white' : 'text-gray-400' ">
        {{ $iconValue }}
    </x-icon>

    <span class="ml-3 {{ $active ? 'text-white' : ''  }}">
        {{ $slot }}
    </span>
</a>
