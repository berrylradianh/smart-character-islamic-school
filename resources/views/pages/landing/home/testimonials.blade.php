@php
    use Illuminate\Support\Facades\Storage;
@endphp

<!-- ... other sections ... -->

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
                        <div class="testimonial__active owl-carousel" data-testimonial-count="{{ $testimonials->count() }}">
                            @foreach ($testimonials as $testimonial)
                                <div class="testimonial__item transition-3 text-center white-bg">
                                    <div class="testimonial__avater">
                                        <img src="{{ $testimonial->image ? Storage::url($testimonial->image) : asset('assets/img/testimonial/placeholder.png') }}" alt="{{ $testimonial->name }}">
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

<!-- Add Owl Carousel initialization script -->
<script>
    $(document).ready(function(){
        // Get the number of testimonials from the data attribute
        var testimonialCount = parseInt($('.testimonial__active').data('testimonial-count'));

        $('.testimonial__active').owlCarousel({
            loop: false, // Disable loop to prevent duplication
            margin: 10,
            nav: true,
            dots: true,
            responsive: {
                0: {
                    items: testimonialCount // 1 card on mobile if 1, 2 if 2, 3 if 3, up to testimonial count if more
                },
                600: {
                    items: testimonialCount // 2 cards on tablets if 2, 3 if 3, up to testimonial count if more
                },
                1000: {
                    items: testimonialCount // 3 cards on desktops if 3, slides if more than 3
                }
            }
        });
    });
</script>

<!-- ... other sections ... -->
