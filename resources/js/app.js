import './bootstrap';

async function isServerAlive() {
    try {
        const response = await fetch('/health', { method: 'HEAD', timeout: 5000 });
        return response.ok;
    } catch (error) {
        console.error('Server tidak responsif:', error);
        return false;
    }
}

async function clearAllCaches() {
    if (!navigator.onLine) {
        console.log('Offline: Tidak menghapus cache');
        return;
    }
    const serverAlive = await isServerAlive();
    if (!serverAlive) {
        console.log('Server mati: Tidak menghapus cache');
        return;
    }
    try {
        const cacheNames = await caches.keys();
        console.log('Cache ditemukan:', cacheNames);
        console.log('Cookie sebelum hapus cache:', document.cookie);
        await Promise.all(cacheNames.map(cacheName => caches.delete(cacheName)));
        console.log('Semua cache dihapus');
        console.log('Cookie setelah hapus cache:', document.cookie);
    } catch (error) {
        console.error('Gagal menghapus cache:', error);
    }
}

async function manageServiceWorker() {
    try {
        if (navigator.onLine) {
            const serverAlive = await isServerAlive();
            if (serverAlive) {
                const registrations = await navigator.serviceWorker.getRegistrations();
                await Promise.all(registrations.map(reg => reg.unregister()));
                console.log('Semua Service Worker lama dihapus');

                const registration = await navigator.serviceWorker.register('/service-worker.js');
                console.log('Service Worker baru terdaftar:', registration);
            } else {
                console.log('Server mati: Tidak mengelola Service Worker untuk menjaga cache');
                const registration = await navigator.serviceWorker.getRegistration('/service-worker.js');
                if (registration) {
                    console.log('Service Worker sudah ada:', registration);
                } else {
                    console.warn('Tidak ada Service Worker terdaftar saat server mati');
                }
            }
        } else {
            console.log('Offline: Tidak mengelola Service Worker untuk menjaga cache');
            const registration = await navigator.serviceWorker.getRegistration('/service-worker.js');
            if (registration) {
                console.log('Service Worker sudah ada:', registration);
            } else {
                console.warn('Tidak ada Service Worker terdaftar saat offline');
            }
        }
    } catch (error) {
        console.error('Gagal mengelola Service Worker:', error);
    }
}

if ('serviceWorker' in navigator) {
    console.log('Service Worker API tersedia');

    window.addEventListener('load', async () => {
        console.log('Halaman dimuat, status:', navigator.onLine);

        const clickBlocker = document.getElementById('click-blocker');
        if (clickBlocker) {
            clickBlocker.classList.add('hidden');
            setTimeout(() => {
                clickBlocker.remove();
            }, 300);
        }

        if (navigator.onLine) {
            const serverAlive = await isServerAlive();
            if (serverAlive) {
                console.log('Online dan server hidup: Menghapus cache dan mendaftar ulang Service Worker');
                await clearAllCaches();
                await manageServiceWorker();
            } else {
                console.log('Online tapi server mati: Memeriksa Service Worker');
                await manageServiceWorker();
            }
        } else {
            console.log('Offline: Memeriksa Service Worker');
            await manageServiceWorker();
        }
    });

    window.addEventListener('popstate', async () => {
        if (navigator.onLine) {
            const serverAlive = await isServerAlive();
            if (serverAlive && !window.location.pathname.includes('/dashboards')) {
                console.log('Perubahan rute terdeteksi dan server hidup, menghapus cache');
                await clearAllCaches();
            } else {
                console.log('Perubahan rute terdeteksi di dashboard atau server mati, menggunakan cache');
            }
        } else {
            console.log('Perubahan rute terdeteksi, tapi offline, menggunakan cache');
        }
    });

    navigator.serviceWorker.addEventListener('message', async (event) => {
        if (event.data.type === 'NEW_REQUEST' && navigator.onLine) {
            const serverAlive = await isServerAlive();
            if (serverAlive) {
                console.log('Request baru terdeteksi dan server hidup, menghapus cache');
                await clearAllCaches();
            } else {
                console.log('Request baru terdeteksi, tapi server mati, tidak menghapus cache');
            }
        }
    });
} else {
    console.warn('Service Worker API tidak didukung di browser ini.');
}
