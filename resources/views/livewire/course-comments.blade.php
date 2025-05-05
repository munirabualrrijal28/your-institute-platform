<div style="display: flex; flex-direction: column; height: 100%;">
    <!-- Scrollable Comments List -->
    💬 Comments: {{ $commentCount }}

    <div style="flex: 1; overflow-y: auto; padding: 1rem;">
        @foreach ($comments ?? [] as $comment)
        <div wire:key="comment-wrapper-{{ $comment->id }}">
            <livewire:comment-item :comment="$comment" :wire:key="'comment-'.$comment->id" />


            <!-- ✅ Load replies if open -->
            @if ($openReplies[$comment->id] ?? false)
                @foreach ($loadedReplies[$comment->id] ?? [] as $reply)
                    <div class="ms-4">
                        <livewire:comment-item :comment="$reply" :wire:key="'reply-'.$reply->id" />
                    </div>
                @endforeach
            @endif

            <!-- ✅ Toggle + Reply button -->
            <div class="ms-5 mb-3">
                @if ($comment->replies->count())
                    <button wire:click="toggleReplies({{ $comment->id }})" class="btn btn-sm">
                        {{ $openReplies[$comment->id] ?? false ? '🔽 Hide' : '▶ Show' }} Replies
                    </button>
                @endif

                <button wire:click="replyTo({{ $comment->id }})" class="btn btn-sm btn-outline-primary ms-2">
                    Reply
                </button>
            </div>
        </div>


            <!-- ✅ Reply Form -->
            @if ($parentId === $comment->id)
                <form wire:submit.prevent="postComment" class="ms-5 mt-2 mb-4">
                    <div class="input-group">
                        <textarea wire:model="content" class="form-control" rows="2" placeholder="Write a reply..."></textarea>
                        <button type="submit" class="btn btn-success btn-sm">Send</button>
                    </div>
                    <button type="button" wire:click="cancelReply" class="btn btn-sm btn-link mt-1">Cancel</button>
                    @error('content') <small class="text-danger">{{ $message }}</small> @enderror
                </form>
            @endif

        @endforeach
    </div>

    <!-- Sticky Main Comment Form -->
    @if ($parentId === null)
        <div class="border-top bg-green p-3" style="position: sticky; bottom: 0; z-index: 10;">
            <form wire:submit.prevent="postComment">
                <div wire:key="form-{{ $this->formKey }}">
                    <textarea wire:model="content" class="form-control" rows="2" placeholder="Write your comment..."></textarea>
                    @error('content') <small class="text-danger">{{ $message }}</small> @enderror
                    <button type="submit" class="btn btn-primary mt-2">Comment</button>
                </div>
            </form>
        </div>
    @endif
</div>
