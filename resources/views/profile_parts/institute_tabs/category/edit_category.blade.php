@extends('institute.layouts.layout')
@section('institute_page_title')
    Edite Category - Institute Panel
@endsection
{{-- <h2>Create Category Page</h2> --}}

@section('institute_layout')
    <div calss="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Edit Category</h5>
                </div>
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-warning alert-dismissible fade show">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif



                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif

                    {{-- <form action="{{ route('institute.category.update', $category_info->id) }}"
                       >
                        @csrf
                        @method('PUT') <!-- This is required -->
                        <label for="category_name" class="fw-bold mb-2">Your Category Name</label>
                        <input type="text" name="category_name" class="form-control"
                            placeholder="Languages | Computer ..." value = "{{ $category_info->category_name }}"
                            autocomplete="off">
                        <button type="submit" class="btn btn-primary w-200 w-100">Update Category</button>
                    </form> --}}
                    {{--  --}}
                    {{--  --}}
                    {{--  --}}
                    {{--  --}}
                    {{--  --}}
                    <form method="POST" action="{{ route('institute.category.update', $category_info->id) }}"
                       >
                        @csrf
                        @method('PUT')
                        <label for="category_name" class="fw-bold mb-2">Your Category Name</label>
                        <input type="text" name="category_name" class="form-control"
                            placeholder="Languages | Computer ..." autocomplete="off"
                            value = "{{ $category_info->category_name }}">

                        {{-- <input type="text" name="institute_id_fk" class="form-control" placeholder="Institute You Chose" autocomplete="off" value="1"> --}}
                        <label for="category_des" class="fw-bold mb-2">Category description</label>
                        {{-- <input type="textarea" name="category_des" class="form-control" placeholder=" ..." autocomplete="off"> --}}
                        <textarea rows="5" name="category_des" class="form-control" cols="50" style="resize: both;"
                            placeholder=" ..." autocomplete="off"> {{ $category_info->category_des }}</textarea>

                        <div>
                            <label class="block mb-1 text-gray-700">Upload Category Photo</label>
                            <input type="file" name="category_photo" accept="image/*"
                                class="w-full px-4 py-2 border rounded-md">
                        </div>
                        <button type="submit" class="btn btn-primary w-200 w-100">Update Category</button>
                    </form>
                </div>
            </div>


        </div>
    </div>
@endsection
