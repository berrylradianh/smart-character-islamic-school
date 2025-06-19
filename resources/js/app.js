import './bootstrap';

if ('serviceWorker' in navigator) {
    console.log('Service Worker API tersedia, memulai logika...');

    window.addEventListener('load', async () => {
        console.log('Halaman dimuat, menghapus Service Worker lama...');
        try {
            const registrations = await navigator.serviceWorker.getRegistrations();

            for (const registration of registrations) {
                await registration.unregister();
                console.log('Service Worker lama dihapus:', registration);
            }

            console.log('Mendaftarkan Service Worker baru...');
            const newRegistration = await navigator.serviceWorker.register('/service-worker.js');
            console.log('Service Worker baru terdaftar:', newRegistration);
        } catch (error) {
            console.error('Gagal mengelola Service Worker:', error);
        }
    });
} else {
    console.warn('Service Worker API tidak didukung di browser ini.');
}
