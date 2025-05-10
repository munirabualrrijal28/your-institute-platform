@extends('profile_parts.lib')

@section('lib_layout')

    <div class="container mx-auto">


        <div class="flex flex-col">

            <div class="col-12">

                <div class="card">
                    <div class="card-header rounded-full">
                        <h5 class="card-title mb-0">Create Category</h5>
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

                        <form action="{{ route('institute.category.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label for="category_name" class="fw-bold mb-2">Your Category Name</label>
                            <input type="text" name="category_name" class="form-control"
                                placeholder="Languages | Computer ..." autocomplete="off">

                            {{-- <input type="text" name="institute_id_fk" class="form-control" placeholder="Institute You Chose" autocomplete="off" value="1"> --}}
                            <label for="category_des" class="fw-bold mb-2">Category description</label>
                            {{-- <input type="textarea" name="category_des" class="form-control" placeholder=" ..." autocomplete="off"> --}}
                            <textarea rows="5" name="category_des" class="form-control" cols="50" style="resize: both;"
                                placeholder=" ..." autocomplete="off"></textarea>

                            <div>
                                <label class="block mb-1 text-gray-700">Upload Category Photo</label>
                                <input type="file" name="category_photo" accept="image/*" required
                                    class="w-full px-4 py-2 border rounded-md">
                            </div>
                            <button type="submit" class="btn btn-primary w-200 w-100">Add Category</button>
                        </form>
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
                        <div class="card-header">
                            <h5 class="card-title mb-0">Manage Category</h5>
                        </div>

                        @if (session('message'))
                            <div class="alert alert-success my-2" id="update-message">
                                {{ session('message') }}
                            </div>
                        @endif
                    </div>

                    {{-- Grid container for category cards --}}
                    {{-- <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 p-4"> --}}


                        <div id="categoryCards" class="row g-4 w-full">
                            @include('profile_parts.institute_tabs.category.parts.category_cards')
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
                <script>
                    function confirmDelete(button) {
                        const form = button.closest('form'); // Get the associated form

                        Swal.fire({
                            title: 'Are you sure?',
                            text: "Everything related to this Category will be deleted too!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit(); // Submit the form if confirmed
                            }
                        });
                    }
                </script>


                <!-- code down here after updating the success message will be shown for few seconds and disappeared  -->
                <script>
                    // Check if the success message exists
                    document.addEventListener('DOMContentLoaded', function() {
                        const message = document.getElementById('update-message');
                        if (message) {
                            // Set a timer to fade out the message after 3 seconds (3000 milliseconds)
                            setTimeout(() => {
                                message.style.transition = 'opacity 1s'; // Transition effect
                                message.style.opacity = '0'; // Fade out
                                // Remove the message after the fade out is complete
                                setTimeout(() => {
                                    message.remove();
                                }, 1000); // Wait for 1 second before removing
                            }, 3000); // 3 seconds
                        }
                    });
                </script>

                {{--  --}}

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
                                        const newContent = html.querySelector('#categoryCards').innerHTML;

                                        document.querySelector('#categoryCards').innerHTML = newContent;
                                    });
                            }
                        });
                    });
                </script>




            </div>



        </div>

        {{--  --}}
        {{--  --}}

        {{--  --}}
        {{--  --}}

    </div>


    <div class="d-flex justify-content-center mt-4">
        {{ $categories->links() }}
    </div>



@endsection
