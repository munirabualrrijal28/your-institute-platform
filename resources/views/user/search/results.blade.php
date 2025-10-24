@extends('user.layouts.layout')
@php use Illuminate\Support\Str; @endphp

@section('user_layout')
    <div class="px-6 py-6 space-y-6 text-gray-800">

        <h2 class="text-2xl font-bold">نتائج البحث عن: "{{ $query }}"</h2>

        {{-- Institutes (rectangular cards) --}}
        @if (isset($institutes) && $institutes->count())
            <h3 class="text-teal-600 font-semibold mt-4">🏫 معاهد</h3>
            {{-- <div class="space-y-4">
            @foreach ($institutes as $ins)
                <div class="bg-white p-4 shadow rounded-md flex justify-between items-center">
                    <div class="text-lg font-semibold">{{ $ins->ins_name }}</div>
                    <a href="{{ route('user.user_ins_profile', $ins->id) }}"
                       class="text-sm text-teal-600 hover:underline">عرض المعهد</a>
                </div>
            @endforeach
        </div> --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 px-6">


                @foreach ($institutes as $institute)
                    <a href="{{ route('user.user_ins_profile', ['id' => $institute->id]) }}" target="_blank"
                        class="flex-shrink-0 flex flex-col items-center bg-white rounded-xl shadow-md p-4 transition hover:shadow-lg">
                        <img src="{{ asset($institute->ins_profile_photo) }}"
                            class="h-20 w-20 rounded-full object-cover border-2 border-white mb-2"
                            alt="{{ $institute->ins_name }}">
                        <span class="text-sm text-gray-700 font-medium">{{ $institute->ins_name }}</span>
                    </a>
                @endforeach
        @endif
    </div>


    </div>

    {{-- Courses (card grid) --}}
    @if (isset($courses) && $courses->count())
        <h3 class="text-teal-600 font-semibold mt-6">📘 دورات</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 px-6">
            @foreach ($courses as $course)
                {{-- <div class="bg-white p-4 rounded shadow">
                    <h4 class="text-lg font-bold mb-1">{{ $course->course_name }}</h4>
                    <p class="text-sm text-gray-500">{{ Str::limit($course->course_description, 100) }}</p>
                    <a href="{{ route('user.user_ins_profile', ['id' => $institute->id]) }}"
                        class="text-sm text-teal-600 hover:underline block mt-2">عرض التفاصيل</a>
                </div> --}}
                <!-- ✅ Course List in Two Rows and 4 Columns -->
                @php
                    $imageUrl = $course->media->first()
                        ? asset('storage/' . $course->media->first()->url)
                        : asset('images/profile/user_ic.svg');
                @endphp

                <div x-data="{ showComments: false }" class="bg-white rounded-xl shadow-md flex flex-col">

                    <img src="{{ $imageUrl }}" alt="Course Image" class="w-full h-40 object-cover">
                    <div class="p-4 flex flex-col flex-grow">
                        <h3 class="text-center text-lg font-bold text-gray-800 mb-1">{{ $course->course_name }}</h3>
                        <p class="text-center text-sm text-gray-600 mb-2">
                            {{ Str::limit($course->course_description, 80) }}</p>
                        <p class="text-center text-xs text-gray-400 mb-2">📅 {{ $course->created_at->diffForHumans() }}
                        </p>

                        {{-- <div class="text-center">
                            <button @click="showComments = true" class="text-blue-600 hover:underline text-sm">
                                {{-- 💬 Comments({{ $course->comments->count() }}) --}}
                                {{-- 💬 Comments <livewire:course-comments.comment-count :course="$course"
                                    :wire:key="'comments-'.$course->id" /> --}}
                            {{-- </button> --}}
                        {{-- </div>  --}}

                        <a href="{{ route('user.user_ins_profile', ['id' => $institute->id]) }}"
                            class="text-sm text-teal-600 hover:underline block mt-2">عرض المعهد</a>

                        <div class="mt-auto flex justify-center gap-3 pt-4 border-t">


                        </div>

                    </div>

                    <!-- Comments Modal -->
                    {{-- Left Side --}}
                    {{-- <div x-show="showComments" class="fixed inset-0 bg-black bg-opacity-40 z-40 flex flex-col md:flex-row"
                        @click.self="showComments = false" x-transition>
                        <div
                            class="w-full md:w-1/2 bg-gray-200 text-white flex flex-col justify-center items-center p-6 space-y-6">
                            <div class="text-lg text-black font-semibold text-center">{{ $course->course_description }}
                            </div>
                            <img src="{{ $imageUrl }}" alt="Course Image"
                                class="rounded-xl w-full max-h-64 md:max-h-72 object-cover">
                        </div>

                        {{-- Right Side --}}
                        {{-- <div class="w-full md:w-1/2 h-full bg-white shadow-xl p-4 overflow-y-auto">
                            <div class="flex justify-between items-center border-b pb-2 mb-4">
                                <h2 class="text-lg font-bold">التعليقات</h2>
                                <button @click="showComments = false"
                                    class="text-gray-500 hover:text-red-500 text-xl">✖</button>
                            </div>
                            <livewire:course-comments.course-comments :course="$course"
                                :wire:key="'comments-'.$course->id" />
                        </div> --}}

                    {{-- </div>  --}}
                </div>
            @endforeach
        </div>
    @endif

    {{-- Advertisements (card grid) --}}
    @if (isset($ads) && $ads->count())
        <h3 class="text-teal-600 font-semibold mt-6">📢 إعلانات</h3>
        {{-- <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6"> --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-6">
            @foreach ($ads as $ad)
                {{-- <div class="bg-white p-4 rounded shadow">
                    <h4 class="text-lg font-bold mb-1">{{ $ad->title }}</h4>
                    <p class="text-sm text-gray-500">{{ Str::limit($ad->content, 100) }}</p>
                    <a href="{{ route('user.user_ins_profile', ['id' => $institute->id]) }}"
                        class="text-sm text-teal-600 hover:underline block mt-2">عرض الإعلان</a>
                </div> --}}
                <!-- Grid of Advertisements -->
                {{-- <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-6"> --}}
                @php
                    $imageUrl = $ad->media->first()
                        ? asset('storage/' . $ad->media->first()->url)
                        : asset('images/default-ad.jpg');
                @endphp
                <div wire:key="ad-{{ $ad->id }}" x-data="{ showComments: false, isUploading: false }"
                    class="bg-white rounded-xl shadow-md  flex flex-col">

                    <div wire:key="ad-{{ $ad->id }}"
                        class="bg-white rounded-xl shadow-md  flex flex-col">
                        <img src="{{ $imageUrl }}" alt="Ad Image" class="w-full h-40 object-cover">

                        <div class="p-4 flex flex-col flex-grow">
                            <p class="text-center text-sm text-gray-700 mb-2">{{ Str::limit($ad->content, 100) }}
                            </p>
                            <p class="text-center text-xs text-gray-400 mb-2">📅
                                {{ $ad->created_at->diffForHumans() }}
                            </p>


<a href="{{ route('user.user_ins_profile', ['id' => $institute->id]) }}"
                        class="text-sm text-teal-600 hover:underline block mt-2">عرض المعهد</a>
                        </div>
                        {{--  --}}




                        {{--  --}}
                    </div>
                </div>
                {{-- </div> --}}
            @endforeach
        </div>
    @endif

    </div>
@endsection
