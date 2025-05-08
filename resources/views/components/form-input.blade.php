@props(['name', 'label', 'type' => 'text', 'value' => '', 'error' => null])

<div>
  <label for="{{ $name }}" class="block text-sm font-semibold text-left mb-1">{{ $label }}</label>
  <input id="{{ $name }}" name="{{ $name }}" type="{{ $type }}" value="{{ $value }}"
         autocomplete="off"
         class="w-full rounded-full border px-4 py-2 shadow focus:outline-none focus:ring-2 focus:ring-teal-400
                {{ $error ? 'border-red-500' : 'border-teal-300' }}">
  @if ($error)
    <p class="text-red-500 text-xs mt-1 flex items-center">
      <i data-feather="alert-circle" class="w-4 h-4 mr-1"></i> {{ $error }}
    </p>
  @endif
</div>
