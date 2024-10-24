@props(['name' => '', 'label' => ''])
@php
    $id = $name . rand(0000, 99999);
@endphp
<div {{ $attributes->class(['w-100', 'form-filed']) }} data-name="{{ $name }}" data-id="{{ $id }}">
    @if (!empty($label))
        <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    @endif
    {{ $slot }}
    @error($name)
        <p class="text-danger fs-6 mt-1 ">
            {{ $message }}
        </p>
    @enderror
</div>
