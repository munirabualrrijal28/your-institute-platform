{{-- @php
    $admin = auth()->guard('admin')->user();

    $unreadCount = $admin && method_exists($admin, 'notifications')
        ? $admin->notifications()->whereNull('read_at')->count()
        : 0;
@endphp

<!-- Notification Icon -->
<div class="relative">
    <button onclick="toggleNotificationDropdown()" class="relative focus:outline-none">
        <i data-feather="bell" class="w-5 h-5 text-gray-600"></i>
        @if ($unreadCount > 0)
            <span
                class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full px-1">{{ $unreadCount }}</span>
        @endif
        <form method="POST" action="{{ route('admin.notifications.markAsRead') }}">
    @csrf
    <button class="text-blue-500 text-xs float-right mr-4 mt-1 hover:underline">Mark all as read</button>
</form>
    </button>

    <!-- Dropdown List -->
    <div id="notificationDropdown"
        class="hidden absolute right-0 left-0 mt-2 w-80 bg-white border border-gray-200 rounded shadow-lg z-50">
        <div class="p-4 font-semibold border-b">Notifications</div>
        <ul class="max-h-64 overflow-y-auto">
            @foreach ($notifications as $notification)
                <li class="px-4 py-2 text-sm border-b hover:bg-gray-100">
                    {{ $notification->data['message'] ?? 'New notification' }}
                </li>
                @empty
                    <li class="px-4 py-2 text-sm text-gray-500">No notifications</li>
                @endforelse
            </ul>
        </div>
    </div>

<script>
    function toggleNotificationDropdown() {
        const dropdown = document.getElementById('notificationDropdown');
        dropdown.classList.toggle('hidden');
    }

    // Close when clicking outside
    document.addEventListener('click', function (event) {
        const dropdown = document.getElementById('notificationDropdown');
        if (!event.target.closest('#notificationDropdown') &&
            !event.target.closest('[onclick="toggleNotificationDropdown()"]')) {
            dropdown?.classList.add('hidden');
        }
    });
</script> --}}
