<div class="bg-white rounded-xl shadow p-5 flex items-center space-x-4 rtl:space-x-reverse">
    <!-- Profile Photo -->
    <img src="{{ asset($instructor->photo ?? '/images/profile/user_ic.svg') }}"
         class="rounded-full w-16 h-16 object-cover border" alt="Instructor Photo" />

    <!-- Info -->
    <div class="text-right space-y-1 flex-1">
        <h3 class="text-lg font-bold text-gray-900">{{ $instructor->name }}</h3>
        <p class="text-sm text-gray-600">{{ $instructor->bio }}</p>
    </div>

    <!-- Actions -->
    <div>
        <button wire:click="edit({{ $instructor->id }})"
            class="text-sm text-indigo-600 hover:underline flex items-center gap-1">
            <i data-feather="edit" class="w-4 h-4"></i> تعديل
        </button>
    </div>
</div>
