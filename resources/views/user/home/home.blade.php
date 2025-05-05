@extends('user.layouts.layout')
@section('user_page_title')
    {{-- User - Home --}}
@endsection
@section('user_layout')
    {{-- <h2>Home</h2> --}}


{{--  --}}
{{--  --}}
{{--  --}}


            <!-- ✅ Carousel Section -->

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
<!-- ✅ Institutes Section -->
<section class="bg-gray py-8 px-6">
    <!-- ✅ Centered "Show All Courses" Button -->
    <div class="text-center mb-6">
        <a href="{{ route('user.ins_profile') }}" target="_blank"
           class="inline-block bg-green-200 text-green-800 font-semibold px-6 py-2 rounded-full shadow hover:bg-green-300 transition">
            Show All Institutes
        </a>
    </div>



    {{-- ['path' => 'images/inst_profile/jats/jats.png', 'name' => 'JATS'],
    ['path' => 'images/inst_profile/lbm/lb.jpg', 'name' => 'LBM'],
    ['path' => 'images/inst_profile/24/24_ins.jpg', 'name' => '24 Academy'],
    ['path' => 'images/inst_profile/yali/yali.jpg', 'name' => 'Yali'],
    ['path' => 'images/inst_profile/speak/speak.jpg', 'name' => 'SpeakNow'], --}}



    <!-- ✅ Horizontal Scrollable Institute Logos -->
    <div class="flex overflow-x-auto gap-6 scrollbar-hide">
        {{-- <div class="flex overflow-x-auto gap-6 items-center px-2 pb-2 scrollbar-hide"> --}}
        @foreach ($institutes as $institute)
            <a href="{{ route('user.ins_profile', ['id' => $institute['id']]) }}" target="_blank"
               class="flex-shrink-0 flex flex-col items-center bg-white rounded-xl shadow-md p-4 transition hover:shadow-lg">
                <img src="{{ asset($institute['ins_profile_photo']) }}"
                @php
                // dd($institute['ins_photo_profile']);
                @endphp
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





{{--  --}}
{{--  --}}
{{--  --}}

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
    {{--  --}}
@endsection
