<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-6">
    @foreach ($ads as $ad)
        @php
            $images = $ad->media->filter(fn($media) => Str::startsWith($media->type, 'image/'));
            $imageUrl = $images->isNotEmpty() ? asset('storage/' . $images->first()->url) : asset('images/default-ad.jpg');
        @endphp

        <div x-data="{ showComments: false }" class="bg-white rounded-xl shadow-md overflow-hidden flex flex-col">
            <!-- Ad Image -->
            <img src="{{ $imageUrl }}" alt="Ad Image" class="w-full h-40 object-cover">

            <!-- Content -->
            <div class="p-4 flex flex-col flex-grow">
                <h3 class="text-center text-lg font-bold text-gray-800 mb-1">
                    {{ Str::limit($ad->content, 30) }}
                </h3>
                <p class="text-center text-sm text-gray-600 mb-2">
                    {{ Str::limit($ad->content, 80) }}
                </p>
                <p class="text-center text-xs text-gray-400 mb-2">📅 {{ $ad->created_at->diffForHumans() }}</p>

                <!-- 💬 Comments Trigger -->
                <div class="text-center">
                    <button @click="showComments = true" class="text-blue-600 hover:underline text-sm">
                        💬 Comments ({{ $ad->comments->count() }})
                    </button>
                </div>

                <!-- Actions -->
                <div class="mt-auto flex justify-center gap-3 pt-4 border-t">
                    <!-- Edit -->
                    <form action="{{ route('institute.manage_ad', ['edit_id' => $ad->id, 'tab' => 'ads']) }}" method="GET">
                        <input type="hidden" name="edit_id" value="{{ $ad->id }}">
                        <button type="submit" class="text-blue-500 hover:text-blue-700" title="Edit">
                            <i data-feather="edit" class="w-5 h-5"></i>
                        </button>
                    </form>

                    <!-- Delete -->
                    <form action="{{ route('institute.delete_ad', $ad->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="text-red-600 hover:text-red-800" onclick="confirmDelete(this)" title="Delete">
                            <i data-feather="trash-2" class="w-5 h-5"></i>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Floating Comment Panel -->
            <div x-show="showComments" class="fixed inset-0 bg-black bg-opacity-40 z-40 flex" @click.self="showComments = false" x-transition>
                <!-- Left Side -->
                <div class="w-1/2 bg-gray-200 text-white flex flex-col justify-center items-center p-6 space-y-6">
                    <div class="text-lg font-semibold">{{ $ad->content }}</div>
                    <img src="{{ $imageUrl }}" alt="Ad Image" class="rounded-xl w-full max-h-72 object-cover">
                </div>

                <!-- Right Side -->
                <div class="w-1/2 h-full bg-white shadow-xl p-4 overflow-y-auto">
                    <div class="flex justify-between items-center border-b pb-2 mb-4">
                        <h2 class="text-lg font-bold">Comments</h2>
                        <button @click="showComments = false" class="text-gray-500 hover:text-red-500">✖</button>
                    </div>
                    <livewire:ad-comments.ad-comments :ad="$ad" :wire:key="'comments-'.$ad->id" />
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- Pagination -->
{{-- <div class="mt-6 flex justify-center">
    {!! $ads->withQueryString()->links() !!}
</div> --}}

