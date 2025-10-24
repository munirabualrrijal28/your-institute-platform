@extends('user.layouts.layout')
@section('user_page_title')
    {{-- User - Home --}}
@endsection
@section('user_layout')
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 px-6">


        @foreach ($institutes as $institute)
            <a href="{{ route('user.user_ins_profile', ['id' => $institute->id]) }}" target="_blank"
                class="flex-shrink-0 flex flex-col items-center bg-white rounded-xl shadow-md p-4 transition hover:shadow-lg">
                <img src="{{ asset($institute->ins_profile_photo) }}"
                    class="h-20 w-20 rounded-full object-cover border-2 border-white mb-2" alt="{{ $institute->ins_name }}">
                <span class="text-sm text-gray-700 font-medium">{{ $institute->ins_name }}</span>
            </a>
        @endforeach

    </div>


    {{--  --}}
    {{--  --}}
    {{--  --}}
  {{-- @if (isset($courses) && $courses->count()) --}}
        {{-- <h3 class="text-teal-600 font-semibold mt-6">📘 دورات</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 px-6">
            @foreach ($courses as $course)
                {{-- <div class="bg-white p-4 rounded shadow">
                    <h4 class="text-lg font-bold mb-1">{{ $course->course_name }}</h4>
                    <p class="text-sm text-gray-500">{{ Str::limit($course->course_description, 100) }}</p>
                    <a href="{{ route('user.user_ins_profile', ['id' => $institute->id]) }}"
                        class="text-sm text-teal-600 hover:underline block mt-2">عرض التفاصيل</a>
                </div> --}}
                <!-- ✅ Course List in Two Rows and 4 Columns -->
                {{-- @php
                    $imageUrl = $course->media->first()
                        ? asset('storage/' . $course->media->first()->url)
                        : asset('images/profile/user_ic.svg');
                @endphp --}}

                {{-- <div x-data="{ showComments: false }" class="bg-white rounded-xl shadow-md overflow-hidden flex flex-col">
                    <img src="{{ $imageUrl }}" alt="Course Image" class="w-full h-40 object-cover">
                    <div class="p-4 flex flex-col flex-grow">
                        <h3 class="text-center text-lg font-bold text-gray-800 mb-1">{{ $course->course_name }}</h3>
                        <p class="text-center text-sm text-gray-600 mb-2">
                            {{ Str::limit($course->course_description, 80) }}</p>
                        <p class="text-center text-xs text-gray-400 mb-2">📅 {{ $course->created_at->diffForHumans() }}
                        </p> --}}


                        {{-- <a href="{{ route('user.user_ins_profile', ['id' => $institute->id]) }}"
                            class="text-sm text-teal-600 hover:underline block mt-2">عرض المعهد</a>

                        <div class="mt-auto flex justify-center gap-3 pt-4 border-t">


                        </div>

                    </div>
                </div>
            @endforeach
        </div> --}}
    {{-- @endif --}}

    {{-- Advertisements (card grid) --}}
    {{-- @if (isset($ads) && $ads->count()) --}}
        {{-- <h3 class="text-teal-600 font-semibold mt-6">📢 إعلانات</h3> --}}
        {{-- <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6"> --}}

        {{-- <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-6">
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


<a href="{{ route('user.user_ins_profile', ['id' => $ad->institute_id_fk]) }}"
                        class="text-sm text-teal-600 hover:underline block mt-2">عرض المعهد</a>
                        </div>




                    </div>
                </div>
            @endforeach
        </div> --}}


    {{-- @endif --}}

    {{-- </div> --}}





{{--  --}}
{{--  --}}
{{--  --}}

    {{--
   <div class="mt-6">
        {{ $institutes->links('pagination::tailwind') }}
    </div> --}}


    <div class="mt-6 flex justify-center">
        {!! $institutes->withQueryString()->links() !!}
    </div>


@endsection
