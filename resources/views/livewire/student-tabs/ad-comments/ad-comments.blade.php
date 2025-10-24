<div>


<div class="flex flex-col h-full text-gray-800 font-sans">
    <!-- Header with Comment Count -->


    <div class="px-4 py-2 text-lg font-semibold text-teal-700 bg-white shadow sticky top-0 z-20 border-b border-gray-200">
      {{-- 💬  <livewire:student-tabs.ad-comments.comment-count :ad="$ad"
                                :wire:key="'comments-'.$ad->id" /> --}}
                                        {{-- 💬 Comments: {{ $commentCount ?? 0 }} --}}
        💬 Comments: {{ $commentCount ?? 0 }}

    </div>

    <!-- Scrollable Comment List -->
    <div class="flex-1 overflow-y-auto p-4 space-y-6 animate-fade-in-slow">
        @foreach ($comments ?? [] as $comment)
            <div wire:key="comment-wrapper-{{ $comment->id }}" class="bg-white rounded-xl shadow-md border border-gray-100 p-4">
                <livewire:student-tabs.ad-comments.comment-item :comment="$comment" :wire:key="'comment-'.$comment->id" />

                <!-- Replies -->
                @if ($openReplies[$comment->id] ?? false)
                    <div class="mt-3 ps-6 space-y-4">
                        @foreach ($loadedReplies[$comment->id] ?? [] as $reply)
                            <livewire:student-tabs.ad-comments.comment-item :comment="$reply" :wire:key="'reply-'.$reply->id" />
                        @endforeach
                    </div>
                @endif

                <!-- Toggle / Reply Buttons -->
                <div class="mt-2 ps-6 flex gap-3">
                    @if ($comment->replies->count())
                        <button wire:click="toggleReplies({{ $comment->id }})"
                            class="text-sm text-teal-600 hover:text-teal-800 transition">
                            {{ $openReplies[$comment->id] ?? false ? '🔽 Hide Replies' : '▶ Show Replies' }}
                        </button>
                    @endif

                    <button wire:click="replyTo({{ $comment->id }})"
                        class="text-sm text-blue-600 hover:text-blue-800 transition">
                        Reply
                    </button>
                </div>

                <!-- Reply Form -->
                @if ($parentId === $comment->id)
                    <form wire:submit.prevent="postComment" class="mt-3 ps-6 space-y-2">
                        <textarea wire:model="content" rows="2" placeholder="Write a reply..."
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring-teal-500 focus:outline-none"></textarea>
                        @error('content') <small class="text-red-500">{{ $message }}</small> @enderror

                        <div class="flex gap-2">
                            <button type="submit" wire:loading.attr="disabled" wire:target="postComment"
                                class="px-4 py-1 text-white bg-teal-600 hover:bg-teal-700 rounded-md shadow transition">
                                <span wire:loading.remove wire:target="postComment">Send</span>
                                <span wire:loading wire:target="postComment">Sending...</span>
                            </button>
                            <button type="button" wire:click="cancelReply"
                                class="text-sm text-gray-500 hover:underline">
                                Cancel
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        @endforeach
    </div>

    <!-- Main Comment Input (Sticky) -->
    @if ($parentId === null)
        <div class="bg-white border-t border-gray-200 p-4 shadow-md sticky bottom-0 z-30">
            <form wire:submit.prevent="postComment" class="space-y-2">
                <div wire:key="form-{{ $this->formKey }}">
                    <textarea wire:model="content" rows="2" placeholder="Write your comment..."
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-teal-500 focus:outline-none"></textarea>
                    @error('content') <small class="text-red-500">{{ $message }}</small> @enderror
                    <button type="submit" wire:loading.attr="disabled" wire:target="postComment"
                        class="px-5 py-2 bg-teal-600 text-white rounded-md shadow hover:bg-teal-700 transition">
                        <span wire:loading.remove wire:target="postComment">Comment</span>
                        <span wire:loading wire:target="postComment">Posting...</span>
                    </button>
                </div>
            </form>
        </div>
    @endif
</div>

<style>
@keyframes fade-in-slow {
    from {
        opacity: 0;
        transform: translateY(12px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.animate-fade-in-slow {
    animation: fade-in-slow 0.6s ease-out;
}
</style>

</div>
