@props(['icon' => "none",
        'subMenu' => false,
        'iconValue' => '',
        'active' => false,
])

@php
    $classes = $subMenu ? "aside-menu-link text-left flex items-center p-2 py-4 ml-4 pl-11 w-auto text-base font-normal rounded-lg transition duration-75 group hover:bg-[#0099FF] dark:text-white dark:hover:bg-[#0099FF]"
                        : "aside-menu-link text-left flex items-center p-2 py-4 text-base font-normal rounded-lg dark:text-white hover:bg-[#0099FF] dark:hover:bg-[#0099FF]";

    $classes .= $active ? " bg-[#0099FF] text-white " : " text-gray-900"
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    <x-icon :name="$icon" :color="$active ? 'text-white' : 'text-gray-400' ">
        {{ $iconValue }}
    </x-icon>

    <span class="ml-3 text-menu-link">
        {{ $slot }}
    </span>
</a>
