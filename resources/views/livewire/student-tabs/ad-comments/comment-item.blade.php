@php
    $user = $comment->user;
    $profile = $user->media->firstWhere('type', 'profile_photo');
    $profileUrl = $profile ? asset('storage/' . $profile->url) : asset('images/profile/user_ic.svg');
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

                        <li>
                            <a class="dropdown-item text-danger" wire:click="confirmDelete">
                                🗑️ Delete
                            </a>
                        </li>
                    </ul>
                </div>
            @endif
        </div>

        {{-- @if ($isEditing)
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
        @endif --}}
        {{--  --}}
        {{-- Report  --}}
                    <p class="mb-0">{{ $comment->content }}</p>

        @if ($comment->user_id_fk !== auth()->id())
            <div x-data="{ showReport: false }" class="mt-3">
                <button @click="showReport = true" class="text-xs text-red-500 hover:underline">🚨 Report</button>

                <!-- Report Modal -->
                <div x-show="showReport" @click.away="showReport = false"
                    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                    <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-sm space-y-4 animate-fade-in">
                        <h3 class="text-lg font-semibold text-gray-800">Report Comment</h3>
                        <form method="POST" action="{{ route('reports_store') }}">
                            @csrf
                            <input type="hidden" name="reportable_type" value="App\Models\Comments">
                            <input type="hidden" name="reportable_id" value="{{ $comment->id }}">

                            <label class="block text-sm text-gray-700 font-medium mb-1">Reason</label>
                            <select name="reason" required class="w-full border rounded px-3 py-2 text-sm">
                                <option value="spam">Spam</option>
                                <option value="abuse">Abusive Language</option>
                                <option value="scam">Scam or Fraud</option>
                                <option value="other">Other</option>
                            </select>

                            <label class="block text-sm text-gray-700 font-medium mt-3 mb-1">Additional Notes</label>
                            <textarea name="description" rows="2" class="w-full border rounded px-3 py-2 text-sm"></textarea>

                            <div class="flex justify-end gap-2 mt-4">
                                <button type="button" @click="showReport = false"
                                    class="px-3 py-1 rounded text-gray-600 hover:underline">Cancel</button>
                                <button type="submit"
                                    class="px-4 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif

        {{--  --}}
    </div>
    @if ($confirmingDelete)
        <div class="alert alert-warning mt-2 delete-float">
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
