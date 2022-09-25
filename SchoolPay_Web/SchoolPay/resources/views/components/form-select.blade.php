@props(['name'])

@error($name)
@php
    $error_color = 'border-red-500';
@endphp
@enderror

@php
    $border_color = $error_color ?? 'border-gray-300';
    $classes = "bg-transparent border-0 border-b-2 $border_color appearance-none text-sm block w-full p-2.5 pl-1 text-white"
@endphp

<div>
    <label>
        <select {{ $attributes->merge(['class' => $classes]) }}
                name="{{ $name }}"
                required
        >
            <option selected disabled>
                Choisir {{ $label }}
            </option>

            {{ $slot }}
        </select>

        @error($name)
        <p class="mt-2 text-xs text-red-500 ">{{ $message }}</p>
        @enderror
    </label>
</div>

