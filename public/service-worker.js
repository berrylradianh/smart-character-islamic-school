
const CACHE_NAME = 'scis-pwa-v1';
const DYNAMIC_CACHE = 'dynamic-cache';
const DB_NAME = 'offline-requests';
const DB_VERSION = 1;
const STORE_NAME = 'pending-requests';
const urlsToCache = [
  "/assets/css/animate.css",
  "/assets/css/backtotop.css",
  "/assets/css/bootstrap.css",
  "/assets/css/flaticon.css",
  "/assets/css/font-awesome-pro.css",
  "/assets/css/magnific-popup.css",
  "/assets/css/meanmenu.css",
  "/assets/css/nice-select.css",
  "/assets/css/owl-carousel.css",
  "/assets/css/spacing.css",
  "/assets/css/style.css",
  "/assets/css/swiper-bundle.css",
  "/assets/fonts/fa-brands-400.ttf",
  "/assets/fonts/fa-brands-400.woff2",
  "/assets/fonts/fa-light-300.ttf",
  "/assets/fonts/fa-light-300.woff2",
  "/assets/fonts/fa-regular-400.ttf",
  "/assets/fonts/fa-regular-400.woff2",
  "/assets/fonts/fa-solid-900.ttf",
  "/assets/fonts/fa-solid-900.woff2",
  "/assets/fonts/fa-thin-100.ttf",
  "/assets/fonts/fa-thin-100.woff2",
  "/assets/fonts/fa-v4compatibility.ttf",
  "/assets/fonts/fa-v4compatibility.woff2",
  "/assets/img/about/about-1.jpg",
  "/assets/img/about/about-2.jpg",
  "/assets/img/about/about-3.jpg",
  "/assets/img/about/about-shape-1.png",
  "/assets/img/about/about-shape-2.png",
  "/assets/img/about/about-shape-3.png",
  "/assets/img/about/core-values.png",
  "/assets/img/about/expert.png",
  "/assets/img/about/social-care.png",
  "/assets/img/agenda/agenda-1.png",
  "/assets/img/agenda/agenda-2.png",
  "/assets/img/agenda/agenda-3.png",
  "/assets/img/agenda/agenda-4.png",
  "/assets/img/android-chrome-192x192.png",
  "/assets/img/android-chrome-512x512.png",
  "/assets/img/app/app-shape-1.png",
  "/assets/img/app/app-shape-2.png",
  "/assets/img/app/apple.png",
  "/assets/img/app/google-play.png",
  "/assets/img/apple-touch-icon.png",
  "/assets/img/blog/author/author-1.jpg",
  "/assets/img/blog/author/author-2.jpg",
  "/assets/img/blog/author/author-3.jpg",
  "/assets/img/blog/author/blog-author-1.jpg",
  "/assets/img/blog/banner/banner-1.jpg",
  "/assets/img/blog/blog-1.jpg",
  "/assets/img/blog/blog-2.jpg",
  "/assets/img/blog/blog-3.jpg",
  "/assets/img/blog/blog-big-1.jpg",
  "/assets/img/blog/blog-big-2.jpg",
  "/assets/img/blog/blog-big-3.jpg",
  "/assets/img/blog/blog-big-4.jpg",
  "/assets/img/blog/blog-big-5.jpg",
  "/assets/img/blog/blog-big-6.jpg",
  "/assets/img/blog/blog-big-7.jpg",
  "/assets/img/blog/blog-shape-1.png",
  "/assets/img/blog/blog-shape-2.png",
  "/assets/img/blog/blog-shape-3.png",
  "/assets/img/blog/blog-shape-4.png",
  "/assets/img/blog/comments/comment-1.jpg",
  "/assets/img/blog/comments/comment-2.jpg",
  "/assets/img/blog/comments/comment-3.jpg",
  "/assets/img/blog/quote-1.png",
  "/assets/img/blog/sm/blog-sm-1.jpg",
  "/assets/img/blog/sm/blog-sm-2.jpg",
  "/assets/img/blog/sm/blog-sm-3.jpg",
  "/assets/img/blog/tahfidz-super-camp.png",
  "/assets/img/brand/brand-1.png",
  "/assets/img/brand/brand-2.png",
  "/assets/img/brand/brand-3.png",
  "/assets/img/brand/brand-4.png",
  "/assets/img/brand/brand-5.png",
  "/assets/img/brand/brand-6.png",
  "/assets/img/brand/brand-7.png",
  "/assets/img/brand/kabar-periangan.png",
  "/assets/img/brand/kapol.png",
  "/assets/img/brand/priangan.png",
  "/assets/img/brand/tribunnews.png",
  "/assets/img/breadcrumb/breadcrumb-bg-1.jpg",
  "/assets/img/breadcrumb/page-title-shape-1.png",
  "/assets/img/breadcrumb/page-title-shape-2.png",
  "/assets/img/breadcrumb/page-title-shape-3.png",
  "/assets/img/breadcrumb/page-title-shape-4.png",
  "/assets/img/breadcrumb/page-title-shape-5.png",
  "/assets/img/breadcrumb/page-title-shape-6.png",
  "/assets/img/campus/campus-1.jpg",
  "/assets/img/campus/campus-2.jpg",
  "/assets/img/campus/campus-3.jpg",
  "/assets/img/campus/campus-4.jpg",
  "/assets/img/certificate/certificate.png",
  "/assets/img/course/2/course-1.jpg",
  "/assets/img/course/2/course-2.jpg",
  "/assets/img/course/2/course-3.jpg",
  "/assets/img/course/2/course-4.jpg",
  "/assets/img/course/2/course-5.jpg",
  "/assets/img/course/2/course-6.jpg",
  "/assets/img/course/bg/course-bg.png",
  "/assets/img/course/cart/cart-1.jpg",
  "/assets/img/course/cart/cart-2.jpg",
  "/assets/img/course/cart/cart-3.jpg",
  "/assets/img/course/comment/course-comment-1.jpg",
  "/assets/img/course/comment/course-comment-2.jpg",
  "/assets/img/course/course-1.jpg",
  "/assets/img/course/course-2.jpg",
  "/assets/img/course/course-3.jpg",
  "/assets/img/course/course-4.jpg",
  "/assets/img/course/course-5.jpg",
  "/assets/img/course/course-6.jpg",
  "/assets/img/course/course-dot.png",
  "/assets/img/course/course-sm-1.jpg",
  "/assets/img/course/details/course-details-1.jpg",
  "/assets/img/course/instructor/course-instructor-1.jpg",
  "/assets/img/course/instructor/course-instructor-2.jpg",
  "/assets/img/course/instructor/course-instructor-3.jpg",
  "/assets/img/course/list/course-1.jpg",
  "/assets/img/course/list/course-2.jpg",
  "/assets/img/course/list/course-3.jpg",
  "/assets/img/course/list/course-4.jpg",
  "/assets/img/course/list/course-5.jpg",
  "/assets/img/course/list/course-6.jpg",
  "/assets/img/course/payment/payment-1.png",
  "/assets/img/course/sm/cart-1.jpg",
  "/assets/img/course/sm/cart-2.jpg",
  "/assets/img/course/sm/cart-3.jpg",
  "/assets/img/course/sm/course-sm-1.jpg",
  "/assets/img/course/sm/course-sm-2.jpg",
  "/assets/img/course/sm/course-sm-3.jpg",
  "/assets/img/course/tutor/course-tutor-1.jpg",
  "/assets/img/course/tutor/course-tutor-2.jpg",
  "/assets/img/course/tutor/course-tutor-3.jpg",
  "/assets/img/course/tutor/course-tutor-4.jpg",
  "/assets/img/course/tutor/course-tutor-5.jpg",
  "/assets/img/course/tutor/course-tutor-6.jpg",
  "/assets/img/course/video/course-video.jpg",
  "/assets/img/error/error.png",
  "/assets/img/event/event-person-1.jpg",
  "/assets/img/event/event-person-2.jpg",
  "/assets/img/events/event-1.jpg",
  "/assets/img/events/event-shape-2.png",
  "/assets/img/events/event-shape-3.png",
  "/assets/img/events/events-shape.png",
  "/assets/img/events/sponsor-logo.png",
  "/assets/img/favicon-16x16.png",
  "/assets/img/favicon-32x32.png",
  "/assets/img/favicon.ico",
  "/assets/img/favicon.png",
  "/assets/img/icon/apple-store.png",
  "/assets/img/icon/blog/blog-clock.svg",
  "/assets/img/icon/blog/blog-eye.svg",
  "/assets/img/icon/category/category-1.svg",
  "/assets/img/icon/category/category-2.svg",
  "/assets/img/icon/category/category-3.svg",
  "/assets/img/icon/category/category-4.svg",
  "/assets/img/icon/category/category-5.svg",
  "/assets/img/icon/category/category-6.svg",
  "/assets/img/icon/category/category-7.svg",
  "/assets/img/icon/category/category-8.svg",
  "/assets/img/icon/category/category-9.svg",
  "/assets/img/icon/counter/counter-book.svg",
  "/assets/img/icon/counter/counter-globe.svg",
  "/assets/img/icon/counter/counter-monitor.svg",
  "/assets/img/icon/counter/counter-user.svg",
  "/assets/img/icon/course/course-book-2.svg",
  "/assets/img/icon/course/course-book-3.svg",
  "/assets/img/icon/course/course-book.svg",
  "/assets/img/icon/course/course-eye.svg",
  "/assets/img/icon/course/course-fire.svg",
  "/assets/img/icon/course/course-label.svg",
  "/assets/img/icon/course/course-paint.svg",
  "/assets/img/icon/course/course-star-2.svg",
  "/assets/img/icon/course/course-star.svg",
  "/assets/img/icon/course/course-user.svg",
  "/assets/img/icon/course/course-usr-2.svg",
  "/assets/img/icon/cta/cta-cap.svg",
  "/assets/img/icon/cta/cta-user.svg",
  "/assets/img/icon/event/event-clock.svg",
  "/assets/img/icon/event/event-location.svg",
  "/assets/img/icon/features/book.svg",
  "/assets/img/icon/features/graduation.svg",
  "/assets/img/icon/features/university.svg",
  "/assets/img/icon/flash.svg",
  "/assets/img/icon/google-play-store.png",
  "/assets/img/icon/header/header-call.svg",
  "/assets/img/icon/header/header-dot-menu.svg",
  "/assets/img/icon/header/header-home.svg",
  "/assets/img/icon/header/header-location.svg",
  "/assets/img/icon/header/header-mail.svg",
  "/assets/img/icon/header/header-search-2.svg",
  "/assets/img/icon/header/header-search.svg",
  "/assets/img/icon/header/header-user-2.svg",
  "/assets/img/icon/header/header-user.svg",
  "/assets/img/icon/menu.svg",
  "/assets/img/icon/play-2.svg",
  "/assets/img/icon/play.svg",
  "/assets/img/icon/research/research-monitor-mobile.svg",
  "/assets/img/icon/research/research-monitor-video.svg",
  "/assets/img/icon/research/research-video.svg",
  "/assets/img/icon/sign/circle.png",
  "/assets/img/icon/sign/dot.png",
  "/assets/img/icon/sign/flower.png",
  "/assets/img/icon/sign/man-1.png",
  "/assets/img/icon/sign/man-2.png",
  "/assets/img/icon/sign/man-3.png",
  "/assets/img/icon/sign/sign-up.png",
  "/assets/img/icon/sign/zigzag.png",
  "/assets/img/icon/slider/slider-search.svg",
  "/assets/img/icon/star-2.svg",
  "/assets/img/icon/star.svg",
  "/assets/img/lantern.png",
  "/assets/img/logo/logo-name.png",
  "/assets/img/logo/logo-white.png",
  "/assets/img/logo/logo.png",
  "/assets/img/moon.png",
  "/assets/img/news/news-1.png",
  "/assets/img/news/news-2.png",
  "/assets/img/news/news-3.png",
  "/assets/img/news/news-4.png",
  "/assets/img/news/news-5.png",
  "/assets/img/news/news-6.png",
  "/assets/img/ppdb.png",
  "/assets/img/price/price-shape.png",
  "/assets/img/price/price-thumb.png",
  "/assets/img/profile/profile-img.jpg",
  "/assets/img/program/program-1.png",
  "/assets/img/program/program-2.png",
  "/assets/img/program/program-3.png",
  "/assets/img/program.png",
  "/assets/img/research/2/research-1.png",
  "/assets/img/research/2/research-bg.jpg",
  "/assets/img/research/research-1.jpg",
  "/assets/img/research/research-2.jpg",
  "/assets/img/research/research-3.jpg",
  "/assets/img/research/research-shape-1.png",
  "/assets/img/research/research-shape-2.png",
  "/assets/img/research/research-shape-3.png",
  "/assets/img/resource.png",
  "/assets/img/slider/2/shape/slider-cap-1.png",
  "/assets/img/slider/2/shape/slider-cap-2.png",
  "/assets/img/slider/2/shape/slider-cap-3.png",
  "/assets/img/slider/2/shape/slider-shape-1.jpg",
  "/assets/img/slider/2/shape/slider-shape-2.jpg",
  "/assets/img/slider/2/slider-2-bg.jpg",
  "/assets/img/slider/2/slider-thumb.png",
  "/assets/img/slider/3/slider-1.jpg",
  "/assets/img/slider/3/slider-2.jpg",
  "/assets/img/slider/slider-1.png",
  "/assets/img/slider/slider-2.png",
  "/assets/img/student.png",
  "/assets/img/team/details/shape/shape-1.png",
  "/assets/img/team/details/shape/shape-2.png",
  "/assets/img/team/details/teacer-details-1.jpg",
  "/assets/img/team/team-1.png",
  "/assets/img/team/team-2.png",
  "/assets/img/team/team-3.png",
  "/assets/img/team/team-4.png",
  "/assets/img/team/team-shape-1.png",
  "/assets/img/team/team-shape-2.png",
  "/assets/img/team/team-shape-3.png",
  "/assets/img/team/team-shape-4.png",
  "/assets/img/testimonial/testimonial-1.jpg",
  "/assets/img/testimonial/testimonial-2.jpg",
  "/assets/img/testimonial/testimonial-3.jpg",
  "/assets/img/testimonial/testimonial-4.jpg",
  "/assets/img/visi dan misi.png",
  "/assets/js/ajax-form.js",
  "/assets/js/backtotop.js",
  "/assets/js/bootstrap-bundle.js",
  "/assets/js/counterup.js",
  "/assets/js/imagesloaded-pkgd.js",
  "/assets/js/isotope-pkgd.js",
  "/assets/js/magnific-popup.js",
  "/assets/js/main.js",
  "/assets/js/meanmenu.js",
  "/assets/js/nice-select.js",
  "/assets/js/owl-carousel.js",
  "/assets/js/parallax.js",
  "/assets/js/swiper-bundle.js",
  "/assets/js/vendor/jquery.js",
  "/assets/js/vendor/waypoints.js",
  "/assets/js/wow.js",
  "/dashboard/assets/css/bootstrap.min.css",
  "/dashboard/assets/css/icons.css",
  "/dashboard/assets/css/metismenu.min.css",
  "/dashboard/assets/css/morris.css",
  "/dashboard/assets/css/style.css",
  "/dashboard/assets/css/summernote.min.css",
  "/dashboard/assets/fonts/fa-brands-400.eot",
  "/dashboard/assets/fonts/fa-brands-400.svg",
  "/dashboard/assets/fonts/fa-brands-400.ttf",
  "/dashboard/assets/fonts/fa-brands-400.woff",
  "/dashboard/assets/fonts/fa-brands-400.woff2",
  "/dashboard/assets/fonts/fa-regular-400.eot",
  "/dashboard/assets/fonts/fa-regular-400.svg",
  "/dashboard/assets/fonts/fa-regular-400.ttf",
  "/dashboard/assets/fonts/fa-regular-400.woff",
  "/dashboard/assets/fonts/fa-regular-400.woff2",
  "/dashboard/assets/fonts/fa-solid-900.eot",
  "/dashboard/assets/fonts/fa-solid-900.svg",
  "/dashboard/assets/fonts/fa-solid-900.ttf",
  "/dashboard/assets/fonts/fa-solid-900.woff",
  "/dashboard/assets/fonts/fa-solid-900.woff2",
  "/dashboard/assets/fonts/materialdesignicons-webfont.eot",
  "/dashboard/assets/fonts/materialdesignicons-webfont.svg",
  "/dashboard/assets/fonts/materialdesignicons-webfont.ttf",
  "/dashboard/assets/fonts/materialdesignicons-webfont.woff",
  "/dashboard/assets/fonts/materialdesignicons-webfont.woff2",
  "/dashboard/assets/fonts/outlined-iconset.eot",
  "/dashboard/assets/fonts/outlined-iconset.svg",
  "/dashboard/assets/fonts/outlined-iconset.ttf",
  "/dashboard/assets/fonts/outlined-iconset.woff",
  "/dashboard/assets/fonts/themify.eot",
  "/dashboard/assets/fonts/themify.svg",
  "/dashboard/assets/fonts/themify.ttf",
  "/dashboard/assets/fonts/themify.woff",
  "/dashboard/assets/images/alumni.png",
  "/dashboard/assets/images/error.png",
  "/dashboard/assets/images/favicon.ico",
  "/dashboard/assets/images/flags/french_flag.jpg",
  "/dashboard/assets/images/flags/germany_flag.jpg",
  "/dashboard/assets/images/flags/italy_flag.jpg",
  "/dashboard/assets/images/flags/russia_flag.jpg",
  "/dashboard/assets/images/flags/spain_flag.jpg",
  "/dashboard/assets/images/flags/us_flag.jpg",
  "/dashboard/assets/images/logo-dark.png",
  "/dashboard/assets/images/logo-light.png",
  "/dashboard/assets/images/maintenance-img.png",
  "/dashboard/assets/images/pendaftar.png",
  "/dashboard/assets/images/restaurant.png",
  "/dashboard/assets/images/small/img-1.jpg",
  "/dashboard/assets/images/small/img-2.jpg",
  "/dashboard/assets/images/small/img-3.jpg",
  "/dashboard/assets/images/small/img-4.jpg",
  "/dashboard/assets/images/small/img-5.jpg",
  "/dashboard/assets/images/small/img-6.jpg",
  "/dashboard/assets/images/small/img-7.jpg",
  "/dashboard/assets/images/staff.png",
  "/dashboard/assets/images/student.png",
  "/dashboard/assets/images/users/user-1.jpg",
  "/dashboard/assets/images/users/user-10.jpg",
  "/dashboard/assets/images/users/user-2.jpg",
  "/dashboard/assets/images/users/user-3.jpg",
  "/dashboard/assets/images/users/user-4.jpg",
  "/dashboard/assets/images/users/user-5.jpg",
  "/dashboard/assets/images/users/user-6.jpg",
  "/dashboard/assets/images/users/user-7.jpg",
  "/dashboard/assets/images/users/user-8.jpg",
  "/dashboard/assets/images/users/user-9.jpg",
  "/dashboard/assets/images/users/user_default.jpg",
  "/dashboard/assets/js/app.js",
  "/dashboard/assets/js/bootstrap.bundle.min.js",
  "/dashboard/assets/js/jquery.min.js",
  "/dashboard/assets/js/jquery.slimscroll.js",
  "/dashboard/assets/js/metismenu.min.js",
  "/dashboard/assets/js/morris.min.js",
  "/dashboard/assets/js/raphael.min.js",
  "/dashboard/assets/js/summernote.min.js",
  "/dashboard/assets/js/waves.min.js",
  "/dashboard/assets/pages/alertify-init.js",
  "/dashboard/assets/pages/apexcharts.init.js",
  "/dashboard/assets/pages/c3-chart-init.js",
  "/dashboard/assets/pages/calendar-init.js",
  "/dashboard/assets/pages/chartist.init.js",
  "/dashboard/assets/pages/chartjs.init.js",
  "/dashboard/assets/pages/countdown.int.js",
  "/dashboard/assets/pages/dashboard.init.js",
  "/dashboard/assets/pages/datatables.init.js",
  "/dashboard/assets/pages/echart.int.js",
  "/dashboard/assets/pages/flot.init.js",
  "/dashboard/assets/pages/form-advanced.init.js",
  "/dashboard/assets/pages/form-advanced.js",
  "/dashboard/assets/pages/form-editors.int.js",
  "/dashboard/assets/pages/form-validation.init.js",
  "/dashboard/assets/pages/form-wizard.init.js",
  "/dashboard/assets/pages/gmaps.js",
  "/dashboard/assets/pages/jvectormap.init.js",
  "/dashboard/assets/pages/lightbox.js",
  "/dashboard/assets/pages/morris.init.js",
  "/dashboard/assets/pages/nestable-init.js",
  "/dashboard/assets/pages/rangeslider-init.js",
  "/dashboard/assets/pages/rangeslider.init.js",
  "/dashboard/assets/pages/rating-init.js",
  "/dashboard/assets/pages/sparklines.init.js",
  "/dashboard/assets/pages/sweet-alert.init.js",
  "/dashboard/assets/pages/table-editable.int.js",
  "/dashboard/assets/pages/table-responsive.init.js",
  "/dashboard/assets/pages/xeditable.js",
  "/storage/agenda_images/3znYfhVGulmucfvh1XTJmcwJGR3bxk5CM9r3U5WP.png",
  "/storage/agenda_images/5c2Utd5nv1aSfFxsQkqk6dnCV96fXshbZw37XwZN.jpg",
  "/storage/agenda_images/CdM2a325QbZct8akdQuTNqDBFcrJqjDjSS6TWx7H.png",
  "/storage/agenda_images/MZ1ic6DECi5mRGdaELlMkcuS9D3H5EzZtmJIGdYK.jpg",
  "/storage/agenda_images/TkkCbD1Ce2tm4wMBFfs28TrzcQoxXx25Xl299Nwb.jpg",
  "/storage/agenda_images/ZhLyXP4jjMA0OjFHRyRaq3E1cUZIx6exw1B6lPed.png",
  "/storage/agenda_images/bExRQ6cCMzM2ZGGN2qBLFW3GCoVjkmRNY0waL43u.png",
  "/storage/agenda_images/csavs1aCEqAO5Ew0tXTwGhDJaHQB1lGc5lgzuHeZ.png",
  "/storage/agenda_images/nT2dLXQrRtfmV2byK9a6h6EV6VKO6vogrtoCI8Qa.jpg",
  "/storage/agenda_images/osTkqIklFUjoYyLUyxFT5xkElEJOvf3rqcGnx2Hd.png",
  "/storage/agenda_images/pz0j5uWc4CyF03r6BW60JPbSA6xoBtyHAyGSrMj9.png",
  "/storage/agenda_images/ujR6Mhc2fLu13W5cVAyCFgVqzQgMHA0c5RC0ozIs.jpg",
  "/storage/dashboard/icons/a5ITMGR0WEKjzKHV4bRt6A3l1gX9a4hfov4FSavv.png",
  "/storage/dashboard/icons/alumni.png",
  "/storage/dashboard/icons/cUwmL6jYEX1k08D73WLDirmHggl45ioN2nxtKCkU.jpg",
  "/storage/dashboard/icons/pendaftar.png",
  "/storage/dashboard/icons/staff.png",
  "/storage/dashboard/icons/student.png",
  "/storage/documents/akta/9DCGHaNf4Q6aKl0tT1yUnK1DiJOqlY9IDCHJloAa.jpg",
  "/storage/documents/akta/DT5Ph36qMqrY4pVeYapToGniRgSImDQFt73vLXKD.png",
  "/storage/documents/akta/EdxI1CUVy9jdUB6ecQ7ve1ZvKL75xuOsWT9ZVv3G.pdf",
  "/storage/documents/akta/WEQD5h0KFnrdADckIPFWm3qsQWgIjAew6K2YSfPY.png",
  "/storage/documents/akta/biklu4zxtKp9As9fx39U1NPog7VEx1Rm01vQ12os.pdf",
  "/storage/documents/akta/bmU5q2v7hmG0cGYVFpXsnDhgT5ah6NhTsDZ9oV7E.pdf",
  "/storage/documents/akta/cZYyTRtcmn0HQMwJDuQBZoRqXIpxr3tidy7vajpe.jpg",
  "/storage/documents/akta/d6NIEWejF5DvAQSHUXKveWdyyNzVITtJYhxixS8M.jpg",
  "/storage/documents/akta/qEIZ33GiqgDt6C7kEE6DsMH2QrTB33VMazOLHGQu.pdf",
  "/storage/documents/akta/vYUZAP67bHCacIDoFyUySqyiLQSq2AdVF6dsVkmY.png",
  "/storage/documents/akta/zOPr6QpMrIyvMRsYOBckWREME6Qc8Vs1viokspxw.pdf",
  "/storage/documents/ijazah_sd/0NsCKl5FXQafQ7VshtLCBxBQCJLvt0f0YAy4MnuO.pdf",
  "/storage/documents/ijazah_sd/5FpohampwKVm4wKuUAiqsxWegsB4XvtTCXnF6YA9.png",
  "/storage/documents/ijazah_sd/A2JtegiX4ox1WFUhn3cuNNWU0AiI3QzgYWise3Ei.pdf",
  "/storage/documents/ijazah_sd/LIlze6LRJZZh6xoUkDuthtaSLGxieULl8vbF2x9v.jpg",
  "/storage/documents/ijazah_sd/M2YuneHLo4EOjv1pEh2bvifIW9xl9wxzMQgklSG9.pdf",
  "/storage/documents/ijazah_sd/PavPWL3jgS7hLfnmwLlCtXArwWAHrymHuZbtBhc7.pdf",
  "/storage/documents/ijazah_sd/RoJt8wPfJtVSLO8PiO4kI5XwuzK1719ihQKEu8DQ.png",
  "/storage/documents/ijazah_sd/UtWueJqhoqg7wHnrOTK4E3pi3h7lbvJC33iMrGQe.png",
  "/storage/documents/ijazah_sd/b0M1Lzc5jExktDyZSHBGpdRkPEsnLWAEAgsBcsiF.pdf",
  "/storage/documents/ijazah_sd/qnUu5GG2pxGO8nALknzSi6iZezGYkLUjIR3pvo75.png",
  "/storage/documents/ijazah_sma/GNHC6BxQFKR3JqDV6pbBQZlwaTXxYujIwxpN3oZh.png",
  "/storage/documents/ijazah_smp/Qn6NXKIvsTJ6AosD6AAAn4OsqINXlv663fZ0qBOH.png",
  "/storage/documents/ijazah_smp/Xbo5G7maLTFgTeYO879aP9M4blAeuhB38Gmr1oEU.jpg",
  "/storage/documents/ijazah_smp/oazxc3mPIhoIDwg12jpYQcf7f3sih4y7RBxz7fLz.png",
  "/storage/documents/kk/0az9tjTBp4A5DsVJdwKwfdYgjWMfpcZbG0VTzoj7.jpg",
  "/storage/documents/kk/7exfu6qdzvVnwJQoVnWb6rNZ6BJLSwc9CqxH4rqa.png",
  "/storage/documents/kk/7tAGfhbB4umiWGfIRkJ8J3SSGFY6alBRMGi9mNY4.pdf",
  "/storage/documents/kk/Ee5H3sgdhzHsb0EgVdRItpj2f85SbZXcsVa1mbWN.jpg",
  "/storage/documents/kk/JgAbf3YmeVG0SSCykc2zwJK63yUlQIbI2dBP61L6.pdf",
  "/storage/documents/kk/Kw3ned5lnDvDpshyqzGwRoCW240C2Dqi1WLpaH4c.pdf",
  "/storage/documents/kk/Mb4Qeiw7nZ0ROqlDmYhwPjAee4GUbQPle19KOOJq.pdf",
  "/storage/documents/kk/QAdAh2cy0xBMnXufribMC93Ag35WeHlzCnONAUG8.jpg",
  "/storage/documents/kk/S34skc42jtxs0Eoow5G6fzN71Qr3nukFhlcm10rh.jpg",
  "/storage/documents/kk/iWGdC6ikUsEcF61Q3HpPNosOhAagIgMBER8JfkRV.pdf",
  "/storage/documents/kk/zPNyx8GHkGgGRxW8428HSZdIwCUTz2kcNxnAoxSR.jpg",
  "/storage/documents/pasfoto/5YiI4k68vXPbRAL0fB20BLGGvFHWxTUJcDEjkssq.jpg",
  "/storage/documents/pasfoto/6QVCm38a87qxl8bLTQQ07I2xLsTrDbyNBjoAgu0U.jpg",
  "/storage/documents/pasfoto/BrZeTONUyGIcVl5cKY2UXyw4kQeNpfd7VKUuk3hK.png",
  "/storage/documents/pasfoto/C2OtFR0FZ5mzO154anS8EoKZbtqRjpFoqAakhuK7.png",
  "/storage/documents/pasfoto/DhzrNzMd2S9cM6Ea40TsErjptBmU3bSs9683bV1f.png",
  "/storage/documents/pasfoto/Dr1MtiZd0pKWhMYuF0rheJcYQ3ANjHYkqoH7vqQW.jpg",
  "/storage/documents/pasfoto/NnVGMqY7nQbY4YSjxIHyspEkugOe7wQy7A9JKf79.jpg",
  "/storage/documents/pasfoto/O5FFoBGK9vAIdylBey99TRF0rf2PhMcDzrQr12Tn.jpg",
  "/storage/documents/pasfoto/QkhOGDmHPu7Gs3HlBe9ZGUMbmWTFVnf47ZEmHCrh.jpg",
  "/storage/documents/pasfoto/UGq4FyN6CRMtN1Bfx3MvAU3mHUxqL06J6RY0EN7b.jpg",
  "/storage/documents/pasfoto/gCj8JmGO7FEcrGQ2Mjy6vHwFLXOsJAEotDXwXDHN.jpg",
  "/storage/documents/pasfoto/laxvyHIYzXnMEl2on3pVmmhGDLnubrx5y8bZ6JZ4.jpg",
  "/storage/documents/pasfoto/pRt7wLznC5BBCZCoJDCV33SRylXtNDZz6V1dbKnR.png",
  "/storage/documents/pasfoto/wcUrUY3tRUskB7BsFn3F9lM46dncLGQNWRZMkTuY.jpg",
  "/storage/documents/piagam/9rWju1agFXaGtB3b5faYfdpRy1gSwrf8JVAW5XPy.jpg",
  "/storage/documents/piagam/FyXxHozC68sssgzzenIycSIVOYR3MTPbdMgKYsc7.jpg",
  "/storage/documents/piagam/JIX6TohN9hWU9ca1fqvrzTsr1o75yA9MkJ4oeyme.png",
  "/storage/documents/piagam/JVgj9oC94LDl4YZI8zwkEyqby0tyLMJMR9oc8fgB.png",
  "/storage/documents/piagam/OLHxtppaUc0fXew5spXdHyLWMFDEiue0sK5WgbX7.png",
  "/storage/documents/piagam/OaYsHopg5IKzq8OBfehwNMLY3lXexKpBqfm0XsQY.pdf",
  "/storage/documents/piagam/VjSwfWdNCkLB7UWIcGnUIbRDwlB7q5eL4XGGk5zR.png",
  "/storage/documents/piagam/Vy0Lh84tK6P5Cyyd2ag9wkQdyTNRVXNm84XdULzB.jpg",
  "/storage/documents/piagam/czD7AkvOrugAxoNNpugX9mtDPIPgfHfOLyeMpAQ6.jpg",
  "/storage/documents/piagam/gT2zybN3oHutkO5e3neEd0tFyzPuO8zE12YS1bwr.png",
  "/storage/documents/piagam/ksXfCD6w5Q5OG4RHlOMXgGlZX15llZFwiPGRn20Y.jpg",
  "/storage/heroes/5FuQ6fQXCXN9ahR3tlM3Upi3FfJiHcfSSMS7vigk.jpg",
  "/storage/heroes/8zdfXpVvqmvhgI8VRENA1OaZDcsG5ZrwkM0Plo2Z.png",
  "/storage/heroes/DFzjinNxcPEOB1B6MUArXcxTArCyLXo27rwd4eqC.jpg",
  "/storage/heroes/JeCuU4tN9u87z2s7F2utgOIMzUXzn5tX4o627tOn.jpg",
  "/storage/heroes/MSMRgZpSWcdCQClv7oDbTScYZbMrqovcIVkRIyiU.png",
  "/storage/heroes/UjRTKETALnIhfWeJFclVYJjlCaBisBL8WASRj5Mt.png",
  "/storage/heroes/VnyzWUooeQ1om8UPWFl67sWHLIJ6OYVIc4kD3h1s.jpg",
  "/storage/heroes/WC9dL05W5ukUoHpdlSVKT0kJjV8MwHhmnIfcAlHe.png",
  "/storage/heroes/We286KAUeNbKsWsoItOMh5DZQ2Y55P9uLgAuPZWK.png",
  "/storage/heroes/dafcXTSYI4Grr3yi7pBSfjFKOOpwpNsZG0M2uEbk.png",
  "/storage/heroes/fzHDT7BJGJglturvw4sRwB3jPCjWKGm6tnINzV37.png",
  "/storage/heroes/kgvJzCW21KXsulkHIekWevhqSeIwYO5HWMCqte96.jpg",
  "/storage/heroes/x2GSPnoWJCHWkqF1IkW8YjzQf23qegEQC5oz0klI.jpg",
  "/storage/heroes/zw2z3cNuqAjdgLXbWFL6N78qOO5iXvZdvZnHwjkb.jpg",
  "/storage/introductions/vCjq8CqLDnz7fKi2XrTfqcgDOvI7nuvSSCDwQBLV.png",
  "/storage/introductions/yNjjFYGNS737zsinE1euUgI0XNgT61RKiny29cdw.png",
  "/storage/media_images/HuhGa1OL6O6A4WV3KKgzFNybRvdf9P3EKwQp1XtB.png",
  "/storage/media_images/PtsNMebSvIizWzvcwA5TdNT5SjqpFd800UzTouBN.png",
  "/storage/media_images/dxaWRgjb0gZWEfXCEhqk139mSgbuOhPmsheeEEOx.png",
  "/storage/media_images/kabar-periangan.png",
  "/storage/media_images/kapol.png",
  "/storage/media_images/priangan.png",
  "/storage/media_images/rKpNl38NUz9dW4DlG4DTK9v3BmjLh7y9zw8FHCkp.png",
  "/storage/media_images/tribunnews.png",
  "/storage/media_images/yBOlOeO0N3Wq3TQ0yCLL3FleXA6IaEBxCqQ4U9n5.jpg",
  "/storage/news_images/0MDxtngI0sKGh1JW8Wcyp8eZoXaRTowyxjt1ef6o.jpg",
  "/storage/news_images/2lZ89aQG3bfD1z4aAozPqPftB7QPf41mbedsEcqG.jpg",
  "/storage/news_images/EiTz3jgQfBCHsaKe1vGYlrLyuMWahNRKQUDit2x2.png",
  "/storage/news_images/IuGcP3YPPux8FPs5SQu3dOjPCzvQS4Vb3nO2zqem.jpg",
  "/storage/news_images/UZrZxg3igt7Y8igDSd29EkJjJ7wKPRo3rEyAlQE9.png",
  "/storage/news_images/XtknJov4OzEecZIjINcSnY6u2psbaDmsNSdwUyYV.png",
  "/storage/news_images/g8mijuFPkBjeClwkjGUp5MaJaWLT164BItUE2DG3.jpg",
  "/storage/news_images/hZNWqe2idTf9mPt0S8KtrYmg0BGTzaZP2omUTh35.jpg",
  "/storage/news_images/hhLTU6PayTGsDVjns9BlGmkwbzyltHKWTz11P0yh.png",
  "/storage/news_images/ovtZ8BCEA9r5CX8qlCzAoSQBKjIpNH10kJZFeXih.jpg",
  "/storage/news_images/zEyYBliiGSNoF6zyhvKwAyE3THjl5OiTsPUcgsnE.jpg",
  "/storage/ppdb_images/ppdb.png",
  "/storage/profile_images/ims42nLndrb36V6Cfx3eHXqSKoqph6Ee65eZHy00.png",
  "/storage/profile_images/program-1.png",
  "/storage/program_images/4j3O36LYbLtfT3O6mu3nXsKBmjpZzZlEb4njp5ok.png",
  "/storage/program_images/7Y4UC1wclJTo1txvSExtadUZ3XC6Uz6vRCQHxCmw.png",
  "/storage/program_images/8LFS2iyzutob9qGuXPPS7r5BDm2ppu7cu4JDRKkh.png",
  "/storage/program_images/IsBJ4lCE8q8OfCXfIQEv3x9b8nVzBUcquS9xgudw.png",
  "/storage/program_images/NDX4FuGKxSMwVBA8kxcjvqW4zXBiEYsHkl3wFYEh.png",
  "/storage/program_images/VknnBtHFmk0qB9NMHZEBFF7GekYZGNoxe7ulCSTz.jpg",
  "/storage/program_images/ZUl44jnjgzlD1j4m9s2hVuwGGhsKFPTTvqyZul0U.png",
  "/storage/program_images/k3RnGGd1T2rLzroLziVYdPbmlVdgD65SZcFCIe5N.png",
  "/storage/program_images/pFbhlcIQxKDFdnFh4sjnqc0tlcl2AigsgVebtySN.png",
  "/storage/program_images/yJsjJYc7LWS5XmtygHF4cGlO5ts9IcejlxJSXl36.png",
  "/storage/registrations/0L9xgfhcTVCLIaPn64x5devxChLQfxJpwNyWuBQK.pdf",
  "/storage/registrations/0UyaiNOv768hYYiAztp3TT44TYfuTrMdZAPxjAu1.jpg",
  "/storage/registrations/0xHZjnaq8fJKxIcZYroEa1MI33K3rg7Z5n38ARq3.pdf",
  "/storage/registrations/5Bx5yaSZ8yjDjdCxdC4Nfq24w0ccgtio2BJUdUUA.pdf",
  "/storage/registrations/6XEpgE39XMC9RzHI2kR8eBiCFrhsWCjuYOXGKHCo.jpg",
  "/storage/registrations/6llGjZzyutAJxUEXisGnY2U6NewB2BXm5SzfKNeF.pdf",
  "/storage/registrations/8us3qFoCNZSmen2gch2bmO16uCYkj3hyvjU0duvw.pdf",
  "/storage/registrations/AJ247RZ8nkVAN8D4SvX1EYqv7oAroANkgLws70E8.pdf",
  "/storage/registrations/AMTCIAuV07Tc01bbnGIRIQMYYG37YQDdVsDO2uPa.jpg",
  "/storage/registrations/CWZxXBzAPL5DFmClQCjQKYgCcUb3uxEpKtKhItrz.png",
  "/storage/registrations/DozPMsQHpemSUMhUyCILDmHEauPaNJeWCowzXEjR.pdf",
  "/storage/registrations/HNi6DcZ4KvBEDrq8mRgtjqPGQQu10T9q4Fa8v7aR.pdf",
  "/storage/registrations/HoTxH97ObW6LL0WRMPvCRoNJ0iLpheDrJVzICo0i.pdf",
  "/storage/registrations/I1iQR5i7J57RDlZ9vFm1gp1LrdDP3w2NFmMnHQRT.pdf",
  "/storage/registrations/Kmlt5gKrwbp5mJpBrKuGUVYXDBmWPDSKvWVOxt1Q.jpg",
  "/storage/registrations/L1x4Is96dOI7ltAHyqhoziUqgPf5kaD3MukUqLQj.png",
  "/storage/registrations/LEckrrv2WrMW4zlF9hv7OqWND34ZMx4CAjzLsA0x.png",
  "/storage/registrations/LfpJmRFTmBsEHL4OxkPX4EsAtrsjdMj6NYLLzIxv.pdf",
  "/storage/registrations/Mx2Qh6Z01mnQMLmEXuCoqWdaPtU77lW8wZOHGKKa.pdf",
  "/storage/registrations/Nty6cRz3MabO0HcNTpG0ZhB5slvl60r2Wt2Oj03L.png",
  "/storage/registrations/O6fc2itlJ06FcYNZAylzu6mpQfKaEZrpEbfgnJfQ.pdf",
  "/storage/registrations/PCu4aVNrdVEch12TgrSXuVREHHYcDrNom3HnqPGx.png",
  "/storage/registrations/PPgfFmTBMO47PHZTMhmNuayphUKoW3sFSQ7W9dxs.pdf",
  "/storage/registrations/RMD1D6ottDU7YZYpRGwmaJiYfz7OaJcrIT0C7pJI.png",
  "/storage/registrations/RPQc32rmUbLKOFvRt8jqBjejXJpHP8ZTwDOqb9EZ.png",
  "/storage/registrations/RPsWn91Dmb7C3Xg151Ro7lA6NuVhKh39nDbLBDZP.jpg",
  "/storage/registrations/RlB9kAD83aYjzjLkkueVxXzExyfgzg52EHmRK0bb.jpg",
  "/storage/registrations/SXZt6GnpjqDiWwbNE9rhv0ZIhEUiBDmhqVTbpmsb.jpg",
  "/storage/registrations/SqzuaKbH7YZKiZilBnjpOl6pnQL2s1PVZ4ycoKEm.jpg",
  "/storage/registrations/TPDsA6PbaFD9LvXafZSh25aSvamoD6PBXZfYhwSE.png",
  "/storage/registrations/Tb4nFLXjGvQUnAQmKNHJyyTGjuxzipRdkK7H0m4R.pdf",
  "/storage/registrations/TzIcHfKr5Ojo43J2pItksnHeGTNYmAbHFiraeWvN.pdf",
  "/storage/registrations/UDnA3kEXcoQQXl4NDaGI156SMaxe3PXwKb4lA3Nd.png",
  "/storage/registrations/UNHtBUbnmB5gaOOh369e2gLsniEOwy3cUZLhx0ik.pdf",
  "/storage/registrations/V6FLH4W7yws0ctch1PXS3Q4sne2DXZ6sqvOpvQwk.jpg",
  "/storage/registrations/Z0HWMUaoaAoiT4ynNfm1kk2TvQtCEPXJ4x7sfoxZ.jpg",
  "/storage/registrations/Z5PVxmYZZvM7AAQKp1pKiY5ziDfIZSwFiBmW4KRo.png",
  "/storage/registrations/aVXvy38AY6EU4DjPd7kGr55QRes2QVJEZ4Lq1mhx.pdf",
  "/storage/registrations/akta/1fGx3ZK6DdBOEAOJIIqVjVPKSLCkq3TQj0Q9VfXf.jpg",
  "/storage/registrations/akta/2pdFFejAOGt24z9mH0nxgnpGLG54feqbIIah8jEg.jpg",
  "/storage/registrations/akta/FBJJof8WjCDApMM1IXHZbetREY9lpizyiLK7mGlC.jpg",
  "/storage/registrations/akta/d6VsC0N7OgbP6H3SlLieVNSQbQkzqBVTS9crC2SS.png",
  "/storage/registrations/akta/jyrJSicZOU3mdOQ9uBYwoGFx2jDUX0p5suZYjXg6.png",
  "/storage/registrations/akta/l905MoCKcKt70YWGhfGpcqmiV3hs3Hy93nls0SVb.jpg",
  "/storage/registrations/akta/n0QXsZ6DJi5Qjfm4pflpuxhfucToDQKC56sjPkcj.jpg",
  "/storage/registrations/bukti_pembayaran/7OStwWjVaq8aFtXRNFJrtCyAKBaYwyPmUqMssVai.jpg",
  "/storage/registrations/bukti_pembayaran/CUKYlbX1gKMkHpgbOft9MUupae24nFaQssUbvGER.pdf",
  "/storage/registrations/bukti_pembayaran/D3jYu5ki9v3ldcQd4B9hx5Oi1Eti36fKqjhtoehO.png",
  "/storage/registrations/bukti_pembayaran/NiGSmCAzEw8m6x4DJyLbdirhNaiVsl79tfh3emDy.pdf",
  "/storage/registrations/bukti_pembayaran/TVB8VVfwEprHmHWb0yGzz84QXxMGn7hAs60jUvdN.jpg",
  "/storage/registrations/bukti_pembayaran/YMf93vtfFDgiCXs0cDJMu16dq6iuo88qAtpBQfmd.pdf",
  "/storage/registrations/bukti_pembayaran/a8AvVkofwGksEdEasYZD2GNoVwmt1h9SDaf3c15U.jpg",
  "/storage/registrations/bukti_pembayaran/aK1qJgzTGJtNabgFc88GSKPz0BUvVBMrHIhLCSMR.png",
  "/storage/registrations/bukti_pembayaran/cAK1d2f0BYZvIE3Cpil9093JyMzqJCILQ31YF8iZ.jpg",
  "/storage/registrations/bukti_pembayaran/kdpH1KATJAJQyaIwynNgfPQaikzZOFyf6WPRuqhP.jpg",
  "/storage/registrations/bukti_pembayaran/kilMPPGcEiGvh7btYX5crZMpdgdKCucgKfhjnQlM.jpg",
  "/storage/registrations/bukti_pembayaran/ngCKJckx2m8JlU7dKqh1weegY4Kx7CWviU6XbmoZ.jpg",
  "/storage/registrations/bukti_pembayaran/nmpVreVP6FfHjN5uNMf4bhTHKosUNRLYqtpL6v8N.jpg",
  "/storage/registrations/bukti_pembayaran/oG8qWFvmPhlflZA5IqPkwCHKi9zI8l3aorZEjUuB.jpg",
  "/storage/registrations/bukti_pembayaran/yKJWMIX23iGyCPHy4fiN3e25FS3Nu41UfaQTpVC9.jpg",
  "/storage/registrations/cRK2cjSit7wAK0F9LjQmFyYozpGBiQ21pMZMbmvf.png",
  "/storage/registrations/dBWfTBb2cEoYroqnjyop9YKHsjOUOOpu2UunXTUH.png",
  "/storage/registrations/e3eBGJijU5zwcXyQID70OCyUwui7qvEUj0gGUBGt.pdf",
  "/storage/registrations/eJMPjd7p6pFbowYUvHSB3BOAKpTQ7dyIvU7xQkIh.png",
  "/storage/registrations/fXwkcoQcqHF3JVGRZdRSzHxsnBaBiXPqUqY8JayM.pdf",
  "/storage/registrations/fjynP4Kn66BBvqZnYCSBA42uAMM2egBEAEnPDj2p.png",
  "/storage/registrations/gzHcqt9flIpIGcYDWHUO1EKOfX1QgIS4HiXwKbku.pdf",
  "/storage/registrations/i4j2ugo91S1CPLOZ3wBe2D1ibexJm8KkV6EQCF4P.pdf",
  "/storage/registrations/ijazah/3wIhW1yilF16dZnc78SpVwrF2lrjix6cDoOp2EjK.jpg",
  "/storage/registrations/ijazah/Q26eoKP6QOW9ZOurXrSmVM3m6Bex0TDJiJupFSAk.jpg",
  "/storage/registrations/ijazah/W25xtI7vn6WKUnKueJqgTJDGyNXTxZ8EfbuvPLON.jpg",
  "/storage/registrations/ijazah/gErlb0t6HWvdccgjVbN7Hq84iSnPsL5GpHqkNVmj.jpg",
  "/storage/registrations/ijazah/xIcbZZg0wteK85kCNlKqGZJ0kreoDrwMuJk7Lmuc.jpg",
  "/storage/registrations/jnp2Pw3tAzL0AdLIR3Zvn4q0Yihm2cssiEqW3P9E.jpg",
  "/storage/registrations/kk/7QQ5SVRqvVZokyNwZDvW5wn9BloBDLcKq8QXy4Xo.jpg",
  "/storage/registrations/kk/BsRoPgtekPx8Rdy2w3nLLbVpJkP86qtsHarQD8Mc.jpg",
  "/storage/registrations/kk/NBisQZUfw69HAMP97EVfBRk58EXHXhGFQM1xizhO.jpg",
  "/storage/registrations/kk/VP7fB7p26vNt91HbGs8G58I2NO6aW5B337ZyBALd.jpg",
  "/storage/registrations/kk/fg13TP3EoDrWqKUdOW7JmjJQ9bjEjapK5tNf9ugn.jpg",
  "/storage/registrations/kk/u6yLDfy02y5fH2CDGmlQ6sMQZJwoefjtLcRzevDr.jpg",
  "/storage/registrations/kk/vbbYNjnMABMBsTIBFlaqb1nCZjbESgrC6W07qcTy.jpg",
  "/storage/registrations/ktSVhQMWrlRz0g7JYIPpmuRxJZz1PEQr5OuHEH4D.pdf",
  "/storage/registrations/mSt9M27wLJf8wogwwsvNNpVi3ApbxQuyVInk4MNM.jpg",
  "/storage/registrations/nJySQXiIKwMQnULEJnsBXcTt5tRSZ6ILR3cMuaoL.pdf",
  "/storage/registrations/nYYrBN9EtaL7ViJ5JeZqTpkPmbgZmWPFUDPjszIG.pdf",
  "/storage/registrations/oDfdSuKr634HXrL4gM6ucwE0QELaNFetZseA6LqW.jpg",
  "/storage/registrations/pasfoto/04xIyMyIG1ZTFuZsgN1y7vvufkXW84OVRfkvD0Fm.jpg",
  "/storage/registrations/pasfoto/5TLvtlWA8DsFGG9XFcp40MrLv2hBJpEBejhxdK0O.png",
  "/storage/registrations/pasfoto/F2qUSPUA5wjBADvPBLyJ2JgDzgYf1YTBVJCLbU6V.jpg",
  "/storage/registrations/pasfoto/G53iZTpZrJNBjmTGwDilevT3GSRwqT5dKuxk55nz.jpg",
  "/storage/registrations/pasfoto/Jqx8kyctzUqXveg4HgMawRsrRxmYxHI1KJc80nYH.jpg",
  "/storage/registrations/pasfoto/SLUqa77rgvrhXjf947kMT486YDzMh3qCSW9kGnf4.jpg",
  "/storage/registrations/pasfoto/jhBxZoUnXtIlachwNgN2TxGTPtMLfTa89jG136oR.jpg",
  "/storage/registrations/piagam/D2DJHHP09Br5QQvpuwtAKCPb8VK7mvit9fEHTHIK.png",
  "/storage/registrations/piagam/NyJGCFVRcCVbmXcqDT27dC2RA9G9y68uKVRMouqU.jpg",
  "/storage/registrations/qjm13Eg6Gd2eZvPXAc51gVvwLSFBCzhDIUeUFyhT.jpg",
  "/storage/registrations/qpgcKHfw9xwEpcz6yPKFCK8y2ctE6LxbtgKeE2Rn.png",
  "/storage/registrations/rIu6SrFo4PbcOw873gUVcK8L63ul7l32sj1lYJvz.pdf",
  "/storage/registrations/rkjc4EONcki79el0fQIFAEWTJPTGagVrOKuxVsuS.png",
  "/storage/registrations/rwEbuXiQX2zZuN2LbWAXhb8tbdMpkWfD8zVcWEog.jpg",
  "/storage/registrations/sBntJ8fVJzRAghVgHIRSe6ENWOMevzauOxkAI4yo.pdf",
  "/storage/registrations/sFdMdcl3BiLSro3HmftUESrfchfR5T6u5fvbPuas.jpg",
  "/storage/registrations/tVDCnxqOoYlc8cmMydhGEr5G2NZdMhCrpxdBSwdA.jpg",
  "/storage/registrations/uj2YNobFT4nlKFmo5ebAAAGRyTvp1W0D6fkhduVl.jpg",
  "/storage/registrations/vRgcz8ZmmKYDchCwFQ5ANR7sKiwVXOhdfA6kvPOK.jpg",
  "/storage/registrations/vcyD8Y5MvAwAVssXr8a5TacQj6hcbQqJvTEE0XIt.jpg",
  "/storage/registrations/wTru9bsQMd5WOP9GMXRzj7XRjkj6bgj1L3T4D8lb.png",
  "/storage/registrations/xmwOQCtW4F9vNQghYKR7qAWrWCknPLOKd37cOtCs.pdf",
  "/storage/registrations/yelNobojvSPagStbTI337ZIG85LaaKY3gJLfJfWm.pdf",
  "/storage/registrations/yoXkP4h3xtfQBRk5VKl62LMJKQrUofFTSSQzu4VY.png",
  "/storage/testimonial_images/5XfMJFmu3aWUJlGAOeLIGsmg43ErxwhNSE0y4zGh.jpg",
  "/storage/testimonial_images/RvlYlFN9AgiYQNVSH4pUUvxer0KR6NKaYHp4W8zZ.png",
  "/storage/testimonial_images/e2bpO3LjMDjz0Se9yWqjbvLBw9egoAeOhuc2KRE0.png",
  "/storage/testimonial_images/gYgmhOUFGeXGxha5dXWRqpREiJEqAHWqp1J6WQ1m.png",
  "/storage/testimonial_images/jN5COxnYF7IJOaeHP7pLVLj8ZJFFwq73Ps3Z6ITl.jpg",
  "/storage/testimonial_images/tSTYeldHhlLGdCOK3yHYpiW5MVp8Ze1U15cDsaHN.png",
  "/storage/testimonial_images/uVHQqLxM0iH4bWLw3VaUQFaB6VtdaoDpTrwe0EmT.jpg",
  "/storage/values/icons/core-values.png",
  "/storage/values/icons/expert.png",
  "/storage/values/icons/social-care.png",
  "/storage/values/icons/zglBJ5aR6MQ6B7E8wNGd8CJ12aL3CYbnvmogP6ex.png",
  "/storage/vision_images/AMWL9gbqlzJrsSmXki3cO2VXuDBbS1x85CuZJTyh.png",
  "/storage/vision_images/visi dan misi.png",
  "/",
  "/profile",
  "/vision",
  "/program",
  "/ppdb",
  "/search",
  "/search-suggestions",
  "/auth/login",
  "/auth/register",
  "/dashboards",
  "/dashboards/profile",
  "/dashboards/profile/edit",
  "/dashboards/ppdb-pendaftaran",
  "/dashboards/ppdb-pengumuman",
  "/dashboards/ppdb-pendaftaran/revisi",
  "/dashboards/stats",
  "/dashboards/content-hero",
  "/dashboards/content-news",
  "/dashboards/content-agenda",
  "/dashboards/content-introduction",
  "/dashboards/list-pendaftar",
  "/dashboards/values",
  "/dashboards/content-programs",
  "/dashboards/content-testimonials",
  "/dashboards/content-media",
  "/dashboards/content-profile",
  "/dashboards/content-vision",
  "/dashboards/content-ppdb",
  "/dashboards/roles",
  "/dashboards/roles/create",
  "/dashboards/roles/edit",
  "/dashboards/users",
  "/dashboards/users/create",
  "/dashboards/users/edit"
];

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
