import './bootstrap';

import Alpine from 'alpinejs';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

import { Livewire } from '../../vendor/livewire/livewire/dist/livewire.esm';
window.Livewire = Livewire; // ✅ Make Livewire globally accessible for Alpine
Livewire.start();

window.Alpine = Alpine;
Alpine.start();

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true,
    encrypted: true,
    authEndpoint: '/broadcasting/auth',
    disableStats: true,
});

// Notification listener
window.Echo.private(`user.${userId}`)
    .listen('.notification.sent', (e) => {
        console.log('🔔 Real-time notification received', e);
        Livewire.dispatch('refresh-notifications');
        feather.replace();

        const toast = document.createElement('div');
        toast.innerHTML = `
            <div class="fixed top-5 right-5 bg-blue-600 text-white px-4 py-2 rounded shadow">
                🔔 ${e.message}
            </div>`;
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 5000);
    });
