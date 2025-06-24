<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ $title.' - SCIS' ?? "" }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}">

    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <meta name="theme-color" content="#000000">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/meanmenu.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl-carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/backtotop.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome-pro.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/spacing.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
</head>

<style>
    #loading {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: rgba(255, 255, 255, 0.8);
        z-index: 9999;
    }

    #loading-center {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #loading-center-absolute {
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>

<body>
    <!-- pre loader area start -->
    <div id="loading">
        <div id="loading-center">
            <div id="loading-center-absolute">
                <img src="{{ asset('assets/img/favicon.png') }}" alt="">
            </div>
        </div>
    </div>
    <!-- pre loader area end -->

    <!-- back to top start -->
    <div class="progress-wrap" style="background-color: white;">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- back to top end -->

    @include('components.header')

    @yield('content')

    @include('components.footer')

    <!-- JS here -->
    <script src="{{ asset('assets/js/vendor/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/waypoints.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-bundle.js') }}"></script>
    <script src="{{ asset('assets/js/meanmenu.js') }}"></script>
    <script src="{{ asset('assets/js/swiper-bundle.js') }}"></script>
    <script src="{{ asset('assets/js/owl-carousel.js') }}"></script>
    <script src="{{ asset('assets/js/magnific-popup.js') }}"></script>
    <script src="{{ asset('assets/js/parallax.js') }}"></script>
    <script src="{{ asset('assets/js/backtotop.js') }}"></script>
    <script src="{{ asset('assets/js/nice-select.js') }}"></script>
    <script src="{{ asset('assets/js/counterup.js') }}"></script>
    <script src="{{ asset('assets/js/wow.js') }}"></script>
    <script src="{{ asset('assets/js/isotope-pkgd.js') }}"></script>
    <script src="{{ asset('assets/js/imagesloaded-pkgd.js') }}"></script>
    <script src="{{ asset('assets/js/ajax-form.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <script>
        function showDropdown(element) {
            var submenu = element.querySelector('.submenu');
            if (submenu) {
                submenu.style.display = "block";
            }
        }

        function hideDropdown(element) {
            var submenu = element.querySelector('.submenu');
            if (submenu) {
                setTimeout(() => {
                    if (!submenu.matches(':hover') && !element.matches(':hover')) {
                        submenu.style.display = "none";
                    }
                }, 200);
            }
        }

        $(document).ready(function() {
            // CSRF Token Setup
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Search Suggestions
            $('#search-input').on('keyup', function() {
                var query = $(this).val().trim();
                var suggestionsBox = $('#search-suggestions');
                var suggestionsList = suggestionsBox.find('ul');

                if (query.length > 0) {
                    $.ajax({
                        url: '{{ route("landing.search.suggestions") }}',
                        method: 'GET',
                        data: {
                            query: query
                        },
                        success: function(data) {
                            suggestionsList.empty();
                            if (data.length > 0) {
                                $.each(data, function(index, suggestion) {
                                    suggestionsList.append(
                                        '<li style="padding: 8px 15px; cursor: pointer; transition: background 0.2s;" ' +
                                        'onmouseover="this.style.background=\'#f0f0f0\';" ' +
                                        'onmouseout="this.style.background=\'white\';" ' +
                                        'onclick="window.location.href=\'' + suggestion.url + '\'">' +
                                        suggestion.title +
                                        '</li>'
                                    );
                                });
                                suggestionsBox.show();
                            } else {
                                suggestionsList.append(
                                    '<li style="padding: 8px 15px; color: #999;">Tidak ada saran</li>'
                                );
                                suggestionsBox.show();
                            }
                        },
                        error: function() {
                            suggestionsList.empty().append(
                                '<li style="padding: 8px 15px; color: #999;">Terjadi kesalahan</li>'
                            );
                            suggestionsBox.show();
                        }
                    });
                } else {
                    suggestionsBox.hide();
                }
            });

            // Hide suggestions on click outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.header__search').length) {
                    $('#search-suggestions').hide();
                }
            });

            // Owl Carousel Initialization for Testimonials
            $('.testimonial__active').owlCarousel({
                loop: false,
                margin: 10,
                nav: true,
                navText: [
                    '<i class="fa-solid fa-arrow-left"></i>',
                    '<i class="fa-solid fa-arrow-right"></i>'
                ],
                dots: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 3
                    }
                },
                onInitialized: updateNavVisibility,
                onTranslated: updateNavVisibility
            });

            function updateNavVisibility(event) {
                var owl = $('.testimonial__active').data('owl.carousel');
                var current = event.item.index;
                var total = event.item.count;
                var itemsPerPage = event.page.size;

                if (current === 0) {
                    $('.owl-prev').hide();
                } else {
                    $('.owl-prev').show();
                }

                if (current + itemsPerPage >= total) {
                    $('.owl-next').hide();
                } else {
                    $('.owl-next').show();
                }
            }
        });
    </script>
    @vite(['resources/js/app.js'])
</body>

</html>
