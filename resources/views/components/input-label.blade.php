@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700']) }}>
    {{ $value ?? $slot }}
</label>

{{-- @props(['label', 'name', 'type' => 'text'])

<div>
    <label class="block text-sm font-semibold mb-1">{{ $label }}</label>
    <input type="{{ $type }}" name="{{ $name }}" required
           class="w-full rounded-full border border-teal-300 px-5 py-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-400" />
</div> --}}
