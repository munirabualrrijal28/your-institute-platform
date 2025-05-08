{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
 --}}
{{-- <head>
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
      .login-title hr {
        height: 2px;
        background-color: #0FAD94;
        border: none;
        flex: 1;
      }

      .login-input {
        border: 2px solid #b2dfdb;
        box-shadow: 0 2px 5px rgba(175, 238, 227, 0.3);
      }

      .login-button {
        background-color: #0FAD94;
        font-family: Georgia, 'Times New Roman', serif;
      }

      .login-button:hover {
        background-color: #0b8d78;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
      }
    </style>
  </head>

  <div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
    <div class="bg-white rounded-2xl shadow-lg max-w-md w-full px-10 py-8">

      <!-- Logo -->
      <div class="flex flex-col items-center mb-4">
        <img src="{{ asset('images/home/light/your_ins_logo.png') }}" alt="Logo" class="h-16 mb-1">
      </div>

      <!-- Title with lines -->
      <div class="flex items-center justify-center mb-6 login-title gap-3">
        <hr>
        <h2 class="text-2xl font-bold text-black font-serif">Log in</h2>
        <hr>
      </div>

      <!-- Form -->
      <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="mb-5">
          <label for="email" class="block text-sm font-semibold mb-1">Email</label>
          <input id="email" type="email" name="email" required autofocus
            class="w-full rounded-full login-input px-5 py-3 focus:outline-none focus:ring-2 focus:ring-teal-400 transition">
        </div>

        <!-- Password -->
        <div class="mb-5">
          <label for="password" class="block text-sm font-semibold mb-1">Password</label>
          <input id="password" type="password" name="password" required
            class="w-full rounded-full login-input px-5 py-3 focus:outline-none focus:ring-2 focus:ring-teal-400 transition">
        </div>

        <!-- Remember Me -->
        <div class="mb-6 flex items-center">
          <input type="checkbox" name="remember" id="remember" class="mr-2">
          <label for="remember" class="text-sm font-medium">Remember me</label>
        </div>

        <!-- Login Button -->
        <div class="text-center mb-4">
          <button type="submit"
            class="login-button text-white text-lg font-bold py-2 px-10 rounded-full transition">
            Log in
          </button>
        </div>

        <!-- Forgot Password -->
        @if (Route::has('password.request'))
          <div class="text-center">
            <a href="{{ route('password.request') }}"
              class="text-blue-600 hover:underline text-sm">Forgot your password?</a>
          </div>
        @endif
      </form>
    </div>
  </div> --}}
{{--


  <head>
    {{-- <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet"> --}}
<!-- Tailwind CDN -->
{{-- <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head> --}}

{{-- <div class="min-h-screen flex items-center justify-center bg-gray-200 px-4 py-8"> --}}

<!-- ✅ Login Card -->
{{-- <div class="bg-white px-6 py-6 rounded-2xl shadow-xl border border-gray-300 w-[380px] sm:w-[420px] md:w-[460px]"> --}}

<!-- ✅ Logo (Custom Height & Width) -->
{{-- <div class="flex justify-center mb-2">
            <img src="{{ asset('images/home/light/your_ins_logo.png') }}"
            alt="Logo"
            class="h-[200px] w-auto max-w-full">
        </div> --}}

<!-- ✅ Title with Borders -->
{{-- <div class="flex items-center justify-center mb-6 gap-3">
            <hr class="flex-grow border-t-2 border-teal-700">
            <h2 class="text-2xl font-bold text-black font-serif">Log In</h2>
            <hr class="flex-grow border-t-2 border-teal-500">
        </div> --}}

<!-- ✅ Login Form -->
{{-- <form method="POST" action="{{ route('login') }}" class="space-y-5" dir="ltr">
            @csrf --}}

<!-- Email -->
{{-- <div>
                <label for="email" class="block text-sm font-semibold mb-1 text-left">Email</label>
                <input id="email" type="email" name="email" autocomplete="off" required autofocus
                    class="w-full rounded-full border border-teal-300 px-5 py-3 shadow-md focus:outline-none focus:ring-2 focus:ring-teal-400 text-left">
            </div> --}}

<!-- Password -->
{{-- <div>
                <label for="password" class="block text-sm font-semibold mb-1 text-left">Password</label>
                <input id="password" type="password" name="password" autocomplete="off" required
                    class="w-full rounded-full border border-teal-300 px-5 py-3 shadow-md focus:outline-none focus:ring-2 focus:ring-teal-400 text-left">
            </div> --}}

<!-- Remember Me -->
{{-- <div class="flex items-center mb-2">
                <input type="checkbox" name="remember" id="remember" class="mr-2">
                <label for="remember" class="text-sm font-medium">Remember me</label>
            </div> --}}

<!-- Submit Button -->
{{-- <div class="text-center">
                <button type="submit"
                        class="bg-teal-500 hover:bg-teal-600 text-white font-semibold py-2 px-10 rounded-full shadow-lg text-lg">
                    Log In
                </button>
            </div> --}}

<!-- Forgot Password -->
{{-- @if (Route::has('password.request'))
                <div class="text-center mt-2">
                    <a class="text-sm text-blue-600 hover:underline text-left" href="{{ route('password.request') }}">
                        Forgot your password ?
                    </a>
                </div>
            @endif
        </form>
    </div>
</div> --}}

{{-- End of previous login page --}}



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Your Institute</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @keyframes fadeSlideUp {
            0% {
                opacity: 0;
                transform: translateY(40px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-slide-up {
            animation: fadeSlideUp 0.8s ease-out forwards;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-cyan-100 via-blue-100 to-teal-100 min-h-screen flex items-center justify-center px-4 py-8">
    <div class="animate-fade-slide-up bg-white px-6 py-6 rounded-2xl shadow-xl border border-gray-300 w-full max-w-md">
        <!-- Logo -->
        <div class="flex justify-center mb-4">
            <img src="{{ asset('images/home/light/your_ins_logo.png') }}" alt="Logo" class="h-[200px] w-auto">
        </div>

        <!-- Title -->
        <div class="flex items-center justify-center mb-6 gap-3">
            <hr class="flex-grow border-t-2 border-teal-700">
            <h2 class="text-2xl font-bold text-black font-serif">Log In</h2>
            <hr class="flex-grow border-t-2 border-teal-500">
        </div>

        <!-- Error Messages -->
        @if(session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->has('email') || $errors->has('password'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <p class="font-semibold">Incorrect email or password. Please check and try again.</p>
    </div>
@endif

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" class="space-y-5" dir="ltr">
            @csrf

            <!-- Email -->
            <div class="relative">
                <label for="email" class="block text-sm font-semibold mb-1 text-left">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                       class="peer w-full rounded-full border border-teal-300 px-5 py-3 shadow-md focus:outline-none focus:ring-2 focus:ring-teal-400">
            </div>

            <!-- Password -->
<!-- Password -->
<div class="relative" x-data="{ show: false }">
    <label for="password" class="block text-sm font-semibold mb-1 text-left">Password</label>
    <input :type="show ? 'text' : 'password'" id="password" name="password" value="{{ old('password') }}" required
           autocomplete="current-password"
           class="peer w-full rounded-full border border-teal-300 px-5 py-3 pr-12 shadow-md focus:outline-none focus:ring-2 focus:ring-teal-400">

    <!-- 👁️ Eye Icon Fully Centered -->
    <div class="absolute right-4 top-4 bottom-0 flex items-center">
        <button type="button" @click="show = !show" class="text-gray-400 hover:text-teal-600">
            <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943
                      9.542 7-1.274 4.057-5.065 7-9.542 7-4.477
                      0-8.268-2.943-9.542-7z" />
            </svg>
            <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7
                      a10.05 10.05 0 012.013-3.368M15 12a3 3 0
                      00-3-3m0 0a3 3 0 00-3 3m6 0a3 3 0 01-3 3m0
                      0a3 3 0 01-3-3m0 0a3 3 0 013-3" />
            </svg>
        </button>
    </div>
</div>


            <!-- Remember Me -->
            <div class="flex items-center">
                <input type="checkbox" name="remember" id="remember" class="mr-2" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember" class="text-sm font-medium">Remember me</label>
            </div>

            <!-- Submit -->
            <div class="text-center">
                <button type="submit"
                        class="bg-gradient-to-r from-teal-500 to-cyan-500 hover:from-cyan-600 hover:to-teal-600 text-white font-semibold py-2 px-10 rounded-full shadow-lg text-lg transition-all duration-300">
                    Log In
                </button>
            </div>

            <!-- Forgot Password -->
            @if (Route::has('password.request'))
                <div class="text-center mt-2">
                    <a class="text-sm text-blue-600 hover:underline" href="{{ route('password.request') }}">
                        Forgot your password?
                    </a>
                </div>
            @endif
        </form>
    </div>
</body>

</html>
