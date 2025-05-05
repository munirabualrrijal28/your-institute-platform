{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register</title>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>


    @vite(['resources/css/app.css', 'resources/js/app.js'])

  {{-- <style>

    [x-cloak] { display: none !important; }
    .smooth-height { transition: height 0.3s ease; }
    .active-tab {
      border-bottom-width: 3px;
      border-color: black;
      color: black;
      font-weight: 800;
    }
    .inactive-tab {
      border-bottom-width: 3px;
      border-color: #14b8a6; /* teal-600 */
      color: #14b8a6;
      font-weight: 800;
    }
    .custom-shadow {
      box-shadow: 0px 3px 6px rgba(0,0,0,0.16);
    }
  </style> --}}
</head>
{{-- w-[500px] h-[1000px] --}}
<body class="bg-gray-200 flex items-center justify-center min-h-screen px-4">
    <div x-data="tabs()" x-init="init"
         class="w-[540px] bg-white px-6 py-6 rounded-2xl shadow-[0_4px_16px_rgba(0,0,0,0.15)]
                max-w-[420px] md:max-w-[460px] border border-gray-300">

      <!-- ✅ Logo -->
      <div class="flex justify-center mb-3">
        <img src="/images/home/light/logo_your.png" alt="Logo" class="h-14 w-auto">
      </div>

      <!-- ✅ Title -->
      <h2 class="text-2xl font-bold text-center text-black mb-5">Register</h2>

      <!-- ✅ Tabs -->
      <div class="flex justify-between items-center mb-5">
        <button @click="setTab('institute')"
                :class="tab === 'institute' ? 'border-b-2 border-black text-black font-semibold' : 'border-b-2 border-teal-500 text-teal-500 font-semibold'"
                class="w-1/2 text-sm py-1 text-center transition-all duration-300">
          Institute
        </button>
        <button @click="setTab('student')"
                :class="tab === 'student' ? 'border-b-2 border-black text-black font-semibold' : 'border-b-2 border-teal-500 text-teal-500 font-semibold'"
                class="w-1/2 text-sm py-1 text-center transition-all duration-300">
          Student
        </button>
      </div>

      <!-- ✅ Form Container -->
      <div x-ref="container" class="relative overflow-hidden transition-all duration-300">

        <!-- ✅ Student Form -->
        <div x-ref="student" x-show="tab === 'student'" x-cloak x-transition class="absolute top-0 left-0 w-full">
          <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="role" value="student">

            <div>
              <label class="block text-sm text-gray-700 mb-1 text-left">Student Name</label>
              <input type="text" name="name" autocomplete="off"
                     class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm shadow-sm
                     focus:outline-none focus:ring-2 focus:ring-teal-400">
            </div>

            <div>
              <label class="block text-sm text-gray-700 mb-1 text-left">Email</label>
              <input type="email" name="email" autocomplete="off"
                     class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm shadow-sm
                     focus:outline-none focus:ring-2 focus:ring-teal-400">
            </div>

            <div>
              <label class="block text-sm text-gray-700 mb-1 text-left">Password</label>
              <input type="password" name="password" autocomplete="off"
                     class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm shadow-sm
                     focus:outline-none focus:ring-2 focus:ring-teal-400">
            </div>

            <div>
              <label class="block text-sm text-gray-700 mb-1 text-left">Confirm Password</label>
              <input type="password" name="password_confirmation" autocomplete="off"
                     class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm shadow-sm
                     focus:outline-none focus:ring-2 focus:ring-teal-400">
            </div>

            <div class="text-center mt-1">
              <button type="submit"
                      class="bg-teal-500 hover:bg-teal-600 text-white font-medium py-2 px-6 rounded-md text-sm
                      shadow-md transition duration-200">
                Register
              </button>
            </div>
          </form>
        </div>

        <!-- ✅ Institute Form -->
        <div x-ref="institute" x-show="tab === 'institute'" x-cloak x-transition class="absolute top-0 left-0 w-full">
          <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <input type="hidden" name="role" value="institute">

            <div>
              <label class="block text-sm text-gray-700 mb-1 text-left">Institute Name</label>
              <input type="text" name="ins_name" autocomplete="off"
                     class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm shadow-sm
                     focus:outline-none focus:ring-2 focus:ring-teal-400">
            </div>

            <div>
              <label class="block text-sm text-gray-700 mb-1 text-left">Email</label>
              <input type="email" name="email" autocomplete="off"
                     class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm shadow-sm
                     focus:outline-none focus:ring-2 focus:ring-teal-400">
            </div>

            <div>
              <label class="block text-sm text-gray-700 mb-1 text-left">Password</label>
              <input type="password" name="password" autocomplete="off"
                     class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm shadow-sm
                     focus:outline-none focus:ring-2 focus:ring-teal-400">
            </div>

            <div>
              <label class="block text-sm text-gray-700 mb-1 text-left">Confirm Password</label>
              <input type="password" name="password_confirmation" autocomplete="off"
                     class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm shadow-sm
                     focus:outline-none focus:ring-2 focus:ring-teal-400">
            </div>

            <div>
              <label class="block text-sm text-gray-700 mb-1 text-left">Upload License Photo</label>
              <input type="file" name="ins_lic_photo" accept="image/*"
                     class="w-full border border-gray-300 rounded-md px-3 py-2 bg-white text-sm
                     shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-400">
            </div>

            <div class="text-center mt-1">
              <button type="submit"
                      class="bg-teal-500 hover:bg-teal-600 text-white font-medium py-2 px-6 rounded-md text-sm
                      shadow-md transition duration-200">
                Register
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script>
      function tabs() {
        return {
          tab: 'student',
          init() {
            this.$nextTick(() => this.setHeight());
          },
          setTab(tabName) {
            this.tab = tabName;
            this.$nextTick(() => this.setHeight());
          },
          setHeight() {
            const container = this.$refs.container;
            const content = this.$refs[this.tab];
            container.style.height = content.offsetHeight + 'px';
          }
        };
      }
    </script>
  </body>


</html>
