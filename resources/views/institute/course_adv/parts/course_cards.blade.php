@php use Illuminate\Support\Str; @endphp

<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
    @forelse ($course_advs as $course_adv)
        @php
            $images = $course_adv->media->filter(fn($media) => Str::startsWith($media->type, 'image/'));
            $my_domain = 'http://127.0.0.1:8000';
        @endphp

        <div class="col">
            <div class="card h-100 shadow-sm border rounded-3">

                {{-- Display image --}}
                @if ($images->isNotEmpty())
                    <img src="{{ asset($my_domain . '/storage/' . $images->first()->url) }}" class="card-img-top"
                        style="height: 200px; object-fit: cover;" alt="Course Image">
                @else
                    <img src="{{ asset('images/default-course.jpg') }}" class="card-img-top"
                        style="height: 200px; object-fit: cover;" alt="Default Course">
                @endif

                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $course_adv->course_adv_name }}</h5>
                    <p class="text-muted small">🕒 {{ $course_adv->created_at?->diffForHumans() ?? 'N/A' }}</p>
                    <p class="text-muted mb-1">Category: {{ $course_adv->category->category_name ?? 'No category' }}</p>
                    <p class="card-text small">{{ Str::limit($course_adv->course_adv_description, 100) }}</p>

                    <div class="mt-auto border-top pt-2 d-flex justify-content-between align-items-center ">
                        {{-- Comments Button --}}
                        <button type="button" class="btn btn-outline-secondary p-2 me-2" data-bs-toggle="modal"
                            data-bs-target="#commentsModal{{ $course_adv->id }}">
                            💬 Comments:
                            <livewire:comment-count :courseAdv="$course_adv" />
                        </button>
                        {{-- Edit Button --}}
                        <form action="{{ route('institute.manage_course_adv') }}" method="GET" class="d-inline me-2">
                            <input type="hidden" name="edit_id" value="{{ $course_adv->id }}">
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </form>

                        {{-- Delete Button --}}
                        <form action="{{ route('institute.delete.course_adv', $course_adv->id) }}" method="POST"
                            class="d-inline me-8">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger" onclick="confirmDelete(this)">
                                <i data-feather="delete"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Comments Modal --}}
            <div class="modal fade" id="commentsModal{{ $course_adv->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Comments - {{ $course_adv->course_adv_name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body p-3" style="max-height: 400px; overflow-y: auto;">
                            <livewire:course-comments :course_adv="$course_adv" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <p class="text-center">No Course Advertisements Found.</p>
        </div>
    @endforelse
</div>

{{-- Pagination --}}
<div class="mt-4 d-flex justify-content-center">
    {!! $course_advs->withQueryString()->links() !!}
</div>
