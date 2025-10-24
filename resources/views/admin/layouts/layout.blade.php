{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords"
        content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">



    <title>@yield('admin_page_title')</title>

	<link href="{{asset('assets/css/app.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


     <script src="https://cdn.tailwindcss.com"></script>
     <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
     <script src="//unpkg.com/alpinejs" defer></script>
     <script src="https://unpkg.com/feather-icons"></script>


     @vite(['resources/css/app.css', 'resources/js/app.js'])
   @livewireStyles
</head>

<body>



    <div class="flex">
    <!-- Sidebar -->
<<!-- Sidebar -->
<aside class="w-64 bg-white shadow-xl h-screen fixed top-0 left-0 z-40 flex flex-col justify-between">
    <div>
        <div class="p-6 border-b">
            <h1 class="text-2xl font-bold text-blue-600">Your Institute</h1>
            <p class="text-sm text-gray-500">Admin Panel</p>
        </div>
        <nav class="mt-6 px-4 space-y-2">
            <a href="{{route('admin.dashboard')}}" class="flex items-center gap-3 py-2 px-4 rounded-lg transition font-medium no-underline hover:no-underline {{ request()->is('admin/dashboard') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-blue-100 text-gray-700' }}">
                <i data-feather="bar-chart-2" class="w-5 h-5"></i> Dashboard
            </a>
            <a href="{{route('admin.manage.institutes')}}" class="flex items-center gap-3 py-2 px-4 rounded-lg transition font-medium no-underline hover:no-underline {{ request()->is('admin/manage-institutes') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-blue-100 text-gray-700' }}">
                <i data-feather="layers" class="w-5 h-5"></i> Manage Institutes
            </a>
            <a href="{{route('admin.manage.students')}}" class="flex items-center gap-3 py-2 px-4 rounded-lg transition font-medium no-underline hover:no-underline {{ request()->is('admin/manage-students') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-blue-100 text-gray-700' }}">
                <i data-feather="user" class="w-5 h-5"></i> Manage Students
            </a>
            <a href="/admin/create-advertisement" class="flex items-center gap-3 py-2 px-4 rounded-lg transition font-medium no-underline hover:no-underline {{ request()->is('admin/create-advertisement') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-blue-100 text-gray-700' }}">
                <i data-feather="megaphone" class="w-5 h-5"></i> Post Advertisement
            </a>
        </nav>
    </div>
    <form method="POST" action="{{ route('admin.logout') }}" class="p-4">
        @csrf
        <button class="flex items-center gap-3 w-full text-left text-red-600 hover:bg-red-100 py-2 px-4 rounded-lg font-medium no-underline hover:no-underline">
            <i data-feather="log-out" class="w-5 h-5"></i> Logout
        </button>
    </form>
</aside>



    <!-- Content Area -->

        <!-- Content -->
        <main class="ml-64 flex-1 p-10 transition-all duration-500">
            @yield('content')
        </main>

</div>

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
{{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
{{-- <script src="https://unpkg.com/alpinejs" defer></script> --}}

{{-- ✅ Feather first --}}
{{-- <script>
         document.addEventListener("DOMContentLoaded", function() {
             feather.replace();
         });
     </script>

</body> --}}

{{-- </html>  --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Panel | Your Institute</title>

    <script src="https://unpkg.com/feather-icons"></script>
    {{-- <script src="https://unpkg.com/alpinejs" defer></script> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">

    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    @livewireStyles

    <style>
        :root {
            --brand-color: #009688;
        }

        .text-brand {
            color: var(--brand-color);
        }

        .bg-brand {
            background-color: var(--brand-color);
        }

        .hover\:bg-brand-dark:hover {
            background-color: #00796b;
        }
    </style>

</head>

<body class="bg-gray-100 font-sans">

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-xl fixed inset-y-0 left-0 z-50 flex flex-col justify-between">
            <div>

                <div class="p-6 border-b">

                    <div class="flex items-center gap-2">
                        <img src="/images/icons/full_logo.png" alt="Logo" class="h-30 w-30">
                        {{-- <h1 class="text-xl font-bold text-brand">Your Institute</h1> --}}
                    </div>
                    {{--  --}}

                    {{-- @include('admin.layouts.notifications') --}}


                    {{--  --}}


                    {{--  --}}

                    <p class="text-sm text-gray-500 mt-1">Admin Panel</p>
                </div>
                {{--  --}}

                 @php

                    use App\Models\Notifications;

                    $admin = auth()->guard('admin')->user();
                    $notifications = Notifications::where('reciver_id', $admin->id)
                        ->where('reciver_type', \App\Models\Admin::class)
                        ->latest()
                        ->take(10)
                        ->get();
                    $unreadCount = $notifications->whereNull('read_at')->count();
                @endphp
                {{--

                <div class="relative" x-data="{ open: false }">
                    <!-- Bell Button -->
                    <button @click="open = !open" class="relative focus:outline-none">
                        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>

                        @if ($unreadCount > 0)
                            <span class="absolute top-0 right-0 bg-red-600 text-white text-xs rounded-full px-1">
                                {{ $unreadCount }}
                            </span>
                        @endif
                    </button>

                    <!-- Dropdown -->
                    <div x-show="open" @click.away="open = false"
                        class="absolute left-20  mt-2 w-80 bg-white rounded shadow z-50">
                        @forelse ($notifications as $note)
                            <form method="POST" {{-- action="{{ route('admin.notifications.read', $note->id) }}" --}}
                {{-- @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 border-b hover:bg-gray-100">
                                    <p class="text-sm text-gray-800">{{ $note->data['message'] ?? '' }}</p>
                                    <p class="text-xs text-gray-500">{{ $note->created_at->diffForHumans() }}</p>
                                </button>
                            </form>
                        @empty
                            <div class="px-4 py-2 text-sm text-gray-500">No notifications</div>
                        @endforelse

                    </div> --}}
                {{-- </div>  --}}

                {{--  --}}
                {{--  --}}
                {{--  --}}
                {{--  --}}
                {{--  --}}

     <div class="relative"
     x-data="{
         open: false,
         dropdownPosition: 'right',
         updatePosition() {
             const button = $el.querySelector('button');
             const rect = button.getBoundingClientRect();
             const viewportWidth = window.innerWidth;

             // If too close to right edge, switch to left
             this.dropdownPosition = (viewportWidth - rect.right < 350) ? 'left' : 'right';
         }
     }"
     @resize.window="updatePosition"
     x-init="updatePosition"
>
    <!-- Bell Button -->
    <button @click="open = !open; updatePosition()" class="relative">
        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
        </svg>

        <span id="notification-count"
              class="absolute top-0 right-0 bg-red-600 text-white text-xs rounded-full px-1 {{ $unreadCount == 0 ? 'hidden' : '' }}">
            {{ $unreadCount }}
        </span>
    </button>

    <!-- Dropdown -->
    <div x-show="open" @click.away="open = false"
         :class="dropdownPosition === 'right' ? 'right-[-500px]' : 'left-20'"
         class="absolute  mt-2 bg-white rounded shadow z-50 w-800 max-w-[90vw] p-2 transition-all duration-200"
    >
        <div class="flex justify-between items-center mb-2">
            <span class="font-semibold text-gray-700">Notifications</span>

            <form method="POST" action="{{ route('admin.notifications_markAllAsRead') }}">
                @csrf
                <button type="submit" onclick="markAllAsRead()" id="markAllBtn"
                        class="text-xs text-blue-600 hover:underline focus:outline-none">
                    Mark all as read
                </button>
            </form>
        </div>

        <div id="notification-container">
            @foreach ($notifications as $note)
                <div id="notif-{{ $note->id }}"
                     class="px-4 py-2 mb-1 rounded transition-all {{ $note->read_at ? 'bg-white' : 'bg-blue-100' }}">
                    <div class="flex justify-between items-center">
                        <p class="text-sm text-gray-800">{{ $note->data['message'] ?? '' }}</p>
                        @if (is_null($note->read_at))
                            <form method="POST"
                                  action="{{ route('admin.notification_markAsRead', $note->id) }}">
                                @csrf
                                <button type="submit" onclick="markAsRead({{ $note->id }})"
                                        class="text-xs text-teal-600 hover:underline">Mark as read</button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>



                {{--  --}}
                {{--  --}}
                {{--  --}}
                {{--  --}}
                {{--  --}}

                <nav class="mt-6 left-20 px-4 space-y-2">
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center gap-3 py-2 px-4 rounded-lg font-medium transition {{ request()->is('admin/dashboard') ? 'bg-teal-100 text-brand font-semibold' : 'hover:bg-gray-100 text-gray-700' }}">
                        <i data-feather="bar-chart-2" class="w-5 h-5"></i> Dashboard
                    </a>
                    <a href="{{ route('admin.manage.institutes') }}"
                        class="flex items-center gap-3 py-2 px-4 rounded-lg font-medium transition {{ request()->is('admin/manage-institutes') ? 'bg-teal-100 text-brand font-semibold' : 'hover:bg-gray-100 text-gray-700' }}">
                        <i data-feather="layers" class="w-5 h-5"></i> Manage Institutes
                    </a>
                    <a href="{{ route('admin.manage.students') }}"
                        class="flex items-center gap-3 py-2 px-4 rounded-lg font-medium transition {{ request()->is('admin/manage-students') ? 'bg-teal-100 text-brand font-semibold' : 'hover:bg-gray-100 text-gray-700' }}">
                        <i data-feather="users" class="w-5 h-5"></i> Manage Students
                    </a>
                    <a href="{{ route('admin.manage.ads') }}"
                        class="flex items-center gap-3 py-2 px-4 rounded-lg font-medium transition {{ request()->is('admin/manage-advertisements') ? 'bg-teal-100 text-brand font-semibold' : 'hover:bg-gray-100 text-gray-700' }}">
                        <i data-feather="layout" class="w-5 h-5"></i> Manage Advertisements
                    </a>
                    {{-- <a href="{{ route('admin.manage.report') }}" class="flex items-center gap-3 py-2 px-4 rounded-lg font-medium transition {{ request()->is('admin/create-advertisement') ? 'bg-teal-100 text-brand font-semibold' : 'hover:bg-gray-100 text-gray-700' }}">
                    <i data-feather="megaphone" class="w-5 h-5"></i> Manage Reports
                </a> --}}
                    <a href="{{ route('admin.manage.reports') }}"
                        class="flex items-center gap-3 py-2 px-4 rounded-lg font-medium transition {{ request()->is('admin/reports') ? 'bg-teal-100 text-brand font-semibold' : 'hover:bg-gray-100 text-gray-700' }}">
                        <i data-feather="file-text" class="w-5 h-5"></i> Manage Reports
                    </a>
                </nav>


            </div>

            <form method="POST" action="{{ route('admin.logout') }}" class="p-4">
                @csrf
                <button
                    class="flex items-center gap-3 w-full text-left text-red-600 hover:bg-red-100 py-2 px-4 rounded-lg font-medium">
                    <i data-feather="log-out" class="w-5 h-5"></i> Logout
                </button>
            </form>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 ml-64 p-6">
            @yield('content')
        </main>

    </div>


    {{--  --}}


    {{--  --}}
    <script>
        feather.replace();
    </script>
    @livewireScripts

    {{-- Real-time script --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const adminId = @json(Auth::guard('admin')->id());

            window.Echo.private(`admin.${adminId}`)
                .listen('.notification.sent', (e) => {
                    const notifContainer = document.getElementById('notification-container');
                    const bellCounter = document.getElementById('notification-count');

                    const html = `
                    <div id="notif-${e.id}" class="px-4 py-3 rounded shadow bg-blue-100 mb-1 transition-all">
                        <div class="flex justify-between items-center">
                            <p class="text-sm text-gray-700">${e.message}</p>
                            <button onclick="markAsRead(${e.id})"
                                    class="text-xs text-teal-600 hover:underline">Mark as read</button>
                        </div>
                    </div>
                `;

                    notifContainer.insertAdjacentHTML('afterbegin', html);

                    if (bellCounter) {
                        let count = parseInt(bellCounter.textContent) || 0;
                        count += 1;
                        bellCounter.textContent = count;
                        bellCounter.classList.remove('hidden');
                    }
                });
        });

        function markAsRead(id) {
            fetch(`/admin/notifications/${id}/mark-as-read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                }
            }).then(() => {
                const el = document.getElementById(`notif-${id}`);
                if (el) {
                    el.classList.remove('bg-blue-100');
                    el.classList.add('bg-white');
                    el.querySelector('button')?.remove();
                }

                const bellCounter = document.getElementById('notification-count');
                let count = parseInt(bellCounter.textContent) || 1;
                count = Math.max(count - 1, 0);
                bellCounter.textContent = count;
                if (count === 0) bellCounter.classList.add('hidden');
            });
        }

        function markAllAsRead() {
            fetch(`/admin/notifications/mark-all-as-read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                }
            }).then(() => {
                document.querySelectorAll('#notification-container > div').forEach(div => {
                    div.classList.remove('bg-blue-100');
                    div.classList.add('bg-white');
                    div.querySelector('button')?.remove();
                });

                const bellCounter = document.getElementById('notification-count');
                bellCounter.textContent = '0';
                bellCounter.classList.add('hidden');
            });
        }
    </script>

</body>

</html>
