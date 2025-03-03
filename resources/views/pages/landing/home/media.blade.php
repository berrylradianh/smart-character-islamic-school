<section class="app__area app__bg">
    <div class="container">
        <div class="app__inner theme-bg-3 p-relative fix">
            <div class="app__shape">
                <img class="app__shape-1" src="assets/img/app/app-shape-1.png" alt="">
                <img class="app__shape-2" src="assets/img/app/app-shape-2.png" alt="">
            </div>
            <div class="row align-items-center">
                <div class="col-xxl-12 col-xl-12 col-lg-12">
                    <div class="app__wrapper p-relative z-index-1 text-center">
                        <h3 class="app__title coverage-title">Telah diliput oleh :</h3>
                    </div>
                </div>
                <div class="col-xxl-12 col-xl-12 col-lg-12">
                    <div class="app__download p-relative z-index-1 d-flex align-items-center justify-content-center logo-slider">
                        <div class="logo-slider-inner">
                            <div class="app__item mr-15">
                                <img src="{{asset('assets/img/brand/kabar-periangan.png')}}" alt="Kabar Periangan">
                            </div>
                            <div class="app__item mr-15">
                                <img src="{{asset('assets/img/brand/kapol.png')}}" alt="Kapol">
                            </div>
                            <div class="app__item mr-15">
                                <img src="{{asset('assets/img/brand/priangan.png')}}" alt="Priangan.com">
                            </div>
                            <div class="app__item">
                                <img src="{{asset('assets/img/brand/tribunnews.png')}}" alt="Smart Character">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .coverage-title {
        margin-top: 10px;
        margin-bottom: 15px;
    }

    .logo-slider {
        overflow: hidden;
        white-space: nowrap;
        position: relative;
    }

    .logo-slider .app__item {
        display: inline-block;
        margin-right: 15px;
        vertical-align: middle;
    }

    .logo-slider-inner {
        display: inline-block;
    }

    .logo-slider-inner img {
        filter: brightness(0) invert(1);
    }

    @media (max-width: 768px) {
        .logo-slider {
            justify-content: flex-start;
        }

        .logo-slider .app__item {
            margin-right: 10px;
        }

        .coverage-title {
            font-size: 16px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sliderInner = document.querySelector('.logo-slider-inner');
        const slider = document.querySelector('.logo-slider');
        let position = 0;
        const slideWidth = sliderInner.offsetWidth;
        const containerWidth = slider.offsetWidth;

        const items = sliderInner.querySelectorAll('.app__item');
        items.forEach(item => {
            const clone = item.cloneNode(true);
            sliderInner.appendChild(clone);
        });

        const totalSlideWidth = sliderInner.offsetWidth / 2;

        if (totalSlideWidth > containerWidth) {
            function slide() {
                position -= 1;
                sliderInner.style.transform = `translateX(${position}px)`;

                if (Math.abs(position) >= totalSlideWidth) {
                    position = 0;
                    setTimeout(() => {
                        sliderInner.style.transition = 'none';
                        sliderInner.style.transform = `translateX(${position}px)`;
                        setTimeout(() => {
                            sliderInner.style.transition = 'transform 0s linear';
                        }, 0);
                    }, 0);
                }
            }

            sliderInner.style.transition = 'transform 0s linear';

            const slideInterval = setInterval(slide, 10);

            slider.addEventListener('mouseenter', () => {
                clearInterval(slideInterval);
            });

            slider.addEventListener('mouseleave', () => {
                slideInterval = setInterval(slide, 20);
            });
        } else {
            sliderInner.style.transform = 'translateX(0)';
            sliderInner.style.transition = 'none';
        }
    });
</script>
