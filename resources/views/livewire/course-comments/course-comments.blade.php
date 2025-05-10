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
    </div>
@endforeach

    </div>
</div>
