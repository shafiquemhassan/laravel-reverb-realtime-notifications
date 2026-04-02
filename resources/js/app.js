import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

// Notification Listener
if (window.userId) {
    window.Echo.private(`App.Models.User.${window.userId}`)
        .notification((notification) => {
            console.log('Notification received:', notification);
            window.Swal.fire({
                title: 'New Notification!',
                text: notification.message,
                icon: 'info',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
            });
        });
}

Alpine.start();
