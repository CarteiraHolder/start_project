import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

export let webSocket = new Echo({
    broadcaster: 'pusher',
    key: 'app-key',
    wsHost: '127.0.0.1',
    wsPort: 6001,
    wssPort: 6001,
    forceTLS: false,
    encrypted: true,
    disableStats: true,
    enabledTransports: ['ws', 'wss'],
    cluster: 'mt1',
    auth: {
        headers: {
            Authorization: `Bearer ${localStorage.token}`
        }
    }
});