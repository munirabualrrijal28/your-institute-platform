@php
    $user = auth()->user();
    $profilePhoto = $user->media()->where('type', 'profile_photo')->first();
    $photoUrl = $profilePhoto ? asset('storage/' . $profilePhoto->url) : asset('/images/profile/user_ic.svg');
@endphp
@extends('user.layouts.layout')

@section('user_page_title')
    User - Settings
@endsection

@section('user_layout')


    <div x-data="{
        {{-- activeTab: 'account', --}}
        showNameEdit: false,
            showPhotoUpload: false,
            showConfirmDelete: false,
            showPasswordDialog: false,
            showSuccess: false,
            enableReset: false,
            passwordInput: '',
            nameInput: '{{ $current_stu->user->name }}', // pre-fill input
    }" x-init="$watch('showSuccess', val => val && setTimeout(() => showSuccess = false, 3000))" class="space-y-10">


        <!-- Header -->
        <div class="bg-white p-6 rounded-2xl shadow-xl flex justify-between items-center animate-fade-in">
            <div class="text-right">
                <p class="text-gray-600">المتابعون</p>
                <h2 class="text-3xl font-extrabold text-teal-700">{{ $following->count() }}</h2>
            </div>
            <div class="flex items-center gap-4">
                <button class="text-blue-600 hover:text-blue-800 transition-all duration-200">
                    {{-- <i data-feather="edit-3" class="w-6 h-6"></i> --}}
                </button>
                <div class="flex items-center gap-2">
                    <h1 class="text-2xl font-bold text-gray-800">{{ $current_stu->user->name }}</h1>
                </div>


                <div class="relative group">
                    <img src="{{ $photoUrl }}" alt="Profile Photo"
                        class="w-16 h-16 rounded-full object-cover border-2 border-teal-500 transition-transform duration-300 group-hover:scale-105">
                </div>


            </div>

        </div>

        {{--  --}}


        {{--  --}}
        <!-- Tabs -->
        <div x-data="{ activeTab: 'account' }" class="space-y-10">

            <!-- Tab Buttons -->
            <div class="flex justify-center gap-4">
                <button @click="activeTab = 'account'"
                    :class="activeTab === 'account' ? 'bg-teal-600 text-white shadow-lg' :
                        'text-teal-700 border border-teal-300'"
                    class="px-5 py-2 rounded-full font-medium transition duration-300 hover:bg-teal-100">
                    خاص بالحساب
                </button>

                <button @click="activeTab = 'following'"
                    :class="activeTab === 'following' ? 'bg-teal-600 text-white shadow-lg' :
                        'text-teal-700 border border-teal-300'"
                    class="px-5 py-2 rounded-full font-medium transition duration-300 hover:bg-teal-100">
                    المتابعون
                </button>
            </div>

            <!-- Tab Content -->
            <div>
                <template x-if="activeTab === 'account'">
                    <div class="space-y-6 animate-fade-in">
                        @include('user.settings.parts.account', ['current_stu' => $current_stu])
                    </div>
                </template>

                <template x-if="activeTab === 'following'">
                    <div class="space-y-6 animate-fade-in">

                        {{-- <livewire:user.settings.following-tab :student-id="$current_stu->id" /> --}}


                        @include('user.settings.parts.following', [
                            'current_stu' => $current_stu,
                            'following' => $following,
                        ])


                    </div>
                </template>



            </div>
        </div>

        <!-- END TAB WRAPPER -->

        {{-- Temporarily show both --}}
        {{-- Just for testing --}}

        {{-- @include('user.settings.parts.account', ['current_stu' => $current_stu])
@include('user.settings.parts.following', ['current_stu' => $current_stu, 'following' => $following]) --}}

        {{--  --}}
        {{--  --}}
        {{--  --}}
        {{--  --}}


        <!-- Confirmation Modal -->
        <div x-show="showConfirmDelete" x-cloak
            class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-2xl shadow-2xl w-full max-w-sm animate-scale-in">
                <h3 class="text-xl font-bold text-red-600 mb-4">Are you sure?</h3>
                <p class="text-gray-700 mb-6">Do you really want to delete your account? This action
                    cannot be undone.</p>
                <div class="flex justify-end gap-4">
                    <button @click="showConfirmDelete = false"
                        class="bg-gray-200 px-4 py-2 rounded-xl hover:bg-gray-300">Cancel</button>
                    <button @click="showConfirmDelete = false; showPasswordDialog = true"
                        class="bg-red-600 text-white px-4 py-2 rounded-xl hover:bg-red-700">Yes,
                        Delete</button>
                </div>
            </div>
        </div>

        <!-- Password Confirmation Modal -->
        <div x-show="showPasswordDialog" x-cloak
            class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-2xl shadow-2xl w-full max-w-sm animate-scale-in">
                <h3 class="text-xl font-bold text-red-600 mb-4">Enter Your Password</h3>
                <input type="password" x-model="passwordInput"
                    class="w-full px-4 py-2 mb-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500"
                    placeholder="Password">
                <div class="flex justify-end gap-4">
                    <button @click="showPasswordDialog = false"
                        class="bg-gray-200 px-4 py-2 rounded-xl hover:bg-gray-300">Cancel</button>
                    <button @click="$wire.passwordInput = passwordInput; $wire.deleteAccount();"
                        class="bg-red-600 text-white px-4 py-2 rounded-xl hover:bg-red-700">Confirm
                        Delete</button>
                </div>
            </div>
        </div>

        <!-- Success Modal -->
        <div x-show="showSuccess" x-cloak
            class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-2xl shadow-2xl w-full max-w-sm animate-scale-in text-center">
                <h3 class="text-xl font-bold text-green-600 mb-4">Action Successful</h3>
                <p class="text-gray-700 mb-6">Your changes have been applied successfully.</p>
                <button @click="showSuccess = false"
                    class="bg-teal-600 text-white px-6 py-2 rounded-xl hover:bg-teal-700">Close</button>
            </div>
        </div>


        @if ($errors->any())
            <script>
                window.dispatchEvent(new CustomEvent('showError'));
            </script>
        @endif

        {{-- @livewire('user.settings.account-tab', ['userId' => auth()->id()], key('account-settings-tab')) --}}

        <!-- Success Dialog -->
        <div x-data="{ showSuccess: false }" @showSuccess.window="showSuccess = true">
            <div x-show="showSuccess" x-cloak class="dialog">
                <div class="dialog-card text-center">
                    <h3 class="dialog-title text-green-600">Success</h3>
                    <p class="text-gray-600">Your changes were saved successfully.</p>
                    <button @click="showSuccess = false" class="btn-primary mt-4">OK</button>
                </div>
            </div>
        </div>



    </div>

    {{--  --}}

    <style>
        .animate-fade-in {
            animation: fadeIn 0.3s ease-out both;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    {{--  --}}
    <style>
        .dialog {
            @apply fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50;
        }

        .dialog-card {
            @apply bg-white p-6 rounded-xl shadow-xl w-full max-w-sm;
        }

        .dialog-title {
            @apply text-xl font-bold mb-4;
        }
    </style>



    <style>
        [x-cloak] {
            display: none;
        }

        .animate-fade-in {
            animation: fadeIn 0.4s ease-out both;
        }

        .animate-scale-in {
            animation: scaleIn 0.3s ease-in-out both;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>



    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('activeTab', 'account')
        });

        feather.replace(); // Replaces icons on tab switch
    </script>
    <script>
        window.addEventListener('unfollowed', () => {
            location.reload();
        });
    </script>
    {{-- <script>
        feather.replace();
    </script> --}}
@endsection
