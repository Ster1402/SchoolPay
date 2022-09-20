@props(['name'])

@error($name)
@php
    $error_color = 'border-red-500'
@endphp
@enderror

@php
    $border_color = $error_color ?? 'border-gray-300';
    $classes = "bg-transparent border-0 border-b-2 $border_color appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 text-gray-600 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 pl-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
@endphp

<div>
    <label>
        <select {{ $attributes->merge(['class' => $classes]) }}
                name="{{ $name }}"
        >
            <option disabled>
                Select {{ $label }}
            </option>

            {{ $slot }}
        </select>

        @error($name)
        <p class="mt-2 text-xs text-red-500 ">{{ $message }}</p>
        @enderror
    </label>
</div>

