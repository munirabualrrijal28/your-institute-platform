@extends('institute.layouts.layout')
{{-- @section('institute_page_title')
    {{-- Institute - Profile --}}
{{-- @endsection --}}

{{-- <div x-data="courseEditor()" x-init="init()" class="relative"> --}}

    @section('institute_layout')
        {{-- <h2>Profile Page</h2> --}}



        <div class="bg-gray-100 text-right w-auto">

            <!-- Header -->
            <div class="bg-white shadow-sm py-5 px-6 grid grid-cols-2 items-center">

                <!-- Right Column: Followers and Posts -->
                <div class="grid grid-cols-2 w-full text-center">
                    <div class="flex flex-col items-center justify-center">
                        <p class="text-xl font-bold text-gray-900">{{$followers_count}}</p>
                        <p class="text-sm text-gray-500">المتابعين</p>
                    </div>
                    <div class="flex flex-col items-center justify-center">
                        <p class="text-xl font-bold text-gray-900">50</p>
                        <p class="text-sm text-gray-500">المنشورات</p>
                    </div>
                </div>

                <!-- Left Column: Institute name with verification + image -->
                <div class="flex justify-end items-center gap-4">

                    <!-- Name + Verified Icon -->
                    <div class="flex items-center gap-2">
                        <h1 class="text-2xl font-bold text-gray-800">{{$institute->ins_name}} </h1>
                        <img src="{{ asset('/images/icons/verified.svg') }}" alt="Verified" class="w-5 h-5"
                            title="Verified Institute">
                    </div>

                    <!-- Profile Image -->
                    <img src="{{ asset('/images/profile/user_ic.svg') }}" alt="JATS Logo" class="w-20 h-20 rounded-full" />
                </div>

            </div>

            {{-- Down here showing the tabs with livewire --}}

            {{-- <livewire:institute-tabs.institute-tabs /> --}}

            <div dir="ltr">
                <livewire:institute-tabs.institute-tabs :institute-id="$institute->id" />
            </div>





        </div>

        
    @endsection


