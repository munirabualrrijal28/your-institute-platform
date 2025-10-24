<!DOCTYPE html>
<html lang="en" dir="ltr"">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {{-- <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5"> --}}
    <meta name="keywords"
        content=" admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <meta name="user-id" content="{{ Auth::id() }}"> --}}

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />


    <title>@yield('user_page_title')</title>

    {{-- <link href="{{ asset( 'assets/css/app.css') }}" rel="stylesheet"> --}}
    {{-- <link href="{{resources(path: 'resources/css/app.css')}}" rel="stylesheet"> --}}

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />


    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://unpkg.com/feather-icons"></script>

    {{--  --}}
    <!-- Tailwind CDN -->





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

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-8px);
            }
        }
    </style>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>



    @livewireStyles
</head>





<body class="d-flex flex-column min-vh-100" data-bs-scroll="true">
    {{-- <body class="relative d-flex flex-column min-vh-100" data-bs-scroll="true"> --}}

    <!-- Old Welcome Header -->

    {{-- <div class="bg-teal-600   h-20 d-flex align-items-center text-center justify-center ">
        <h3 class="text-white font-bold">
            Welcome in Your-Institute Platform
        </h3>
    </div> --}}
    <!-- Animated Welcome Header -->
    <header class="bg-gradient-to-r from-teal-600 to-emerald-500 py-6 shadow-lg text-white text-center">
        <h1 class="text-3xl font-extrabold animated-heading">Welcome to Your-Institute Platform</h1>
        <p class="text-base mt-1 animate-fadeIn">Empowering education through verified institutions</p>
    </header>
    {{--  --}}


    {{--  --}}
    <div class="d-flex flex-grow-1">



        <!-- Tailwind Sidebar -->
        <div id="sidebar"
            class="fixed top-0 left-0 w-64 h-screen bg-white shadow-lg transform -translate-x-full transition-transform duration-300 z-50 flex flex-col">


            <div class="flex justify-start p-4">
                <button id="closeSidebar" class="text-gray-600 hover:text-red-600">
                    <i data-feather="x" class="w-5 h-5"></i></button>
            </div>
            <!-- Logo -->
            <div class="flex justify-center mb-4">
                <img src="/images/home/light/logo_your.png" alt="Logo" class="h-[120px]">
            </div>
            <hr class="h-[20px]">

            <!-- Sidebar Links -->
            <nav class="px-4 flex-1 space-y-2">
                <a href="{{ route('user_home') }}"
                    class="block py-2 px-4 rounded hover:bg-teal-100 text-gray-700 font-medium hover:no-underline">
                    <i data-feather="home" class="inline-block w-4 h-4 mr-2"></i> Home
                </a>
                <a href="{{ route('user_profile') }}"
                    class="block py-2 px-4 rounded hover:bg-teal-100 text-gray-700 font-medium hover:no-underline">
                    <i data-feather="user" class="inline-block w-4 h-4 mr-2"></i> Profile
                </a>
                <a href="{{ route('user_settings') }}"
                    class="block py-2 px-4 rounded hover:bg-teal-100 text-gray-700 font-medium hover:no-underline">
                    <i data-feather="settings" class="inline-block w-4 h-4 mr-2"></i> Settings
                </a>

                <!-- Logout -->
                {{--  --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="absolute bottom-5 left-0 w-full text-left py-2 px-4 rounded hover:bg-red-100 text-red-600 font-medium">
                        <i data-feather="log-out" class="inline-block w-4 h-4 mr-2"></i> Logout
                    </button>

                </form>
                {{--  --}}
                <!-- 🔘 Logout triggers global modal -->
                <!-- 🔘 Sidebar Logout Button — triggers modal only -->
                {{--
<button @click="$dispatch('logout-request')"
        type="button"
        class="absolute bottom-5 left-0 w-full text-left py-2 px-4 rounded hover:bg-red-100 text-red-600 font-medium">
    <i data-feather="log-out" class="inline-block w-4 h-4 mr-2"></i> Logout
</button> --}}


                {{--  --}}
            </nav>
            {{--  --}}

        </div>





        {{--  --}}
        {{--  --}}
        {{-- Menu Start  --}}
        <div class="main d-flex flex-column w-100">

            <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-3 py-0">
                <div class="container-fluid d-flex justify-between align-items-center flex-wrap">





                    <livewire:notifications.notify />


                    {{--  --}}
                    {{-- End Notifications  --}}
                    {{--  --}}

                    <div class="relative z-500000 w-full max-w-4xl mx-auto">

                        {{-- <livewire:search.search-component /> --}}
                        <livewire:search.global-search />

                        {{--  --}}
                    </div>

                    <!-- Left Section: Drawer + Logo -->
                    <div class="d-flex align-items-center me-3">
                        <img src="/images/home/light/your_ins_logo.png" alt="Logo" class="img-fluid"
                            style="max-height: 170px; width: 170px;">
                        <button id="openSidebar" class="text-gray-600 hover:text-teal-600 focus:outline-none">
                            <i data-feather="menu" class="w-6 h-6"></i>
                        </button>
                    </div>
                </div>
            </nav>



            {{-- @yield('user_home_tabs') --}}
            <main class="flex-grow-1">
                <div class="container mx-auto px-4">



                    @yield('user_layout')



                </div>

                {{--  --}}
                {{--  --}}
                {{--  --}}


                {{--  --}}
                {{--  --}}
                {{--  --}}

            </main>


        </div>


    </div>

    {{--  --}}
    {{--  --}}
    {{--  --}}

    <!-- ✅ GLOBAL LOGOUT MODAL -->
    {{-- <div x-data="{ showLogoutConfirm: false }" @logout-request.window="showLogoutConfirm = true">
        <div x-show="showLogoutConfirm" x-transition x-cloak
            class="fixed inset-0 z-[9999] bg-black bg-opacity-50 flex items-center justify-center">

            <div class="bg-white rounded-lg shadow-lg p-6 w-80">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Are you sure you want to log out?</h2>

                <div class="flex justify-end gap-4 mt-4">
                    <!-- Cancel Button -->
                    <button @click="showLogoutConfirm = false"
                        class="px-4 py-2 rounded text-gray-600 hover:bg-gray-100">
                        No
                    </button>

                    <!-- Confirm Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                            Yes
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}

    {{--  --}}





    {{--  --}}



    {{--  --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>


    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script>
        const USER_ID = {{ Auth::id() }};
    </script>

    <script>
        window.Echo.private('user.' + USER_ID)
            .listen('.App\\Events\\NotificationSent', (e) => {
                Livewire.dispatch('refreshNotifications')
            });

        window.Pusher = Pusher;

        window.Echo = new Echo({
            broadcaster: 'pusher',
            key: '{{ env('PUSHER_APP_KEY') }}',
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
            encrypted: true,
            forceTLS: true,
            authEndpoint: '/broadcasting/auth',
        });
    </script>




    {{-- <script>
        function markReadAll() {
            fetch('{{ route('notifications.markAsRead') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        document.querySelectorAll('[x-data]').forEach(el => el.__x.$data.unread = 0);
                    }
                });
        }

        document.addEventListener("alpine:init", () => {
            Alpine.data("markReadAll", () => ({
                markReadAll
            }));
        });
    </script> --}}


    {{-- --}}
    {{--  --}}
    {{-- ✅ Feather first --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            feather.replace();
        });
    </script>

    {{--  --}}
    {{-- @auth

        <script>
            window.Echo.private(`user.${userId}`)
                .listen('.notification.sent', (e) => {
                    const html = `
            <div id="notif-${e.id}" class="px-4 py-3 rounded bg-blue-100 shadow transition">
                <div class="flex justify-between items-center">
                    <p class="text-sm text-gray-700">${e.message}</p>
                    <button onclick="markAsRead(${e.id})"
                            class="text-xs text-teal-600 hover:underline">Mark as read</button>
                </div>
            </div>`;
                    document.getElementById('notification-container')
                        ?.insertAdjacentHTML('afterbegin', html);
                });
        </script>
    @endauth --}}

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const userId = @json(Auth::id());

            window.Echo.private('user.' + userId)
                .listen('.notification.sent', (e) => {
                    console.log('🔔 New Notification:', e);

                    // Optional: show a toast popup
                    const toast = document.createElement('div');
                    toast.innerHTML = `<div class="fixed top-5 right-5 bg-green-600 text-white px-4 py-2 rounded shadow">
                    🔔 ${e.message}
                </div>`;
                    document.body.appendChild(toast);
                    setTimeout(() => toast.remove(), 5000);

                    // Refresh the Livewire notification list
                    Livewire.dispatch('refresh-notifications');
                });
        });
    </script>

    {{--  --}}

    {{-- ✅ Sidebar functions (AFTER DOM is loaded      {{-- Open And Closing SideBar --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const openBtn = document.getElementById("openSidebar");
            const closeBtn = document.getElementById("closeSidebar");
            const sidebar = document.getElementById("sidebar");

            if (openBtn && closeBtn && sidebar) {
                openBtn.addEventListener("click", () => {
                    sidebar.classList.remove("-translate-x-full");
                });

                closeBtn.addEventListener("click", () => {
                    sidebar.classList.add("-translate-x-full");
                });
            } else {
                console.warn("Sidebar toggle elements not found.");
            }
        });
    </script>

    {{-- Comment Code Dynamic --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {


            document.querySelectorAll('.comment-form').forEach(function(form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    let courseId = form.dataset.courseId;
                    let parentId = form.dataset.parentId || '';

                    let formData = new FormData(form);
                    formData.set('parent_id', parentId); // ensure parent_id is always sent

                    fetch("{{ route('user.comments_store') }}", {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json'
                            },
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // ✅ Create a new comment div
                                const newComment = document.createElement('div');
                                newComment.classList.add('mb-3', 'p-2', 'border-bottom');
                                newComment.innerHTML = `
                               <strong>${data.comment.user_name}</strong>
                               <span class="text-muted small">🕒 just now</span>
                               <p class="mb-0">${data.comment.content}</p>`;

                                const modalBody = document.querySelector(
                                    `#commentsModal${courseId} .modal-body`);

                                // If it's a reply
                                if (parentId) {
                                    const parentComment = modalBody.querySelector(
                                        `[data-comment-id="${parentId}"]`);
                                    if (parentComment) {
                                        // Append reply under the parent
                                        const repliesSection = parentComment.querySelector(
                                            '.replies') || createRepliesSection(
                                            parentComment);
                                        repliesSection.appendChild(newComment);
                                    }
                                } else {
                                    // Top-level comment: prepend to modal body
                                    modalBody.prepend(newComment);
                                }

                                // Clear textarea
                                form.querySelector('textarea[name="content"]').value = '';

                            } else {
                                alert('Something went wrong while posting your comment.');
                            }
                        })
                        .catch(error => {
                            console.error(error);
                            alert('Error while posting comment.');
                        });
                });
            });
            //
            function createRepliesSection(parent) {
                const div = document.createElement('div');
                div.classList.add('mt-2', 'ms-4', 'p-2', 'border-start', 'replies');
                parent.appendChild(div);
                return div;
            }
        });
        document.addEventListener('click', function(e) {
            if (!sidebar.contains(e.target) && !openSidebarBtn.contains(e.target)) {
                sidebar.classList.add('-translate-x-full');
            }
        });
    </script>

    {{--  --}}
    {{--  --}}
    {{--  --}}
    {{-- @push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const userId = @json(Auth::id());

        if (typeof window.Echo === 'undefined') {
            console.error("❌ Echo is not defined yet.");
            return;
        }

        window.Echo.private(`user.${userId}`)
            .listen('.notification.sent', (e) => {
                console.log('🔔 Notification received:', e);

                const notifContainer = document.getElementById('notification-container');
                const bellCounter = document.getElementById('notification-count');

                const html = `
                    <div id="notif-${e.id}" class="px-4 py-3 rounded shadow bg-blue-100 mb-1 transition-all">
                        <div class="flex justify-between items-center">
                            <p class="text-sm text-gray-700">${e.message}</p>
                            <button onclick="markAsRead(${e.id})"
                                    class="text-xs text-teal-600 hover:underline">تمييز كمقروء</button>
                        </div>
                    </div>
                `;

                notifContainer?.insertAdjacentHTML('afterbegin', html);

                if (bellCounter) {
                    let count = parseInt(bellCounter.textContent) || 0;
                    bellCounter.textContent = count + 1;
                    bellCounter.classList.remove('hidden');
                }
            });
    });
</script>
@endpush --}}
    {{--  --}}


    @livewireScripts
</body>



</html>






{{--  --}}
