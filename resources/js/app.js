import './bootstrap';

if ('serviceWorker' in navigator) {
    console.log('Service Worker API tersedia, memulai logika...');

    window.addEventListener('load', async () => {
        console.log('Halaman dimuat, mendaftarkan Service Worker...');
        try {
            const registration = await navigator.serviceWorker.register('/service-worker.js');
            console.log('Service Worker terdaftar:', registration);
        } catch (error) {
            console.error('Gagal mendaftarkan Service Worker:', error);
        }
    });
} else {
    console.warn('Service Worker API tidak didukung di browser ini.');
}
