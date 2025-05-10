@extends('institute.layouts.layout')
@section('institute_page_title')
  Institute Settings
@endsection
@section('institute_sidebar_name')
Institute Name
@endsection
@section('institute_layout')

<div class="min-h-screen bg-gray-100 py-10 px-6" x-data="{ tab: 'account' }">
  <div class="max-w-5xl mx-auto space-y-10">
    <!-- Header -->
    <div class="bg-white p-6 rounded-2xl shadow-md flex justify-between items-center">
      <div class="text-right">
        <p class="text-gray-600">المتابعون</p>
        <h2 class="text-2xl font-bold">3</h2>
      </div>
      <div class="flex items-center gap-4">
        <div class="relative">
          <img src="/images/institute-placeholder.png" alt="Institute" class="w-16 h-16 rounded-full object-cover border-2 border-gray-300">
          <label for="upload-photo" class="absolute -bottom-1 -right-1 bg-teal-600 text-white rounded-full p-1 cursor-pointer hover:bg-teal-700">
            <i data-feather="camera" class="w-4 h-4"></i>
            <input id="upload-photo" type="file" class="hidden">
          </label>
        </div>
        <button class="text-blue-600 hover:text-blue-800 transition duration-300">
          <i data-feather="edit-3" class="w-6 h-6"></i>
        </button>
        <span class="font-semibold text-lg">User Name</span>
        <i data-feather="user" class="w-8 h-8 text-gray-700"></i>
      </div>
    </div>

    <!-- Tabs -->
    <div class="flex justify-center space-x-4 rtl:space-x-reverse">
      <button :class="tab === 'account' ? 'bg-teal-600 text-white' : 'text-teal-700'" class="px-5 py-2 rounded-full font-medium shadow hover:bg-teal-100 transition" @click="tab = 'account'">خاص بالحساب</button>
      <button :class="tab === 'followers' ? 'bg-teal-600 text-white' : 'text-teal-700'" class="px-5 py-2 rounded-full font-medium shadow hover:bg-teal-100 transition" @click="tab = 'followers'">المتابعون</button>
    </div>

    <!-- Account Tab -->
    <div x-show="tab === 'account'" class="space-y-6">
      @include('institute.settings.parts.account')
    </div>

    <!-- Followers Tab -->
    <div x-show="tab === 'followers'" class="space-y-6">
      @include('institute.settings.parts.followers')
    </div>
  </div>
</div>

<script>
  feather.replace();
</script>
@endsection
