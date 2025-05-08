@extends('user.layouts.layout')
@section('user_page_title')
User - Settings
@endsection
@section('user_layout')

<div class="bg-gray-100 text-right w-auto">

    <!-- Header -->
    <div class="bg-white shadow-sm py-5 px-6 grid grid-cols-2 items-center">

        <!-- Right Column: Followers and Posts -->
        <div class="grid grid-cols-2 w-full text-center">
            <div class="flex flex-col items-center justify-center">
                <p class="text-xl font-bold text-gray-900">{{ $followersCount ?? '0' }}</p>
                <p class="text-sm text-gray-500">المتابعون</p>
            </div>
        </div>

        <!-- Left Column: User name, edit icon, profile image -->
        <div class="flex justify-end items-center gap-4 relative">

            <!-- Name + Edit Icon -->
            <div class="flex items-center gap-2">
                <h1 class="text-2xl font-bold text-gray-800">{{ $current_ins->ins_name ?? 'User Name' }}</h1>
                <a href="#" title="Edit Name">
                    <img src="{{ asset('/images/icons/edit.svg') }}" alt="Edit" class="w-5 h-5">
                </a>
            </div>

            <!-- Profile image with overlay icon -->
            <div class="relative">
                <img src="{{ asset('/images/profile/user_ic.svg') }}" alt="User Logo" class="w-20 h-20 rounded-full border shadow-md object-cover">
                <a href="#" class="absolute bottom-0 right-0 bg-white rounded-full p-1 shadow" title="Change Photo">
                    <img src="{{ asset('/images/icons/image_upload.svg') }}" class="w-5 h-5" alt="Upload">
                </a>
            </div>
        </div>
    </div>

    <!-- Tabs Section -->
    <div class="bg-teal-600 text-white px-6 py-2 flex flex-wrap gap-3 justify-center">

        <!-- Active Tab -->
        <button class="bg-white text-teal-600 px-4 py-2 rounded-full font-semibold shadow">
            خاص بالحساب
        </button>

        <!-- Inactive Tab -->
        <button class="hover:bg-teal-700 px-4 py-2 rounded-full font-semibold">
            المتابعون
        </button>
    </div>

</div>


@endsection
