@extends('user.layouts.layout')
@section('user_page_title')
@endsection
@section('user_layout')
    <div class="bg-gray-100 text-right w-auto">

        {{-- <p class="text-red-500 text-sm">
    Auth User ID: {{ Auth::id() }} |
    Role: {{ Auth::check() ? Auth::user()->role : 'guest' }}
</p> --}}

        <div class="bg-gray-100 text-right w-auto">

            <!-- Header -->
            <div class="bg-white shadow-sm py-5 px-6 grid grid-cols-2 items-center">



                <!-- Right Column: Followers and Posts -->
                <div class="grid grid-cols-2 w-full text-center">
                    <div class="flex flex-col items-center justify-center">
                        <p class="text-xl font-bold text-gray-900">{{ $followers_count }}</p>
                        <p class="text-sm text-gray-500">المتابعين</p>
                    </div>

                    <livewire:follow.follow-button :institute="$institute" />

                    {{--  --}}

                    @php
                        $approvedRatings = $institute
                            ->ratings()
                            ->whereNotNull('review')
                            ->where('is_approved', true)
                            ->get();

                        $avgRating = round($approvedRatings->avg('rating'), 1);

                        $student = \App\Models\Student::where('user_id_fk', Auth::id())->first();
                        $canRate =
                            Auth::check() &&
                            Auth::user()->role == 2 &&
                            $student &&
                            \App\Models\Followers::where('student_id_fk', $student->id)
                                ->where('institute_id_fk', $institute->id)
                                ->exists();
                    @endphp



                    <div class="flex items-center justify-between bg-white shadow p-3 rounded-lg w-full max-w-xl">
                        <div class="flex items-center gap-2">
                            <span class="text-sm text-gray-700 font-semibold">Rating:</span>
                            <div class="text-yellow-400 text-sm">
                                @for ($i = 1; $i <= 5; $i++)
                                    <span class="{{ $i <= $avgRating ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                                @endfor
                            </div>
                            <span class="text-xs text-gray-500 ml-1">({{ $avgRating }}/5)</span>
                        </div>



                        <div>
                            {{--  --}}
                            {{--  --}}
                            {{--  --}}
                            {{-- <livewire:ratings.institute-rating-modal :institute-id="$institute->id" /> --}}

                            @if (!$canRate)
                                <p class="text-sm text-gray-500 text-center">
                                    You must follow this institute to leave a rating.
                                </p>
                            @elseif ($canRate && !$hasRated)
                                {{-- ⭐ First-time rating form --}}
                                {{-- <form>...submit form here... --}}
                                {{-- <div x-data="{ showRatings: false }" @open-modal.window="showRatings = true" @close-modal.window="showRatings = false">
    <button @click="$wire.set('showModal', true); showRatings = true" class="text-sm text-teal-600 hover:underline hover:text-teal-700">
        ★ View Ratings
    </button>

    <template x-if="showRatings">
        <livewire:ratings.institute-rating-modal :institute-id="$institute->id" />
    </template>
</div> --}}
                                <!-- Trigger button to open rating modal -->

                                <!-- Livewire Modal always loaded -->
                                <livewire:ratings.institute-rating-modal :institute-id="$institute->id" />

                                <!-- Alpine for trigger -->
                                <div x-data>
                                    <button @click="Livewire.dispatch('open-rating-modal')"
                                        class="text-sm text-teal-600 hover:underline hover:text-teal-700">
                                        ★ View Ratings
                                    </button>
                                </div>


                                {{--  --}}
                                {{--  --}}
                                {{--  --}}
                            @elseif ($canRate && $hasRated)
                                {{-- 🔁 Edit existing rating form --}}
    <livewire:ratings.institute-rating-modal :institute-id="$institute->id" />

                                <!-- Alpine for trigger -->
                                <div x-data>
                                    <button @click="Livewire.dispatch('open-rating-modal')"
                                        class="text-sm text-teal-600 hover:underline hover:text-teal-700">
                                        ★ View Ratings
                                    </button>
                                </div>

                            @endif
                        </div>
                        {{--  --}}
                        {{--  --}}
                        {{--  --}}



                    </div>


                    {{--  --}}
                </div>

                {{-- user.follow_institute --}}
                {{-- <livewire:follow.follow-button> --}}
                @php
                    // dd($institute);
                @endphp

                {{-- <livewire:follow-button :institute="$institute" /> --}}

                <!-- Left Column: Institute name with verification + image -->
                <div class="flex justify-end items-center gap-4">

                    <!-- Name + Verified Icon -->
                    <div class="flex items-center gap-2">
                        <h1 class="text-2xl font-bold text-gray-800">{{ $institute->ins_name }} </h1>
                        @if ($institute->ins_is_verified)
                            <img src="{{ asset('/images/icons/verified.svg') }}" alt="Verified" class="w-5 h-5"
                                title="Verified Institute">
                        @else
                            <img src="{{ asset('/images/icons/unverified.svg') }}" alt="Verified" class="w-5 h-5"
                                title="Verified Institute">
                            {{-- <img src="{{ asset('/images/icons/verified.svg') }}" alt="Verified" class="w-5 h-5"
                                title="Verified Institute"> --}}
                        @endif
                    </div>

                    <!-- Profile Image -->
                    <img src="{{ asset($institute->ins_profile_photo ?? '/images/profile/user_ic.svg') }}" alt="صورة المدرب"
                        class="rounded-full w-16 h-16 object-cover">
                </div>

            </div>

            {{-- Down here showing the tabs with livewire --}}



            <div dir="ltr">
                <livewire:student-tabs.student-tabs :institute-id="$institute->id" />
            </div>





        </div>




    </div>
@endsection
