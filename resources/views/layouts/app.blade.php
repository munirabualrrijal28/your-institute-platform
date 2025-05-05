<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {{-- <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5"> --}}
    {{-- <meta name="author" content="AdminKit"> --}}
    <meta name="keywords"
        content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />

    {{-- <link rel="canonical" href="https://demo-basic.adminkit.io/pages-blank.html" /> --}}

    <title>@yield('user_page_title')</title>

    {{-- <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet"> --}}
    {{-- <link href="{{resources(path: 'resources/css/app.css')}}" rel="stylesheet"> --}}

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


    @vite(['resources/css/app.css', 'resources/js/app.js'])
<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

    <style>
        .body-pro {

            font-family: 'Cairo', sans-serif;
        }

        .profile-card {
            transition: all 0.3s ease-in-out;
        }

        .profile-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        }
    </style>
    <style>
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .scroll-drag {
            cursor: grab;
        }

        .scroll-drag:active {
            cursor: grabbing;
        }
    </style>

    <style>
        .slideshow-container {
            max-width: 100%;
            position: relative;
            margin: auto;
        }

        .mySlides {
            display: none;
        }

        .dot {
            height: 16px;
            width: 16px;
            margin: 0 4px;
            background-color: #ccc;
            border-radius: 9999px;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        .dot.active {
            background-color: #34d399;
            /* Tailwind's green-400 */
        }

        .prev,
        .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            padding: 0.5rem 1rem;
            /* px-4 py-2 */
            color: white;
            font-weight: bold;
            font-size: 1.25rem;
            /* text-xl */
            border-radius: 0.5rem;
            z-index: 10;
            user-select: none;
            transform: translateY(-50%);
        }

        .prev:hover,
        .next:hover {
            background-color: rgba(0, 0, 0, 0.6);
        }

        .prev {
            left: 0;
            border-radius: 0 0.5rem 0.5rem 0;
        }

        .next {
            right: 0;
            border-radius: 0.5rem 0 0 0.5rem;
        }

        @keyframes fade {
            from {
                opacity: 0.4
            }

            to {
                opacity: 1
            }
        }

        .fade {
            animation: fade 1.2s ease-in-out;
        }
    </style>



</head>

<body>
    <div class="wrapper">
        <div class="main">

            <!-- ✅ Navbar Section -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-4 ">
                <div class="container-fluid d-flex align-items-center justify-content-between flex-nowrap">

                    <!-- Left: Logo only -->
                    <div class="d-flex align-items-center flex-shrink-0">
                        <img src="/images/home/light/your_ins_logo.png" alt="Logo" class="img-fluid"
                            style="max-height: 170px;">
                    </div>

                    <!-- Center: Search bar -->
                    <div class="flex-grow-1 mx-4">
                        <form action="{{ route('user_search') }}" method="GET" class="mb-0">
                            <div class="input-group border border-teal-500 rounded-pill overflow-hidden"
                                style="height: 42px;">
                                <span class="input-group-text bg-white border-0 px-3">
                                    <i data-feather="search" class="text-muted"></i>
                                </span>
                                <input type="text" name="query" class="form-control border-0 py-1"
                                    placeholder="Search for Anything" style="height: 40px;">
                            </div>
                        </form>
                    </div>

                    <!-- Right: Auth Buttons -->
                    <div class="d-flex align-items-center gap-2 flex-shrink-0">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ route('admin') }}"
                                    class="btn btn-outline-dark rounded-pill px-4 py-1">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-dark rounded-pill px-4 py-1">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-dark rounded-pill px-4 py-1">Sign
                                        Up</a>
                                @endif
                            @endauth
                        @endif
                    </div>

                </div>
            </nav>


            <!-- ✅ Carousel Section -->
            {{-- <section class="relative overflow-hidden w-full max-w-5xl mx-auto rounded-xl shadow">
                <div id="carousel-track" class="flex transition-transform duration-700 ease-in-out w-[300%]">
                  <div class="w-full flex-shrink-0 relative">
                    <img src="/images/home/home.jpg" class="w-full h-60 object-cover" />
                    <div class="absolute bottom-0 left-0 w-full text-center bg-black bg-opacity-40 text-white py-2 text-sm">
                      تعلم وارتقِ بسهولة مع Your Institute
                    </div>
                  </div>
                  <div class="w-full flex-shrink-0 relative">
                    <img src="/images/home/home.jpg" class="w-full h-60 object-cover" />
                    <div class="absolute bottom-0 left-0 w-full text-center bg-black bg-opacity-40 text-white py-2 text-sm">
                      من أفضل المعاهد
                    </div>
                  </div>
                  <div class="w-full flex-shrink-0 relative">
                    <img src="/images/home/home.jpg" class="w-full h-60 object-cover" />
                    <div class="absolute bottom-0 left-0 w-full text-center bg-black bg-opacity-40 text-white py-2 text-sm">
                      احصل على شهادات معتمدة
                    </div>
                  </div>
                </div>

                <!-- Dots -->
                <div class="absolute bottom-2 left-1/2 -translate-x-1/2 flex gap-2">
                  <span class="dot bg-teal-500 w-3 h-3 rounded-full"></span>
                  <span class="dot bg-gray-300 w-3 h-3 rounded-full"></span>
                  <span class="dot bg-gray-300 w-3 h-3 rounded-full"></span>
                </div>
              </section> --}}
              <section class="w-full max-w-7xl mx-auto px-4 py-10">
                <div class="swiper mySwiper rounded-2xl overflow-hidden shadow-lg">
                    <div class="swiper-wrapper">

                        {{-- <!-- Slide 1 -->
                        <div class="swiper-slide">
                            <img src="{{ asset('images/home/home1.png') }}" alt="Slide 1" class="w-full h-80 object-cover" />
                            <div class="text-white text-center text-sm bg-black/40 py-2 -mt-12 z-10 relative">
                                تعلم وارتقِ بسهولة مع Your Institute
                            </div>
                        </div> --}}

                        <!-- Slide 2 -->
                        <div class="swiper-slide">
                            <img src="{{ asset('images/home/home2.jpg') }}" alt="Slide 2" class="w-full h-80 object-cover" />
                            {{-- <div class="text-white text-center text-sm bg-black/40 py-2 -mt-12 z-10 relative">
                                من أفضل المعاهد
                            </div> --}}
                        </div>

                        <!-- Slide 3 -->
                        <div class="swiper-slide">
                            <img src="{{ asset('images/home/home3.jpeg') }}" alt="Slide 3" class="w-full h-80 object-cover" />

                            {{-- <div class="text-white text-center text-sm bg-black/40 py-2 -mt-12 z-10 relative">
                                دورات معتمدة ومجانية
                            </div> --}}
                        </div>
                        <!-- Slide 4 -->
                        <div class="swiper-slide">
                            <img src="{{ asset('images/home/home4.png') }}" alt="Slide 3" class="w-full h-80 object-cover" />
                            <img src="{{ asset('images/home/home1.png') }}" alt="Slide 1" class="w-full h-80 object-cover" />

                            {{-- <div class="text-white text-center text-sm bg-black/40 py-2 -mt-12 z-10 relative">
                                دورات معتمدة ومجانية
                            </div> --}}
                        </div>

                    </div>

                    <!-- Dots -->
                    <div class="swiper-pagination"></div>

                    <!-- Navigation arrows -->
                    <div class="swiper-button-prev text-white"></div>
                    <div class="swiper-button-next text-white"></div>
                </div>
            </section>



            {{--  --}}


            <!-- ✅ Register Now Section -->

            <section class="relative w-full  max-w-7xl mx-auto my-15 px-18 flex justify-center">
            {{-- <section class="relative w-full max-w-7xl mx-auto px-4 py-10"> --}}
                <!-- Image with Overlay Container -->
                <div class="relative h-[400px] rounded-2xl overflow-hidden shadow-xl">

                    <!-- ✅ Floating Box -->
                    {{-- <div class="absolute top-1/2 left-10 transform -translate-y-1/2 bg-white bg-opacity-90 rounded-2xl shadow-lg px-8 py-6 max-w-sm w-full text-center"> --}}
                    <div
                        class="absolute align-self-start top-1/2 left-10 transform -translate-y-1/2 bg-white bg-opacity-90 rounded-2xl shadow-lg p-6 max-w-xs w-30 margin-float mt-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-2 text-center">Register Now</h2>
                        <h4 class="text-gray-600 font-bold text-lg">Choose Your Suitable Institute</h4>
                    </div>
                    <!-- ✅ Background Image -->
                    <img src="/images/home/home.jpg" alt="Register Background"
                        class="w-full h-full object-cover rounded-2xl">


                </div>
            </section>



            <!-- ✅ Intro Text -->
            <section class="bg-gray-50 text-center py-6">
                <h2 class="text-xl font-semibold text-gray-800">
                    With your institute's platform<br />
                    <span class="text-gray-600">we save you effort, money and time.</span>
                </h2>
            </section>


            <!-- ✅ Institute Logos Section -->
            <section class="bg-gray py-6 px-6 flex-nowrap">
                <!-- Button -->
                <div class="text-end mb-4 ">
                    <a href="#"
                        class="inline-block bg-green-600 text-white px-5 py-2 rounded shadow hover:bg-green-700 transition">Show
                        All Institutes</a>
                </div>

                <!-- Horizontal Scrollable Institute Logos -->
                <div
                    class="flex overflow-x-auto gap-6 items-center px-2 pb-2 scrollbar-thin scrollbar-thumb-green-300 scrollbar-track-transparent">
                    @php
                        $institutes = [
                            ['path' => 'images/inst_profile/jats/jats.png', 'name' => 'JATS'],
                            ['path' => 'images/inst_profile/lbm/lb.jpg', 'name' => 'LBM'],
                            ['path' => 'images/inst_profile/24/24_ins.jpg', 'name' => '24 Academy'],
                            ['path' => 'images/inst_profile/yali/yali.jpg', 'name' => 'Yali'],
                            ['path' => 'images/inst_profile/speak/speak.jpg', 'name' => 'SpeakNow'],
                            ['path' => 'images/inst_profile/jats/jats.png', 'name' => 'JATS'],
                            ['path' => 'images/inst_profile/lbm/lb.jpg', 'name' => 'LBM'],
                            ['path' => 'images/inst_profile/24/24_ins.jpg', 'name' => '24 Academy'],
                            ['path' => 'images/inst_profile/yali/yali.jpg', 'name' => 'Yali'],
                            ['path' => 'images/inst_profile/speak/speak.jpg', 'name' => 'SpeakNow'],
                            ['path' => 'images/inst_profile/jats/jats.png', 'name' => 'JATS'],
                            ['path' => 'images/inst_profile/lbm/lb.jpg', 'name' => 'LBM'],
                            ['path' => 'images/inst_profile/24/24_ins.jpg', 'name' => '24 Academy'],
                            ['path' => 'images/inst_profile/yali/yali.jpg', 'name' => 'Yali'],
                            ['path' => 'images/inst_profile/speak/speak.jpg', 'name' => 'SpeakNow'],
                        ];
                    @endphp

                    @foreach ($institutes as $institute)
                        <div class="flex-shrink-0 flex flex-col items-center">
                            <img src="{{ asset($institute['path']) }}"
                                class="h-20 w-20 rounded-full object-cover border-2 border-white shadow"
                                alt="{{ $institute['name'] }}">
                            <span class="text-sm mt-2 text-gray-700 font-medium">{{ $institute['name'] }}</span>
                        </div>
                    @endforeach
                </div>
            </section>



            <!-- ✅ Trending Section -->
            <section class="bg-gray-100 py-8 px-4">
                <h2 class="text-center text-xl font-bold mb-6">Trending Now</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white p-4 rounded-lg shadow">
                        <h3 class="text-teal-600 font-bold mb-2">Programming</h3>
                        <ul class="space-y-1 text-sm">
                            <li>Python - 2170 learners</li>
                            <li>Flutter - 2000 learners</li>
                            <li>C# - 1104 learners</li>
                        </ul>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow">
                        <h3 class="text-teal-600 font-bold mb-2">Design</h3>
                        <ul class="space-y-1 text-sm">
                            <li>Photoshop - 5400 learners</li>
                            <li>Illustrator - 6028 learners</li>
                            <li>InDesign - 1104 learners</li>
                        </ul>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow">
                        <h3 class="text-teal-600 font-bold mb-2">Computer</h3>
                        <ul class="space-y-1 text-sm">
                            <li>ICDL - 5400 learners</li>
                            <li>IC3 - 6028 learners</li>
                            <li>Typing - 1104 learners</li>
                        </ul>
                    </div>
                </div>
            </section>


            <!-- ✅ Testimonials Section -->
            <!-- ✅ Testimonials Horizontal Slider -->
            <!-- ✅ Testimonials Horizontal Slider -->



            <div class="flex overflow-x-auto gap-6 snap-x snap-mandatory scroll-smooth hide-scrollbar px-2 pb-4">
                <!-- البطاقة الأولى -->
                <div
                    class="min-w-[350px] max-w-sm bg-gradient-to-tr from-green-50 to-green-100 p-6 rounded-3xl shadow-md hover:shadow-xl transition-all duration-300 relative flex-shrink-0 snap-center group">
                    <!-- اقتباس كبير بالخلفية -->
                    <svg class="absolute top-4 right-4 w-12 h-12 text-green-200 opacity-20" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M7.17 6.17a4 4 0 015.66 0l.17.17.17-.17a4 4 0 015.66 5.66l-5.83 5.83a1 1 0 01-1.41 0l-5.83-5.83a4 4 0 010-5.66z" />
                    </svg>

                    <!-- معلومات الطالب -->
                    <div class="flex items-center gap-4 mb-4 z-10 relative">
                        <div
                            class="flex items-center justify-center w-16 h-16 rounded-full border-4 border-white shadow-md overflow-hidden">
                            <img src="/images/profile/user_ic.svg" alt="" class=" w-full h-full" />
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-lg">مصطفى المقطري</h4>
                            <p class="text-yellow-400 text-sm">★★★★★</p>
                        </div>
                    </div>

                    <!-- نص المراجعة -->
                    <p class="text-sm text-gray-700 leading-relaxed z-10 relative">
                        تجربة مذهلة! استفدت كثيرًا من الكورسات خصوصًا الإنجليزية، والنظام سهل ويضمن الجودة.
                    </p>
                </div>
                <!-- البطاقة الأولى -->
                <div
                    class="min-w-[350px] max-w-sm bg-gradient-to-tr from-green-50 to-green-100 p-6 rounded-3xl shadow-md hover:shadow-xl transition-all duration-300 relative flex-shrink-0 snap-center group">
                    <!-- اقتباس كبير بالخلفية -->
                    <svg class="absolute top-4 right-4 w-12 h-12 text-green-200 opacity-20" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M7.17 6.17a4 4 0 015.66 0l.17.17.17-.17a4 4 0 015.66 5.66l-5.83 5.83a1 1 0 01-1.41 0l-5.83-5.83a4 4 0 010-5.66z" />
                    </svg>

                    <!-- معلومات الطالب -->
                    <div class="flex items-center gap-4 mb-4 z-10 relative">
                        <div
                            class="flex items-center justify-center w-16 h-16 rounded-full border-4 border-white shadow-md overflow-hidden">
                            <img src="/images/profile/user_ic.svg" alt="Student"
                                class="object-cover w-full h-full" />
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-lg">محمد سفيان</h4>
                            <p class="text-yellow-400 text-sm">★★★★★</p>
                        </div>
                    </div>

                    <!-- نص المراجعة -->
                    <p class="text-sm text-gray-700 leading-relaxed z-10 relative">
                        تجربة مذهلة! استفدت كثيرًا من الكورسات خصوصًا الإنجليزية، والنظام سهل ويضمن الجودة.
                    </p>
                </div>
                <!-- البطاقة الأولى -->
                <div
                    class="min-w-[350px] max-w-sm bg-gradient-to-tr from-green-50 to-green-100 p-6 rounded-3xl shadow-md hover:shadow-xl transition-all duration-300 relative flex-shrink-0 snap-center group">
                    <!-- اقتباس كبير بالخلفية -->
                    <svg class="absolute top-4 right-4 w-12 h-12 text-green-200 opacity-20" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M7.17 6.17a4 4 0 015.66 0l.17.17.17-.17a4 4 0 015.66 5.66l-5.83 5.83a1 1 0 01-1.41 0l-5.83-5.83a4 4 0 010-5.66z" />
                    </svg>

                    <!-- معلومات الطالب -->
                    <div class="flex items-center gap-4 mb-4 z-10 relative">
                        <div
                            class="flex items-center justify-center w-16 h-16 rounded-full border-4 border-white shadow-md overflow-hidden">
                            <img src="/images/profile/user_ic.svg" alt="Student"
                                class="object-cover w-full h-full" />
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-lg">منير نعمان</h4>
                            <p class="text-yellow-400 text-sm">★★★★★</p>
                        </div>
                    </div>

                    <!-- نص المراجعة -->
                    <p class="text-sm text-gray-700 leading-relaxed z-10 relative">
                        تجربة مذهلة! استفدت كثيرًا من الكورسات خصوصًا الإنجليزية، والنظام سهل ويضمن الجودة.
                    </p>
                </div>
                <!-- البطاقة الأولى -->
                <div
                    class="min-w-[350px] max-w-sm bg-gradient-to-tr from-green-50 to-green-100 p-6 rounded-3xl shadow-md hover:shadow-xl transition-all duration-300 relative flex-shrink-0 snap-center group">
                    <!-- اقتباس كبير بالخلفية -->
                    <svg class="absolute top-4 right-4 w-12 h-12 text-green-200 opacity-20" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M7.17 6.17a4 4 0 015.66 0l.17.17.17-.17a4 4 0 015.66 5.66l-5.83 5.83a1 1 0 01-1.41 0l-5.83-5.83a4 4 0 010-5.66z" />
                    </svg>

                    <!-- معلومات الطالب -->
                    <div class="flex items-center gap-4 mb-4 z-10 relative">
                        <div
                            class="flex items-center justify-center w-16 h-16 rounded-full border-4 border-white shadow-md overflow-hidden">
                            <img src="/images/profile/user_ic.svg" alt="Student"
                                class="object-cover w-full h-full" />
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-lg">علي سنان</h4>
                            <p class="text-yellow-400 text-sm">★★★★★</p>
                        </div>
                    </div>

                    <!-- نص المراجعة -->
                    <p class="text-sm text-gray-700 leading-relaxed z-10 relative">
                        تجربة مذهلة! استفدت كثيرًا من الكورسات خصوصًا الإنجليزية، والنظام سهل ويضمن الجودة.
                    </p>
                </div>
                <!-- البطاقة الأولى -->
                <div
                    class="min-w-[350px] max-w-sm bg-gradient-to-tr from-green-50 to-green-100 p-6 rounded-3xl shadow-md hover:shadow-xl transition-all duration-300 relative flex-shrink-0 snap-center group">
                    <!-- اقتباس كبير بالخلفية -->
                    <svg class="absolute top-4 right-4 w-12 h-12 text-green-200 opacity-20" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M7.17 6.17a4 4 0 015.66 0l.17.17.17-.17a4 4 0 015.66 5.66l-5.83 5.83a1 1 0 01-1.41 0l-5.83-5.83a4 4 0 010-5.66z" />
                    </svg>

                    <!-- معلومات الطالب -->
                    <div class="flex items-center gap-4 mb-4 z-10 relative">
                        <div
                            class="flex items-center justify-center w-16 h-16 rounded-full border-4 border-white shadow-md overflow-hidden">
                            <img src="/images/profile/user_ic.svg" alt="Student"
                                class="object-cover w-full h-full" />
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-lg">المدير عبدالله الحاشدي</h4>
                            <p class="text-yellow-400 text-sm">★★★★★</p>
                        </div>
                    </div>

                    <!-- نص المراجعة -->
                    <p class="text-sm text-gray-700 leading-relaxed z-10 relative">
                        تجربة مذهلة! استفدت كثيرًا من الكورسات خصوصًا الإنجليزية، والنظام سهل ويضمن الجودة.
                    </p>
                </div>

                <!-- البطاقة الثالثة -->
            </div>




            {{--  --}}


            {{--  --}}
            <section class="bg-gray-50 py-10 px-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">

                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-teal-700 font-bold text-lg mb-2">About Us</h3>
                        <p class="text-sm text-gray-600">Your Institute is a modern platform that connects students to
                            certified educational institutes across the country.</p>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-teal-700 font-bold text-lg mb-2">Our Services</h3>
                        <ul class="text-sm text-gray-600 space-y-1">
                            <li>Course Advertisement</li>
                            <li>Student Registration</li>
                            <li>Notifications & Comments</li>
                            <li>Institute Ratings</li>
                        </ul>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-teal-700 font-bold text-lg mb-2">Contact</h3>
                        <p class="text-sm text-gray-600">Email: support@yourinstitute.com</p>
                        <p class="text-sm text-gray-600">Phone: +967 777 123 456</p>
                        <p class="text-sm text-gray-600">Sana'a, Yemen</p>
                    </div>

                </div>
            </section>
            {{--  --}}



            <!-- ✅ Footer -->
            <footer class="footer bg-light mt-5">
                <div class="container-fluid">
                    <div class="row text-muted py-3">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a class="text-muted" href="#"><strong>Your Institute</strong></a>
                            </p>
                        </div>
                        <div class="col-6 text-end">
                            <ul class="list-inline">
                                <li class="list-inline-item"><a class="text-muted" href="#">Support</a></li>
                                <li class="list-inline-item"><a class="text-muted" href="#">Help Center</a>
                                </li>
                                <li class="list-inline-item"><a class="text-muted" href="#">Privacy</a></li>
                                <li class="list-inline-item"><a class="text-muted" href="#">Terms</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>

        </div>
    </div>








    <script src="{{ asset('assets/js/app.js') }}"></script>

    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>



    <script>
        feather.replace();
    </script>
    {{--  --}}
    <script>
        function updateActiveDot(container) {
            const dots = document.querySelectorAll("#testimonialDots span");
            const cards = container.querySelectorAll("div.snap-center");
            let index = 0;
            let minDistance = Infinity;

            cards.forEach((card, i) => {
                const cardLeft = card.getBoundingClientRect().left;
                const containerLeft = container.getBoundingClientRect().left;
                const distance = Math.abs(cardLeft - containerLeft);

                if (distance < minDistance) {
                    minDistance = distance;
                    index = i;
                }
            });

            dots.forEach((dot, i) => {
                dot.classList.toggle("bg-green-400", i === index);
                dot.classList.toggle("bg-green-200", i !== index);
            });
        }
    </script>
    <!-- #region -->


    {{-- SlideShow Code --}}
    {{-- <script>
        const track = document.getElementById('carousel-track');
        const dots = document.querySelectorAll('.dot');
        let index = 0;
        const totalSlides = dots.length;

        function updateSlide() {
          track.style.transform = `translateX(-${index * 100}%)`;
          dots.forEach((dot, i) => {
            dot.classList.toggle('bg-teal-500', i === index);
            dot.classList.toggle('bg-gray-300', i !== index);
          });
        }

        setInterval(() => {
          index = (index + 1) % totalSlides;
          updateSlide();
        }, 5000);

        dots.forEach((dot, i) => {
          dot.addEventListener('click', () => {
            index = i;
            updateSlide();
          });
        });

        // Initial render
        updateSlide();
      </script> --}}
    {{--  --}}
    {{-- SlideShow Code 2 --}}
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
            speed: 800,
            effect: "slide",
        });
    </script>

    {{--  --}}
    <!-- Swiper JS -->

</body>

</html>

