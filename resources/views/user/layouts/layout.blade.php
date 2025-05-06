<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {{-- <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5"> --}}
    {{-- <meta name="author" content="AdminKit"> --}}
    <meta name="keywords"
        content=" bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />

    {{-- <link rel="canonical" href="https://demo-basic.adminkit.io/pages-blank.html" /> --}}

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
     <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* .body-pro {

            font-family: 'Cairo', sans-serif;
        }

        .profile-card {
            transition: all 0.3s ease-in-out;
        }

        .profile-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        } */
    </style>

{{--
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
    </style> --}}

    {{-- <style>
        #sidebar {
            left: 0;
        }

        body.sidebar-collapsed #sidebar {
            left: -260px;
        }

        #sidebar {
            transition: left 0.3s ease;
        }
    </style> --}}
</head>





<body class="relative d-flex flex-column min-vh-100" data-bs-scroll="true">
    <div class="bg-teal-600   h-20 d-flex align-items-center text-center justify-center ">
        <h3 class="text-white font-bold">
          Welcome in Your-Institute Platform
      </h3>
      </div>

    <div class="d-flex flex-grow-1">



        <!-- Tailwind Sidebar -->
        <div id="sidebar"

            class="fixed top-0 left-0 w-64 h-screen bg-white shadow-lg transform -translate-x-full transition-transform duration-300 z-50 flex flex-col">


            <div class="flex justify-end p-4">
                <button id="closeSidebar" class="text-gray-600 hover:text-red-600">
                    <i data-feather="x" class="w-5 h-5"></i></button>
            </div>
            <!-- Logo -->
            <div class="flex justify-center mb-4">
                <img src="/images/home/light/logo_your.png" alt="Logo" class="h-12">
            </div>

            <!-- Sidebar Links -->
            <nav class="px-4 flex-1 space-y-2">
                <a href="{{ route('user_home') }}"
                    class="block py-2 px-4 rounded hover:bg-teal-100 text-gray-700 font-medium">
                    <i data-feather="home" class="inline-block w-4 h-4 mr-2"></i> Home
                </a>
                <a href="{{ route('user_profile') }}"
                    class="block py-2 px-4 rounded hover:bg-teal-100 text-gray-700 font-medium">
                    <i data-feather="user" class="inline-block w-4 h-4 mr-2"></i> Profile
                </a>
                <a href="{{ route('user_settings') }}"
                    class="block py-2 px-4 rounded hover:bg-teal-100 text-gray-700 font-medium">
                    <i data-feather="settings" class="inline-block w-4 h-4 mr-2"></i> Settings
                </a>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full text-left py-2 px-4 rounded hover:bg-red-100 text-red-600 font-medium">
                        <i data-feather="log-out" class="inline-block w-4 h-4 mr-2"></i> Logout
                    </button>
                </form>
            </nav>
        </div>





        {{--  --}}
        {{--  --}}
        {{--  --}}
        <div class="main d-flex flex-column w-100">

            <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-3 py-0">
                <div class="container-fluid d-flex justify-content-between align-items-center flex-wrap">

   <!-- Right Section: Nav Items -->
   <div class="d-flex align-items-center gap-3">

    <!-- Notifications -->
    <ul class="navbar-nav navbar-align d-flex align-items-center me-3 mb-0">
        <li class="nav-item dropdown">
            <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown"
                data-bs-toggle="dropdown">
                <div class="position-relative">
                    <i class="align-middle" data-feather="bell"></i>
                    <span class="indicator">4</span>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0"
                aria-labelledby="alertsDropdown">
                <div class="dropdown-menu-header">4 New Notifications</div>
                <div class="list-group">
                    <!-- ... Your notification items ... -->
                </div>
                <div class="dropdown-menu-footer">
                    <a href="#" class="text-muted">Show all notifications</a>
                </div>
            </div>
        </li>
    </ul>


</div>
                    {{--  --}}

                    <!-- Middle Section: Search Bar (responsive) -->
                    <div class="flex-grow-1 mx-3 my-2 my-lg-0 text-left">
                        <form action="{{ route('user_search') }}" method="GET" class="w-100">
                            <div class="input-group shadow-lg rounded-pill overflow-hidden">
                                <input type="text" name="query" class="form-control form-control-lg border-0"
                                    placeholder="Search...">
                                <button class="btn btn-secondary bg-teal-500 " type="submit">
                                    <i data-feather="search"></i>
                                </button>
                            </div>
                        </form>
                    </div>




                    {{--  --}}
                               <!-- Left Section: Drawer + Logo -->
                    {{-- button to show sidebar --}}
                    <div class="d-flex align-items-center me-3">
                        {{-- <a class="sidebar-toggle js-sidebar-toggle me-2">
                            <i class="hamburger align-self-center"></i>
                        </a> --}}
                        <img src="/images/home/light/your_ins_logo.png" alt="Logo" class="img-fluid "
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


                    {{--  --}}

                    {{--  --}}
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
    {{--  --}}





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

    {{-- ✅ Sidebar functions (AFTER DOM is loaded!) --}}
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
    @livewireStyles

</body>



</html>






{{--  --}}



