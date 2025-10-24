@php
    // use App\Models\Institute;
    $institute = \App\Models\Institute::find($instituteId);
    $avgRating = $institute
        ? round($institute->ratings()->whereNotNull('review')->where('is_approved', true)->avg('rating'), 1)
        : 0;
@endphp



<div>



    @php
        $institute = \App\Models\Institute::find($instituteId);
        $avgRating = $institute
            ? round($institute->ratings()->whereNotNull('review')->where('is_approved', true)->avg('rating'), 1)
            : 0;
    @endphp

    @if ($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" x-cloak>
            <div class="bg-white w-full max-w-2xl mx-4 p-6 rounded-lg shadow-lg overflow-y-auto max-h-[90vh]">

                <!-- Header -->
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold text-gray-800">Institute Ratings</h2>
                    <button wire:click="$set('showModal', false)"
                        class="text-gray-400 hover:text-red-600 text-2xl font-bold">×</button>
                </div>

                <!-- Flash Message -->
                @if (session()->has('message'))
                    <div class="bg-green-100 text-green-800 px-3 py-2 rounded mb-4 text-sm shadow">
                        {{ session('message') }}
                    </div>
                @endif

                <!-- Form -->
                <form wire:submit.prevent="save" class="space-y-4 mt-4">
                    <!-- Stars -->
                    <div class="flex justify-center gap-1 text-3xl text-yellow-400">
                        @for ($i = 1; $i <= 5; $i++)
                            <button type="button" wire:click="$set('rating', {{ $i }})"
                                class="{{ $i <= $rating ? 'text-yellow-400 scale-110' : 'text-gray-300' }}">
                                ★
                            </button>
                        @endfor
                    </div>

                    <!-- Review -->
                    <textarea wire:model.defer="review" rows="3" class="w-full border rounded p-2 text-sm"
                        placeholder="Write your review here..."></textarea>

                    @error('rating')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <!-- Submit Buttons -->
                    <div class="flex justify-end gap-4">
                        <button type="submit"
                            class="bg-teal-600 text-white px-4 py-2 rounded hover:bg-teal-700 text-sm">
                            {{ $existingRatingId ? 'Update Rating' : 'Submit Rating' }}
                        </button>

                        {{--  --}}

                        {{-- @if ($existingRatingId)
                    <button wire:click="deleteRating" type="button"
                        class="text-red-600 hover:underline text-sm">
                        🗑️ Delete Rating
                    </button>
                   @endif --}}


                        <!-- Delete Button with Alpine Confirmation -->
                        @if ($existingRatingId)
                            <div x-data="{ confirmDelete: false }" class="mt-2">
                                <button type="button" @click="confirmDelete = true"
                                    class="text-red-600 hover:underline text-sm">
                                    🗑️ Delete Rating
                                </button>

                                <!-- Confirmation Box -->
                                <div x-show="confirmDelete" x-transition
                                    class="mt-2 bg-red-100 border border-red-300 text-red-700 p-3 rounded shadow text-sm space-y-2">
                                    <p>Are you sure you want to delete your rating?</p>
                                    <div class="flex gap-4 justify-end">
                                        <button @click="confirmDelete = false" class="text-gray-500 hover:underline">
                                            Cancel
                                        </button>
                                        <button @click="$wire.deleteRating(); confirmDelete = false"
                                            class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                            Yes, Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif



                        {{--  --}}
                        {{--  --}}
                        {{--  --}}

                    </div>



                </form>

                <!-- Average Rating -->
                <hr class="my-6 border-gray-300">
                <div class="flex items-center gap-2 justify-center">
                    <span class="text-sm font-semibold text-gray-700">Average Rating:</span>
                    <div class="text-yellow-400 text-base">
                        @for ($i = 1; $i <= 5; $i++)
                            <span class="{{ $i <= $avgRating ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                        @endfor
                    </div>
                    <span class="text-sm text-gray-500">({{ $avgRating }}/5)</span>
                </div>

                <!-- Ratings List -->
                <hr class="my-4 border-gray-300">
                <livewire:ratings.institute-rating-list :institute-id="$instituteId" />
            </div>
        </div>
    @endif




</div>
