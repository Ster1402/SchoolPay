@props(['trigger' => 'Menu', 'id' => "dropdownDefault"])

{{-- Trigger --}}
<button id="{{ $id }}"
        data-dropdown-toggle="{{ $id }}-links"
        class="w-max-content focus:outline-none font-semibold rounded-xl text-sm px-4 py-2 text-left inline-flex justify-between items-center"
        type="button">
    {{ $trigger }}
    <x-icon name="arrow-rounded"/>
</button>

{{-- Dropdown menu --}}
<div id="{{ $id }}-links"
     style="transform: translate(0px, 50px);
            position: absolute;
            inset: 0px auto auto 0px;
            margin: 0px;"
     class="hidden z-10 w-full max-h-52 overflow-auto rounded-xl divide-y divide-gray-100 bg-gray-100 rounded-xl shadow block">
    <ul class="py-1 text-sm text-left"
        aria-labelledby="{{ $id }}">
        {{ $slot }}
    </ul>
</div>
