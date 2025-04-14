import './bootstrap';

if ('serviceWorker' in navigator) {
    console.log('Service Worker API tersedia, memulai logika...');

    window.addEventListener('load', async () => {
        console.log('Halaman dimuat, memeriksa status koneksi...');
        console.log('navigator.onLine:', navigator.onLine);

        if (navigator.onLine) {
            console.log('Perangkat online, menghapus Service Worker dan cache...');
            try {
                // Dapatkan semua registrasi Service Worker
                const registrations = await navigator.serviceWorker.getRegistrations();
                console.log('Registrasi Service Worker ditemukan:', registrations.length);

                // Hapus setiap Service Worker
                for (let registration of registrations) {
                    try {
                        await registration.unregister();
                        console.log('Service Worker dihapus:', registration);
                    } catch (error) {
                        console.error('Gagal menghapus Service Worker:', registration, error);
                    }
                }

                // Dapatkan semua cache
                const cacheNames = await caches.keys();
                console.log('Cache ditemukan:', cacheNames);

                // Hapus setiap cache
                for (let cacheName of cacheNames) {
                    try {
                        await caches.delete(cacheName);
                        console.log('Cache dihapus:', cacheName);
                    } catch (error) {
                        console.error('Gagal menghapus cache:', cacheName, error);
                    }
                }

                // Daftarkan ulang Service Worker
                console.log('Mendaftarkan ulang Service Worker...');
                try {
                    const newRegistration = await navigator.serviceWorker.register('/service-worker.js');
                    console.log('Service Worker terdaftar:', newRegistration);
                } catch (error) {
                    console.error('Gagal mendaftarkan Service Worker:', error);
                }
            } catch (error) {
                console.error('Kesalahan selama pengelolaan Service Worker:', error);
            }
        } else {
            console.log('Perangkat offline, memeriksa registrasi Service Worker...');
            try {
                const registration = await navigator.serviceWorker.getRegistration('/service-worker.js');
                if (!registration) {
                    console.log('Tidak ada Service Worker, mendaftarkan untuk offline...');
                    const newRegistration = await navigator.serviceWorker.register('/service-worker.js');
                    console.log('Service Worker terdaftar untuk offline:', newRegistration);
                } else {
                    console.log('Service Worker sudah ada untuk offline:', registration);
                }
            } catch (error) {
                console.error('Gagal memeriksa/mendaftarkan Service Worker offline:', error);
            }
        }
    });
} else {
    console.warn('Service Worker API tidak didukung di browser ini.');
}
