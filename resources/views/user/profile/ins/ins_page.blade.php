@extends('user.layouts.layout')
@section('user_page_title')
@endsection
@section('user_layout')
    {{-- <h2>Profile Page</h2> --}}



    <div class="bg-gray-100 text-right w-auto">

        <!-- Header -->
        <div class="bg-white shadow-sm py-5 px-6 grid grid-cols-2 items-center">

            <!-- Right Column: Followers and Posts -->
            <div class="grid grid-cols-3 w-full text-center">
           <!-- Followers -->
{{-- <div class="flex flex-col items-center justify-center">
    <p class="text-xl font-bold text-gray-900">{{ $institute->followers_count }}</p>
    <p class="text-sm text-gray-500">المتابعين</p>
</div> --}}

<!-- Posts -->
<div class="flex flex-col items-center justify-center">
    <p class="text-xl font-bold text-gray-900">{{ $institute->advertisements_count }}</p>
    <p class="text-sm text-gray-500">المنشورات</p>
</div>
                <div class="flex flex-col items-center justify-center bg-teal-500  rounded-xl ">

                    {{-- <button class="w-full h-full rounded-xl bg-teal-500 hover:bg-teal-600">Follow</button> --}}
                    <form method="POST" action="{{ route('user.follow_institute', $institute->id) }}">
                        @csrf
                        <button type="submit"
                            class="{{ $isFollowing ? 'bg-teal-700 text-white' : 'bg-teal-500 text-white hover:bg-teal-600' }} w-full h-full rounded-xl font-semibold">
                            {{ $isFollowing ? 'Following' : 'Follow' }}
                        </button>
                    </form>
                    {{--  --}}
                </div>


            </div>

            <!-- Left Column: Institute name with verification + image -->
            <div class="flex justify-end items-center gap-4">

                <!-- Name + Verified Icon -->
                <div class="flex items-center gap-2">
                    <button class="bt bt "></button>
<h1 class="text-2xl font-bold text-gray-800">{{ $institute->ins_name }}</h1>
                   @if ($institute->ins_is_verified)
    <img src="{{ asset('/images/icons/verified.svg') }}" alt="Verified" class="w-5 h-5"
         title="Verified Institute">
@endif
                </div>

                <!-- Profile Image -->
<img src="{{ asset($institute->ins_profile_photo) }}" alt="{{ $institute->ins_name }} Logo"
     class="w-20 h-20 rounded-full object-cover" />
            </div>

        </div>

        <!-- Tabs -->
        <div class="bg-teal-600 text-white px-6 py-2 flex flex-wrap gap-3 justify-center">

            <button class="bg-white text-teal-600  px-4 py-2 rounded-full font-semibold shadow">الكادر</button>
            <button class="hover:bg-teal-700  px-4 py-2 rounded-full font-semibold">الكورسات</button>
            <button class="hover:bg-teal-700 px-4 py-2 rounded-full font-semibold">الأقسام</button>
            <button class="hover:bg-teal-700 px-4 py-2 rounded-full font-semibold">الإعلانات</button>
        </div>

        <!-- Instructor Cards Section -->
        <div class="container mx-auto px-6 py-8">
            {{-- <h2 class="text-2xl font-bold mb-6 text-teal-700">المدربون</h2> --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Instructor Card -->
                <div class="bg-white rounded-xl shadow hover:shadow-lg p-5 flex items-center space-x-4">
                    <img src="{{ asset('/images/profile/user_ic.svg') }}" alt="صورة المدرب"
                        class="rounded-full w-16 h-16 object-cover" />
                    <div class="text-right">
                        <h3 class="text-lg font-bold">محمد سليمان الرياني</h3>
                        <p class="text-gray-600">مختص في دورات الجرافيكس</p>
                    </div>
                </div>

                <!-- Instructor Card -->
                <div class="bg-white rounded-xl shadow hover:shadow-lg p-5 flex items-center space-x-4">
                    <img src="{{ asset('/images/profile/user_ic.svg') }}" alt="صورة المدرب"
                        class="rounded-full w-16 h-16 object-cover" />
                    <div class="text-right">
                        <h3 class="text-lg font-bold">مصطفى فهمي المغتربي</h3>
                        <p class="text-gray-600">مختص في دورات اللغة الهندية</p>
                    </div>
                </div>

                <!-- Instructor Card -->
                <div class="bg-white rounded-xl shadow hover:shadow-lg p-5 flex items-center space-x-4">
                    <img src="{{ asset('/images/profile/user_ic.svg') }}" alt="صورة المدرب"
                        class="rounded-full w-16 h-16 object-cover" />
                    <div class="text-right">
                        <h3 class="text-lg font-bold">منير نعمان أبو الرجال</h3>
                        <p class="text-gray-600">مختص في دورات اللغة الإنجليزية</p>
                    </div>
                </div>

            </div>
        </div>


        {{--  --}}


    </div>
@endsection
