<div class="space-y-6">

    {{-- ✏️ Add Comment --}}
    <div class="bg-white p-4 rounded shadow">
        <textarea wire:model.defer="commentText" placeholder="أضف تعليقاً..."
            class="w-full border rounded px-4 py-2 focus:ring focus:ring-blue-200"></textarea>
        <div class="flex justify-end mt-2">
            <button wire:click="postComment"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">نشر</button>
        </div>
        @error('commentText')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- 💬 Comments List --}}
    <div class="space-y-4">
      @foreach ($comments as $comment)
    <div class="bg-gray-100 p-3 rounded mb-2">
        <div class="flex justify-between items-center">
            <strong>{{ $comment->user->name }}</strong>

            @if ($comment->user_id === auth()->id())
                <div class="text-sm space-x-2">
                    <button wire:click="startEdit({{ $comment->id }}, '{{ addslashes($comment->body) }}')" class="text-blue-600 hover:underline">تعديل</button>
                    <button wire:click="deleteComment({{ $comment->id }})" class="text-red-600 hover:underline">حذف</button>
                </div>
            @endif
        </div>

        @if ($editCommentId === $comment->id)
            <textarea wire:model.defer="editedText" class="w-full border p-2 rounded my-2"></textarea>
            <div class="flex space-x-2">
                <button wire:click="updateComment" class="text-white bg-blue-600 px-3 py-1 rounded">حفظ</button>
                <button wire:click="cancelEdit" class="text-gray-500 px-3 py-1">إلغاء</button>
            </div>
        @else
            <p class="mt-1 text-sm text-gray-700">{{ $comment->body }}</p>
        @endif

        {{-- replies would go here --}}
        <div>
    {{-- New Comment Input --}}
    <textarea wire:model.defer="newComment" class="w-full rounded border p-2" placeholder="أضف تعليقًا..."></textarea>
    <button wire:click="addComment" class="mt-2 bg-blue-500 text-white px-4 py-1 rounded">نشر</button>

    <div class="mt-6 space-y-4">
        @foreach($comments as $comment)
            <div class="border rounded p-3">
                @if ($editCommentId === $comment->id)
                    <textarea wire:model.defer="editContent" class="w-full border p-2 rounded"></textarea>
                    <div class="flex gap-2 mt-2">
                        <button wire:click="updateComment" class="bg-green-500 text-white px-3 py-1 rounded">حفظ</button>
                        <button wire:click="$set('editCommentId', null)" class="text-gray-600">إلغاء</button>
                    </div>
                @else
                    <div class="text-gray-800">{{ $comment->content }}</div>
                    <div class="text-sm text-gray-500 flex gap-3 mt-2">
                        <button wire:click="startEdit({{ $comment->id }}, '{{ addslashes($comment->content) }}')">تعديل</button>
                        <button wire:click="deleteComment({{ $comment->id }})" class="text-red-600">حذف</button>
                    </div>
                @endif

                {{-- Replies --}}
                <div class="ml-6 mt-3 space-y-2">
                    @foreach ($comment->replies as $reply)
                        <div class="border rounded p-2 bg-gray-50">
                            {{ $reply->content }}
                            <div class="text-sm text-gray-500 mt-1">– {{ $reply->user->name ?? 'مستخدم' }}</div>
                        </div>
                    @endforeach

                    <div>
                        <textarea wire:model.defer="newReply.{{ $comment->id }}" class="w-full border rounded p-2 mt-2"
                                  placeholder="رد..."></textarea>
                        <button wire:click="addReply({{ $comment->id }})"
                                class="mt-1 bg-gray-300 px-3 py-1 rounded">رد</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

    </div>
@endforeach

    </div>
</div>
