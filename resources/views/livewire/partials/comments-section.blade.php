{{-- Display All Top-Level Comments --}}
{{-- <livewire:course-comments :courseAdv="$course_adv" /> --}}
@foreach($comments as $comment)
    <div class="border p-2 mb-3" wire:key="comment-{{ $comment->id }}">
        <strong>{{ $comment->user->name }}</strong>
        <span class="text-muted small">{{ $comment->created_at->diffForHumans() }}</span>
        <p>{{ $comment->content }}</p>

        {{-- Reply Button --}}
        <button wire:click="replyTo({{ $comment->id }})" class="btn btn-sm btn-outline-secondary mb-2">Reply</button>

        {{-- Replies --}}
        @foreach($comment->replies as $reply)
            <div class="ms-4 p-2 border-start">
                <strong>{{ $reply->user->name }}</strong>
                <span class="text-muted small">{{ $reply->created_at->diffForHumans() }}</span>
                <p>{{ $reply->content }}</p>
            </div>
        @endforeach
    </div>
@endforeach
{{-- Comment Form --}}

