{{-- @extends('institute.layouts.layout')

@section('institute_page_title')
Manage Course Advertisement - Institute Panel
@endsection

@section('institute_sidebar_name')
Institute Name
@endsection

@section('institute_layout')



<h2>Manage Course Advertisement Page</h2>

@if (session('message'))
    <div class="alert alert-success my-2" id="update-message">
        {{ session('message') }}
    </div>
@endif

 <!-- Add Course Adv Button -->
 <div class="mb-4 text-end">
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addCourseModal">
       Update Course Adv
    </button>
</div>

<!-- Modal -->
<div class="modal fade" id="addCourseModal" tabindex="-1" aria-labelledby="addCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content p-3">
            <div class="modal-header">
                <h5 class="modal-title" id="addCourseModalLabel">Update Course Adv</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
            </div>
            <div class="modal-body">
                @if (session('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                @endif

                <form action="{{ route('institute.update.course_adv', $course_adv_info->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label>اسم الدورة</label>
                        <input type="text" name="course_adv_name" class="form-control"
                               value="{{ old('course_adv_name', $course_adv_info->course_adv_name) }}" required>
                    </div>

                    <div class="mb-3">
                        <label>التصنيف</label>
                        <select name="category_id_fk" class="form-select" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $course_adv_info->category_id_fk == $category->id ? 'selected' : '' }}>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>وصف الدورة</label>
                        <textarea name="course_adv_description" class="form-control">{{ old('course_adv_description', $course_adv_info->course_adv_description) }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">تحديث</button>
                </form>


            </div>
        </div>
    </div>
</div>

@endsection --}}
