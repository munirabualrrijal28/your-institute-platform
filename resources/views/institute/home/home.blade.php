{{-- <h1>TEST</h1> --}}
@extends('institute.layouts.layout')
@section('institute_page_title')
    Institute Home
@endsection
@section('institute_sidebar_name')
    Institute Name
@endsection
@section('institute_layout')
    <h2>Home</h2>



    {{--  --}}

    <!-- Register CTA -->
    <div class="bg-teal-500 text-white text-center py-8 relative w-full ">
        <div class="max-w-8xl mx-auto flex flex-col md:flex-row items-center justify-between w-full h-70 relative">
            <div class="text-black bg-white mb-6 md:mb-0 border z-10 -mr-80 ml-20 ">
                <h2 class="text-xl font-semibold">Register Now</h2>
                <p class="text-md">Choose Your Suitable Institute</p>
            </div>
            {{-- <img src="/images/students.png" alt="students" class="w-1/3" /> --}}
            <img src="/images/home/home.png" alt="students" class="w-full h-full object-cover" />
        </div>
    </div>


    {{--  --}}
    {{-- @section('institute_home_tabs')
  Institute Menu
@endsection --}}

    {{--  --}}
    <!-- Slogan Section -->
    <div class="text-center py-10 px-4">
        <h3 class="text-lg font-semibold">With your institute's platform</h3>
        <p class="text-gray-600">we save you effort, money and time.</p>
    </div>




    <!-- Responsive Categories Grid using Tailwind CSS -->
    {{-- <div class="p-4 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
    <!-- Single Category Card -->
    <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden cursor-pointer">
      <img src="/path-to-image.jpg" alt="Category Name" class="w-full h-32 object-cover">
      <div class="p-2 text-center">
        <h3 class="text-sm font-semibold text-gray-700">Category Name</h3>
      </div>
      {{--  --}}
    {{-- <!-- Single Category Card -->
    <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden cursor-pointer">
      <img src="/path-to-image.jpg" alt="Category Name" class="w-full h-32 object-cover">
      <div class="p-2 text-center">
        <h3 class="text-sm font-semibold text-gray-700">Category Name</h3>
      </div>

    </div> --}}
    {{-- </div> --}}
    <div class="relative flex overflow-auto ">
        {{-- @php
$ins_home = collect([
    ['path' => 'images/inst_profile/jats/jats.png', 'name' => 'JATS'],
    ['path' => 'images/inst_profile/lbm/lb.jpg', 'name' => 'LBM'],
    ['path' => 'images/inst_profile/lbm/24_ins.jpg', 'name' => '24 ِAcademy'],
    ['path' => 'images/inst_profile/yali/yali.jpg', 'name' => 'Yali'],
    ['path' => 'images/inst_profile/speak/speak.jpg', 'name' => 'SpeakNow'],
    ['path' => 'images/inst_profile/we_can/we.jpg', 'name' => 'We Can'],

]);
    @endphp --}}
        {{-- @foreach ($ins_home as $item) --}}
            <!-- Single Category Card -->
            {{-- <div
                class="bg-white  rounded-2xl shadow hover:shadow-lg transition overflow-hidden cursor-pointer w-60 h-60 m-2 py-8 flex-shrink-0 scrollbar-none">
                <img src="{{ asset($item['path']) }}" alt="{{$item['name']}}"
                    class="w-full h-full object-cover">
                <div class="p-2 text-center pt-5">
                    <h3 class="text-sm font-semibold text-gray-700">{{$item['name']}}</h3>
                </div>
            </div> --}}
            {{-- End of Single Category Card --}}
        {{-- @endforeach --}}





    </div>




    {{--  --}}

    <!-- Repeat the above block for each category -->









    <!-- Programming Courses -->
    {{-- <div class="max-w-6xl mx-auto py-10">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
        @isset($courses)

        @foreach ($courses as $course)
            <div class="border p-4 rounded-lg text-center shadow-sm">
                <img src="{{ $course->icon }}" alt="{{ $course->title }}" class="mx-auto mb-2 h-12" />
                <h4 class="font-semibold">{{ $course->title }}</h4>
                <p class="text-sm text-gray-500">{{ $course->institute->name }}</p>
                <p class="text-yellow-500 text-sm">⭐ {{ $course->rating }} ({{ $course->learners }})</p>
                <p class="text-teal-600 font-bold mt-1">${{ $course->price }}</p>
            </div>
        @endforeach
        @endisset
    </div> --}}

    <div class="text-center mt-6">
        <a href="#" class="bg-teal-600 text-white px-6 py-2 rounded-md">Show All Programming Courses</a>
    </div>
    </div>

    <!-- Institutes Logos -->
    <div class="bg-gray-100 py-10 text-center">
        <div class="flex justify-center gap-10">
            {{-- @isset($courses)
        @foreach ($institutes as $institute)
            <img src="{{ $institute->logo }}" alt="{{ $institute->name }}" class="h-16" />
        @endforeach

        @endisset --}}

        </div>
    </div>

    <!-- Trending Now -->
    <div class="bg-white py-10">
        <h3 class="text-xl font-semibold text-center mb-6">Trending Now</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-6xl mx-auto">

            {{-- @isset($courses)
        @foreach ($trending as $category => $items)
            <div>
                <h4 class="text-teal-600 font-bold mb-2">{{ $category }}</h4>
                <ul class="text-gray-700">
                    @foreach ($items as $item)
                        <li>{{ $item['name'] }} <span class="text-gray-500">({{ $item['learners'] }} learners)</span></li>
                    @endforeach
                </ul>
            </div>
        @endforeach

        @endisset --}}

        </div>
    </div>



    {{--  --}}
@endsection
