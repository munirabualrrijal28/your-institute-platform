@props(['label', 'name'])

<div x-data="{ show: false }">
    <label class="block text-sm font-semibold mb-1">{{ $label }}</label>
    <div class="relative">
        <input :type="show ? 'text' : 'password'" name="{{ $name }}" autocomplete="off"
               class="w-full rounded-full border border-teal-300 px-4 py-2 shadow focus:outline-none focus:ring-2 focus:ring-teal-400">
        <button type="button" @click="show = !show"
                class="absolute inset-y-0 right-3 text-gray-500 text-sm focus:outline-none">
            <span x-show="!show">👁️</span>
            <span x-show="show">🙈</span>
        </button>
    </div>
    @error($name)
      <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
    @enderror
</div>
