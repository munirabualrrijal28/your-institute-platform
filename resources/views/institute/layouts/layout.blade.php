 <!DOCTYPE html>
 <html lang="en" dir="ltr">

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

     {{-- <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet"> --}}
     {{-- <link href="{{ asset('assets/css/profile.css') }}" rel="stylesheet"> --}}
     {{-- <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet"> --}}
     {{-- <link rel="stylesheet" href="profile.css"> --}}
     {{-- <link href="{{resources(path: 'resources/css/app.css')}}" rel="stylesheet"> --}}

     <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
     <!-- Bootstrap CSS -->
     {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}

     <script src="https://cdn.tailwindcss.com"></script>
     <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
     <script src="//unpkg.com/alpinejs" defer></script>
     <script src="https://unpkg.com/feather-icons"></script>


     @vite(['resources/css/app.css', 'resources/js/app.js'])

     {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
     @livewireStyles
     {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> --}}
     {{--  --}}
     {{-- <style>
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
     </style> --}}

     {{--  --}}
 </head>

 <body class="relative d-flex flex-column min-vh-100" data-bs-scroll="true">

    <div class="bg-teal-600   h-[100px] d-flex align-items-center text-center justify-center ">
        <h3 class="text-white font-bold">
            Welcome in Your-Institute Platform
        </h3>
    </div>



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
                 {{-- <a href="{{ route('user_home') }}"
                     class="block py-2 px-4 rounded hover:bg-teal-100 text-gray-700 font-medium">
                     <i data-feather="home" class="inline-block w-4 h-4 mr-2"></i> Home
                 </a> --}}
                 <a href="{{ route('institute_profile') }}"
                     class="block py-2 px-4 rounded hover:bg-teal-100 text-gray-700 font-medium hover:no-underline">
                     {{-- class="block py-2 px-4 rounded hover:bg-teal-100 text-gray-700 font-medium"> --}}

                     <i data-feather="user" class="inline-block w-4 h-4 mr-2"></i> Profile
                 </a>
                 <a href="{{ route('institute_settings') }}"
                     class="block py-2 px-4 rounded hover:bg-teal-100 text-gray-700 font-medium hover:no-underline">
                     <i data-feather="settings" class="inline-block w-4 h-4 mr-2"></i> Settings
                 </a>


                 <!-- Logout -->
                 <form method="POST" action="{{ route('logout') }}">
                     @csrf
                     <button type="submit"
                         class="absolute bottom-5 left-0 w-full text-left py-2 px-4 rounded hover:bg-red-100 text-red-600 font-medium">
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
                     <div x-data="{ open: false }" class="relative">

                        <!-- 🔔 Notification Bell -->
                        <button @click="open = !open" class="relative focus:outline-none">
                            <i data-feather="bell"></i>
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold w-5 h-5 flex items-center justify-center rounded-full">
                                4
                            </span>
                        </button>

                        <!-- ⬇️ Dropdown Panel -->
                        <div x-show="open"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-2"
                             @click.outside="open = false"
                             class="absolute right-0 mt-2 w-64 bg-white shadow-lg rounded-lg z-50 overflow-hidden">

                            <div class="px-4 py-2 border-b font-semibold text-gray-700">4 New Notifications</div>

                            <div class="divide-y divide-gray-200">
                                <div class="px-4 py-2 text-sm text-gray-600 hover:bg-gray-100 cursor-pointer">New comment on your course</div>
                                <div class="px-4 py-2 text-sm text-gray-600 hover:bg-gray-100 cursor-pointer">New follower</div>
                                <div class="px-4 py-2 text-sm text-gray-600 hover:bg-gray-100 cursor-pointer">Profile update approved</div>
                                <div class="px-4 py-2 text-sm text-gray-600 hover:bg-gray-100 cursor-pointer">1 new message</div>
                            </div>

                            <div class="px-4 py-2 border-t text-sm text-center text-blue-600 hover:underline cursor-pointer">
                                Show all notifications
                            </div>
                        </div>
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

         {{-- End of main --}}

     </div>




     {{--  --}}
     {{--  --}}
     {{--  --}}



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

<script>
    document.addEventListener("livewire:load", () => {
        // ✅ Re-render icons after every Livewire update
        Livewire.hook('message.processed', () => {
            feather.replace();
        });
    });
</script>
     {{-- @livewireScripts --}}
     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     {{-- <script src="https://unpkg.com/alpinejs" defer></script> --}}

     {{-- ✅ Feather first --}}
     <script>
         document.addEventListener("DOMContentLoaded", function() {
             feather.replace();
         });
     </script>

     {{-- For Handling Comments Functions --}}
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


     {{-- Open And Closing SideBar --}}

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
     {{--  --}}




     {{--  --}}




     @livewireStyles

 </body>




 </html>
