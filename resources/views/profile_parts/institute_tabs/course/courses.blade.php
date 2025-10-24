@extends('profile_parts.lib')

@section('lib_layout')
    <div x-data="{ showAnyComments: false }"> <!-- 👈 Add a wrapper Alpine scope to manage visibility globally -->
  

        <div class="space-y-6" x-data="coursesPage">



            <!-- Add New Course Button and Form -->
            <div class="bg-white p-6 rounded-xl shadow">
                <div x-data="{ showForm: false }">
                    <button @click="showForm = !showForm"
                        class="bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded-xl transition-all duration-300">
                        + أضف مدرب جديد
                    </button>

                    <div x-show="showForm" x-transition class="mt-6">
                        <form action="{{ route('institute.store.course') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="block font-medium mb-1">اسم الدورة</label>
                                <input type="text" name="course_name" class="w-full border-gray-300 rounded-lg px-3 py-2"
                                    required value="{{ old('course_name') }}" placeholder="Course Name" autocomplete="off">
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
                                <textarea name="course_description" rows="4" class="w-full border-gray-300 rounded-lg px-3 py-2 resize-y"
                                    required>{{ old('course_description') }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="block font-medium mb-1">الملفات المتعلقة (اختياري)</label>
                                <input type="file" name="course_files[]"
                                    class="w-full border-gray-300 rounded-lg px-3 py-2" accept="image/*,video/*,audio/*"
                                    multiple>
                            </div>

                            <div class="text-end">
                                <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



        </div>







        {{--  --}}
        {{--  --}}

        {{-- <h2>Manage Category Page</h2> --}}

        {{--  --}}
        {{-- <h2>Manage Category Page</h2> --}}
        <div class="row">

            <div class="card">

                <div class="row d-inline-block">

                    {{-- Grid container for category cards --}}
                    {{-- <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 p-4"> --}}


                    <div id="course-cards" class="row g-4 ">
                        {{-- @include('profile_parts.institute_tabs.course.parts.course_cards') --}}
                        @include('profile_parts.institute_tabs.course.parts.course-card', [
                            'course' => $courses,
                        ])

                    </div>

                    {{-- </div> --}}
                    {{-- End of grid container --}}


                </div>


                {{-- <script>
                    function confirmDelete() {
                        return confirm('Are you sure you want to delete this category?');
                    }
                </script> --}}



                <!-- code down here after click on delete button it will show custom dialog to continue or not -->
                <!-- why using this code because if delete button was pressed accedentlly it will directly delete the item , so this code is safe approach -->


                <!-- Auto Hide Success Message -->

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
                    });
                </script>


                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const message = document.getElementById('update-message');
                        if (message) {
                            setTimeout(() => {
                                message.style.transition = 'opacity 1s';
                                message.style.opacity = '0';
                                setTimeout(() => {
                                    message.remove();
                                }, 1000);
                            }, 3000);
                        }
                    });
                </script>
                {{-- End Manage Part  --}}





                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        document.addEventListener("click", function(e) {
                            if (e.target.closest('.pagination a')) {
                                e.preventDefault();
                                const url = e.target.closest('a').getAttribute('href');

                                fetch(url, {
                                        headers: {
                                            'X-Requested-With': 'XMLHttpRequest'
                                        }
                                    })
                                    .then(response => response.text())
                                    .then(data => {
                                        const parser = new DOMParser();
                                        const html = parser.parseFromString(data, 'text/html');
                                        const newContent = html.querySelector('#courseCards').innerHTML;

                                        document.querySelector('#courseCards').innerHTML = newContent;

                                        // ✅ Fix: Re-render feather icons after DOM update
                                        feather.replace();
                                    });
                            }
                        });
                    });
                </script>





                </script>



            </div>



        </div>

        {{--  --}}
        {{--  --}}

        {{--  --}}
        {{--  --}}
        <!-- Pagination -->
        {{-- <div class="d-flex justify-content-center mt-4">
            {{ $courses->links() }}
        </div> --}}
<!-- Pagination -->
<div class="mt-6 flex justify-center">
    {!! $courses->withQueryString()->links() !!}
</div>

    </div>
@endsection
