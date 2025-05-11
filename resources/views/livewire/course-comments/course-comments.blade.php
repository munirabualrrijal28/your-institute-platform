<div class="space-y-4">
    <div>
        <textarea wire:model.defer="newComment" class="w-full p-2 border rounded" placeholder="أضف تعليقاً..."></textarea>
        @error('newComment')
            <span class="text-red-600 text-sm">{{ $message }}</span>
        @enderror
        <button wire:click="addComment" class="mt-2 px-4 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">
            نشر التعليق
        </button>
    </div>

    <div class="space-y-3">
        @foreach ($comments as $comment)
            <div class="bg-gray-100 p-3 rounded shadow text-right">
                <p class="text-sm text-gray-800"><strong>{{ $comment->user->name }}</strong></p>
                <p class="text-gray-700">{{ $comment->content }}</p>
                <p class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
            </div>
            @if (auth()->id() === $comment->user_id)
                {{-- <button x-data @click="Livewire.dispatch('confirmCommentDelete', {{ $comment->id }})"
                    class="absolute top-2 left-2 text-red-500 hover:text-red-700 text-xs">
                    حذف
                </button> --}}
                <button wire:click="confirmDeleteComment({{ $comment->id }})" class="text-red-500 hover:text-red-700 text-sm">
    حذف
</button>
            @endif
        @endforeach
    </div>

    {{--  --}}

    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('confirmCommentDelete', commentId => {
                Swal.fire({
                    title: 'هل أنت متأكد؟',
                    text: 'سيتم حذف هذا التعليق نهائيًا!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'نعم، احذف',
                    cancelButtonText: 'إلغاء'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch('deleteConfirmedComment', commentId);
                    }
                });
            });
        });
    </script>




    {{--  --}}
</div>
