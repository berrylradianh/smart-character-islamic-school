@php
    use Illuminate\Support\Facades\Storage;
@endphp

<section class="slider__area">
    <div class="slider__active swiper-container">
        <div class="swiper-wrapper">
            @forelse ($heroes as $hero)
                <div class="slider__item swiper-slide p-relative slider__height d-flex align-items-center z-index-1">
                    <div class="slider__bg slider__overlay include-bg" data-background="{{ $hero->image ? Storage::url($hero->image) : 'assets/img/slider/default.pngかという' }}"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-xxl-6 col-xl-7 col-lg-8 col-md-10 col-sm-10">
                                <div class="slider__content p-relative z-index-1">
                                    <span data-animation="fadeInUp" data-delay=".3s">Smart Character Islamic School</span>
                                    <h2 class="slider__title" data-animation="fadeInUp" data-delay=".6s">{{ $hero->title }}</h2>
                                    <p data-animation="fadeInUp" data-delay=".9s">{{ $hero->description }}</p>
                                    <div class="slider__btn" data-animation="fadeInUp" data-delay="1.1s">
                                        <a href="{{ route('auth.register') }}"
                                            style="display: inline-block; padding: 15px 30px; font-size: 18px; background-color: #E47804;
                                            color: #fff; text-decoration: none; border-radius: 8px; transition: 0.3s; font-weight: bold;"
                                            onmouseover="this.style.backgroundColor='#FF9800';"
                                            onmouseout="this.style.backgroundColor='#E47804';">
                                            Daftar Sekarang
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="slider__item swiper-slide p-relative slider__height d-flex align-items-center z-index-1">
                    <div class="slider__bg slider__overlay include-bg" data-background="assets/img/slider/default.png"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-xxl-6 col-xl-7 col-lg-8 col-md-10 col-sm-10">
                                <div class="slider__content p-relative z-index-1">
                                    <span data-animation="fadeInUp" data-delay=".3s">Smart Character Islamic School</span>
                                    <h2 class="slider__title" data-animation="fadeInUp" data-delay=".6s">Default Title</h2>
                                    <p data-animation="fadeInUp" data-delay=".9s">Default description for hero section.</p>
                                    <div class="slider__btn" data-animation="fadeInUp" data-delay="1.1s">
                                        <a href="{{ route('auth.register') }}"
                                            style="display: inline-block; padding: 15px 30px; font-size: 18px; background-color: #E47804;
                                            color: #fff; text-decoration: none; border-radius: 8px; transition: 0.3s; font-weight: bold;"
                                            onmouseover="this.style.backgroundColor='#FF9800';"
                                            onmouseout="this.style.backgroundColor='#E47804';">
                                            Daftar Sekarang
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
        <div class="main-slider-paginations">
            <button class="slider-button-next"><i class="fa-regular fa-arrow-right"></i></button>
            <button class="slider-button-prev"><i class="fa-regular fa-arrow-left"></i></button>
        </div>
    </div>
</section>
