@extends('profile_parts.lib')

@section('lib_layout')
    {{-- @php
        $isEdit = isset($editCourse);
    @endphp --}}
    {{-- <div class="container mx-auto">
        {{--  --}}
    {{-- <button @click="showForm = !showForm" --}}
    {{-- class="bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded-xl transition-all duration-300"> --}}
    {{-- + Add New Course --}}
    {{-- </button> --}}
    {{-- --}}


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
                            <input type="file" name="course_files[]" class="w-full border-gray-300 rounded-lg px-3 py-2"
                                accept="image/*,video/*,audio/*" multiple>
                        </div>

                        <div class="text-end">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Course Cards Grid with Pagination -->
        {{-- <div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <template x-for="course in paginatedCourses" :key="course.id">
                    <div class="bg-white rounded-xl shadow overflow-hidden flex flex-col h-full">
                        <img :src="course.photo || '/images/profile/user_ic.svg'"
                            class="h-40 w-full object-cover">
                        <div class="p-4 flex flex-col flex-grow">
                            <h3 class="text-lg font-semibold mb-2" x-text="course.name"></h3>
                            <p class="text-gray-600 text-sm flex-grow" x-text="course.bio"></p>
                        </div>
                    </div>
                </template>
            </div> --}}

        <!-- Pagination Controls -->
        <div class="flex justify-between items-center mt-6">
            <button @click="prevPage" :disabled="currentPage === 1"
                class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 disabled:opacity-50 disabled:cursor-not-allowed">
                السابق
            </button>
            <div class="text-gray-600">
                الصفحة <span x-text="currentPage"></span> من <span x-text="totalPages"></span>
            </div>
            <button @click="nextPage" :disabled="currentPage === totalPages"
                class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 disabled:opacity-50 disabled:cursor-not-allowed">
                التالي
            </button>
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

                    {{-- @include('livewire.course-comments') --}}
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



            {{-- <script>
                    document.addEventListener('alpine:init', () => {
                        Alpine.data('coursesPage', () => ({
                            // courses: [
                            //   { id: 1, name: 'محمد سفيان الرياشي', bio: 'مختص في دورات الجرافيكس', photo: null },
                            //   { id: 2, name: 'عبدالله الحاشدي', bio: 'مختص في دورات البرمجة', photo: null },
                            //   { id: 3, name: 'مصطفى  المقطري', bio: 'مختص في دورات اللغة الهندية', photo: null },
                            //   { id: 4, name: 'منير نعمان ابوالرجال', bio: 'مختص في دورات اللغة الإنجليزية', photo: null },
                            // ]
                            ,
                            currentPage: 1,
                            perPage: 8,
                            get paginated() {
                                const start = (this.currentPage - 1) * this.perPage;
                                return this.courses.slice(start, start + this.perPage);
                            },
                            get totalPages() {
                                return Math.ceil(this.courses.length / this.perPage);
                            },
                            nextPage() {
                                if (this.currentPage < this.totalPages) this.currentPage++;
                            },
                            prevPage() {
                                if (this.currentPage > 1) this.currentPage--;
                            }
                        }))
                    })
                </script> --}}

            {{-- <script>
                    document.addEventListener("DOMContentLoaded", function () {
    // Re-run feather icons after each tab switch
    document.querySelectorAll("[data-tab]").forEach((tabBtn) => {
        tabBtn.addEventListener("click", () => {
            setTimeout(() => {
                feather.replace(); // Refresh icons
            }, 50); // Slight delay to allow DOM to update
        });
    });
}); --}}

            </script>



        </div>



    </div>

    {{--  --}}
    {{--  --}}

    {{--  --}}
    {{--  --}}

    </div>
@endsection
