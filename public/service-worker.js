const CACHE_NAME = 'scis-pwa-v1';
const urlsToCache = [
    '/',
    '/assets/img/favicon.png',
    '/assets/img/android-chrome-192x192.png',
    '/assets/img/android-chrome-512x512.png',
    '/assets/css/bootstrap.css',
    '/assets/css/meanmenu.css',
    '/assets/css/animate.css',
    '/assets/css/owl-carousel.css',
    '/assets/css/swiper-bundle.css',
    '/assets/css/backtotop.css',
    '/assets/css/magnific-popup.css',
    '/assets/css/nice-select.css',
    '/assets/css/font-awesome-pro.css',
    '/assets/css/spacing.css',
    '/assets/css/style.css',
    '/assets/js/vendor/jquery.js',
    '/assets/js/vendor/waypoints.js',
    '/assets/js/bootstrap-bundle.js',
    '/assets/js/meanmenu.js',
    '/assets/js/swiper-bundle.js',
    '/assets/js/owl-carousel.js',
    '/assets/js/magnific-popup.js',
    '/assets/js/parallax.js',
    '/assets/js/backtotop.js',
    '/assets/js/nice-select.js',
    '/assets/js/counterup.js',
    '/assets/js/wow.js',
    '/assets/js/isotope-pkgd.js',
    '/assets/js/imagesloaded-pkgd.js',
    '/assets/js/ajax-form.js',
    '/assets/js/main.js',
    '/dashboard/assets/css/bootstrap.min.css',
    '/dashboard/assets/css/metismenu.min.css',
    '/dashboard/assets/css/icons.css',
    '/dashboard/assets/css/style.css',
    '/dashboard/assets/css/morris.css',
    '/dashboard/assets/js/jquery.min.js',
    '/dashboard/assets/js/bootstrap.bundle.min.js',
    '/dashboard/assets/js/metismenu.min.js',
    '/dashboard/assets/js/jquery.slimscroll.js',
    '/dashboard/assets/js/waves.min.js',
    '/dashboard/assets/js/morris.min.js',
    '/dashboard/assets/js/raphael.min.js',
    '/dashboard/assets/js/app.js',
    '/dashboard/assets/pages/dashboard.init.js'
];

// Install Service Worker
self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(CACHE_NAME).then(cache => {
            return cache.addAll(urlsToCache);
        })
    );
});

// Activate Service Worker
self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames.map(cacheName => {
                    if (cacheName !== CACHE_NAME) {
                        return caches.delete(cacheName);
                    }
                })
            );
        })
    );
});

// Fetch Event (Cache First Strategy)
self.addEventListener('fetch', event => {
    event.respondWith(
        caches.match(event.request).then(response => {
            return response || fetch(event.request);
        })
    );
});

self.addEventListener('fetch', event => {
    if (event.request.url.includes('/dashboards') || event.request.url.includes('/')) {
        event.respondWith(
            fetch(event.request)
                .then(response => {
                    const responseClone = response.clone();
                    caches.open('dynamic-cache').then(cache => {
                        cache.put(event.request, responseClone);
                    });
                    return response;
                })
                .catch(() => caches.match(event.request))
        );
    } else {
        event.respondWith(
            caches.match(event.request).then(response => {
                return response || fetch(event.request);
            })
        );
    }
});

self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames.map(cacheName => {
                    if (cacheName !== CACHE_NAME) {
                        return caches.delete(cacheName);
                    }
                })
            );
        }).then(() => self.clients.claim())
    );
});
