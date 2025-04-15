import { existsSync, readdirSync, writeFileSync } from 'fs';
import { join } from 'path';

// Direktori yang akan dipindai
const directories = [
    'public/assets',
    'public/dashboard/assets',
    'storage/app/public'
];

// Ekstensi yang akan di-cache
const allowedExtensions = [
    '.css', '.js', '.png', '.jpg', '.jpeg', '.svg', '.woff', '.woff2', '.ttf', '.eot', '.ico',
    '.pdf' // Untuk file yang diunggah
];

// Fungsi untuk memindai folder secara rekursif
function getFilesRecursively(dir, baseDir = '') {
    let results = [];
    const files = readdirSync(dir, { withFileTypes: true });

    files.forEach(file => {
        const relativePath = join(baseDir, file.name);
        const fullPath = join(dir, file.name);

        if (file.isDirectory()) {
            results = results.concat(getFilesRecursively(fullPath, relativePath));
        } else {
            const ext = file.name.substring(file.name.lastIndexOf('.')).toLowerCase();
            if (allowedExtensions.includes(ext)) {
                let urlPath;
                if (dir.startsWith('storage/app/public')) {
                    // File di storage/app/public diakses via /storage/...
                    urlPath = `/storage/${relativePath.replace(/\\/g, '/')}`;
                } else {
                    // File di public/assets atau public/dashboard/assets
                    urlPath = `/${relativePath.replace(/\\/g, '/')}`;
                }
                urlPath = urlPath.replace(/\/\//g, '/');
                results.push(urlPath);
            }
        }
    });

    return results;
}

// Kumpulkan semua file dari direktori
let allFiles = [];
directories.forEach(dir => {
    if (existsSync(dir)) {
        if (dir.startsWith('storage/app/public')) {
            // Untuk storage, gunakan path relatif dari root
            allFiles = allFiles.concat(getFilesRecursively(dir, ''));
        } else {
            // Untuk public/assets dan public/dashboard/assets
            allFiles = allFiles.concat(getFilesRecursively(dir, dir.replace('public/', '')));
        }
    }
});

// Tambahkan root
allFiles.unshift('/');

// Template untuk service-worker.js
const swTemplate = `
const CACHE_NAME = 'scis-pwa-v1';
const DYNAMIC_CACHE = 'dynamic-cache';
const urlsToCache = ${JSON.stringify(allFiles, null, 2)};

// Install Service Worker
self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(CACHE_NAME).then(cache => {
            console.log('Caching static assets:', urlsToCache);
            return cache.addAll(urlsToCache).catch(error => {
                console.error('Failed to cache static assets:', error);
                throw error;
            });
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
                        return caches.delete(cacheName);
                    }
                })
            );
        }).then(() => self.clients.claim())
    );
});

// Fetch Event
self.addEventListener('fetch', event => {
    if (event.request.url.includes('/api') || event.request.url.includes('/dashboard')) {
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
                        return cachedResponse || new Response(
                            JSON.stringify({ error: 'Offline, no data available' }),
                            { status: 503, headers: { 'Content-Type': 'application/json' } }
                        );
                    });
                })
        );
    } else {
        event.respondWith(
            caches.match(event.request).then(response => {
                return response || fetch(event.request).then(fetchResponse => {
                    if (fetchResponse.status === 200 && event.request.method === 'GET') {
                        caches.open(CACHE_NAME).then(cache => {
                            cache.put(event.request, fetchResponse.clone());
                        });
                    }
                    return fetchResponse;
                });
            })
        );
    }
});
`;

// Simpan ke public/service-worker.js
writeFileSync('public/service-worker.js', swTemplate);

console.log('service-worker.js telah diperbarui di public/ dengan daftar aset');
