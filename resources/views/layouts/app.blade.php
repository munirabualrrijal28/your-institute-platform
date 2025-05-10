<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('user_page_title')</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <style>
    .hide-scrollbar {
      scrollbar-width: none;
      -ms-overflow-style: none;
    }
    .hide-scrollbar::-webkit-scrollbar {
      display: none;
    }
    .animated-heading {
      animation: bounce 2s infinite;
    }
    @keyframes bounce {
      0%, 100% {
        transform: translateY(0);
      }
      50% {
        transform: translateY(-8px);
      }
    }
  </style>

</head>

<body class="bg-gray-50 text-gray-800 font-sans">
  <!-- Welcome Header -->
  <header class="bg-gradient-to-r from-teal-600 to-emerald-500 py-6 shadow-lg text-white text-center">
    <h1 class="text-3xl font-extrabold animated-heading">Welcome to Your-Institute Platform</h1>
    <p class="text-base mt-1 animate-fadeIn">Empowering education through verified institutions</p>
  </header>

  <!-- Navbar -->
  <nav class="bg-white shadow sticky top-0 z-50 px-6 py-4 flex items-center justify-between">
    <div class="space-x-2">
        @if (Route::has('login'))
          @auth
            <a href="{{ route('dashboard') }}"
              class="px-4 py-2 bg-emerald-600 text-white rounded-full hover:bg-emerald-700 transition">Dashboard</a>
          @else
            <a href="{{ route('login') }}"
              class="px-4 py-2 bg-gray-800 text-white rounded-full hover:bg-gray-700 transition">Login</a>
            @if (Route::has('register'))
              <a href="{{ route('register') }}"
                class="px-4 py-2 bg-teal-500 text-white rounded-full hover:bg-teal-600 transition">Register</a>
            @endif
          @endauth
        @endif
      </div>

    <form action="{{ route('user_search') }}" method="GET" class="flex-1 mx-6">
      <input type="text" name="query" placeholder="Search courses or institutes..."
        class="w-full px-4 py-2 rounded-full border-2 border-teal-500 focus:outline-none">
    </form>
    <img src="/images/home/light/your_ins_logo.png" alt="Logo" class="h-[110px]">


  </nav>

  <!-- Hero Carousel -->
  <section class="max-w-7xl mx-auto mt-10">
    <div class="swiper mySwiper rounded-2xl overflow-hidden shadow-xl">
      <div class="swiper-wrapper">
        @foreach (["home2.jpg", "home3.jpeg", "home4.png", "home1.png"] as $img)
        <div class="swiper-slide">
          <img src="{{ asset('images/home/' . $img) }}" class="w-full h-[28rem] object-cover" alt="Slide">
        </div>
        @endforeach
      </div>
      <div class="swiper-pagination"></div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>
    </div>
  </section>

{{--  --}}
   <!-- ✅ Register Now Section -->

   <section class="relative top-16 w-full  max-w-7xl mx-auto my-15 px-18 flex justify-center">
    {{-- <section class="relative w-full max-w-7xl mx-auto px-4 py-10"> --}}
        <!-- Image with Overlay Container -->
        <div class="relative h-[400px] rounded-2xl overflow-hidden shadow-xl">

            <!-- ✅ Floating Box -->
            {{-- <div class="absolute top-1/2 left-10 transform -translate-y-1/2 bg-white bg-opacity-90 rounded-2xl shadow-lg px-8 py-6 max-w-sm w-full text-center"> --}}
            <div
                class="absolute  align-self-start top-1/2 left-10 transform -translate-y-1/2 bg-white bg-opacity-90 rounded-2xl shadow-lg p-6 max-w-xs w-30 margin-float mt-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-2 text-center">Register Now</h2>
                <h4 class="text-gray-600 font-bold text-lg">Choose Your Suitable Institute</h4>
            </div>
            <!-- ✅ Background Image -->
            <img src="/images/home/home.jpg" alt="Register Background"
                class="w-full h-full object-cover rounded-2xl">


        </div>
    </section>

{{--  --}}

  <!-- Smart Matching Services CTA -->
  <section class="bg-gradient-to-br from-green-100 to-teal-100 py-14 mt-12">
    <div class="max-w-4xl mx-auto text-center px-6">
      <h2 class="text-2xl md:text-3xl font-bold text-teal-800 mb-4 animate__animated animate__fadeInUp">Discover the Right Course Instantly</h2>
      <p class="text-gray-600 text-lg mb-6">Let us help match you with the best educational opportunity available near you.</p>
      <a href="{{ route('register') }}"
        class="bg-teal-500 hover:bg-teal-600 transition text-white font-semibold px-8 py-3 rounded-full shadow-md">Join Now</a>
    </div>
  </section>

  <!-- Institutes Scrollable Row -->
  <section class="bg-white py-12">
    <div class="max-w-7xl mx-auto px-4">
      <h2 class="text-center text-2xl font-bold mb-6">Top Institutes</h2>
      <div class="flex overflow-x-auto gap-6 hide-scrollbar py-4">
        @foreach ($institutes as $institute)
        <a href="{{ route('login', ['id' => $institute['id']]) }}" target="_blank"
          class="flex-shrink-0 w-48 bg-white shadow rounded-xl p-4 hover:scale-105 transition">
          <img src="{{ asset($institute['ins_profile_photo']) }}" class="w-20 h-20 mx-auto rounded-full object-cover mb-3">
          <p class="text-center text-sm font-semibold text-gray-800">{{ $institute['ins_name'] }}</p>
        </a>
        @endforeach
      </div>
    </div>
  </section>


  {{--  --}}


