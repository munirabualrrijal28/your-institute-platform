@if ($institute && $institute->advertisements->isNotEmpty())
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($institute->advertisements as $ad)
            <div
                class="bg-white border border-gray-200 rounded-xl shadow hover:shadow-md transition-all duration-300 overflow-hidden flex flex-col">

                <!-- Media -->
                @php
                    $image = $ad->media->first()
                        ? asset('storage/' . $ad->media->first()->url)
                        : asset('images/profile/user_ic.svg');
                    // $image = $ad->media->firstWhere('type', 'like', 'image/%');
                    // dd($image);
                @endphp
                <div class="h-40 overflow-hidden">
                    @if ($image)
                        <img src="{{ asset($image) }}" class="w-full h-full object-cover" alt="Ad Image">
                    @else
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500 text-sm">
                            No Image
                        </div>
                    @endif
                </div>

                <!-- Content -->
                <div class="p-4 flex-1 flex flex-col justify-between">
                    <div>
                        {{-- <h3 class="text-lg font-semibold text-gray-800 mb-1">{{ $ad->title }}</h3> --}}
                        <p class="text-sm text-gray-600 mb-2">{{ Str::limit($ad->content, 150) }}</p>
                    </div>

                    <!-- Footer -->
                    <div class="flex justify-between items-center mt-3 text-xs text-gray-500">
                        <span>📅 {{ $ad->created_at->format('M d, Y') }}</span>

                        {{-- <!-- Delete -->
                            <form method="POST" action="{{ route('admin.delete.advertisement', $ad->id) }}"
                                  onsubmit="return confirm('Are you sure you want to delete this ad?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline">Delete</button>
                            </form> --}}
                        <!-- Footer -->
                        <div class="flex justify-between items-center mt-3 text-xs text-gray-500">
                            {{-- <span>📅 {{ $ad->created_at->format('M d, Y') }}</span> --}}

                            <div class="flex gap-2">
                                <!-- Edit -->
                                {{-- <a href="{{ route('admin.edit.advertisement', $ad->id) }}" --}}
                                {{-- <a href="" class="text-blue-600 hover:underline">Edit</a> --}}

                                <!-- Delete -->
                                {{-- <form method="POST" action="{{ route('admin.delete.advertisement', $ad->id) }}" --}}
                                <form method="POST" action="{{ route('admin.delete.advertisement', $ad->id) }}"
                                    onsubmit="return confirm('Are you sure you want to delete this advertisement?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 text-white px-3 py-1 text-sm rounded hover:bg-red-600 transition">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        @endforeach
    </div>
@else
    <div class="text-gray-500 text-center py-10">No advertisements found for this institute.</div>
@endif

<div class="mt-6 flex justify-center">
    {!! $advertisements->links() !!}
</div>
