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

{{-- <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register</title>

  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="bg-gray-200 flex items-center justify-center min-h-screen px-4" dir="ltr">

  <div x-data="tabs()" x-init="init"
       class="bg-white px-[20px] py-[26px] rounded-2xl shadow-[0_5px_30px_rgba(0,0,0,0.2)]
              w-[380px] h-[auto] border border-gray-300">

    <!-- ✅ Logo -->
    <div class="flex justify-center mb-0 m-0 p-0">
      <img src="/images/home/light/logo_your.png" alt="Logo" class="w-[150px] h-[170px] object-contain">
    </div>

    <!-- ✅ Title -->
    <h2 class="text-2xl font-extrabold text-center text-black mb-4 font-serif">Register</h2>

    <!-- ✅ Tabs (Student right, Institute left) -->
    <div class="flex justify-between items-center mb-4 px-2">
      <button @click="setTab('institute')"
              :class="tab === 'institute' ? 'border-b-4 border-black text-black font-bold' : 'border-b-4 border-teal-500 text-teal-500 font-bold'"
              class="w-1/2 text-base py-1 text-center transition-all duration-300">
        Institute
      </button>
      <button @click="setTab('student')"
              :class="tab === 'student' ? 'border-b-4 border-black text-black font-bold' : 'border-b-4 border-teal-500 text-teal-500 font-bold'"
              class="w-1/2 text-base py-1 text-center transition-all duration-300">
        Student
      </button>
    </div>

    <!-- ✅ Form Container -->
    <div x-ref="container" class="relative overflow-hidden transition-all duration-300">

      <!-- ✅ Student Form -->
      <div x-ref="student" x-show="tab === 'student'" x-cloak x-transition class="absolute top-0 left-0 w-full">
        <form method="POST" action="{{ route('register') }}" class="space-y-3" autocomplete="off">
            @csrf
            <input type="hidden" name="role" value="student">

            <div>
                <label class="block text-sm font-semibold text-left mb-1">Student Name</label>
                <input type="text" name="name" value="{{ old('name') }}" autocomplete="off"
                       class="w-full rounded-full border border-teal-300 px-4 py-2 shadow focus:outline-none focus:ring-2 focus:ring-teal-400">
                @error('name')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-left mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" autocomplete="off"
                       class="w-full rounded-full border border-teal-300 px-4 py-2 shadow focus:outline-none focus:ring-2 focus:ring-teal-400">
                @error('email')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-left mb-1">Password</label>
                <input type="password" name="password" autocomplete="off"
                       class="w-full rounded-full border border-teal-300 px-4 py-2 shadow focus:outline-none focus:ring-2 focus:ring-teal-400">
                @error('password')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-left mb-1">Confirm Password</label>
                <input type="password" name="password_confirmation" autocomplete="off"
                       class="w-full rounded-full border border-teal-300 px-4 py-2 shadow focus:outline-none focus:ring-2 focus:ring-teal-400">
            </div>

            <div class="text-center">
                <button type="submit"
                        class="bg-teal-500 hover:bg-teal-600 text-white font-semibold py-2 px-8 rounded-full shadow text-base">
                    Register
                </button>
            </div>
        </form>

      </div>

      <!-- ✅ Institute Form -->
      <div x-ref="institute" x-show="tab === 'institute'" x-cloak x-transition class="absolute top-0 left-0 w-full">
        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-3" autocomplete="off">
            @csrf
            <input type="hidden" name="role" value="institute">

            <div>
                <label class="block text-sm font-semibold text-left mb-1">Institute Name</label>
                <input type="text" name="ins_name" value="{{ old('ins_name') }}" autocomplete="off"
                       class="w-full rounded-full border border-teal-300 px-4 py-2 shadow focus:outline-none focus:ring-2 focus:ring-teal-400">
                @error('ins_name')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-left mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" autocomplete="off"
                       class="w-full rounded-full border border-teal-300 px-4 py-2 shadow focus:outline-none focus:ring-2 focus:ring-teal-400">
                @error('email')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-left mb-1">Password</label>
                <input type="password" name="password" autocomplete="off"
                       class="w-full rounded-full border border-teal-300 px-4 py-2 shadow focus:outline-none focus:ring-2 focus:ring-teal-400">
                @error('password')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-left mb-1">Confirm Password</label>
                <input type="password" name="password_confirmation" autocomplete="off"
                       class="w-full rounded-full border border-teal-300 px-4 py-2 shadow focus:outline-none focus:ring-2 focus:ring-teal-400">
            </div>

            <div>
                <label class="block text-sm font-semibold text-left mb-1">Upload Institute Logo</label>
                <input type="file" name="ins_profile_photo" accept="image/*"
                       class="w-full px-4 py-2 border border-teal-300 rounded-full shadow bg-white focus:outline-none focus:ring-2 focus:ring-teal-400">
                @error('ins_profile_photo')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-left mb-1">Upload License Photo</label>
                <input type="file" name="ins_lic_photo" accept="image/*"
                       class="w-full px-4 py-2 border border-teal-300 rounded-full shadow bg-white focus:outline-none focus:ring-2 focus:ring-teal-400">
                @error('ins_lic_photo')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="text-center">
                <button type="submit"
                        class="bg-teal-500 hover:bg-teal-600 text-white font-semibold py-2 px-8 rounded-full shadow text-base">
                    Register
                </button>
            </div>
        </form>

      </div>
    </div>
  </div>

  <!-- ✅ Alpine Tabs Script -->
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

 --}}
 <!DOCTYPE html>
 <html lang="en">
 <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register - Your Institute</title>
   <script src="https://cdn.tailwindcss.com"></script>
   <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
   <style>
     @keyframes fadeSlideUp {
       0% { opacity: 0; transform: translateY(40px); }
       100% { opacity: 1; transform: translateY(0); }
     }
     .animate-fade-slide-up { animation: fadeSlideUp 0.8s ease-out forwards; }
   </style>
 </head>
 <body class="bg-gradient-to-br from-cyan-100 via-blue-100 to-teal-100 min-h-screen flex items-center justify-center px-4 py-8">
 <div x-data="tabs()" x-init="init" class="animate-fade-slide-up bg-white px-6 py-6 rounded-2xl shadow-xl border border-gray-300 w-full max-w-md">

   <div class="flex justify-between items-center mb-4">
     <a href="/" class="text-teal-600 hover:text-teal-800 text-sm flex items-center">
       <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5 mr-1">
         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
       </svg>
       Back to Home
     </a>
     <a href="{{ route('login') }}" class="text-sm text-teal-600 hover:text-teal-800">Already have an account? Log in</a>
   </div>

   <div class="flex justify-center mb-4">
     <img src="/images/home/light/logo_your.png" alt="Logo" class="w-[150px] h-[170px] object-contain">
   </div>

   <div class="flex items-center justify-center mb-6 gap-3">
     <hr class="flex-grow border-t-2 border-teal-700">
     <h2 class="text-2xl font-bold text-black font-serif">Register</h2>
     <hr class="flex-grow border-t-2 border-teal-500">
   </div>

   @if ($errors->any())
     <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
       <p class="font-semibold">Please fix the errors below and try again.</p>
     </div>
   @endif

   <div class="flex justify-between items-center mb-4 px-2">
     <button @click="setTab('institute')"
             :class="tab === 'institute' ? 'border-b-4 border-black text-black font-bold' : 'border-b-4 border-teal-500 text-teal-500 font-bold'"
             class="w-1/2 text-base py-1 text-center transition-all duration-300">Institute</button>
     <button @click="setTab('student')"
             :class="tab === 'student' ? 'border-b-4 border-black text-black font-bold' : 'border-b-4 border-teal-500 text-teal-500 font-bold'"
             class="w-1/2 text-base py-1 text-center transition-all duration-300">Student</button>
   </div>

   <div x-ref="container" class="relative transition-all duration-300">
     <!-- STUDENT FORM -->
     <div x-ref="student" x-show="tab === 'student'" x-cloak x-transition class="w-full">
       <form method="POST" action="{{ route('register') }}" class="space-y-4" autocomplete="off">
         @csrf
         <input type="hidden" name="role" value="student">
         <div>
           <label class="block text-sm font-semibold mb-1">Student Name</label>
           <input type="text" name="name" value="{{ old('name') }}" class="w-full rounded-full border border-teal-300 px-5 py-3 shadow focus:ring-2 focus:ring-teal-400">
           @error('name')<p class="text-sm text-red-500 mt-1">{{ $message }}</p>@enderror
         </div>
         <div>
           <label class="block text-sm font-semibold mb-1">Email</label>
           <input type="email" name="email" value="{{ old('email') }}" class="w-full rounded-full border border-teal-300 px-5 py-3 shadow focus:ring-2 focus:ring-teal-400">
           @error('email')<p class="text-sm text-red-500 mt-1">{{ $message }}</p>@enderror
         </div>
         <div>
           <label class="block text-sm font-semibold mb-1">Password</label>
           <input type="password" name="password" class="w-full rounded-full border border-teal-300 px-5 py-3 shadow focus:ring-2 focus:ring-teal-400">
           @error('password')<p class="text-sm text-red-500 mt-1">{{ $message }}</p>@enderror
         </div>
         <div>
           <label class="block text-sm font-semibold mb-1">Confirm Password</label>
           <input type="password" name="password_confirmation" class="w-full rounded-full border border-teal-300 px-5 py-3 shadow focus:ring-2 focus:ring-teal-400">
         </div>
         <div class="text-center">
           <button type="submit" class="bg-gradient-to-r from-teal-500 to-cyan-500 hover:from-cyan-600 hover:to-teal-600 text-white font-semibold py-2 px-10 rounded-full shadow-lg text-lg">Register</button>
         </div>
       </form>
     </div>

     <!-- INSTITUTE FORM -->
     <div x-ref="institute" x-show="tab === 'institute'" x-cloak x-transition class="w-full">
       <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-4" autocomplete="off">
         @csrf
         <input type="hidden" name="role" value="institute">
         <div>
           <label class="block text-sm font-semibold mb-1">Institute Name</label>
           <input type="text" name="ins_name" value="{{ old('ins_name') }}" class="w-full rounded-full border border-teal-300 px-5 py-3 shadow focus:ring-2 focus:ring-teal-400">
           @error('ins_name')<p class="text-sm text-red-500 mt-1">{{ $message }}</p>@enderror
         </div>
         <div>
           <label class="block text-sm font-semibold mb-1">Email</label>
           <input type="email" name="email" value="{{ old('email') }}" class="w-full rounded-full border border-teal-300 px-5 py-3 shadow focus:ring-2 focus:ring-teal-400">
           @error('email')<p class="text-sm text-red-500 mt-1">{{ $message }}</p>@enderror
         </div>
         <div>
           <label class="block text-sm font-semibold mb-1">Password</label>
           <input type="password" name="password" class="w-full rounded-full border border-teal-300 px-5 py-3 shadow focus:ring-2 focus:ring-teal-400">
           @error('password')<p class="text-sm text-red-500 mt-1">{{ $message }}</p>@enderror
         </div>
         <div>
           <label class="block text-sm font-semibold mb-1">Confirm Password</label>
           <input type="password" name="password_confirmation" class="w-full rounded-full border border-teal-300 px-5 py-3 shadow focus:ring-2 focus:ring-teal-400">
         </div>
         <div>
           <label class="block text-sm font-semibold mb-1">Upload Institute Logo</label>
           <input type="file" name="ins_profile_photo" class="w-full px-5 py-3 border border-teal-300 rounded-full shadow bg-white focus:ring-2 focus:ring-teal-400">
           @error('ins_profile_photo')<p class="text-sm text-red-500 mt-1">{{ $message }}</p>@enderror
         </div>
         <div>
           <label class="block text-sm font-semibold mb-1">Upload License Photo</label>
           <input type="file" name="ins_lic_photo" class="w-full px-5 py-3 border border-teal-300 rounded-full shadow bg-white focus:ring-2 focus:ring-teal-400">
           @error('ins_lic_photo')<p class="text-sm text-red-500 mt-1">{{ $message }}</p>@enderror
         </div>
         <div class="text-center">
           <button type="submit" class="bg-gradient-to-r from-teal-500 to-cyan-500 hover:from-cyan-600 hover:to-teal-600 text-white font-semibold py-2 px-10 rounded-full shadow-lg text-lg">Register</button>
         </div>
       </form>
     </div>
   </div>
 </div>

 <script>
   function tabs() {
     return {
       tab: 'student',
       init() { this.$nextTick(() => this.setHeight()) },
       setTab(tabName) {
         this.tab = tabName;
         this.$nextTick(() => this.setHeight());
       },
       setHeight() {
         const container = this.$refs.container;
         const content = this.$refs[this.tab];
         container.style.height = content.offsetHeight + 'px';
       }
     }
   }
 </script>
 </body>
 </html>
