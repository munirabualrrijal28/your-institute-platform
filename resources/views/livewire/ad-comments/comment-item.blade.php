<div>
<div class="border p-4 rounded bg-gray-50">
    <div class="flex justify-between items-center">
        <div>
            <p class="font-semibold text-gray-800">{{ $comment->user->name }}</p>
            <p class="text-sm text-gray-600">{{ $comment->content }}</p>
            <p class="text-xs text-gray-400">{{ $comment->created_at->diffForHumans() }}</p>
        </div>

        @if(auth()->id() === $comment->user_id)
            <button wire:click="deleteComment" class="text-red-600 hover:text-red-800 text-sm">🗑 حذف</button>
        @endif
    </div>

    <!-- الرد -->
    <div class="mt-2">
        <button wire:click="$toggle('showReplyForm')" class="text-blue-600 text-sm hover:underline">↪ رد</button>
        @if ($showReplyForm)
            <div class="mt-2">
                <textarea wire:model.defer="replyContent"
                          class="w-full rounded border-gray-300 p-2 text-sm"
                          placeholder="اكتب ردك..."></textarea>
                <button wire:click="postReply"
                        class="bg-teal-600 text-white px-3 py-1 mt-2 rounded text-sm hover:bg-teal-700">
                    إرسال
                </button>
            </div>
        @endif
    </div>

    <!-- الردود -->
    @if ($comment->replies->count())
        <div class="pl-6 mt-4 space-y-3 border-l-2 border-gray-300">
            @foreach ($comment->replies as $reply)
                <livewire:comment-item :comment="$reply" :wire:key="'reply-'.$reply->id" />
            @endforeach
        </div>
    @endif
</div>
</div>
