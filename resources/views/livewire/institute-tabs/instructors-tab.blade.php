<div class="space-y-6 ltr" dir="ltr">

    {{-- Flash Message --}}
    @if (session('message'))
        <div class="bg-green-100 text-green-800 p-3 rounded-lg shadow animate-fade-in">
            {{ session('message') }}
        </div>
    @endif

    {{-- Add/Edit Form --}}
    <div class="bg-white rounded-2xl p-6 shadow-md space-y-4 border border-gray-100">
        <h2 class="text-2xl font-bold text-gray-800">
            {{ $editing ? 'تعديل بيانات المدرب' : 'إضافة مدرب جديد' }}
        </h2>

        <form wire:submit.prevent="saveInstructor" wire:key="form-{{ $formKey }}" class="space-y-4">
 {{-- <form
    wire:submit.prevent="saveInstructor"
    wire:key="form-{{ $formKey }}"
    class="space-y-4"
    x-data="{ isUploading: false }"
    x-on:livewire-upload-start="isUploading = true"
    x-on:livewire-upload-finish="isUploading = false"
    x-on:livewire-upload-error="isUploading = false"
> --}}
            <div>
                <label class="block font-medium text-sm mb-1">اسم المدرب</label>
                <input type="text" wire:model.defer="name"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-400 focus:outline-none"
                    required />
                @error('name')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-medium text-sm mb-1">نبذة تعريفية</label>
                <textarea wire:model.defer="bio"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-400 focus:outline-none"
                    required></textarea>
                @error('bio')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-medium text-sm mb-1">البريد الإلكتروني (اختياري)</label>
                <input type="email" wire:model.defer="email"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-400 focus:outline-none" />
                @error('email')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-medium text-sm mb-1">الصورة</label>
                <input type="file" wire:model="photo" class="w-full" />
                @if ($photo)
                    <img src="{{ $photo->temporaryUrl() }}" class="w-24 h-24 rounded-full mt-3 shadow-md border" />
                @endif
                @error('photo')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex space-x-4 justify-end">
                {{--  --}}
                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg font-semibold transition-all duration-300">
                    {{ $editing ? 'تحديث' : 'إضافة' }}
                </button>

{{-- <button type="submit"
    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-semibold transition-all duration-300 flex items-center justify-center"
    x-bind:disabled="isUploading"
>
    <template x-if="isUploading">
        <svg class="animate-spin h-5 w-5 text-white mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor"
                d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
        </svg>
    </template>
    <span x-text="isUploading ? 'جاري رفع الصورة...' : '{{ $editing ? 'تحديث' : 'إضافة' }}'"></span>
</button> --}}
                {{--  --}}
                @if ($editing)
                    <button type="button" wire:click="resetForm"
                        class="bg-gray-400 hover:bg-gray-500 text-white px-5 py-2 rounded-lg font-semibold">إلغاء</button>
                @endif
            </div>
        </form>
    </div>

    {{-- Instructor Cards Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
        @foreach ($instructors as $instructor)
            <div
                class="bg-white rounded-xl shadow p-4 flex items-center space-x-4 transition hover:shadow-lg overflow-hidden">
                <!-- Photo Column -->
                <div class="flex-shrink-0">
                    <img src="{{ $instructor->photo ? asset('storage/' . $instructor->photo) : asset('/images/profile/user_ic.svg') }}"
                        class="w-24 h-24 rounded-xl object-cover border shadow" alt="{{ $instructor->name }}" />
                </div>

                <!-- Info Column -->
                <div class="flex-1 space-y-1 text-right overflow-hidden">
                    <h3 class="text-lg font-bold text-gray-900 truncate">{{ $instructor->name }}</h3>
                    <p class="text-gray-600 text-sm line-clamp-3 overflow-hidden">{{ $instructor->bio }}</p>
                    @if ($instructor->email)
                        <p class="text-gray-500 text-xs mt-1 truncate">{{ $instructor->email }}</p>
                    @endif
                </div>

                <!-- Actions Column -->
                @if (!($editing && $instructorId === $instructor->id))
                    <div class="flex flex-col items-center space-y-2">
                        <button wire:click="editInstructor({{ $instructor->id }})"
                            class="text-blue-600 hover:text-blue-800 transition" title="تعديل">
                            <x-heroicon-s-pencil class="w-5 h-5" />
                        </button>
                        <button onclick="confirmDelete({{ $instructor->id }})"
                            class="text-red-600 hover:text-red-800 transition" title="حذف">
                            <x-heroicon-s-trash class="w-5 h-5" />
                        </button>
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $instructors->links('pagination::tailwind') }}
    </div>


    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'هل أنت متأكد؟',
                text: 'سيتم حذف المدرب نهائياً!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'نعم، احذف',
                cancelButtonText: 'إلغاء'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.Livewire.dispatch('confirmInstructorDelete', {
                        id: id
                    });
                }
            });
        }
    </script>


</div>
