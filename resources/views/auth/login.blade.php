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



  <head>
    {{-- <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet"> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<div class="min-h-screen flex items-center justify-center bg-gray-100 px-4 mb-4 p-10 px-10">
    <div class="bg-white rounded-2xl shadow-[0_4px_20px_rgba(0,0,0,0.12)] max-w-md w-full px-10 py-2 border border-teal-100">

        {{-- <div class="w-[200px] h-[500px] bg-red-300 text-white text-center">
            Tailwind Arbitrary Width Test
        </div> --}}
        <!-- Logo -->
        <div class="flex flex-col items-center mb-0 px-10">
            <img src="{{ asset('images/home/light/your_ins_logo.png') }}" alt="Logo" class="h-22  px-1">
        </div>

        <!-- Login Title with Lines -->
        <div class="flex items-center justify-center mb-4 gap-3">
            <hr class="flex-grow border-t-2 border-teal-800">
            <h2 class="text-2xl font-bold text-black font-serif">Log in</h2>
            <hr class="flex-grow border-t-2 border-teal-500">
        </div>

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-5">
                <label for="email" class="block text-sm font-semibold mb-1">Email</label>
                <input id="email" type="email" name="email" required autofocus
                    class="w-full rounded-full border-2 border-teal-200 px-5 py-3 shadow-sm focus:ring-teal-300 focus:border-teal-400 focus:outline-none transition">
            </div>

            <!-- Password -->
            <div class="mb-5">
                <label for="password" class="block text-sm font-semibold mb-1">Password</label>
                <input id="password" type="password" name="password" required
                    class="w-full rounded-full border-2 border-teal-200 px-5 py-3 shadow-sm focus:ring-teal-300 focus:border-teal-400 focus:outline-none transition">
            </div>

            <!-- Remember Me -->
            <div class="mb-4 flex items-center">
                <input type="checkbox" name="remember" id="remember" class="mr-2">
                <label for="remember" class="text-sm font-medium">Remember me</label>
            </div>

            <!-- Submit Button -->
            <div class="text-center mb-4">
                <button type="submit"
                    class="bg-teal-600 hover:bg-teal-700 text-white text-lg font-bold font-serif py-2 px-10 rounded-full transition-shadow shadow-md hover:shadow-xl">
                    Log in
                </button>
            </div>

            <!-- Forgot Password -->
            @if (Route::has('password.request'))
                <div class="text-center">
                    <a class="text-blue-600 hover:underline text-sm" href="{{ route('password.request') }}">
                        Forgot your password?
                    </a>
                </div>
            @endif
        </form>
    </div>
</div>
