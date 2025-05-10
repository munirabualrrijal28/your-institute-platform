<div class="space-y-6 ltr" dir="ltr">

    {{-- Flash Message --}}
    {{-- @if (session('message'))
        <div class="bg-green-100 text-green-800 p-3 rounded-lg shadow animate-fade-in">
            {{ session('message') }}
        </div>
    @endif --}}
    {{-- with timer --}}
    @if (session('message'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition
            class="bg-green-100 text-green-800 p-3 rounded-lg shadow animate-fade-in">
            {{ session('message') }}
        </div>
    @endif
    {{-- Add/Edit Form --}}
    <div class="bg-white rounded-2xl p-6 shadow-md space-y-4 border border-gray-100">
        <h2 class="text-2xl font-bold text-gray-800">
            {{ $editing ? 'تعديل القسم' : 'إضافة قسم جديدة' }}
        </h2>

        <form wire:submit.prevent="saveCategory" wire:key="form-{{ $formKey }}" x-data="{ isUploading: false }"
            x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false"
            x-on:livewire-upload-error="isUploading = false">
            <div>
                <label class="block font-medium text-sm mb-1">اسم القسم</label>
                <input type="text" wire:model.defer="category_name"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                    required />
                @error('category_name')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-medium text-sm mb-1">الوصف</label>
                <textarea wire:model.defer="category_des"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                    required></textarea>
                @error('category_des')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-medium text-sm mb-1">الصورة</label>
                <input type="file" wire:model="category_photo" class="w-full" />
                {{--  --}}
                {{-- @if ($category_photo)
                    <img src="{{ $category_photo->temporaryUrl() }}"
                        class="w-24 h-24 rounded mt-3 shadow-md border object-cover" />
                @endif --}}
                @if ($category_photo)
                    {{-- When a new image is uploaded --}}
                    <img src="{{ $category_photo->temporaryUrl() }}"
                        class="w-24 h-24 rounded mt-3 shadow-md border object-cover" />
                @elseif ($editing && $categoryId)
                    {{-- When editing, show the existing stored image --}}
                    @php
                        $category = \App\Models\Category::find($categoryId);
                    @endphp
                    @if ($category && $category->category_photo)
                        <img src="{{ asset('storage/' . $category->category_photo) }}"
                            class="w-24 h-24 rounded mt-3 shadow-md border object-cover" />
                    @endif
                @endif
                {{--  --}}
                @error('category_photo')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex space-x-4 justify-end">
                {{-- <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-semibold transition-all duration-300">
                    {{ $editing ? 'تحديث' : 'إضافة' }}
                </button> --}}
                {{--  --}}
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-semibold transition-all duration-300 flex items-center justify-center"
                    x-bind:disabled="isUploading">
                    <template x-if="isUploading">
                        <svg class="animate-spin h-5 w-5 text-white mr-2" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                        </svg>
                    </template>
                    <span x-text="isUploading ? 'جاري رفع الصورة...' : '{{ $editing ? 'تحديث' : 'إضافة' }}'"></span>
                </button>
                {{--  --}}
                @if ($editing)
                    <button type="button" wire:click="resetForm"
                        class="bg-gray-400 hover:bg-gray-500 text-white px-5 py-2 rounded-lg font-semibold">إلغاء</button>
                @endif
            </div>
        </form>
    </div>

    {{-- Categories Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach ($categories as $category)
            <div wire:key="category-{{ $category->id }}"
                class="bg-white rounded-xl shadow p-4 transition hover:shadow-lg overflow-hidden flex flex-col">
                <!-- Image -->
                <div class="w-full h-40 mb-4 overflow-hidden rounded-xl">
                    <img src="{{ $category->category_photo ? asset('storage/' . $category->category_photo) : asset('/images/default-category.jpg') }}"
                        class="w-full h-full object-cover" alt="{{ $category->category_name }}" />
                </div>

                <!-- Info -->
                <div class="flex-1 space-y-1 text-right overflow-hidden">
                    <h3 class="text-lg font-bold text-gray-900 truncate">{{ $category->category_name }}</h3>
                    <p class="text-gray-600 text-sm line-clamp-3 overflow-hidden">{{ $category->category_des }}</p>
                </div>

                <!-- Actions -->
                @if (!($editing && $categoryId === $category->id))
                    <div class="flex justify-end space-x-3 pt-4">
                        <button wire:click="editCategory({{ $category->id }})"
                            class="text-blue-600 hover:text-blue-800 transition" title="تعديل">
                            <x-heroicon-s-pencil class="w-5 h-5" />
                        </button>
                        {{-- <button onclick="confirmCategoryDelete({{ $category->id }})"
                            class="text-red-600 hover:text-red-800 transition" title="حذف">
                            <x-heroicon-s-trash class="w-5 h-5" />
                        </button> --}}
                        {{-- <button onclick="confirmCategoryDelete({{ $category->id }})"> --}}
                        {{-- <button wire:click="deleteCategory({{ $category->id }})"
                            class="text-red-600 hover:text-red-800 transition" title="حذف">
                            <x-heroicon-s-trash class="w-5 h-5" />
                        </button> --}}


                        <button wire:click="$dispatch('confirmCategoryDelete', {{ $category->id }})"
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
        {{ $categories->links('pagination::tailwind') }}
    </div>
    <script>
        function confirmCategoryDelete(id) {
            Swal.fire({
                title: 'هل أنت متأكد؟',
                text: 'سيتم حذف الدورة القسم!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'نعم، احذف',
                cancelButtonText: 'إلغاء'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('deleteConfirmedCategory', {
                        id: id
                    });
                }
            });
        }
    </script>


    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('confirmCategoryDelete', courseId => {
                Swal.fire({
                    title: 'هل أنت متأكد؟',
                    text: 'سيتم حذف الدورة نهائيًا!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'نعم، احذف',
                    cancelButtonText: 'إلغاء'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch('deleteConfirmedCategory', {
                            id: courseId
                        });
                    }
                });
            });
        });
    </script>


</div>
