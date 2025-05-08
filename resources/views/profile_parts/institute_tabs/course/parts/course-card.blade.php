@php use Illuminate\Support\Str; @endphp
@extends('profile_parts.lib')

@section('lib_layout')



<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-4">
    @foreach ($courses as $course)
        @php
            $images = $course->media->filter(fn($media) => Str::startsWith($media->type, 'image/'));
            $imageUrl = $images->isNotEmpty() ? asset('storage/' . $images->first()->url) : asset('images/default-course.jpg');
        @endphp

        <div class="bg-white rounded-xl shadow-md p-4 flex flex-col h-full relative group">
            <!-- Course Image -->
            <img src="{{ $imageUrl }}" alt="Course Image"
                 class="h-40 w-full object-cover rounded-md mb-3">

            <!-- Course Info -->
            <div class="flex-grow">
                <h3 class="text-lg font-bold text-gray-800 mb-1">{{ $course->course_name }}</h3>
                <p class="text-sm text-gray-500 mb-2">{{ Str::limit($course->course_description, 80) }}</p>
                <p class="text-xs text-gray-400">📅 {{ $course->created_at->diffForHumans() }}</p>

                     <!-- ✅ ADD THIS inside the course card -->
            <livewire:course-comments :course="$course" :wire:key="'comments-'.$course->id" />
            </div>

            <!-- Actions -->
            <div class="flex justify-between items-center pt-3 border-t mt-3">
                <!-- Edit Icon -->



                {{-- <form method="POST" action="{{ route('institute.delete.course', $course->id) }}" class="delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="button" title="Delete"
                            onclick="confirmDelete(this)"
                            class="text-red-500 hover:text-red-700">
                        <i data-feather="trash-2" class="w-5 h-5"></i>
                    </button>
                </form> --}}

                {{--  --}}
                  {{-- Edit Button --}}
                  <form action="{{ route('institute.manage_course'  ,['edit_id' => $course->id, 'tab' => 'courses']) }}" method="GET" class="d-inline me-2">
                    <input type="hidden" name="edit_id" value="{{ $course->id }}">
                    <button type="submit"  class="btn btn-primary">
                        <i data-feather="edit"></i>
                    </button>
                </form>

                {{-- Delete Button --}}
                <form action="{{ route('institute.delete.course', $course->id) }}" method="POST"
                    class="delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger" onclick="confirmDelete(this)">
                        <i data-feather="delete"></i>
                    </button>
                </form>
                <!-- Optional View Icon (if needed) -->
                {{-- <a href="#" title="View Details" class="text-gray-600 hover:text-teal-600">
                    <i data-feather="eye" class="w-5 h-5"></i>
                </a> --}}
            </div>
        </div>
    @endforeach
</div>









<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('coursesPage', () => ({
            courses: @json($courses ?? []), // ensure courses data is passed correctly
            currentPage: 1,
            perPage: 8, // 2 rows x 4 columns

            get totalPages() {
                return Math.ceil(this.courses.length / this.perPage);
            },

            get paginatedCourses() {
                const start = (this.currentPage - 1) * this.perPage;
                return this.courses.slice(start, start + this.perPage);
            },

            nextPage() {
                if (this.currentPage < this.totalPages) {
                    this.currentPage++;
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                }
            },

            prevPage() {
                if (this.currentPage > 1) {
                    this.currentPage--;
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                }
            }
        }));
        Alpine.effect(() => {
    feather.replace();
});
    });
</script>



{{-- End Manage Part  --}}

<!-- SweetAlert Delete Confirmation -->
<script>
    function confirmDelete(button) {

        const form = button.closest('form');
        Swal.fire({
            title: 'Are you sure?',
            text: "Everything related to this Course Adv will be deleted too!",
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

{{-- Pagination --}}
<div class="mt-4 d-flex justify-content-center">
    {{-- {!! $courses->withQueryString()->links() !!} --}}
</div>

@endsection
