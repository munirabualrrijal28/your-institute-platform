{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4">

    <div class="bg-white rounded-2xl shadow-lg shadow-teal-200 max-w-md w-full px-8 py-1">

        <!-- ✅ Logo -->
        <div class="flex justify-center mb-2  " style="height: 166px;">
            <img src="{{ asset('images/home/light/logo_your.png') }}" alt="Logo"
                class="h-50 max-h-2 w-auto object-contain">
        </div>

        <!-- ✅ Title -->
        <h2 class="text-center text-2xl font-bold text-gray-800 mb-2">Forgot your password?</h2>

        <!-- ✅ Description -->
        <p class="text-sm text-gray-600 text-center mb-6 leading-relaxed px-4">
            No problem. Just let us know your email address and we’ll send you a password reset link.
        </p>

        <!-- ✅ Success message -->
        @if (session('status'))
            <div class="mb-4 text-green-600 text-sm text-center font-semibold">
                {{ session('status') }}
            </div>
        @endif

        <!-- ✅ Form -->
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Input -->
            <div class="mb-5 px-6 ">
                <label for="email" class="block text-sm font-semibold mb-1 ">Email</label>
                <input id="email" type="email" name="email" required
                    class="w-full rounded-full border-2 border-teal-300 px-4 py-3 shadow-sm focus:ring-2 focus:ring-teal-400 focus:border-teal-400 outline-none transition"
                    value="{{ old('email') }}" autofocus>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="text-center mt-6 mb-6">
                <button type="submit"
                    class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-2 px-6 rounded-full shadow-md hover:shadow-lg transition-all">
                    Send Reset Link
                </button>
            </div>
        </form>

    </div>

</body>

</html>
