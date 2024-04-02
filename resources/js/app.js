import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

Echo.channel('notification')
    .listen('NewMessageNotification', (e) => {
        alert(e.message.message);
    });