<!-- Trending Courses Section -->
<section class="bg-gray-100 py-16">
    <div class="max-w-7xl mx-auto px-4">
      <h2 class="text-2xl font-bold text-center mb-10 text-gray-800">Trending Courses</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        <div class="bg-white rounded-xl p-6 shadow hover:shadow-lg transition transform hover:-translate-y-1">
          <h3 class="text-lg font-semibold text-teal-600 mb-2">Programming</h3>
          <ul class="text-sm text-gray-600 space-y-1">
            <li>Python - 2170 learners</li>
            <li>Flutter - 2000 learners</li>
            <li>C# - 1104 learners</li>
          </ul>
        </div>
        <div class="bg-white rounded-xl p-6 shadow hover:shadow-lg transition transform hover:-translate-y-1">
          <h3 class="text-lg font-semibold text-teal-600 mb-2">Design</h3>
          <ul class="text-sm text-gray-600 space-y-1">
            <li>Photoshop - 5400 learners</li>
            <li>Illustrator - 6028 learners</li>
            <li>InDesign - 1104 learners</li>
          </ul>
        </div>
        <div class="bg-white rounded-xl p-6 shadow hover:shadow-lg transition transform hover:-translate-y-1">
          <h3 class="text-lg font-semibold text-teal-600 mb-2">Computer</h3>
          <ul class="text-sm text-gray-600 space-y-1">
            <li>ICDL - 5400 learners</li>
            <li>IC3 - 6028 learners</li>
            <li>Typing - 1104 learners</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- Testimonials Section -->
  <section class="bg-white py-16">
    <div class="max-w-6xl mx-auto px-4">
      <h2 class="text-2xl font-bold text-center text-gray-800 mb-10">Student Testimonials</h2>
      <div class="grid md:grid-cols-3 gap-6">
        @foreach ([1, 2, 3] as $i)
        <div class="bg-gray-50 p-6 rounded-xl shadow-md hover:shadow-xl transition duration-300">
          <p class="text-gray-700 italic mb-4">“This platform changed my learning experience completely.”</p>
          <div class="flex items-center gap-3">
            <img src="/images/profile/user_ic.svg" class="w-10 h-10 rounded-full object-cover">
            <div>
              <h4 class="text-sm font-semibold text-gray-900">Student {{ $i }}</h4>
              <span class="text-xs text-teal-500">Enrolled Learner</span>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- About / Services / Contact Info -->
  <section class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-8">
      <div class="bg-white p-6 rounded-lg shadow text-center">
        <h3 class="text-teal-700 font-bold text-lg mb-3">About Us</h3>
        <p class="text-sm text-gray-600">Your Institute is a trusted digital platform that connects learners with certified educational institutes across the country.</p>
      </div>
      <div class="bg-white p-6 rounded-lg shadow text-center">
        <h3 class="text-teal-700 font-bold text-lg mb-3">Our Services</h3>
        <ul class="text-sm text-gray-600 space-y-1">
          <li>Course Advertisement</li>
          <li>Student Registration</li>
          <li>Notifications & Comments</li>
          <li>Institute Ratings</li>
        </ul>
      </div>
      <div class="bg-white p-6 rounded-lg shadow text-center">
        <h3 class="text-teal-700 font-bold text-lg mb-3">Contact</h3>
        <p class="text-sm text-gray-600">Email: support@yourinstitute.com</p>
        <p class="text-sm text-gray-600">Phone: +967 777 123 456</p>
        <p class="text-sm text-gray-600">Sana'a, Yemen</p>
      </div>
    </div>
  </section>
  {{--  --}}




  {{-- <!-- Floating Help Button -->
  <div class="fixed bottom-6 right-6 z-50">
    <a href="#" class="bg-teal-600 hover:bg-teal-700 text-white px-5 py-3 rounded-full shadow-lg flex items-center gap-2">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 14v.01M12 10h.01M16 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
      Help Center
    </a>
  </div> --}}

  {{--  --}}

  <!-- Footer -->
  <footer class="bg-white py-6 mt-10 border-t border-gray-200">
    <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row justify-between items-center text-sm text-gray-500">
      <p>&copy; {{ date('Y') }} Your Institute. All rights reserved.</p>
      <div class="space-x-4 mt-3 md:mt-0">
        <a href="#" class="hover:text-teal-600">Support</a>
        <a href="#" class="hover:text-teal-600">Privacy</a>
        <a href="#" class="hover:text-teal-600">Terms</a>
      </div>
    </div>
  </footer>


  {{--  --}}
  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
  <script>
    const swiper = new Swiper(".mySwiper", {
      loop: true,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });
  </script>
  <script>
    document.addEventListener("DOMContentLoaded", () => feather.replace());
  </script>



</body>

</html>


