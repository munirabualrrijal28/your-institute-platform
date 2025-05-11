@extends('user.layouts.layout')
@section('user_page_title')
User - Settings
@endsection
@section('user_layout')

<div class="min-h-screen bg-gray-100 py-10 px-6" x-data="{ tab: 'account', showConfirm: false, showPassword: false, password: '' }">
  <div class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100 py-10 px-4 sm:px-6 lg:px-8" x-data="{ tab: 'account', showConfirm: false, showPassword: false, password: '' }">
  <div class="max-w-5xl mx-auto space-y-10">
    <!-- Header -->
    <div class="bg-white p-6 rounded-2xl shadow-xl flex justify-between items-center animate-fade-in">
      <div class="text-right">
        <p class="text-gray-600">المتابعون</p>
        <h2 class="text-3xl font-extrabold text-teal-700">{{$following->count()}}</h2>
      </div>
      <div class="flex items-center gap-4">
        <button class="text-blue-600 hover:text-blue-800 transition-all duration-200">
          <i data-feather="edit-3" class="w-6 h-6"></i>
        </button>
        <div class="flex items-center gap-2">
          <h1 class="text-2xl font-bold text-gray-800">{{ $current_stu->user->name }}</h1>
        </div>
        <div class="relative group">
          <img src="/images/profile/user_ic.svg" alt="Institute" class="w-16 h-16 rounded-full object-cover border-2 border-teal-500 transition-transform duration-300 group-hover:scale-105">
          <label for="upload-photo" class="absolute -bottom-1 -right-1 bg-teal-600 text-white rounded-full p-1 cursor-pointer hover:bg-teal-700">
            <i data-feather="camera" class="w-4 h-4"></i>
            <input id="upload-photo" type="file" class="hidden">
          </label>
        </div>
      </div>
    </div>

    <!-- Tabs -->
    <div class="flex justify-center space-x-4 rtl:space-x-reverse">
      <button :class="tab === 'account' ? 'bg-teal-600 text-white shadow-lg' : 'text-teal-700 border border-teal-300'" class="px-5 py-2 rounded-full font-medium transition duration-300 hover:bg-teal-100" @click="tab = 'account'">خاص بالحساب</button>
      <button :class="tab === 'followers' ? 'bg-teal-600 text-white shadow-lg' : 'text-teal-700 border border-teal-300'" class="px-5 py-2 rounded-full font-medium transition duration-300 hover:bg-teal-100" @click="tab = 'followers'">المتابعون</button>
    </div>

    <!-- Account Tab -->
    <div x-show="tab === 'account'" class="space-y-6 animate-fade-in">
      @include('user.settings.parts.account')
      <div class="text-center pt-4">
        {{-- <button @click="showConfirm = true" class="bg-red-500 text-white px-6 py-2 rounded-xl font-semibold hover:bg-red-600 transition-all duration-300 shadow">Delete Account</button> --}}
      </div>
    </div>

    <!-- Followers Tab -->
    <div x-show="tab === 'followers'" class="space-y-6 animate-fade-in">
      @include('user.settings.parts.following')
    </div>
  </div>

  <!-- Confirmation Modal -->
  <div x-show="showConfirm" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-2xl shadow-2xl w-full max-w-sm animate-scale-in">
      <h3 class="text-xl font-bold text-red-600 mb-4">Are you sure?</h3>
      <p class="text-gray-700 mb-6">Do you really want to delete your account? This action cannot be undone.</p>
      <div class="flex justify-end gap-4">
        <button @click="showConfirm = false" class="bg-gray-200 px-4 py-2 rounded-xl hover:bg-gray-300">Cancel</button>
        <button @click="showConfirm = false; showPassword = true" class="bg-red-600 text-white px-4 py-2 rounded-xl hover:bg-red-700">Yes, Delete</button>
      </div>
    </div>
  </div>

  <!-- Password Modal -->
  <div x-show="showPassword" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-2xl shadow-2xl w-full max-w-sm animate-scale-in">
      <h3 class="text-xl font-bold text-red-600 mb-4">Enter Your Password</h3>
      <input type="password" x-model="password" class="w-full px-4 py-2 mb-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Password">
      <div class="flex justify-end gap-4">
        <button @click="showPassword = false" class="bg-gray-200 px-4 py-2 rounded-xl hover:bg-gray-300">Cancel</button>
        <button @click="if(password === '123456') { alert('Account deleted'); showPassword = false; } else { alert('Incorrect password'); }" class="bg-red-600 text-white px-4 py-2 rounded-xl hover:bg-red-700">Confirm Delete</button>
      </div>
    </div>
  </div>
</div>

<style>
  [x-cloak] { display: none; }
  .animate-fade-in { animation: fadeIn 0.4s ease-out both; }
  .animate-scale-in { animation: scaleIn 0.3s ease-in-out both; }
  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
  }
  @keyframes scaleIn {
    from { opacity: 0; transform: scale(0.95); }
    to { opacity: 1; transform: scale(1); }
  }
</style>

<script>
  feather.replace();
</script>

</div>




<script>
  feather.replace();
</script>

@endsection
