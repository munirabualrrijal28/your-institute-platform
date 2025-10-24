@extends('institute.layouts.layout')
@section('institute_page_title')
    Institute Settings
@endsection
@section('institute_sidebar_name')
    Institute Name
@endsection
@section('institute_layout')
    {{--  --}}
    {{--  --}}
    {{--  --}}






    {{--  --}}
    {{--  --}}
    {{--  --}}

    <div x-data="{
        {{-- activeTab: 'account', --}}
        showNameEdit: false,
            showPhotoUpload: false,
            showConfirmDelete: false,
            showPasswordDialog: false,
            showSuccess: false,
            enableReset: false,
            passwordInput: '',
            nameInput: '{{ $institute->user->name }}', // pre-fill input}" x-init="$watch('showSuccess', val => val && setTimeout(() => showSuccess = false, 3000))" class="min-h-screen bg-gray-100 py-10 px-6">

        <div class="max-w-5xl mx-auto space-y-10">


            <!-- Header -->
            <div class="bg-white p-6 rounded-2xl shadow-xl flex justify-between items-center animate-fade-in">
                <div class="text-right">
                    <p class="text-gray-600">المتابعون</p>
                    <h2 class="text-3xl font-extrabold text-teal-700">{{ $followers_count }}</h2>
                </div>
                <div class="flex items-center gap-4">
                    <button class="text-blue-600 hover:text-blue-800 transition-all duration-200">
                        {{-- <i data-feather="edit-3" class="w-6 h-6"></i> --}}
                    </button>
                    <div class="flex items-center gap-2">
                        <h1 class="text-2xl font-bold text-gray-800">{{ $institute->user->name }}</h1>
                    </div>


                    <div class="relative group">
                        <img src="{{ $institute->ins_profile_photo ? asset('storage/' . $institute->ins_profile_photo) : asset('/images/profile/user_ic.svg') }}"
                            alt="{{ $institute->ins_name }} Logo"
                            class="w-[150px] h-[140px] object-over bg-white shadow-md rounded-xl overflow-hidden flex items-center justify-center border border-gray-200" />
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

                    <button @click="activeTab = 'followers'"
                        :class="activeTab === 'followers' ? 'bg-teal-600 text-white shadow-lg' :
                            'text-teal-700 border border-teal-300'"
                        class="px-5 py-2 rounded-full font-medium transition duration-300 hover:bg-teal-100">
                        المتابعون
                    </button>
                </div>

                {{--  --}}
                {{--  --}}
                {{-- @php
                    dd($institute->is_restricted, $institute->ins_lic_photo_approved);
                @endphp --}}
                @if ($institute->is_restricted && !$institute->ins_lic_photo_approved)
                    <div class="bg-white rounded-xl shadow p-6">
                        <h2 class="text-xl font-bold text-red-600 mb-4">Your License Photo Was Rejected</h2>
                        <p class="text-sm text-gray-600 mb-4">
                            Please upload a new valid license photo. Your account remains restricted until it's approved.
                        </p>

                        <form method="POST" action="{{ route('institute_resubmitLicense') }}" enctype="multipart/form-data"
                            id="resubmitForm">
                            @csrf

                            <input type="file" name="ins_lic_photo" accept="image/*"
                                class="block w-full border border-gray-300 p-2 rounded" required
                                onchange="handleUpload(event)" />

                            @error('ins_lic_photo')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror

                            <!-- Preview container -->
                            <div id="previewContainer" class="mt-4 hidden">
                                <p class="text-sm text-gray-500 mb-2">Preview:</p>
                                <img id="previewImage" src="#" alt="Image Preview"
                                    class="w-64 max-w-full border border-gray-300 rounded shadow" />
                            </div>

                            <button type="submit" id="submitBtn"
                                class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded shadow mt-3 w-full disabled:opacity-50 disabled:cursor-not-allowed">
                                Resubmit Photo
                            </button>
                        </form>

                        {{--  --}}

    <!-- License Viewer & Rejection -->
                    @if ($institute->ins_lic_photo)
                        <div x-data="{ open: false, reject: false }" class="space-y-4">
                            <!-- View License Button -->
                            <button @click="open = true"
                                class="text-sm text-blue-600 underline hover:text-blue-800 transition">
                                View License Document
                            </button>

                            <!-- Modal Preview -->
                            <div x-show="open"
                                class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60">
                                <div class="bg-white rounded-lg shadow-xl p-6 relative max-w-xl w-full animate-fade-in">
                                    <button @click="open = false"
                                        class="absolute top-3 right-3 text-gray-400 hover:text-red-600">
                                        <i data-feather="x" class="w-5 h-5"></i>
                                    </button>
                                    <h4 class="text-lg font-semibold mb-4">Uploaded License</h4>
                                    <img src="{{ asset('storage/' . $institute->ins_lic_photo) }}"
                                        class="w-full h-auto rounded-lg shadow border">
                                </div>
                            </div>


                        </div>
                    @endif

                        {{--  --}}
                    </div>

                    <script>
                        function handleUpload(event) {
                            const input = event.target;
                            const file = input.files[0];
                            const button = document.getElementById('submitBtn');
                            const previewContainer = document.getElementById('previewContainer');
                            const previewImage = document.getElementById('previewImage');

                            if (file) {
                                const reader = new FileReader();

                                reader.onload = function(e) {
                                    previewImage.src = e.target.result;
                                    previewContainer.classList.remove('hidden');
                                };

                                reader.readAsDataURL(file);

                                // Disable button temporarily
                                button.disabled = true;
                                button.innerText = 'Uploading...';

                                setTimeout(() => {
                                    button.disabled = false;
                                    button.innerText = 'Resubmit Photo';
                                }, 2000); // You can adjust this if needed
                            }
                        }
                    </script>

                @endif




                <!-- Tab Content -->
                <div>
                    <template x-if="activeTab === 'account'">
                        <div class="space-y-6 animate-fade-in">
                            @include('institute.settings.parts.account')
                        </div>
                    </template>

                    <template x-if="activeTab === 'followers'">
                        <div class="space-y-6 animate-fade-in">

                            {{-- <livewire:user.settings.following-tab :student-id="$current_stu->id" /> --}}


                            @include('institute.settings.parts.followers')


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


    {{--  --}}
    {{--  --}}
    {{--  --}}
@endsection
