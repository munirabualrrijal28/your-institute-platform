<div style="display: flex; flex-direction: column; height: 100%;">
    <!-- Scrollable Comments List -->
    💬 Comments: {{ $commentCount ?? 0 }}


    <div style="flex: 1; overflow-y: auto; padding: 1rem;">
     <div class="space-y-4">
    @foreach ($comments as $comment)
        <livewire:comment-item :comment="$comment" :wire:key="'comment-'.$comment->id" />
    @endforeach
</div>

    </div>

    <!-- Sticky Main Comment Form -->
    {{-- @if ($parentId === null)
        <div class="border-top bg-gray-100 p-3" style="position: sticky; bottom: 0; z-index: 10;">
            <form wire:submit.prevent="postComment">
                <div wire:key="form-{{ $this->formKey }}">
                    <textarea wire:model="content" class="form-control" rows="2" placeholder="Write your comment..."></textarea>
                    @error('content') <small class="text-danger">{{ $message }}</small> @enderror
                    <button type="submit" class="btn btn-primary mt-2">Comment</button>
                </div>
            </form>
        </div>
    @endif --}}
</div>
