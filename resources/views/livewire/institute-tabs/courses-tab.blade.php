@php use Illuminate\Support\Str; @endphp
@extends('profile_parts.lib')

@section('lib_layout')

<div class="space-y-6">
    <!-- Add New Course Button and Form -->
    <div class="bg-white p-6 rounded-xl shadow">
        <div x-data="{ showForm: false }">
            <button @click="showForm = !showForm"
                class="bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded-xl transition-all duration-300">
                + أضف دورة جديدة
            </button>

            <div x-show="showForm" x-transition class="mt-6">
                <form action="{{ route('institute.store.course') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="block font-medium mb-1">اسم الدورة</label>
                        <input type="text" name="course_name" class="w-full border-gray-300 rounded-lg px-3 py-2"
                            required value="{{ old('course_name') }}" placeholder="Course Name">
                    </div>

                    <div class="mb-3">
                        <label class="block font-medium mb-1">التصنيف</label>
                        <select name="category_id_fk" class="w-full border-gray-300 rounded-lg px-3 py-2" required>
                            <option value="">-- اختر التصنيف --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id_fk') == $category->id ? 'selected' : '' }}>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="block font-medium mb-1">وصف الدورة</label>
                        <textarea name="course_description" rows="4"
                            class="w-full border-gray-300 rounded-lg px-3 py-2 resize-y">{{ old('course_description') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="block font-medium mb-1">الملفات المتعلقة</label>
                        <input type="file" name="course_files[]" class="w-full border-gray-300 rounded-lg px-3 py-2"
                            accept="image/*,video/*,audio/*" multiple>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Course Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach ($courses as $course)
            @php
                $images = $course->media->filter(fn($media) => Str::startsWith($media->type, 'image/'));
                $imageUrl = $images->isNotEmpty() ? asset('storage/' . $images->first()->url) : asset('images/default-course.jpg');
            @endphp

            <div x-data="{ showComments: false }" class="bg-white rounded-xl shadow-md p-4 flex flex-col h-full relative">
                <!-- Course Image -->
                <img src="{{ $imageUrl }}" alt="Course Image" class="h-40 w-full object-cover rounded-md mb-3">

                <!-- Info -->
                <h3 class="text-lg font-bold text-gray-800 mb-1">{{ $course->course_name }}</h3>
                <p class="text-sm text-gray-500 mb-2">{{ Str::limit($course->course_description, 80) }}</p>
                <p class="text-xs text-gray-400">📅 {{ $course->created_at->diffForHumans() }}</p>

                <!-- 💬 Comments Button -->
                <button @click="showComments = true" class="text-blue-600 hover:underline text-sm mt-2">
                    💬 Comments ({{ $course->comments->count() }})
                </button>

                <!-- Floating Comment Panel -->
                <div x-show="showComments"
                    class="fixed inset-0 bg-black bg-opacity-40 z-40"
                    @click.self="showComments = false"
                    x-transition>
                    <div class="absolute right-0 top-0 h-full w-full sm:w-[450px] bg-white shadow-xl p-4 overflow-y-auto z-50">
                        <div class="flex justify-between items-center border-b pb-2 mb-4">
                            <h2 class="text-lg font-bold">Comments</h2>
                            <button @click="showComments = false" class="text-gray-500 hover:text-red-500">✖</button>
                        </div>

                        <!-- Livewire Comment Section -->
                        <livewire:course-comments :course="$course" :wire:key="'comments-'.$course->id" />
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex justify-between items-center pt-3 border-t mt-3">
                    <form action="{{ route('institute.manage_course', ['edit_id' => $course->id, 'tab' => 'courses']) }}" method="GET">
                        <input type="hidden" name="edit_id" value="{{ $course->id }}">
                        <button type="submit" class="btn btn-primary">
                            <i data-feather="edit"></i>
                        </button>
                    </form>
                    <form action="{{ route('institute.delete.course', $course->id) }}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger" onclick="confirmDelete(this)">
                            <i data-feather="delete"></i>
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

 

<!-- Delete Confirm -->
<script>
    function confirmDelete(button) {
        const form = button.closest('form');
        Swal.fire({
            title: 'Are you sure?',
            text: "Everything related to this course will be deleted too!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }
</script>

@endsection
