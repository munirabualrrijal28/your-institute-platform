@extends('user.layouts.layout')
@section('user_page_title')
@endsection
@section('user_layout')
    {{--  --}}
    <div class="bg-gray-100 text-right w-auto">

  <!-- Tabs -->
        <div class="bg-teal-600 h-[50px] text-white px-6 py-2 flex flex-wrap gap-3 justify-center">
        </div>
        <!-- Header -->
        <div class="bg-white shadow-sm py-5 px-6 grid grid-cols-2 items-center">

            <!-- Right Column: Followers and Posts -->
            <div class="grid grid-cols-2 w-full text-center">
                <div class="flex flex-col items-center justify-center">
                    <p class="text-xl font-bold text-gray-900">{{ $following->count() }}</p>
                    <p id="user_following" class="text-sm text-gray-500">Following</p>
                </div>

            </div>

            <!-- Left Column: Institute name with verification + image -->
            <div class="flex justify-end items-center gap-4">

                <!-- Name + Verified Icon -->
                <div class="flex items-center gap-2">
                    <h1 class="text-2xl font-bold text-gray-800">{{ $current_stu->user->name }}</h1>
                    {{-- <img src="{{ asset('/images/icons/verified.svg') }}" alt="Verified" class="w-5 h-5" title="Verified Institute"> --}}
                </div>
                {{-- @if ($user->ins_is_verified) --}}
                {{-- <img src="{{ asset('/images/icons/verified.svg') }}" alt="Verified" class="w-5 h-5"
                                title="Verified Institute"> --}}
                {{-- @else --}}
                {{-- <img src="{{ asset('/images/icons/unverified.svg') }}" alt="Verified" class="w-5 h-5"
                                title="Verified Institute"> --}}
                {{-- @endif --}}
                <!-- Profile Image -->
                <img src="{{ asset('/images/profile/user_ic.svg') }}" alt="User Logo" class="w-20 h-20 rounded-full" />
            </div>

        </div>

        <!-- Tabs -->
        <div class="bg-teal-600 h-[50px] text-white px-6 py-2 flex flex-wrap gap-3 justify-center">
        </div>




        {{--  --}}


    </div>





    {{--  --}}
@endsection
