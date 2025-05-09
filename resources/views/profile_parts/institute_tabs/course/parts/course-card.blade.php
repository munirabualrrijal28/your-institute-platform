<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-4">
    @foreach ($courses as $course)
        @php
            $images = $course->media->filter(fn($media) => Str::startsWith($media->type, 'image/'));
            $imageUrl = $images->isNotEmpty() ? asset('storage/' . $images->first()->url) : asset('images/default-course.jpg');
        @endphp

        <div x-data="{ showComments: false }" class="bg-white rounded-xl shadow-md p-4 flex flex-col h-full relative group">
            <!-- Course Image -->
            <img src="{{ $imageUrl }}" alt="Course Image" class="h-40 w-full object-cover rounded-md mb-3">

            <!-- Course Info -->
            <div class="flex-grow">
                <h3 class="text-lg font-bold text-gray-800 mb-1">{{ $course->course_name }}</h3>
                <p class="text-sm text-gray-500 mb-2">{{ Str::limit($course->course_description, 80) }}</p>
                <p class="text-xs text-gray-400">📅 {{ $course->created_at->diffForHumans() }}</p>

                <!-- 💬 Comments Trigger -->
                <button @click="showComments = true" class="text-blue-600 hover:underline text-sm mt-2">
                    💬 Comments ({{ $course->comments->count() }})
                </button>
            </div>

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

                    <!-- Livewire Comment Component -->
                    <livewire:course-comments :course="$course" :wire:key="'comments-'.$course->id" />
                </div>
            </div>

            <!-- Actions -->
            <div class="flex justify-between items-center pt-3 border-t mt-3">
                <!-- Edit -->
                <form action="{{ route('institute.manage_course', ['edit_id' => $course->id, 'tab' => 'courses']) }}" method="GET" class="d-inline me-2">
                    <input type="hidden" name="edit_id" value="{{ $course->id }}">
                    <button type="submit" class="btn btn-primary">
                        <i data-feather="edit"></i>
                    </button>
                </form>

                <!-- Delete -->
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
