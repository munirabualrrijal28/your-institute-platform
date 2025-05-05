<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
    @foreach ($categories as $cat)
        <div class="col">
            <div class="card h-100 shadow-sm border rounded-3">
                <img src="{{ asset('storage/' . $cat->category_photo) }}" alt="Category Image" class="card-img-top w-100 h-32 object-cover" style="height: 200px; object-fit: cover;">

                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-center">{{ $cat->category_name }}</h5>

                    <p class="text-muted mb-2 text-center small"> {{ $cat->category_des ?? 'No description' }}</p>

                    <div class="mt-auto border-top pt-2 d-flex justify-content-center gap-2">
                        <a href="{{ route('institute.edit_category', $cat->id) }}" class="btn btn-sm btn-primary">
                            <i data-feather="edit"></i>
                        </a>

                        <form action="{{ route('institute.category.delete', $cat->id) }}" method="POST" onsubmit="return confirmDelete();">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete(this)">
                                <i data-feather="delete"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $categories->links() }}
</div>
