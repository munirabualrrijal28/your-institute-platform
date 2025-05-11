@extends('user.layouts.layout')
@section('user_page_title')
@endsection
@section('user_layout')



    <div class="bg-gray-100 text-right w-auto">



 <div class="bg-gray-100 text-right w-auto">

            <!-- Header -->
            <div class="bg-white shadow-sm py-5 px-6 grid grid-cols-2 items-center">



                <!-- Right Column: Followers and Posts -->
                <div class="grid grid-cols-2 w-full text-center">
                    <div class="flex flex-col items-center justify-center">
                        <p class="text-xl font-bold text-gray-900">{{$following->count()}}</p>
                        <p class="text-sm text-gray-500">المتابعين</p>
                    </div>

                      <livewire:follow.follow-button :institute="$institute" />



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
                        <h1 class="text-2xl font-bold text-gray-800">{{$institute->ins_name}} </h1>
                         @if ($institute->ins_is_verified)
                            <img src="{{ asset('/images/icons/verified.svg') }}" alt="Verified" class="w-5 h-5"
                                title="Verified Institute">
                        @else
<img src="{{ asset('/images/icons/unverified.svg') }}" alt="Verified" class="w-5 h-5"
                                title="Verified Institute">
                        @endif
                    </div>

                    <!-- Profile Image -->
                        <img src="{{ asset($institute->ins_profile_photo ?? '/images/profile/user_ic.svg') }}" alt="صورة المدرب" class="rounded-full w-16 h-16 object-cover">
                </div>

            </div>

            {{-- Down here showing the tabs with livewire --}}

            {{-- <livewire:institute-tabs.institute-tabs /> --}}

            <div dir="ltr">
                <livewire:institute-tabs.institute-tabs :institute-id="$institute->id" />
            </div>





        </div>




    </div>


@endsection
