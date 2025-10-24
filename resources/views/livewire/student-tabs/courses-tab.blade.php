<div>


    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-6">
        @foreach ($courses as $course)
            @php
                $imageUrl = $course->media->first()
                    ? asset('storage/' . $course->media->first()->url)
                    : asset('images/default-course.jpg');
            @endphp

            <div x-data="{ showComments: false, isUploading: false }" class="bg-white rounded-xl shadow-md overflow-hidden flex flex-col">
                <!-- Ad Image -->
                <img src="{{ $imageUrl }}" alt="Ad Image" class="w-full h-40 object-cover">

                <!-- Content -->
                <div class="p-4 flex flex-col flex-grow">
                    <h3 class="text-center text-lg font-bold text-gray-800 mb-1">{{ $course->course_name }}</h3>
                    <h3 class="text-center text-lg font-bold text-gray-800 mb-1">{{ $course->course_category }}</h3>
                    <p class="text-center text-sm text-gray-600 mb-2">{{ Str::limit($course->course_description, 80) }}
                    </p>
                    <p class="text-center text-xs text-gray-400 mb-2">📅 {{ $course->created_at->diffForHumans() }}</p>

                    <!-- 💬 Comments Trigger -->
                    <div class="text-center">
                        <button @click="showComments = true" class="text-blue-600 hover:underline text-sm">
                            💬 Comments ({{ $course->comments->count() }})
   {{--                                                     💬 Comments
 <livewire:student-tabs.course-comments.comment-count :course="$course"
                                :wire:key="'comments-'.$course->id" /> --}}
                                        {{-- 💬 Comments: {{ $commentCount ?? 0 }} --}}

                        </button>
                    </div>

                    <!-- Actions -->
                    <div class="mt-auto flex justify-center gap-3 pt-4 border-t">
                        <!-- Edit -->

                    </div>
                </div>

                <!-- Floating Comment Panel -->
                <!-- Comments Modal -->
                <div x-show="showComments" class="fixed inset-0 bg-white bg-opacity-40 z-40 flex flex-col md:flex-row"
                    @click.self="showComments = false" x-transition>
                    <div
                        class="w-full md:w-1/2 bg-gray-200 text-white flex flex-col justify-center items-center p-6 space-y-6">
                        <div class="text-lg text-black font-semibold text-center">{{ $course->course_description }}
                        </div>
                        <img src="{{ $imageUrl }}" alt="Course Image"
                            class="rounded-xl w-full max-h-64 md:max-h-72 object-cover">
                    </div>
                    <div class="w-full md:w-1/2 h-full bg-white shadow-xl p-4 overflow-y-auto">
                        <div class="flex justify-between items-center border-b pb-2 mb-4">
                            <h2 class="text-lg font-bold">التعليقات</h2>
                            <button @click="showComments = false"
                                class="text-gray-500 hover:text-red-500 text-xl">✖</button>
                        </div>
                        <livewire:student-tabs.course-comments.course-comments :course="$course"
                            :wire:key="'comments-'.$course->id" />
                    </div>
                </div>
            </div>
        @endforeach

        <div class="mt-6 flex justify-center">

            {!! $courses->links() !!}

        </div>
    </div>



</div>
