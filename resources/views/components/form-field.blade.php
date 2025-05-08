@props(['label', 'name', 'type' => 'text', 'value' => ''])

<div>
    <label class="block text-sm font-semibold mb-1">{{ $label }}</label>
    <input type="{{ $type }}" name="{{ $name }}" value="{{ $value }}" autocomplete="off"
           class="w-full rounded-full border border-teal-300 px-4 py-2 shadow focus:outline-none focus:ring-2 focus:ring-teal-400">
    @error($name)
      <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
    @enderror
</div>
