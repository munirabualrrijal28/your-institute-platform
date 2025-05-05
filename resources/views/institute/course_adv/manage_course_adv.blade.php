@extends('institute.layouts.layout')

@section('institute_page_title')
    Create Course Advertisement - Institute Panel
@endsection

@section('institute_sidebar_name')
    {{-- Institute Name --}}
@endsection

@section('institute_layout')
    {{-- <h2>Create Course Advertisement Page</h2> --}}
    <hr>
    <br>
    @php
    $isEdit = isset($editCourseAdv);
@endphp
    <!-- Add Course Adv Button -->
    <div class="mb-4 text-end">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addCourseModal">
            Add Course Adv
        </button>
    </div>

    <!--Add Modal -->
    <div class="modal fade" id="addCourseModal" tabindex="-1" aria-labelledby="addCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content p-3">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCourseModalLabel">إضافة إعلان دورة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="modal-body">
                    @if (session('message'))
                        <div class="alert alert-success" id="update-message">{{ session('message') }}</div>
                    @endif

                    <form action="{{ route('institute.store.course_adv') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="course_adv_name" class="form-label">اسم الدورة</label>
                            <input type="text" name="course_adv_name" class="form-control" required
                                value="{{ old('course_adv_name') }}" placeholder="Course Name" autocomplete="off">
                        </div>

                        <div class="mb-3">
                            <label for="category_id_fk" class="form-label">التصنيف</label>
                            <select name="category_id_fk" class="form-select" required>
                                <option value="">-- اختر التصنيف --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id_fk') == $category->id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="course_adv_description" class="form-label">وصف الدورة</label>
                            <textarea name="course_adv_description" rows="4" class="form-control resize-y" required>{{ old('course_adv_description') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="course_photo" class="form-label">صورة الدورة (اختياري)</label>
                            <input type="file" name="course_photo" accept="image/*" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="course_files" class="form-label">Related Files (اختياري)</label>
                            <input type="file" name="course_files[]" class="form-control" multiple>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    {{--  --}}
    <!--Edit Modal -->
    <div class="modal fade" id="editCourseModal" tabindex="-1" aria-labelledby="editCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content p-3">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCourseModalLabel"> Update Course</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>

                <div class="modal-body">
                    @if (session('message'))
                        <div class="alert alert-success" id="update-message">{{ session('message') }}</div>
                    @endif


                    <form
                    method="POST"
                    action="{{ $isEdit ? route('institute.update_course_adv', $editCourseAdv->id) : route('institute.store.course_adv') }}"
                    enctype="multipart/form-data">

                    @csrf
                    @if($isEdit)
                        @method('PUT')
                    @endif

                    <input type="hidden" name="institute_id_fk" value="{{ \App\Http\Controllers\Controller::getInstituteId() }}">

                    <div class="mb-3">
                        <label class="form-label">اسم الدورة</label>
                        <input
                            type="text"
                            name="course_adv_name"
                            class="form-control"
                            value="{{ old('course_adv_name', $isEdit ? $editCourseAdv->course_adv_name : '') }}"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">وصف الدورة</label>
                        <textarea
                            name="course_adv_description"
                            class="form-control"
                            rows="4"
                            required
                        >{{ old('course_adv_description', $isEdit ? $editCourseAdv->course_adv_description : '') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">التصنيف</label>
                        <select name="category_id_fk" class="form-select" required>
                            <option value="">-- اختر التصنيف --</option>
                            @foreach ($categories as $cat)
                                <option
                                    value="{{ $cat->id }}"
                                    {{ old('category_id_fk', $isEdit ? $editCourseAdv->category_id_fk : '') == $cat->id ? 'selected' : '' }}
                                >
                                    {{ $cat->category_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="course_photo" class="form-label">صورة الدورة (اختياري)</label>
                        <input type="file" name="course_photo" accept="image/*" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">الملفات المتعلقة (اختياري)</label>
                        <input type="file" name="course_files[]" class="form-control" multiple>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            {{ 'تحديث' }}
                        </button>
                    </div>
                </form>


                </div>
            </div>
        </div>
    </div>

    {{--  --}}
    {{-- Start Manage Part  --}}

    {{-- <h2>Manage Course Advertisement Page</h2> --}}

    @if ($errors->any() || session('message'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var modal = new bootstrap.Modal(document.getElementById('addCourseModal'));
                // modal.show();
            });
        </script>
    @endif
    {{--  --}}

    {{--  --}}
    <div class="row g-4">
        <div id="course-cards" class="row g-4">
            @include('institute.course_adv.parts.course_cards')
            {{-- @include('livewire.course-comments') --}}
        </div>

        </div>

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

        <!-- Auto Hide Success Message -->
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

        {{-- Script down here for edit button CourseAdv  --}}


@if(isset($editCourseAdv))
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var modal = new bootstrap.Modal(document.getElementById('editCourseModal'));
        modal.show();
        // After showing, remove ?edit_id=... from the URL without reloading
        if (window.history.replaceState) {
            const url = new URL(window.location);
            url.searchParams.delete('edit_id');
            window.history.replaceState({}, document.title, url.toString());
        }
    });
</script>
@endif

<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.addEventListener("click", function (e) {
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
                    const newContent = html.querySelector('#courseAdvCards').innerHTML;

                    document.querySelector('#courseAdvCards').innerHTML = newContent;
                });
            }
        });
    });
</script>


{{-- For Showing some cards at a time Pagination --}}
{{-- <script>
    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        const url = $(this).attr('href');

        $.ajax({
            url: url,
            dataType: 'html',
            success: function (data) {
                $('#course-cards').html(data);
                window.history.pushState({}, '', url); // optional: update URL
            }
        });
    });
</script> --}}
{{-- End of Pagination Logic --}}


{{--  --}}
{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.comment-form').forEach(function (form) {
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                let courseId = form.dataset.courseId;
                let formData = new FormData(form);

                fetch("{{ route('institute.comments_store') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // ✅ Add the new comment immediately to the comment section
                        const commentSection = document.querySelector(`#commentsModal${courseId} .modal-body`);

                        const newComment = document.createElement('div');
                        newComment.classList.add('mb-3', 'p-2', 'border-bottom');
                        newComment.innerHTML = `
                            <strong>${data.comment.user_name}</strong>
                            <span class="text-muted small">🕒 just now</span>
                            <p class="mb-0">${data.comment.content}</p>
                        `;

                        commentSection.prepend(newComment);

                        // Clear textarea
                        form.querySelector('textarea[name="content"]').value = '';

                    } else {
                        alert('Something went wrong while posting your comment.');
                    }
                })
                .catch(error => {
                    console.error(error);
                    alert('Error while posting comment.');
                });
            });
        });
    });
    </script> --}}

{{--  --}}

    @endsection
