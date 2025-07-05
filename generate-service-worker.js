import { existsSync, readdirSync, writeFileSync } from 'fs';
import { join } from 'path';

// Direktori untuk aset statis
const directories = [
    'public/assets',
    'public/dashboard/assets',
    'storage/app/public',
    'public/assets/img',
];

// Ekstensi file yang diizinkan untuk di-cache
const allowedExtensions = [
    '.css', '.js', '.png', '.jpg', '.jpeg', '.svg', '.woff', '.woff2', '.ttf', '.eot', '.ico',
    '.pdf'
];

// Daftar rute GET secara manual
const getRoutes = [
    '/',
    '/profile',
    '/faq',
    '/vision',
    '/program',
    '/ppdb',
    '/search',
    '/search-suggestions',
    '/auth/login',
    '/auth/register',
    '/dashboards',
    '/dashboards/profile',
    '/dashboards/profile/edit',
    '/dashboards/ppdb-pendaftaran',
    '/dashboards/ppdb-pengumuman',
    '/dashboards/ppdb-pendaftaran/revisi',
    '/dashboards/stats',
    '/dashboards/content-hero',
    '/dashboards/content-news',
    '/dashboards/content-agenda',
    '/dashboards/content-introduction',
    '/dashboards/list-pendaftar',
    '/dashboards/values',
    '/dashboards/content-programs',
    '/dashboards/content-testimonials',
    '/dashboards/content-media',
    '/dashboards/content-profile',
    '/dashboards/content-vision',
    '/dashboards/content-ppdb',
    '/dashboards/roles',
    '/dashboards/roles/create',
    '/dashboards/roles/edit',
    '/dashboards/users',
    '/dashboards/users/create',
    '/dashboards/users/edit'
];

// Fungsi untuk mendapatkan file secara rekursif dari direktori
function getFilesRecursively(dir, isStorage = false, baseDir = '') {
    let results = [];
    const files = readdirSync(dir, { withFileTypes: true });

    files.forEach(file => {
        const fullPath = join(dir, file.name);
        const relativePath = baseDir ? join(baseDir, file.name) : file.name;

        if (file.isDirectory()) {
            results = results.concat(getFilesRecursively(fullPath, isStorage, relativePath));
        } else {
            const ext = file.name.substring(file.name.lastIndexOf('.')).toLowerCase();
            if (allowedExtensions.includes(ext)) {
                let urlPath;
                if (isStorage) {
                    urlPath = `/storage/${relativePath.replace(/\\/g, '/')}`;
                } else {
                    urlPath = `/${relativePath.replace(/\\/g, '/')}`;
                }
                urlPath = urlPath.replace(/\/\//g, '/');
                results.push(urlPath);
                console.log(`Menambahkan ke urlsToCache: ${urlPath} (dari ${fullPath})`);
            }
        }
    });

    return results;
}

// Kumpulkan semua file aset
let allFiles = [];
directories.forEach(dir => {
    if (existsSync(dir)) {
        console.log(`Memindai direktori: ${dir}`);
        if (dir === 'storage/app/public') {
            allFiles = allFiles.concat(getFilesRecursively(dir, true));
        } else if (dir === 'public/assets') {
            allFiles = allFiles.concat(getFilesRecursively(dir, false, 'assets'));
        } else if (dir === 'public/dashboard/assets') {
            allFiles = allFiles.concat(getFilesRecursively(dir, false, 'dashboard/assets'));
        }
    } else {
        console.warn(`Direktori tidak ditemukan: ${dir}`);
    }
});

// Tambahkan rute GET yang didefinisikan secara manual
allFiles = allFiles.concat(getRoutes);
getRoutes.forEach(route => {
    console.log(`Menambahkan rute GET manual: ${route}`);
});

// Tambahkan root jika belum ada
if (!allFiles.includes('/')) {
    allFiles.unshift('/');
    console.log('Menambahkan root: /');
}

// Template Service Worker
const swTemplate = `
const CACHE_NAME = 'scis-pwa-v1';
const DYNAMIC_CACHE = 'dynamic-cache';
const urlsToCache = ${JSON.stringify(allFiles, null, 2)};

// Install Service Worker
self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(CACHE_NAME).then(cache => {
            console.log('Membuka cache:', CACHE_NAME);
            const cachePromises = urlsToCache.map(url => {
                return fetch(url, { credentials: 'same-origin' })
                    .then(response => {
                        if (!response.ok) {
                            console.warn('Gagal meng-cache URL:', url, 'Status:', response.status);
                            return Promise.resolve();
                        }
                        return cache.put(url, response);
                    })
                    .catch(error => {
                        console.warn('Error meng-cache URL:', url, error);
                        return Promise.resolve();
                    });
            });
            return Promise.all(cachePromises)
                .then(() => console.log('Caching selesai'))
                .catch(error => {
                    console.error('Error selama caching:', error);
                    throw error;
                });
        }).catch(error => {
            console.error('Gagal membuka cache:', error);
            throw error;
        })
    );
});

// Activate Service Worker
self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames.map(cacheName => {
                    if (cacheName !== CACHE_NAME && cacheName !== DYNAMIC_CACHE) {
                        console.log('Menghapus cache lama:', cacheName);
                        return caches.delete(cacheName);
                    }
                })
            );
        }).then(() => self.clients.claim())
    );
});

// Fetch Event
self.addEventListener('fetch', event => {
    const requestUrl = new URL(event.request.url);

    // Hanya tangani permintaan GET
    if (event.request.method !== 'GET') {
        event.respondWith(fetch(event.request));
        return;
    }

    // Tangani permintaan API atau dashboard
    if (requestUrl.pathname.includes('/api') || requestUrl.pathname.includes('/dashboard')) {
        event.respondWith(
            fetch(event.request)
                .then(response => {
                    if (response.status === 200) {
                        const responseClone = response.clone();
                        caches.open(DYNAMIC_CACHE).then(cache => {
                            cache.put(event.request, responseClone);
                            console.log('Cached dynamic data:', event.request.url);
                        });
                    }
                    return response;
                })
                .catch(() => {
                    return caches.match(event.request).then(cachedResponse => {
                        if (cachedResponse) {
                            console.log('Mengambil dari cache dinamis:', event.request.url);
                            return cachedResponse;
                        }
                        return new Response(
                            JSON.stringify({ error: 'Offline, no data available' }),
                            { status: 503, headers: { 'Content-Type': 'application/json' } }
                        );
                    });
                })
        );
    } else {
        // Tangani aset statis dan halaman dengan Cache-First
        event.respondWith(
            caches.match(event.request).then(response => {
                if (response) {
                    console.log('Mengambil dari cache:', event.request.url);
                    return response;
                }

                return fetch(event.request)
                    .then(fetchResponse => {
                        if (fetchResponse.status === 200) {
                            caches.open(CACHE_NAME).then(cache => {
                                cache.put(event.request, fetchResponse.clone());
                                console.log('Cached baru:', event.request.url);
                            });
                        }
                        return fetchResponse;
                    })
                    .catch(() => {
                        if (event.request.mode === 'navigate') {
                            return caches.match('/');
                        }
                        return new Response(
                            '<h1>Offline</h1><p>Konten tidak tersedia saat offline.</p>',
                            { status: 503, headers: { 'Content-Type': 'text/html' } }
                        );
                    });
            })
        );
    }
});
`;

// Simpan ke public/service-worker.js
writeFileSync('public/service-worker.js', swTemplate);

console.log('service-worker.js telah diperbarui di public/ dengan daftar aset dan rute');
console.log('Jumlah item di urlsToCache:', allFiles.length);
