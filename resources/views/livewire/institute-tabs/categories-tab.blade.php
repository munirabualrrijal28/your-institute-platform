    @php
        use App\Models\Institute;
        $user = Auth::user();
        // dd($user->id);
        // $institute = Institute::where('user_id_fk', $user->id)->first();
        $institute = Institute::where('id', $instituteId)->first();
// dd($institute);
$blocked = !$institute || !$institute->ins_is_verified || $institute->is_restricted;
        // dd($blocked);
    @endphp
<div class="space-y-6 ltr" dir="ltr">


    {{-- Flash Message --}}
    @if (session('message'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition
            class="bg-green-100 text-green-800 p-3 rounded-lg shadow animate-fade-in">
            {{ session('message') }}
        </div>
    @endif

    {{-- Add/Edit Form --}}
    <div class="bg-white rounded-2xl p-6 shadow-md space-y-4 border border-gray-100">
        <h2 class="text-2xl font-bold text-gray-800">
            {{ $editing ? 'تعديل القسم' : 'إضافة قسم جديد' }}
        </h2>
        @if ($blocked)
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-xl">
                <p class="font-semibold">⚠ لا يمكنك إضافة أو تعديل الأقسام حالياً.</p>
                <ul class="mt-2 list-disc list-inside text-sm">
                    @if (!$institute->ins_is_verified)
                        <li>المعهد غير موثق. الرجاء انتظار التوثيق من قبل الإدارة.</li>
                    @elseif ($institute->is_restricted)
                        <li>تم تقييد المعهد من قبل الإدارة. يرجى التواصل مع الدعم.</li>
                    @endif
                </ul>
            </div>
        @else
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

                    @if ($category_photo)
                        <img src="{{ $category_photo->temporaryUrl() }}"
                            class="w-24 h-24 rounded mt-3 shadow-md border object-cover" />
                    @elseif ($editing && $categoryId)
                        @php
                            $category = \App\Models\Category::find($categoryId);
                        @endphp
                        @if ($category && $category->category_photo)
                            <img src="{{ asset('storage/' . $category->category_photo) }}"
                                class="w-24 h-24 rounded mt-3 shadow-md border object-cover" />
                        @endif
                    @endif

                    @error('category_photo')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex space-x-4 justify-end">
                    <button type="submit"
                        class="flex items-center justify-center px-5 py-2 rounded-lg font-semibold transition-all duration-300
                               text-white bg-blue-600 hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed"
                        x-bind:disabled="isUploading">

                        <template x-if="isUploading">
                            <svg class="animate-spin h-5 w-5 text-white mr-2" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4" />
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z" />
                            </svg>
                        </template>

                        <span x-text="isUploading ? 'جاري الرفع...' : '{{ $editing ? 'تحديث' : 'إضافة' }}'"></span>
                    </button>

                    @if ($editing)
                        <button type="button" wire:click="resetForm"
                            class="bg-gray-400 hover:bg-gray-500 text-white px-5 py-2 rounded-lg font-semibold">
                            إلغاء
                        </button>
                    @endif
                </div>
            </form>
        @endif


    </div>

    {{-- Categories Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach ($categories as $category)
            {{-- @if ($category->id == 22) --}}
{{--  --}}
    <a href="{{ route('categories_ins_courses', $category->id) }}" target="_blank" class="block">

            <div wire:key="category-{{ $category->id }}"
                class="bg-white rounded-xl shadow p-4 transition hover:shadow-lg overflow-hidden flex flex-col">
                <div class="w-full h-40 mb-4 overflow-hidden rounded-xl">
                    <img src="{{ $category->category_photo ? asset('storage/' . $category->category_photo) : asset('/images/default-category.jpg') }}"
                        class="w-full h-full object-cover" alt="{{ $category->category_name }}" />
                </div>

                <div class="flex-1 space-y-1 text-right overflow-hidden">
                    <h3 class="text-lg font-bold text-gray-900 truncate">{{ $category->category_name }}</h3>
                    <p class="text-gray-600 text-sm line-clamp-3 overflow-hidden">{{ $category->category_des }}</p>
                </div>

                {{-- @if (!($editing && $categoryId === $category->id))
                    <div class="flex justify-end space-x-3 pt-4">
                        <button wire:click="editCategory({{ $category->id }})"
                            class="text-blue-600 hover:text-blue-800 transition" title="تعديل">
                            <x-heroicon-s-pencil class="w-5 h-5" />
                        </button>
                        <button wire:click="confirmDelete({{ $category->id }})"
                            class="text-red-600 hover:text-red-800 transition" title="حذف">
                            <x-heroicon-s-trash class="w-5 h-5" />
                        </button>
                    </div>
                @endif --}}
                @if (!$blocked && !($editing && $categoryId === $category->id))
                    <div class="flex justify-end space-x-3 pt-4">
                        <button wire:click="editCategory({{ $category->id }})"
                            class="text-blue-600 hover:text-blue-800 transition" title="تعديل">
                            <x-heroicon-s-pencil class="w-5 h-5" />
                        </button>
                        <button wire:click="confirmDelete({{ $category->id }})"
                            class="text-red-600 hover:text-red-800 transition" title="حذف">
                            <x-heroicon-s-trash class="w-5 h-5" />
                        </button>
                    </div>
                @endif

            </div>
    </a>
{{--  --}}
            {{-- @endif --}}
        @endforeach
        <div class="mt-6 flex justify-center">
            {!! $categories->withQueryString()->links() !!}
        </div>
    </div>



    <!-- Delete Confirmation Modal -->
    @if ($confirmingDelete)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-xl shadow-lg max-w-sm w-full text-center">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">هل أنت متأكد؟</h2>
                <p class="text-gray-600 mb-6">سيتم حذف القسم لا يمكن التراجع.</p>
                <div class="flex justify-center gap-4">
                    <button wire:click="deleteCategory"
                        class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">نعم،
                        احذف</button>
                    <button wire:click="$set('confirmingDelete', false)"
                        class="bg-gray-300 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-400 transition">إلغاء</button>
                </div>
            </div>
        </div>
    @endif
{{--
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('confirmCategoryDelete', courseId => {
                Swal.fire({
                    title: 'هل أنت متأكد؟',
                    text: 'سيتم حذف القسم مع كل الدورات المتعلقة به نهائيًا!',
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
    </script> --}}

</div>
