<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
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

    {{-- <style>
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
    </style> --}}

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
    <style>
        .hide-scrollbar {
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
    </style>


</head>

<body>

    {{--  --}}
    <div class="bg-teal-600   h-20 d-flex align-items-center text-center justify-center ">
        <h3 class="text-white font-bold">
            Welcome in Your-Institute Platform
        </h3>
    </div>



    {{--  --}}
    <div class="wrapper">
        <div class="main ">

            <!-- ✅ Navbar Section -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-4 ">
                <div class="container-fluid d-flex align-items-center justify-content-between flex-nowrap h-20">


                           {{--  --}}
                    <!-- Right: Auth Buttons -->
                    <div class="d-flex align-items-center gap-2 flex-shrink-0">
                        @if (Route::has('login'))
                            @auth
                                {{-- <a href="{{ route('admin') }}"
                        class="btn btn-outline-dark rounded-pill px-4 py-1">Dashboard</a> --}}
                            @else
                                <a href="{{ route('login') }}" class="btn btn-dark rounded-pill px-4 py-1">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-dark rounded-pill px-4 py-1">
                                        Register
                                    </a>
                                @endif
                            @endauth
                        @endif
                    </div>


                    <!-- Center: Search bar -->
                    <div class="flex-grow-1 px-20  ">
                        <form action="{{ route('user_search') }}" method="GET">
                            <div class="input-group border border-teal-500 rounded-pill overflow-hidden"
                                style="height: 42px;">

                                <input type="text" name="query" class="form-control border-0 py-1 text-start"
                                    placeholder="Search for Anything" style="height: 40px;">
                                <button id="submit" class="input-group-text bg-white border-0 px-3">
                                    <i data-feather="search" class="text-muted"></i>
                                </button>


                            </div>

                        </form>
                    </div>



    <!-- Left: Logo only -->
    <div class="d-flex align-items-center flex-shrink-0">
        <img src="/images/home/light/your_ins_logo.png" alt="Logo" class="relative left-0 img-fluid"
            style="max-height: 150px;">
    </div>

                </div>
            </nav>


            <!-- ✅ Responsive Carousel Section -->
            <section class="w-full max-w-7xl mx-auto px-4 py-10">
                <div class="swiper mySwiper rounded-2xl overflow-hidden shadow-lg">
                    <div class="swiper-wrapper">

                        <!-- Slide 1 -->
                        <div class="swiper-slide">
                            <img src="{{ asset('images/home/home2.jpg') }}" alt="Slide 1"
                                class="w-full h-64 sm:h-72 md:h-80 lg:h-[26rem] xl:h-[30rem] object-cover" />
                        </div>

                        <!-- Slide 2 -->
                        <div class="swiper-slide">
                            <img src="{{ asset('images/home/home3.jpeg') }}" alt="Slide 2"
                                class="w-full h-64 sm:h-72 md:h-80 lg:h-[26rem] xl:h-[30rem] object-cover" />
                        </div>

                        <!-- Slide 3 -->
                        <div class="swiper-slide">
                            <img src="{{ asset('images/home/home4.png') }}" alt="Slide 3"
                                class="w-full h-64 sm:h-72 md:h-80 lg:h-[26rem] xl:h-[30rem] object-cover" />
                        </div>

                        <!-- Slide 4 -->
                        <div class="swiper-slide">
                            <img src="{{ asset('images/home/home1.png') }}" alt="Slide 4"
                                class="w-full h-64 sm:h-72 md:h-80 lg:h-[26rem] xl:h-[30rem] object-cover" />
                        </div>
                        <!-- Slide 5 -->
                        <div class="swiper-slide">
                            <img src="{{ asset('images/home/moh.jpg') }}" alt="Slide 4"
                                class="w-full h-60 sm:h-72 md:h-80 lg:h-[26rem] xl:h-[30rem] object-contain" />
                        </div>
                        <!-- Slide 6 -->
                        <div class="swiper-slide">
                            <img src="{{ asset('images/home/moh2.jpg') }}" alt="Slide 4"
                                class="w-full h-64 sm:h-72 md:h-80 lg:h-[26rem] xl:h-[30rem] object-cover" />
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
            <!-- ✅ Institutes Section -->
            <section class="bg-gray-200 py-8 px-2">
                <!-- ✅ Centered "Show All Courses" Button -->
                <div class="text-center mb-6">
                    <a href="{{ route('user.ins_profile') }}" target="_blank"
                        class="inline-block bg-teal-500 text-white font-semibold px-6 py-2 rounded-full shadow hover:bg-teal-600 transition">
                        Show All Institutes
                    </a>
                </div>



                <!-- ✅ Horizontal Scrollable Institute Logos -->
                <div class="flex overflow-x-auto gap-6 scrollbar-hide px-8 py-8 bg-gray-100">
                    {{-- <div class="flex overflow-x-auto gap-6 items-center px-2 pb-2 scrollbar-hide"> --}}
                    @foreach ($institutes as $institute)
                        <a href="{{ route('user.ins_profile', ['id' => $institute['id']]) }}" target="_blank"
                            class="flex-shrink-0 flex flex-col items-center bg-white rounded-xl shadow-md p-4 transition hover:shadow-lg hover:bg-teal-700 ">
                            <img src="{{ asset($institute['ins_profile_photo']) }}"
                                class="h-20 w-20 rounded-full object-cover border-2 border-white mb-2"
                                alt="{{ $institute['ins_name'] }}">
                            <span class="text-sm text-gray-700 font-medium">{{ $institute['ins_name'] }}</span>
                        </a>
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


            <!-- Outer Container -->
            <div class="bg-gradient-to-br from-gray-200 to-gray-100 py-20 px-8">
                <!-- Slider Container -->
                <div id="reviewSlider"
                    class="flex overflow-x-auto gap-8 snap-x snap-mandatory scroll-smooth hide-scrollbar">
                    <!-- Review Card 1 -->
                    <div
                        class="min-w-[320px] max-w-sm bg-white rounded-3xl p-6 shadow-lg relative flex-shrink-0 snap-center transform hover:scale-[1.03] transition-all duration-500 group">
                        <!-- Decorative Bubble -->
                        <div
                            class="absolute -top-4 -left-4 w-16 h-16 bg-teal-100 rounded-full opacity-30 group-hover:opacity-50 transition duration-500">
                        </div>

                        <!-- Top Quote Marks -->
                        <div class="flex justify-between items-center text-gray-300 text-2xl font-serif mb-4">
                            <span>❝</span>
                            <span>❞</span>
                        </div>

                        <!-- Review Text -->
                        <p class="text-center text-gray-700 italic leading-relaxed mb-6">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Error, accusamus eveniet.
                        </p>

                        <!-- Rating Stars -->
                        <div class="flex justify-center mb-6 text-blue-500 text-xl">
                            ★★★★☆
                        </div>

                        <!-- User Info -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <img src="/images/profile/user_ic.svg" alt="Avatar"
                                    class="w-12 h-12 rounded-full object-cover border-2 border-white shadow-md" />
                                <div>
                                    <h4 class="font-bold text-gray-800 text-base">Jessica Partices</h4>
                                    <p class="text-blue-500 text-sm">Creative Designer</p>
                                </div>
                            </div>
                            <div class="text-gray-400 text-xl">⋮</div>
                        </div>
                    </div>

                    <!-- ✅ Duplicate for more cards -->
                    <!-- Review Card 2 -->
                    <div
                        class="min-w-[320px] max-w-sm bg-white rounded-3xl p-6 shadow-lg relative flex-shrink-0 snap-center transform hover:scale-[1.03] transition-all duration-500 group">
                        <!-- Decorative Bubble -->
                        <div
                            class="absolute -top-4 -left-4 w-16 h-16 bg-teal-100 rounded-full opacity-30 group-hover:opacity-50 transition duration-500">
                        </div>

                        <!-- Top Quote Marks -->
                        <div class="flex justify-between items-center text-gray-300 text-2xl font-serif mb-4">
                            <span>❝</span>
                            <span>❞</span>
                        </div>

                        <!-- Review Text -->
                        <p class="text-center text-gray-700 italic leading-relaxed mb-6">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Error, accusamus eveniet.
                        </p>

                        <!-- Rating Stars -->
                        <div class="flex justify-center mb-6 text-blue-500 text-xl">
                            ★★★★☆
                        </div>

                        <!-- User Info -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <img src="/images/profile/user_ic.svg" alt="Avatar"
                                    class="w-12 h-12 rounded-full object-cover border-2 border-white shadow-md" />
                                <div>
                                    <h4 class="font-bold text-gray-800 text-base">Jessica Partices</h4>
                                    <p class="text-blue-500 text-sm">Creative Designer</p>
                                </div>
                            </div>
                            <div class="text-gray-400 text-xl">⋮</div>
                        </div>
                    </div>

                    <!-- ✅ Duplicate for more cards -->
                    <!-- Review Card 3 -->
                    <div
                        class="min-w-[320px] max-w-sm bg-white rounded-3xl p-6 shadow-lg relative flex-shrink-0 snap-center transform hover:scale-[1.03] transition-all duration-500 group">
                        <!-- Decorative Bubble -->
                        <div
                            class="absolute -top-4 -left-4 w-16 h-16 bg-teal-100 rounded-full opacity-30 group-hover:opacity-50 transition duration-500">
                        </div>

                        <!-- Top Quote Marks -->
                        <div class="flex justify-between items-center text-gray-300 text-2xl font-serif mb-4">
                            <span>❝</span>
                            <span>❞</span>
                        </div>

                        <!-- Review Text -->
                        <p class="text-center text-gray-700 italic leading-relaxed mb-6">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Error, accusamus eveniet.
                        </p>

                        <!-- Rating Stars -->
                        <div class="flex justify-center mb-6 text-blue-500 text-xl">
                            ★★★★☆
                        </div>

                        <!-- User Info -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <img src="/images/profile/user_ic.svg" alt="Avatar"
                                    class="w-12 h-12 rounded-full object-cover border-2 border-white shadow-md" />
                                <div>
                                    <h4 class="font-bold text-gray-800 text-base">Jessica Partices</h4>
                                    <p class="text-blue-500 text-sm">Creative Designer</p>
                                </div>
                            </div>
                            <div class="text-gray-400 text-xl">⋮</div>
                        </div>
                    </div>

                    <!-- ✅ Duplicate for more cards -->
                    <!-- Review Card 4 -->
                    <div
                        class="min-w-[320px] max-w-sm bg-white rounded-3xl p-6 shadow-lg relative flex-shrink-0 snap-center transform hover:scale-[1.03] transition-all duration-500 group">
                        <!-- Decorative Bubble -->
                        <div
                            class="absolute -top-4 -left-4 w-16 h-16 bg-teal-100 rounded-full opacity-30 group-hover:opacity-50 transition duration-500">
                        </div>

                        <!-- Top Quote Marks -->
                        <div class="flex justify-between items-center text-gray-300 text-2xl font-serif mb-4">
                            <span>❝</span>
                            <span>❞</span>
                        </div>

                        <!-- Review Text -->
                        <p class="text-center text-gray-700 italic leading-relaxed mb-6">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Error, accusamus eveniet.
                        </p>

                        <!-- Rating Stars -->
                        <div class="flex justify-center mb-6 text-blue-500 text-xl">
                            ★★★★☆
                        </div>

                        <!-- User Info -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <img src="/images/profile/user_ic.svg" alt="Avatar"
                                    class="w-12 h-12 rounded-full object-cover border-2 border-white shadow-md" />
                                <div>
                                    <h4 class="font-bold text-gray-800 text-base">Jessica Partices</h4>
                                    <p class="text-blue-500 text-sm">Creative Designer</p>
                                </div>
                            </div>
                            <div class="text-gray-400 text-xl">⋮</div>
                        </div>
                    </div>

                </div>

                <!-- Navigation Dots -->
                <div class="flex justify-center mt-6 gap-2">
                    <button onclick="scrollToCard(0)"
                        class="w-3 h-3 rounded-full bg-gray-400 hover:bg-blue-500"></button>
                    <button onclick="scrollToCard(1)"
                        class="w-3 h-3 rounded-full bg-gray-400 hover:bg-blue-500"></button>
                    <button onclick="scrollToCard(2)"
                        class="w-3 h-3 rounded-full bg-gray-400 hover:bg-blue-500"></button>
                    <button onclick="scrollToCard(3)"
                        class="w-3 h-3 rounded-full bg-gray-400 hover:bg-blue-500"></button>
                </div>
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









    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    {{-- ✅ Feather first --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            feather.replace();
        });
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

    {{-- Review Swip Dots --}}
    <script>
        function scrollToCard(index) {
            const slider = document.getElementById('reviewSlider');
            const cards = slider.querySelectorAll('.snap-center');
            if (cards[index]) {
                cards[index].scrollIntoView({
                    behavior: 'smooth',
                    inline: 'center'
                });
            }
        }
    </script>

    {{--  --}}
    <!-- Swiper JS -->

</body>

</html>
