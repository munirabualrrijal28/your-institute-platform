<div class="space-y-6">

    <div class="flex items-center justify-between">
        <h2 class="text-xl font-bold text-gray-800">Courses ({{ $institute->courses_count }})</h2>
    </div>


    <!-- Courses Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($institute->courses as $course)
            <div class="bg-white border rounded-xl shadow p-4 flex flex-col justify-between">
                <div>
                    <img src="{{ $course->media->first()?->url ? asset('storage/' . $course->media->first()->url) : asset('images/default-course.jpg') }}"
                        class="w-full h-40 object-cover rounded mb-3">

                    <h3 class="text-lg font-semibold text-gray-800">{{ $course->course_name }}</h3>
                    <p class="text-sm text-gray-600 mt-1">{{ Str::limit($course->course_description, 80) }}</p>
                </div>

                <div class="mt-4 flex flex-wrap justify-between gap-2">
                    <!-- Edit -->
                    {{-- <a href="{{ route('admin.edit.course', $course->id) }}" --}}
                    {{-- <a href=""
                        class="text-sm px-4 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Edit</a> --}}

                    <!-- Delete -->
                    {{-- <form method="POST" action="{{ route('admin.delete.course', $course->id) }}" --}}
                    {{-- <form method="POST" action=""
                        onsubmit="return confirm('Are you sure you want to delete this course?')">
                        @csrf
                        @method('DELETE')
                        <button class="text-sm px-4 py-1 bg-red-500 text-white rounded hover:bg-red-600">Delete</button>
                    </form> --}}

                    <form method="POST" action="{{ route('admin.delete.course', $course->id) }}"
                        onsubmit="return confirm('Are you sure you want to delete this course? This cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-500 text-white px-3 py-1 text-sm rounded hover:bg-red-600 transition">
                            Delete
                        </button>
                    </form>




                    <!-- Comments -->
                    {{-- <a href="{{ route('admin.comments.course', $course->id) }}" --}}
                    <a class="text-sm px-4 py-1 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">
                        Comments ({{ $course->comments->count() }})
                    </a>
                </div>
            </div>
        @empty
            <p class="text-gray-500 col-span-full">No courses found for this institute.</p>
        @endforelse
    </div>
</div>
