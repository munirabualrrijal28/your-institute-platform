<div>
    <div class="text-center">
        <button wire:click="toggleFollow" wire:loading.attr="disabled"
            class="{{ $isFollowing ? 'bg-red-600 hover:bg-red-700' : 'bg-teal-500 hover:bg-teal-600' }} w-[150px] h-full rounded-xl text-white font-semibold px-4 py-2 transition">
            {{ $isFollowing ? 'إلغاء المتابعة' : 'متابعة' }}
        </button>
        {{-- <p class="mt-1 text-sm text-gray-500">المتابعين: {{ $followerCount }}</p> --}}
    </div>

</div>
