
{{--
@php
    $currentTab = request('tab', 'instructors'); // default to 'instructors'
@endphp
<div>




<!-- Tabs Navigation -->
<div class="bg-teal-600 text-white px-6 py-2 flex flex-wrap gap-3 justify-center">
    <a href="{{ route('institute_profile', ['tab' => 'instructors']) }}"
       class="px-4 py-2 rounded-full font-semibold shadow transition-all duration-200
              {{ $currentTab === 'instructors' ? 'bg-white text-teal-600' : 'hover:bg-teal-700' }}">
        الكادر
    </a>
    <a href="{{ route('institute_profile', ['tab' => 'courses']) }}"
   class="px-4 py-2 rounded-full font-semibold shadow transition-all duration-200
          {{ $currentTab === 'courses' ? 'bg-white text-teal-600' : 'hover:bg-teal-700' }}">
    الكورسات
</a>

    <a href="{{ route('institute_profile', ['tab' => 'categories']) }}"
       class="px-4 py-2 rounded-full font-semibold shadow transition-all duration-200
              {{ $currentTab === 'categories' ? 'bg-white text-teal-600' : 'hover:bg-teal-700' }}">
        الأقسام
    </a>
    <a href="{{ route('institute_profile', ['tab' => 'ads']) }}"
       class="px-4 py-2 rounded-full font-semibold shadow transition-all duration-200
              {{ $currentTab === 'ads' ? 'bg-white text-teal-600' : 'hover:bg-teal-700' }}">
        الإعلانات
    </a>
</div>

<!-- Content Section -->
<div class="container mx-auto px-6 py-8">
    @if ($currentTab === 'instructors')
        @include('profile_parts.institute_tabs.instructor.instructors')
        {{-- @include('profile_parts.institute_tabs.instructors-tab') --}}
    {{-- @elseif ($currentTab === 'courses')

        @include('profile_parts.institute_tabs.course.courses') --}}
        {{-- @include('profile_parts.institute_tabs.courses-tab') --}}
    {{-- @elseif ($currentTab === 'categories')
            @include('profile_parts.institute_tabs.category.categories') --}}

        {{-- @include('profile_parts.institute_tabs.categories-tab') --}}
    {{-- @elseif ($currentTab === 'ads')
            @include('profile_parts.institute_tabs.advertisement.ads') --}}

        {{-- @include('profile_parts.institute_tabs.ads-tab') --}}
    {{-- @endif
</div> --}}



