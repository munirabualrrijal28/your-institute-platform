<div x-data="{ open: false }" class="relative" id="notificationDropdown">


    <button id="notification-bell" @click="open = !open" class="relative">
        <i data-feather="bell" class="w-5 h-5 text-gray-800"></i>
        <span id="notification-count"
            class="absolute -top-1 -right-2 bg-red-600 text-white text-xs font-bold w-5 h-5 rounded-full flex items-center justify-center">
            {{ $unreadCount }}
        </span>
    </button>

    <!-- Dropdown -->
    <div x-show="open" @click.outside="open = false"
        class="absolute right-0 mt-2 w-80 bg-white border rounded-lg shadow-xl z-50 max-h-96 overflow-y-auto"
        x-transition>
        <div class="p-3 border-b font-semibold flex justify-between">
            <span>الإشعارات</span>
            {{-- <button id="markAllBtn" class="text-xs text-blue-600 hover:underline focus:outline-none">
                تمييز كمقروء
            </button> --}}
            <button onclick="markAllAsRead()"class="text-xs text-blue-600 hover:underline focus:outline-nonee">
                تمييز كمقروء
            </button>
        </div>

        <div id="notification-container" class="p-2 space-y-2">
            @foreach ($notifications as $notification)
                {{--  --}}
                @php
                    $hasLink =
                        isset($notification->data['institute_id']) &&
                        (($notification->notification_type === 'new_course' &&
                            isset($notification->data['course_id'])) ||
                            ($notification->notification_type === 'new_ad' && isset($notification->data['ad_id'])));
                @endphp
                {{--  --}}

                <div id="notif-{{ $notification->id }}"
                    class="px-4 py-3 rounded shadow transition {{ is_null($notification->read_at) ? 'bg-blue-100' : 'bg-white' }}">
                    <div class="flex justify-between items-center">
                        @if ($hasLink)
                            <a href="{{ route('user.user_ins_profile', [
                                'id' => $notification->data['institute_id'],
                                'highlight' =>
                                    $notification->notification_type === 'new_course'
                                        ? 'course_' . $notification->data['course_id']
                                        : 'ad_' . $notification->data['ad_id'],
                            ]) }}"
                                class="block hover:bg-gray-100 px-2 py-1">
                                {{ $notification->data['message'] ?? '🔔 Notification' }}
                            </a>
                        @else
                            <span class="block px-2 py-1 text-gray-600">
                                {{ $notification->data['message'] ?? '🔔 Notification' }}
                            </span>
                        @endif

                        @if (is_null($notification->read_at))
                            <button onclick="markAsRead({{ $notification->id }})"class="text-xs text-teal-600 hover:underline">
                تمييز كمقروء
                            </button>
                        @endif



                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Real-time script --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const userId = @json(Auth::id());

            window.Echo.private(`user.${userId}`)
                .listen('.notification.sent', (e) => {
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

                    notifContainer.insertAdjacentHTML('afterbegin', html);

                    if (bellCounter) {
                        let count = parseInt(bellCounter.textContent) || 0;
                        count += 1;
                        bellCounter.textContent = count;
                        bellCounter.classList.remove('hidden');
                    }
                });

            const markAllBtn = document.getElementById('markAllBtn');
            if (markAllBtn) {
                markAllBtn.addEventListener('click', function() {
                    // fetch(`{{ route('notifications.markAllAsRead') }}`, {
                    fetch(`{{ route('notifications.markAllAsRead') }}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
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
                });
            }
        });

        function markAsRead(id) {
            fetch(`/notifications/${id}/mark-as-read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
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
                count = Math.max(count - 1,0);
                bellCounter.textContent = count;
                if (count === 0) bellCounter.classList.add('hidden');
            });
        }
        //
        //
        //
        function markAllAsRead() {
            fetch(`/notifications/mark-all-as-read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            }).then(() => {
                // const el = document.getElementById(`notif-${id}`);
                // if (el) {
                //     el.classList.remove('bg-blue-100');
                //     el.classList.add('bg-white');
                //     el.querySelector('button')?.remove();

                // }

                const bellCounter = document.getElementById('notification-count');
                let count = parseInt(bellCounter.textContent) || 1;
                // count = Math.max(count - 1, 0);
                count = 0;
                bellCounter.textContent = count;
                if (count === 0) bellCounter.classList.add('hidden');
            });
        }


    </script>
</div>
