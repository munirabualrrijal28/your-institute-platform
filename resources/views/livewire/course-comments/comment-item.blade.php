@php
    $user = $comment->user;
    $profile = $user->media->firstWhere('type', 'profile_photo');
    $profileUrl = $profile ? asset('storage/' . $profile->url) : asset('images/default-user.png');
@endphp
<div class="d-flex align-items-start mb-3 bg-gray-100">
    <hr>
    <img src="{{ asset('/images/profile/user_ic.svg') }}" alt="Profile" class="rounded-circle me-2"
        style="width: 40px; height: 40px; object-fit: cover;">



    <div class="flex-grow-1">
        <div class="d-flex justify-content-between">
            <div>
                <strong>{{ $user->name }}</strong>
                <small class="text-muted d-block">{{ $comment->created_at->diffForHumans() }}</small>
            </div>

            @if ($comment->user_id_fk === auth()->id())
                <div class="dropdown">
                    <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown">
                        ⋮
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" wire:click="startEdit">✏️ Edit</a></li>
                        <li>
                            <a class="dropdown-item text-danger" wire:click="confirmDelete">
                                🗑️ Delete
                            </a>
                        </li>
                    </ul>
                </div>
            @endif
        </div>

        @if ($isEditing)
            <form wire:submit.prevent="updateComment" class="mt-2">
                <textarea wire:model="editContent" class="form-control mb-2" rows="2"></textarea>
                <button type="submit" class="btn btn-sm btn-success">Save</button>
                <button type="button" wire:click="cancelEdit" class="btn btn-sm btn-secondary">Cancel</button>
                @error('editContent')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </form>
        @else
            <p class="mb-0">{{ $comment->content }}</p>
        @endif
    </div>
    @if ($confirmingDelete)
        <div  class="alert alert-warning mt-2 delete-float" >
            <strong>Are you sure you want to delete this comment?</strong>
            <div class="mt-2">
                <button wire:click="deleteComment" class="btn btn-sm btn-danger">Yes, Delete</button>
                <button wire:click="cancelDelete" class="btn btn-sm btn-secondary">Cancel</button>
            </div>
        </div>
    @endif
    {{--
     --}}

    {{--  --}}
    <!-- Delete Confirmation Modal -->
    {{-- ✅ Keep this block and delete the other one --}}

    {{-- <div wire:ignore.self class="modal fade" id="deleteModal-{{ $comment->id }}" tabindex="-1"
        aria-labelledby="deleteModalLabel-{{ $comment->id }}" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="deleteModalLabel-{{ $comment->id }}">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    Are you sure you want to delete this comment?
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" wire:click="deleteComment" data-bs-dismiss="modal">
                        Yes, Delete
                    </button>
                </div>
            </div>
        </div>
    </div> --}}




    {{--  --}}
    <script>
        window.addEventListener('openDeleteModal', event => {
            const id = event.detail.commentId;
            const modalEl = document.getElementById(`deleteModal-${id}`);
            if (modalEl) {
                const modal = new bootstrap.Modal(modalEl);
                modal.show();
            }
        });

        window.addEventListener('closeModal', event => {
            const id = event.detail.commentId;
            const modalEl = document.getElementById(`deleteModal-${id}`);
            if (modalEl) {
                const modal = bootstrap.Modal.getInstance(modalEl);
                if (modal) {
                    modal.hide();
                }

                // Forcefully remove any leftover backdrop
                document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
                document.body.classList.remove('modal-open');
                document.body.style = '';
            }
        });
    </script>
</div>
