@php
    use Illuminate\Support\Facades\Storage;
@endphp

<section class="features__area">
    <div class="container">
        <div class="features__inner p-relative z-index-1 white-bg text-center">
            <h2 class="features__title-main" style="margin-bottom: 70px;">MENUMBUHKAN</h2>
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="row">
                        @foreach ($values as $value)
                        <div class="col-md-4">
                            <div class="features__item d-flex flex-column align-items-center white-bg mb-30">
                                <div class="features__icon" @if($value->color) style="background-color: {{ $value->color }}; width: 120px; height: 120px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 15px;" @else style="background-color: #4A90E2; width: 120px; height: 120px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 15px;" @endif>
                                    @if ($value->icon)
                                        <img src="{{ Storage::url($value->icon) }}" alt="{{ $value->title }}" style="width: 80px; height: 80px;">
                                    @else
                                        <img src="{{ asset('assets/img/about/default.png') }}" alt="{{ $value->title }}" style="width: 80px; height: 80px;">
                                    @endif
                                </div>
                                <div class="features__content text-center">
                                    <h3 class="features__title" style="font-size: 24px;">
                                        <span>{{ $value->title }}</span>
                                    </h3>
                                    <p style="font-size: 18px;">{{ $value->description }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
