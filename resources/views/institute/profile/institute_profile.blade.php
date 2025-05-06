@extends('institute.layouts.layout')
@section('institute_page_title')
    {{-- Institute - Profile --}}
@endsection
@section('institute_layout')
    {{-- <h2>Profile Page</h2> --}}



    <div class="bg-gray-100 text-right w-auto">

        <!-- Header -->
        <div class="bg-white shadow-sm py-5 px-6 grid grid-cols-2 items-center">

            <!-- Right Column: Followers and Posts -->
            <div class="grid grid-cols-2 w-full text-center">
                <div class="flex flex-col items-center justify-center">
                    <p class="text-xl font-bold text-gray-900">800</p>
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
                    <h1 class="text-2xl font-bold text-gray-800">Jats Institute</h1>
                    <img src="{{ asset('/images/icons/verified.svg') }}" alt="Verified" class="w-5 h-5"
                        title="Verified Institute">
                </div>

                <!-- Profile Image -->
                <img src="{{ asset('/images/profile/user_ic.svg') }}" alt="JATS Logo" class="w-20 h-20 rounded-full" />
            </div>

        </div>

        <!-- Tabs -->
     <!-- Tabs -->
<div x-data="{ tab: 'instructors' }" class="bg-teal-600 text-white px-6 py-2 flex flex-wrap gap-3 justify-center">

    <button @click="tab = 'instructors'"
        :class="tab === 'instructors' ? 'bg-white text-teal-600' : 'hover:bg-teal-700'"
        class="px-4 py-2 rounded-full font-semibold shadow transition-all duration-200">الكادر</button>

    <button @click="tab = 'courses'"
        :class="tab === 'courses' ? 'bg-white text-teal-600' : 'hover:bg-teal-700'"
        class="px-4 py-2 rounded-full font-semibold shadow transition-all duration-200">الكورسات</button>

    <button @click="tab = 'categories'"
        :class="tab === 'departments' ? 'bg-white text-teal-600' : 'hover:bg-teal-700'"
        class="px-4 py-2 rounded-full font-semibold shadow transition-all duration-200">الأقسام</button>

    <button @click="tab = 'Advertisement'"
        :class="tab === 'ads' ? 'bg-white text-teal-600' : 'hover:bg-teal-700'"
        class="px-4 py-2 rounded-full font-semibold shadow transition-all duration-200">الإعلانات</button>
</div>


        <!-- Instructor Cards Section -->
      
<!-- الكادر Tab Content -->
<div x-show="tab === 'staff'" class="container mx-auto px-6 py-8" x-transition>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Instructor Cards here... -->
           <!-- Instructor Card -->
           <div class="bg-white rounded-xl shadow hover:shadow-lg p-5 flex items-center space-x-4">
            <img src="{{ asset('/images/profile/user_ic.svg') }}" alt="صورة المدرب"
                class="rounded-full w-16 h-16 object-cover" />
            <div class="text-right">
                <h3 class="text-lg font-bold">محمد سفيان الرياشي</h3>
                <p class="text-gray-600">مختص في دورات الجرافيكس</p>
            </div>
        </div>

        <!-- Instructor Card -->
        <div class="bg-white rounded-xl shadow hover:shadow-lg p-5 flex items-center space-x-4">
            <img src="{{ asset('/images/profile/user_ic.svg') }}" alt="صورة المدرب"
                class="rounded-full w-16 h-16 object-cover" />
            <div class="text-right">
                <h3 class="text-lg font-bold">مصطفى فهمي المقطري</h3>
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




        {{--  --}}
    </div>
</div>

<!-- الكورسات Tab Content -->
<div x-show="tab === 'courses'" class="container mx-auto px-6 py-8 hidden" x-transition>
    <p class="text-center text-gray-700">هنا سيتم عرض الكورسات الخاصة بالمعهد</p>
</div>

<!-- الأقسام Tab Content -->
<div x-show="tab === 'departments'" class="container mx-auto px-6 py-8 hidden" x-transition>
    <p class="text-center text-gray-700">هنا سيتم عرض أقسام المعهد</p>
</div>

<!-- الإعلانات Tab Content -->
<div x-show="tab === 'ads'" class="container mx-auto px-6 py-8 hidden" x-transition>
    <p class="text-center text-gray-700">هنا سيتم عرض إعلانات المعهد</p>
</div>

        {{--  --}}


    </div>



@endsection
