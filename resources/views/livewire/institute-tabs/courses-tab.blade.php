<div class="space-y-6 ltr" dir="ltr">

    {{--  --}}
    {{--
    <div x-data x-init="window.confirmCourseDelete = (id) => {
        Swal.fire({
            title: 'هل أنت متأكد؟',
            text: 'سيتم حذف هذه الدورة نهائيًا!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'نعم، احذف',
            cancelButtonText: 'إلغاء'
        }).then((result) => {
            if (result.isConfirmed) {
                window.Livewire.dispatch('confirmCourseDelete', { id });
            }
        });
    };"></div> --}}


    {{-- <head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head> --}}
    {{--  --}}
    <div class="bg-white rounded-2xl p-6 shadow-md space-y-4 border border-gray-100">
        <h2 class="text-2xl font-bold text-gray-800">
            {{ $editing ? 'تعديل الدورة' : 'إضافة دورة جديدة' }}
        </h2>
        @if (session('message'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition
                class="bg-green-100 text-green-800 p-3 rounded-lg shadow">
                {{ session('message') }}
            </div>
        @endif
        <form wire:submit.prevent="saveCourse" wire:key="form-{{ $formKey }}" class="space-y-4"
            x-data="{ isUploading: false }" x-on:livewire-upload-start="isUploading = true"
            x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false">

            {{-- Course Name --}}
            <div>
                <label class="block font-medium text-sm mb-1">اسم الدورة</label>
                <input type="text" wire:model.defer="course_name"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                    required />
                @error('course_name')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Course Description --}}
            <div>
                <label class="block font-medium text-sm mb-1">وصف الدورة</label>
                <textarea wire:model.defer="course_description"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                    required></textarea>
                @error('course_description')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Category Dropdown --}}
            <div>
                <label class="block font-medium text-sm mb-1">الفئة</label>
                <select wire:model.defer="category_id"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    <option value="">اختر فئة</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Image Upload --}}
            {{-- Image Upload --}}
            <div>
                <label class="block font-medium text-sm mb-1">صور الدورة</label>
                <input type="file" wire:model="images" multiple class="w-full" />

                {{-- Preview --}}
                @if ($images)
                    <div class="flex space-x-2 mt-2">
                        @foreach ($images as $image)
                            <img src="{{ $image->temporaryUrl() }}"
                                class="w-20 h-20 object-cover rounded border shadow" />
                        @endforeach
                    </div>
                @elseif ($existingImage)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $existingImage) }}"
                            class="w-20 h-20 object-cover rounded border shadow" />
                    </div>
                @endif

                @error('images.*')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>
            {{-- Submit Buttons --}}
            <div class="flex justify-end space-x-4">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-semibold transition-all"
                    x-bind:disabled="isUploading">
                    <span x-show="!isUploading">{{ $editing ? 'تحديث' : 'إضافة' }}</span>
                    <span x-show="isUploading" class="flex items-center">
                        <svg class="animate-spin h-5 w-5 text-white mr-2" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4" />
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z" />
                        </svg>
                        جاري رفع الصور...
                    </span>
                </button>

                @if ($editing)
                    <button type="button" wire:click="resetForm"
                        class="bg-gray-400 hover:bg-gray-500 text-white px-5 py-2 rounded-lg font-semibold">
                        إلغاء
                    </button>
                @endif
            </div>

        </form>
    </div>


    {{--  --}}
    {{--  --}}
    {{--  --}}
    {{--  --}}
    {{--  --}}







    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

        @foreach ($courses as $course)
            <div wire:key="course-{{ $course->id }}"
                class="bg-white rounded-xl shadow-md overflow-hidden flex flex-col">

                {{-- Course Image --}}
                <div class="h-48 overflow-hidden">
                    <img src="{{ $course->media->first() ? asset('storage/' . $course->media->first()->url) : asset('/images/default-course.jpg') }}"
                        alt="{{ $course->course_name }}" class="w-full h-full object-cover" />
                </div>

                {{-- Course Info --}}
                <div class="p-4 flex-1 flex flex-col justify-between space-y-2 text-right">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 truncate">{{ $course->course_name }}</h3>
                        <p class="text-sm text-gray-600 line-clamp-3">{{ $course->course_description }}</p>
                    </div>

                    {{-- Actions --}}
                    <div class="flex justify-between items-center pt-2">
                        {{-- Comment Icon/Button --}}
                        {{-- <button wire:click="$emit('openComments', {{ $course->id }})"
                            class="text-blue-600 hover:text-blue-800 flex items-center space-x-1">
                            {{-- <x-heroicon-o-chat-alt class="w-5 h-5" /> --}}
                            {{-- <span class="text-sm">تعليقات</span> --}}
                        {{-- </button>  --}}
                        <button @click.window="window.dispatchEvent(new CustomEvent('open-comments', { detail: { courseId: {{ $course->id }} } }))"
    class="text-blue-600 hover:text-blue-800 flex items-center space-x-1">
    {{-- <x-heroicon-s-chat-alt class="w-5 h-5" /> --}}
    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
     viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.77 9.77 0 01-4.2-.9L3 21l1.42-3.39A7.98 7.98 0 013 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
</svg>

    <span class="text-sm">تعليقات</span>
</button>


{{-- <livewire:course-comments.course-comments :course-id="$course->id" :wire:key="'comments-'.$course->id" /> --}}

                        {{-- Edit/Delete (optional) --}}
                        <div class="flex space-x-3">
                            <button wire:click="editCourse({{ $course->id }})" title="تعديل"
                                class="text-gray-500 hover:text-blue-600">
                                <x-heroicon-s-pencil class="w-5 h-5" />
                            </button>

                            {{--  --}}
                            {{-- <button onclick="confirmCourseDelete({{ $course->id }})" title="حذف"
                                class="text-gray-500 hover:text-red-600">
                            <x-heroicon-s-trash class="w-5 h-5" />
                        </button> --}}
                            {{-- <button wire:click="confirmCourseDelete({{ $course->id }})"
                                class="text-red-600 hover:text-red-800 transition" title="حذف"> --}}
                            {{-- <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg> --}}
                            {{-- <x-heroicon-s-trash class="w-5 h-5" />
                            </button> --}}
                            {{--  --}}

                            {{-- <button onclick="confirmDelete({{ $course->id }})"
    class="text-red-600 hover:text-red-800 transition" title="حذف">
    <x-heroicon-s-trash class="w-5 h-5" />
</button> --}}
                            <button wire:click="$dispatch('confirmCourseDelete', {{ $course->id }})"
                                class="text-red-600 hover:text-red-800 transition" title="حذف">
                                <x-heroicon-s-trash class="w-5 h-5" />
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        @endforeach

    </div>

{{-- Comment Modal --}}
<div x-data="{ showComments: false, courseId: null }"
     @open-comments.window="showComments = true; courseId = $event.detail.courseId"
     x-cloak>

    <!-- Overlay -->
    <div x-show="showComments"
         class="fixed inset-0 bg-black bg-opacity-50 z-40"
         @click="showComments = false"></div>

    <!-- Modal Content -->
    <div x-show="showComments"
         class="fixed inset-0 flex items-center justify-center z-50 px-4 py-6 overflow-auto">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-6xl overflow-hidden"
             @click.away="showComments = false"
             x-transition>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 p-6 max-h-[90vh] overflow-y-auto">

                {{-- 🔹 LEFT: Comments --}}
                <div class="border-r border-gray-200 pr-4 overflow-y-auto">
<livewire:course-comments.course-comments :course-id="course_id" />
                </div>

                {{-- 🔹 RIGHT: Course Details --}}
                <div class="space-y-4">
                    @php
                        $courseMap = $courses->keyBy('id');
                    @endphp

                    <template x-if="courseId">
                        <div>
                            <h2 class="text-xl font-bold text-gray-800 mb-2">
                                {{ $courseMap[$course->id]->course_name ?? '' }}
                            </h2>
                            <p class="text-gray-600 leading-relaxed">
                                {{ $courseMap[$course->id]->course_description ?? '' }}
                            </p>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                                @foreach ($courseMap[$course->id]->media ?? [] as $media)
                                    <img src="{{ asset('storage/' . $media->url) }}"
                                         class="w-full h-48 object-cover rounded shadow" />
                                @endforeach
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <div class="text-right px-6 pb-4">
                <button @click="showComments = false"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                    إغلاق
                </button>
            </div>
        </div>
    </div>
</div>

    {{-- End Comment Modal  --}}


    {{--  --}}



    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('confirmCourseDelete', courseId => {
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
                        Livewire.dispatch('deleteConfirmedCourse', {
                            id: courseId
                        });
                    }
                });
            });
        });
    </script>

</div>
