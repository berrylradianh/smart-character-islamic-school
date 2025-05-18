@php
use Illuminate\Support\Facades\Storage;
@endphp

<!-- Testimonial Section -->
<section class="testimonial__area pt-70 pb-120 fix">
    <div class="container">
        <div class="row">
            <div class="col-xxl-12">
                <div class="section__title-wrapper-2 mb-40 text-center">
                    <h3 class="section__title-2">Kata Mereka</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-12">
                <div class="testimonial__slider">
                    @if ($testimonials->isEmpty())
                    <div class="text-center">
                        <p>No testimonials available at the moment. Please check back later!</p>
                    </div>
                    @else
                    <div class="testimonial__active owl-carousel">
                        @foreach ($testimonials as $testimonial)
                        <div class="testimonial__item transition-3 text-center white-bg">
                            <div class="testimonial__avater">
                                <img src="{{ $testimonial->image ? Storage::url($testimonial->image) : asset('dashboard/assets/images/users/user_default.jpg') }}" alt="{{ $testimonial->name }}">
                            </div>
                            <div class="testimonial__text">
                                <p>{{ $testimonial->text }}</p>
                            </div>
                            <div class="testimonial__avater-info mb-5">
                                <h3>{{ $testimonial->name }}</h3>
                                <span>{{ $testimonial->position }}</span>
                            </div>
                            <div class="testimonial__rating">
                                <ul>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <li>
                                        <a href="#"><i class="fa-solid fa-star {{ $i <= $testimonial->rating ? 'text-warning' : 'text-muted' }}"></i></a>
                                        </li>
                                        @endfor
                                </ul>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Owl Carousel Initialization Script -->
<script>
    $(document).ready(function() {
        $('.testimonial__active').owlCarousel({
            loop: false, // Disable loop to prevent duplication
            margin: 10,
            nav: true, // Enable navigation arrows
            navText: [
                '<i class="fa-solid fa-arrow-left"></i>',
                '<i class="fa-solid fa-arrow-right"></i>'
            ],
            dots: true,
            responsive: {
                0: {
                    items: 1 // 1 card on mobile
                },
                600: {
                    items: 2 // 2 cards on tablets
                },
                1000: {
                    items: 3 // 3 cards on desktops
                }
            },
            onInitialized: updateNavVisibility,
            onTranslated: updateNavVisibility
        });

        // Function to hide/show navigation arrows
        function updateNavVisibility(event) {
            var owl = $('.testimonial__active').data('owl.carousel');
            var current = event.item.index;
            var total = event.item.count;
            var itemsPerPage = event.page.size;

            // Hide left arrow at the start
            if (current === 0) {
                $('.owl-prev').hide();
            } else {
                $('.owl-prev').show();
            }

            // Hide right arrow at the end
            if (current + itemsPerPage >= total) {
                $('.owl-next').hide();
            } else {
                $('.owl-next').show();
            }
        }
    });
</script>

<style>
    /* Ensure Owl Carousel navigation arrows are visible */
    .owl-nav {
        display: flex !important;
        justify-content: space-between;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: calc(100% + 100px);
        left: -50px;
    }

    /* Style for navigation buttons */
    .testimonial__active .owl-nav button {
        background: rgba(0, 0, 0, 0.5) !important;
        color: #fff !important;
        border: none !important;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        text-align: center;
        line-height: 40px;
        font-size: 20px;
        transition: all 0.3s ease;
        z-index: 10;
    }

    .testimonial__active .owl-nav button:hover {
        background: rgba(0, 0, 0, 0.8) !important;
    }

    /* Position left arrow to the left of the first card */
    .testimonial__active .owl-prev {
        margin-left: 10px;
    }

    /* Position right arrow to the right of the third card */
    .testimonial__active .owl-next {
        margin-right: 10px;
    }

    /* Ensure carousel container allows arrows to extend outside */
    .testimonial__slider {
        position: relative;
        padding: 0 50px;
    }

    .testimonial__active {
        position: relative;
        overflow: visible !important;
    }

    .testimonial__active .owl-stage-outer {
        overflow: visible !important;
    }

    .owl-nav button {
        opacity: 1;
    }

    /* Uniform card sizing */
    .testimonial__item {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-height: 500px;
        width: 100% !important;
        box-sizing: border-box;
        padding: 20px;
    }

    /* Ensure image size is consistent */
    .testimonial__avater img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 50%;
        margin: 0 auto;
    }

    /* Scrollable text content */
    .testimonial__text {
        height: 150px;
        /* Fixed height for text area */
        overflow-y: auto;
        /* Enable vertical scrolling */
        margin: 10px 0;
        padding-right: 10px;
        /* Space for scrollbar */
    }

    /* Optional: Style the scrollbar */
    .testimonial__text::-webkit-scrollbar {
        width: 8px;
    }

    .testimonial__text::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }

    .testimonial__text::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 4px;
    }

    .testimonial__text::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    /* Ensure name and position are consistent */
    .testimonial__avater-info {
        margin-bottom: 10px;
    }

    .testimonial__avater-info h3 {
        font-size: 1.2rem;
        margin-bottom: 5px;
    }

    .testimonial__avater-info span {
        font-size: 1rem;
        color: #666;
    }

    /* Ensure rating is consistent */
    .testimonial__rating ul {
        display: flex;
        justify-content: center;
        padding: 0;
        margin: 0;
    }

    .testimonial__rating li {
        list-style: none;
        margin: 0 5px;
    }
</style>
