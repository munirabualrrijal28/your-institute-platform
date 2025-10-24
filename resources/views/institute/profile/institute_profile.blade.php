@php
    use App\Models\Institute;

    $user = auth()->user();
    $institute = Institute::where('user_id_fk', $user->id)->first();

    $photoUrl = $institute && $institute->ins_profile_photo
        ? asset('storage/' . $institute->ins_profile_photo)
        : asset('/images/profile/user_ic.svg');
@endphp
@extends('institute.layouts.layout')

@section('institute_layout')
    {{-- <h2>Profile Page</h2> --}}



    <div class="bg-gray-100 px-[90px] text-right w-auto">

        <!-- Header -->
        <div class="bg-white shadow-sm py-5 px-6 grid grid-cols-2 items-center">
            {{--  to show card back ground use : bg-white shadow-md rounded-xl overflow-hidden flex items-center justify-center border border-gray-200 --}}
            <!-- Right Column: Followers and Posts -->
            <div class="grid grid-cols-2 w-full text-center ">
                <div class="flex flex-col items-center justify-center">
                    <p class="text-xl font-bold text-gray-900">{{ $followers->count() }}</p>
                    <p class="text-sm text-gray-500">المتابعين</p>
                </div>
                <div class="flex flex-col items-center justify-center">
                    <p class="text-xl font-bold text-gray-900">{{ $ads->count() }}</p>
                    <p class="text-sm text-gray-500">المنشورات</p>
                </div>
            </div>

            <!-- Left Column: Institute name with verification + image -->
            <div class="flex justify-end items-center gap-4 rounded-full radious-10">

                <!-- Name + Verified Icon -->
                <div class="flex items-center gap-2">
                    <h1 class="text-2xl font-bold text-gray-800">{{ $institute->ins_name }} </h1>
                    @if ($institute->ins_is_verified)
                        <img src="{{ asset('/images/icons/verified.svg') }}" alt="Verified" class="w-5 h-5"
                            title="Verified Institute">
                    @else
                        <img src="{{ asset('/images/icons/unverified.svg') }}" alt="UnVerified" class="w-5 h-5"
                            title="Verified Institute">
                        {{-- <img src="{{ asset('/images/icons/verified.svg') }}" alt="Verified" class="w-5 h-5"
                                title="Verified Institute"> --}}
                    @endif
                </div>
                <!-- Profile Image -->
                <img src="{{ $institute->ins_profile_photo ? asset($photoUrl) : asset('/images/profile/user_ic.svg') }}"
                    alt="{{ $institute->ins_name }} Logo"
                    class="w-[150px] h-[140px] object-over bg-white shadow-md rounded-xl overflow-hidden flex items-center justify-center border border-gray-200" />

            </div>

        </div>



        <div dir="ltr">
            <livewire:institute-tabs.institute-tabs :institute-id="$institute->id" />
        </div>




        <script>
            Livewire.hook('message.processed', () => {
                feather.replace(); // for feather icons
            });
        </script>
    </div>
@endsection
