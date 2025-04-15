<section class="counter__area section-padding">
    <div class="container">
        <div class="row">
            @foreach ($stats as $stat)
            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                <div class="counter__item">
                    <div class="counter__icon" @if($stat->color) style="background-color: {{ $stat->color }};" @else style="background-color: #3b82f6;" @endif>
                        <img src="{{ $stat->icon ? asset('storage/' . $stat->icon) : asset('assets/img/default.png') }}" alt="{{ $stat->name }}">
                    </div>
                    <div class="counter__content">
                        <h3 class="counter__number">{{ number_format($stat->value, 0, ',', '.') }}</h3>
                        <p class="counter__title">{{ $stat->name }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<style>
    .counter__area {
        padding: 60px 0;
        background-color: #f8f9fa;
    }

    .section-padding {
        padding-top: 80px;
        padding-bottom: 80px;
    }

    .counter__item {
        background: #ffffff;
        border-radius: 12px;
        padding: 30px 20px;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .counter__item:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .counter__icon {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0 auto 20px;
        transition: transform 0.3s ease;
    }

    .counter__icon img {
        width: 40px;
        height: 40px;
        object-fit: contain;
    }

    .counter__item:hover .counter__icon {
        transform: scale(1.1);
    }

    .counter__number {
        font-size: 2.5rem;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 10px;
    }

    .counter__title {
        font-size: 1.25rem;
        font-weight: 500;
        color: #4a4a4a;
        margin-bottom: 15px;
    }

    .counter__percentage {
        font-size: 0.9rem;
        color: #6c757d;
    }

    .progress {
        background-color: #e9ecef;
        border-radius: 10px;
        overflow: hidden;
    }

    .progress-bar {
        transition: width 0.6s ease;
    }

    @media (max-width: 991px) {
        .counter__number {
            font-size: 2rem;
        }

        .counter__title {
            font-size: 1.1rem;
        }

        .counter__icon {
            width: 60px;
            height: 60px;
        }

        .counter__icon img {
            width: 35px;
            height: 35px;
        }
    }

    @media (max-width: 767px) {
        .counter__item {
            padding: 20px;
        }

        .counter__number {
            font-size: 1.8rem;
        }

        .counter__title {
            font-size: 1rem;
        }
    }
</style>
