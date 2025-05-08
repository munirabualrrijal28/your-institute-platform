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

    {{-- <link rel="canonical" href="https://demo-basic.adminkit.io/pages-blank.html" /> --}}

    {{-- <title>@yield('user_page_title')</title> --}}


    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />



    {{--  --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">




    {{--  --}}
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- <script src="//unpkg.com/alpinejs" defer></script> --}}

    <script src="https://unpkg.com/feather-icons"></script>

    <!-- Tailwind CDN -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="//unpkg.com/alpinejs" defer></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>





<body class="d-flex flex-column min-vh-100" data-bs-scroll="true">


    {{--  --}}
    <!-- ✅ Global Logout Confirmation Modal (Alpine.js) -->
    <!-- ✅ Global Logout Modal using Alpine.js -->


    {{--  --}}
    <div class="d-flex flex-grow-1">

        {{--  --}}
        {{--  --}}
        {{-- Menu Start  --}}
        <div class="main d-flex flex-column w-100">




            {{-- @yield('user_home_tabs') --}}
            <main class="flex-grow-1">
                <div class="container mx-auto px-4">



                    @yield('lib_layout')


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






    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- <script src="https://unpkg.com/alpinejs" defer></script> --}}
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    {{-- ✅ Feather first --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            feather.replace();
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Re-run feather icons after each tab switch
            document.querySelectorAll("[data-tab]").forEach((tabBtn) => {
                tabBtn.addEventListener("click", () => {
                    setTimeout(() => {
                        feather.replace(); // Refresh icons
                    }, 50); // Slight delay to allow DOM to update
                });
            });
        });
    </script>

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
<script>
    document.addEventListener("livewire:load", () => {
        Livewire.hook('message.processed', (message, component) => {
            // ✅ Re-initialize Feather icons after Livewire DOM update
            feather.replace();
        });
    });
</script>

    {{--  --}}
    @livewireStyles
    @stack('scripts')
</body>



</html>
