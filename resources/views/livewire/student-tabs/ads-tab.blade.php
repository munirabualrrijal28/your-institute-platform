<div>

    <!-- Grid of Advertisements -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-6">
        @foreach ($ads as $ad)
            @php
                $imageUrl = $ad->media->first()
                    ? asset('storage/' . $ad->media->first()->url)
                    : asset('images/default-ad.jpg');
            @endphp

           <div wire:key="ad-{{ $ad->id }}" x-data="{ showComments: false, isUploading: false }"
                        class="bg-white rounded-xl shadow-md overflow-hidden flex flex-col">

                        <div wire:key="ad-{{ $ad->id }}"
                            class="bg-white rounded-xl shadow-md overflow-hidden flex flex-col">
                            <img src="{{ $imageUrl }}" alt="Ad Image" class="w-full h-40 object-cover">

                            <div class="p-4 flex flex-col flex-grow">
                                <p class="text-center text-sm text-gray-700 mb-2">{{ Str::limit($ad->content, 100) }}
                                </p>
                                <p class="text-center text-xs text-gray-400 mb-2">📅
                                    {{ $ad->created_at->diffForHumans() }}
                                </p>

                                {{-- <div class="text-center">
                        💬 {{ $ad->comments->count() }} تعليق
                    </div> --}}
                                <!-- 💬 Comments Trigger -->
                                <div class="text-center">
                                    <button @click="showComments = true" class="text-blue-600 hover:underline text-sm">
                                        💬 Comments <livewire:student-tabs.ad-comments.comment-count :ad="$ad"
                                            :wire:key="'count-'.$ad->id" />
                    {{-- <livewire:ad-comments.ad-comments :ad="$ad" :wire:key="'comments-'.$ad->id" /> --}}

                                    </button>
                                </div>


                                <!-- Actions -->
                                {{-- <div class="mt-auto flex justify-center gap-3 pt-4 border-t">
                                    <button wire:click="editAd({{ $ad->id }})"
                                        class="text-blue-500 hover:text-blue-700 transition" title="تعديل">
                                        <x-heroicon-s-pencil class="w-5 h-5" />
                                    </button>
                                    <button wire:click="confirmDelete({{ $ad->id }})"
                                        class="text-red-600 hover:text-red-800 transition" title="حذف">
                                        <x-heroicon-s-trash class="w-5 h-5" />
                                    </button>
                                </div> --}}
                                {{-- @if (!$blocked)
                                    <div class="mt-auto flex justify-center gap-3 pt-4 border-t">
                                        <button wire:click="editAd({{ $ad->id }})"
                                            class="text-blue-500 hover:text-blue-700 transition" title="تعديل">
                                            <x-heroicon-s-pencil class="w-5 h-5" />
                                        </button>
                                        <button wire:click="confirmDelete({{ $ad->id }})"
                                            class="text-red-600 hover:text-red-800 transition" title="حذف">
                                            <x-heroicon-s-trash class="w-5 h-5" />
                                        </button>
                                    </div>
                                @endif --}}



                            </div>
                            {{--  --}}


                            <!-- Floating Comment Panel -->
                            <div x-show="showComments" class="fixed inset-0 bg-white bg-opacity-40 z-40 flex py-8"
                                @click.self="showComments = false" x-transition>
                                <!-- Left Side -->
                                {{--
                        <div
                            class="w-1/2 bg-gray-200 text-white flex flex-col justify-center items-center p-6 space-y-6">
                            <div class="text-lg font-semibold text-black">{{ $ad->ad_description }}</div>
                            <img src="{{ $imageUrl }}" alt="Course Image"
                                class="rounded-xl w-full max-h-72 object-cover">
                        </div> --}}
                                <!-- Social Media Inspired Course Card (Vertical Layout) -->
                                <div
                                    class="bg-white border py-2 border-gray-200 rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300 w-full max-w-2xl mx-auto">
                                    <!-- Description Section -->
                                    <div class="p-6 bg-gradient-to-br from-gray-50 to-gray-100">
                                        {{-- <h3 class="text-xl font-bold text-gray-800 mb-2">وصف الدورة</h3> --}}
                                        <h3 class="text-xl font-bold text-gray-800 mb-2">-------------</h3>
                                        <p class="text-gray-600 leading-relaxed text-sm md:text-base">
                                            {{ $ad->content }}
                                        </p>

                                        <!-- Metadata / Social Icons -->
                                        {{-- <div class="flex items-center justify-between mt-6">
      <div class="text-sm text-gray-500">مدة الدورة: {{ $ad->duration ?? 'غير محددة' }}</div>
      <div class="flex space-x-3 rtl:space-x-reverse">
        <button class="text-teal-600 hover:text-teal-800">
          <i data-feather="heart"></i>
        </button>
        <button class="text-blue-600 hover:text-blue-800">
          <i data-feather="share-2"></i>
        </button>
      </div>
    </div> --}}
                                    </div>

                                    <!-- Image Section -->
                                    <div class="h-64 sm:h-80 md:h-96">
                                        <img src="{{ $imageUrl }}" alt="Ad Image"
                                            class="w-full h-full object-cover transition-transform duration-300 hover:scale-105" />
                                    </div>
                                </div>




                                {{--  --}}
                                {{--  --}}
                                {{--  --}}
                                <!-- Right Side -->
                                <div class="w-1/2 h-full bg-white shadow-xl p-4 overflow-y-auto">
                                    <div class="flex justify-between items-center border-b pb-2 mb-4">
                                        <h2 class="text-lg font-bold">التعليقات</h2>
                                        <button @click="showComments = false"
                                            class="text-gray-500 hover:text-red-500">✖</button>
                                    </div>

                                    {{-- <livewire:ad-comments.ad-comments :ad="$ad" :wire:key="'comments-' . $ad->id" /> --}}

                                    {{-- @livewire('ad-comments.ad-comments', ['ad' => $ad], key('comments-' . $ad->id)) --}}

                                    <livewire:student-tabs.ad-comments.ad-comments :ad="$ad"
                                        :wire:key="'comments-'.$ad->id" />
                                </div>
                            </div>

                            {{--  --}}
                        </div>
                    </div>
        @endforeach
        {{-- <div class="mt-6 flex justify-center">
            {!! $ads->withQueryString()->links() !!}
        </div> --}}

    </div>
    {{-- <script>
        window.cadMap = @json($ads->keyBy('id'));
    </script> --}}

</div>
