<div>

<div x-data="{ isUploading: false }" class="max-w-6xl mx-auto space-y-10">

    {{-- Flash Message --}}
    @if (session()->has('message'))
        <div class="flex items-center gap-2 bg-green-100 text-green-800 p-3 rounded shadow">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m5 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ session('message') }}</span>
        </div>
    @endif

    <!-- Add/Edit Advertisement Form -->
    <div class="bg-white rounded-2xl p-6 shadow-md space-y-4 border border-gray-100">
        <h2 class="text-2xl font-bold text-gray-800">
            {{ $editing ? 'تعديل الإعلان' : 'إضافة إعلان جديد' }}
        </h2>

        <form wire:submit.prevent="saveAd" wire:key="form-{{ $formKey }}"
              x-on:livewire-upload-start="isUploading = true"
              x-on:livewire-upload-finish="isUploading = false"
              x-on:livewire-upload-error="isUploading = false"
              class="space-y-4">

            <!-- Title -->
            <div class="space-y-1">
                <label class="block text-sm font-semibold text-gray-700">العنوان</label>
                <input wire:model.defer="title" type="text"
                       class="w-full border-gray-300 rounded-xl px-4 py-2 shadow-sm focus:ring focus:ring-teal-100">
                @error('title') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <!-- Content -->
            <div>
                <label class="block font-medium text-sm mb-1">نص الإعلان</label>
                <textarea wire:model.defer="content"
                          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                          required></textarea>
                @error('content') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Image Upload -->
            <div>
                <label class="block font-medium text-sm mb-1">صور الإعلان</label>
                <input type="file" wire:model="images" multiple class="w-full" />

                @if ($images)
                    <div class="flex space-x-2 mt-2">
                        @foreach ($images as $image)
                            <img src="{{ $image->temporaryUrl() }}"
                                 class="w-20 h-20 object-cover rounded border shadow" />
                        @endforeach
                    </div>
                @elseif ($existingImage)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $existingImage) }}"
                             class="w-20 h-20 object-cover rounded border shadow" />
                    </div>
                @endif

                @error('images.*') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Buttons -->
            <div class="flex justify-end space-x-4">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-semibold transition-all"
                        x-bind:disabled="isUploading">
                    <span x-show="!isUploading">{{ $editing ? 'تحديث' : 'إضافة' }}</span>
                    <span x-show="isUploading" class="flex items-center">
                        <svg class="animate-spin h-5 w-5 text-white mr-2" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4" />
                            <path class="opacity-75" fill="currentColor"
                                  d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z" />
                        </svg>
                        جاري رفع الصور...
                    </span>
                </button>

                @if ($editing)
                    <button type="button" wire:click="resetForm"
                            class="bg-gray-400 hover:bg-gray-500 text-white px-5 py-2 rounded-lg font-semibold">
                        إلغاء
                    </button>
                @endif
            </div>
        </form>
    </div>

    <!-- Advertisement Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($ads as $ad)
            @php
                $media = $ad->media->first();
                $mediaUrl = $media
                    ? (Str::startsWith($media->url, 'ads/') ? asset('storage/' . $media->url) : asset($media->url))
                    : asset('images/profile/user_ic.svg');
            @endphp

            <div class="bg-white border rounded-xl shadow hover:shadow-lg transition overflow-hidden flex flex-col">
                <div class="h-40 overflow-hidden bg-gray-100">
                    <img src="{{ $mediaUrl }}" class="w-full h-full object-cover">
                </div>

                <div class="p-4 flex-1 flex flex-col justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-1">{{ $ad->title }}</h3>
                        <p class="text-sm text-gray-600">{{ Str::limit($ad->content, 100) }}</p>
                    </div>

                    <div class="flex justify-end space-x-3 pt-4">
                        <button wire:click="editAd({{ $ad->id }})"
                                class="text-blue-600 hover:text-blue-800 transition" title="تعديل">
                            <x-heroicon-s-pencil class="w-5 h-5" />
                        </button>
                        <button wire:click="confirmDelete({{ $ad->id }})"
                                class="text-red-600 hover:text-red-800 transition" title="حذف">
                            <x-heroicon-s-trash class="w-5 h-5" />
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    {{-- <div class="mt-6">
        {{ $ads->links() }}
    </div> --}}
      <div class="mt-6 flex justify-center">
            {!! $ads->withQueryString()->links() !!}
        </div>

    <!-- Delete Confirmation Modal -->
    @if ($confirmingDelete)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-xl shadow-lg max-w-sm w-full text-center">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">هل أنت متأكد؟</h2>
                <p class="text-gray-600 mb-6">سيتم حذف الإعلان، لا يمكن التراجع.</p>
                <div class="flex justify-center gap-4">
                    <button wire:click="deleteAd({{ $adToDeleteId }})"
                            class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">نعم، احذف</button>
                    <button wire:click="$set('confirmingDelete', false)"
                            class="bg-gray-300 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-400 transition">إلغاء</button>
                </div>
            </div>
        </div>
    @endif

</div>


</div>
