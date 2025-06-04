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
    '/dashboards/ppdb-information',
    '/dashboards/ppdb-timeline',
    '/dashboards/ppdb-faq',
    '/dashboards/ppdb-pendaftaran'
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
const DB_NAME = 'offline-requests';
const DB_VERSION = 1;
const STORE_NAME = 'pending-requests';
const urlsToCache = ${JSON.stringify(allFiles, null, 2)};

// Fungsi untuk membuka IndexedDB
function openDB() {
    return new Promise((resolve, reject) => {
        const request = indexedDB.open(DB_NAME, DB_VERSION);
        request.onupgradeneeded = event => {
            const db = event.target.result;
            db.createObjectStore(STORE_NAME, { autoIncrement: true });
        };
        request.onsuccess = event => resolve(event.target.result);
        request.onerror = event => reject(event.target.error);
    });
}

// Fungsi untuk menyimpan permintaan ke IndexedDB
function saveRequest(requestData) {
    return openDB().then(db => {
        const tx = db.transaction(STORE_NAME, 'readwrite');
        const store = tx.objectStore(STORE_NAME);
        return new Promise((resolve, reject) => {
            const req = store.add(requestData);
            req.onsuccess = () => resolve();
            req.onerror = () => reject(req.error);
        });
    });
}

// Fungsi untuk mendapatkan semua permintaan yang tertunda
function getPendingRequests() {
    return openDB().then(db => {
        const tx = db.transaction(STORE_NAME, 'readonly');
        const store = tx.objectStore(STORE_NAME);
        return new Promise((resolve, reject) => {
            const req = store.getAll();
            req.onsuccess = () => resolve(req.result);
            req.onerror = () => reject(req.error);
        });
    });
}

// Fungsi untuk menghapus permintaan yang tertunda
function clearPendingRequest(id) {
    return openDB().then(db => {
        const tx = db.transaction(STORE_NAME, 'readwrite');
        const store = tx.objectStore(STORE_NAME);
        return new Promise((resolve, reject) => {
            const req = store.delete(id);
            req.onsuccess = () => resolve();
            req.onerror = () => reject(req.error);
        });
    });
}

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

    // Tangani permintaan API atau dashboard
    if (requestUrl.pathname.includes('/api') || requestUrl.pathname.includes('/dashboard')) {
        if (event.request.method === 'GET') {
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
        } else if (['POST', 'PUT'].includes(event.request.method)) {
            event.respondWith(
                fetch(event.request)
                    .then(response => {
                        console.log('Permintaan berhasil dikirim:', event.request.url);
                        return response;
                    })
                    .catch(async () => {
                        console.log('Offline, menyimpan permintaan:', event.request.url);
                        const requestData = {
                            url: event.request.url,
                            method: event.request.method,
                            headers: Object.fromEntries(event.request.headers),
                            body: await event.request.text(),
                            timestamp: Date.now()
                        };
                        await saveRequest(requestData);
                        return new Response(
                            JSON.stringify({ status: 'queued', message: 'Permintaan disimpan untuk sinkronisasi' }),
                            { status: 202, headers: { 'Content-Type': 'application/json' } }
                        );
                    })
            );
        }
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
                        if (fetchResponse.status === 200 && event.request.method === 'GET') {
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

// Sync Event untuk menyinkronkan permintaan tertunda
self.addEventListener('sync', event => {
    if (event.tag === 'sync-pending-requests') {
        event.waitUntil(syncPendingRequests());
    }
});

async function syncPendingRequests() {
    try {
        const requests = await getPendingRequests();
        console.log('Sinkronisasi permintaan tertunda:', requests.length);

        for (const [index, req] of requests.entries()) {
            try {
                const response = await fetch(req.url, {
                    method: req.method,
                    headers: req.headers,
                    body: req.body
                });
                if (response.ok) {
                    console.log('Permintaan tersinkronisasi:', req.url);
                    await clearPendingRequest(index);
                } else {
                    console.warn('Gagal menyinkronkan permintaan:', req.url, response.status);
                }
            } catch (error) {
                console.error('Error saat menyinkronkan:', req.url, error);
            }
        }
    } catch (error) {
        console.error('Error selama sinkronisasi:', error);
    }
}
`;

// Simpan ke public/service-worker.js
writeFileSync('public/service-worker.js', swTemplate);

console.log('service-worker.js telah diperbarui di public/ dengan daftar aset dan rute');
console.log('Jumlah item di urlsToCache:', allFiles.length);
