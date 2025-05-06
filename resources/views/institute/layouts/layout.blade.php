 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
     <meta name="author" content="AdminKit">
     <meta name="keywords"
         content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

     <meta name="csrf-token" content="{{ csrf_token() }}">

     <link rel="preconnect" href="https://fonts.gstatic.com">
     <link rel="shortcut icon" href="img/icons/icon-48x48.png" />

     <link rel="canonical" href="https://demo-basic.adminkit.io/pages-blank.html" />

     <title>@yield('institute_page_title')</title>

     <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
     {{-- <link href="{{ asset('assets/css/profile.css') }}" rel="stylesheet"> --}}
     {{-- <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet"> --}}
     {{-- <link rel="stylesheet" href="profile.css"> --}}
     {{-- <link href="{{resources(path: 'resources/css/app.css')}}" rel="stylesheet"> --}}

     <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
     <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

     <script src="https://cdn.tailwindcss.com"></script>
     <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
     <script src="//unpkg.com/alpinejs" defer></script>

     @vite(['resources/css/app.css', 'resources/js/app.js'])

     {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
     @livewireStyles
     {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> --}}
     {{--  --}}
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

     {{--  --}}
 </head>

 <body class="d-flex flex-column min-vh-100" data-bs-scroll="true">
     <div class="d-flex flex-grow-1">



         <nav id="sidebar" class="sidebar js-sidebar d-flex flex-column" style="height: auto; width: 250px;">
             <!-- Top section: logo and navigation -->
             <div class="sidebar-content js-simplebar flex-grow-1 d-flex flex-column">
                 <a class="sidebar-brand" href="{{ route('institute_profile') }}">
                     <span class="align-middle">@yield('institute_sidebar_name')</span>
                 </a>

                 <a class="sidebar-brand" href="{{ route('institute_profile') }}">
                     <img src="{{ asset('images/home/light/logo_your.png') }}" alt="Logo" class="logo img-fluid">
                 </a>

                 <ul class="sidebar-nav">
                     <li class="sidebar-header">Main</li>

                     <li class="sidebar-item {{ request()->routeIs('institute_profile') ? 'active' : '' }}">
                         <a class="sidebar-link" href="{{ route('institute_profile') }}">
                             <i class="align-middle" data-feather="user"></i> Profile
                         </a>
                     </li>

                     <li class="sidebar-header">Category</li>
                     <li class="sidebar-item {{ request()->routeIs('institute.manage_category') ? 'active' : '' }}">
                         <a class="sidebar-link" href="{{ route('institute.manage_category') }}">
                             <i class="align-middle" data-feather="list"></i> Manage
                         </a>
                     </li>

                     <li class="sidebar-header">Course Advertisement</li>
                     {{-- <li class="sidebar-item {{ request()->routeIs('institute.manage_course_adv') ? 'active' : '' }}">
                         <a class="sidebar-link" href="{{ route('institute.manage_course_adv') }}">
                             <i class="align-middle" data-feather="plus"></i> Create
                         </a>
                     </li> --}}
                     <li class="sidebar-item {{ request()->routeIs('institute.manage_course_adv') ? 'active' : '' }}">
                         <a class="sidebar-link" href="{{ route('institute.manage_course_adv') }}">
                             <i class="align-middle" data-feather="list"></i> Manage
                         </a>
                     </li>

                     <li class="sidebar-header">Tools</li>
                     <li class="sidebar-item {{ request()->routeIs('institute_settings') ? 'active' : '' }}">
                         <a class="sidebar-link" href="{{ route('institute_settings') }}">
                             <i class="align-middle" data-feather="settings"></i> Settings
                         </a>
                     </li>
                 </ul>
             </div>


         </nav>




         {{--  --}}
         {{--  --}}
         {{--  --}}
         <div class="main d-flex flex-column w-100">

             <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-3 py-2">
                 <div class="container-fluid d-flex justify-content-between align-items-center flex-wrap">

                     <!-- Left Section: Drawer + Logo -->
                     <div class="d-flex align-items-center me-3">
                         <a class="sidebar-toggle js-sidebar-toggle me-2">
                             <i class="hamburger align-self-center"></i>
                         </a>
                         <img src="/images/home/light/your_ins_logo.png" alt="Logo" class="logo img-fluid"
                             style="max-height: 40px;">
                     </div>

                     <!-- Middle Section: Search Bar (responsive) -->
                     <div class="flex-grow-1 mx-3 my-2 my-lg-0">
                         <form action="{{ route('user_search') }}" method="GET" class="w-100">
                             <div class="input-group">
                                 <input type="text" name="query" class="form-control form-control-lg"
                                     placeholder="Search...">
                                 <button class="btn btn-outline-secondary" type="submit">
                                     <i data-feather="search"></i>
                                 </button>
                             </div>
                         </form>
                     </div>

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

                         <!-- Profile Dropdown -->
                         <li class="nav-item dropdown list-unstyled">
                             <!-- Mobile Icon -->
                             <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#"
                                 data-bs-toggle="dropdown">
                                 <i class="align-middle" data-feather="settings"
                                     style="width: 24px; height: 24px;"></i>
                             </a>

                             <!-- Desktop: Avatar + Chevron -->
                             <a class="nav-link  d-none d-sm-flex align-items-center gap-2" href="#"
                                 data-bs-toggle="dropdown">
                                 <img src="{{ asset('images/profile/user_ic.svg') }}"
                                     class="rounded-circle border shadow-sm" style="width: 48px; height: 48px;"
                                     alt="User" />
                                 <i class="align-middle" data-feather="chevron-down"
                                     style="width: 20px; height: 20px;"></i>
                             </a>

                             <!-- Dropdown Menu -->
                             <div class="dropdown-menu dropdown-menu-end">


                                 <div class="dropdown-divider"></div>

                                    <a class="dropdown-item" href="{{ route('institute_settings') }}">
                                        <i class="align-middle me-1" data-feather="settings"></i> Settings
                                    </a>
                                    {{-- <input type="submit" value="Logout" class="align-middle me-1" data-feather="settings">Settings --}}
                                 <div class="dropdown-divider"></div>
                                 <form action="{{ route('logout') }}" method="POST" class="px-3">
                                     @csrf
                                     <input type="submit" value="Logout" class="btn btn-warning w-100">
                                 </form>
                             </div>
                         </li>

                     </div>
                 </div>
             </nav>




             @yield('institute_profile_tabs')
             <main class="flex-grow-1">
                 <div class="container mx-auto px-4">



                     @yield('institute_layout')


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
     <!-- Footer -->
     <footer class="bg-gray-100 text-gray-600 py-4">
         <div class="container mx-auto px-4">
             <div class="flex flex-col md:flex-row justify-between items-center text-sm">
                 <p class="mb-2 md:mb-0">
                     <a class="text-gray-500 hover:text-gray-800" href="#"><strong>Your Institute</strong></a> -
                     <a class="text-gray-500 hover:text-gray-800" href="" target="_blank"></strong></a> &copy;
                 </p>
                 <ul class="flex space-x-4">
                     <li><a class="text-gray-500 hover:text-gray-800" href="#">Support</a></li>
                     <li><a class="text-gray-500 hover:text-gray-800" href="#">Help Center</a></li>
                     <li><a class="text-gray-500 hover:text-gray-800" href="#">Privacy</a></li>
                     <li><a class="text-gray-500 hover:text-gray-800" href="#">Terms</a></li>
                 </ul>
             </div>
         </div>
     </footer>
     {{--  --}}
     {{--  --}}
     {{--  --}}
     {{--  --}}
     <script src="{{ asset('assets/js/app.js') }}"></script>

     {{-- @livewireScripts --}}
     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <script src="https://unpkg.com/alpinejs" defer></script>


     <script>
         document.addEventListener('DOMContentLoaded', function() {
             document.querySelectorAll('.comment-form').forEach(function(form) {
                 form.addEventListener('submit', function(e) {
                     e.preventDefault();

                     let courseId = form.dataset.courseId;
                     let parentId = form.dataset.parentId || '';

                     let formData = new FormData(form);
                     formData.set('parent_id', parentId); // ensure parent_id is always sent

                     fetch("{{ route('institute.comments_store') }}", {
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
                                <p class="mb-0">${data.comment.content}</p>
                            `;

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

             function createRepliesSection(parent) {
                 const div = document.createElement('div');
                 div.classList.add('mt-2', 'ms-4', 'p-2', 'border-start', 'replies');
                 parent.appendChild(div);
                 return div;
             }
         });
     </script>



     {{--  --}}
     @livewireStyles

 </body>




 </html>
