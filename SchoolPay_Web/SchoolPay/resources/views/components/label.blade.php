@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-bold text-sm text-white']) }}>
    {{ $value ?? $slot }}
</label>
