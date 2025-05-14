@php
    use Illuminate\Support\Facades\Storage;
@endphp
<section class="about__area p-relative">
    <div class="container">
        <div class="row">
            <div class="col-xxl-5 col-xl-5 col-lg-5">
                <div class="about__content pl-70 pr-25">
                    <div class="section__title-wrapper mb-15">
                        <h2 class="section__title-40">PROGRAM UNGGULAN SCIS</h2>
                    </div>
                    <div class="about__list mb-40">
                        @if ($programs->isEmpty())
                            <p>No programs available at the moment. Please check back later!</p>
                        @else
                            <ul style="list-style: none; padding-left: 0;">
                                @foreach ($programs as $program)
                                <li style="display: flex; align-items: flex-start; gap: 8px;">
                                    <i class="fa-solid fa-check" style="flex-shrink: 0; margin-top: 5px;"></i>
                                    <span>{{ $program->title }} - {{ $program->description }}</span>
                                </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <div class="about__btn">
                        <a href="{{ route('auth.login') }}" style="display: inline-flex; align-items: center; padding: 12px 24px; background-color: #E47804; color: white; text-decoration: none; border-radius: 5px; font-size: 16px; font-weight: bold; margin-top: 20px;" onmouseover="this.style.backgroundColor='#FF9800';"
                            onmouseout="this.style.backgroundColor='#E47804';">
                            Klik Daftar <i class="fas fa-arrow-right" style="margin-left: 8px;"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xxl-7 col-xl-7 col-lg-7">
                <div class="about__thumb-wrapper d-sm-flex mr-20 p-relative">
                    <div class="about__shape">
                        <img class="about__shape-1 d-none d-sm-block" src="{{ asset('assets/img/about/about-shape-1.png') }}" alt="">
                        <img class="about__shape-2 d-none d-sm-block" src="{{ asset('assets/img/about/about-shape-2.png') }}" alt="">
                        <img class="about__shape-3" src="{{ asset('assets/img/about/about-shape-3.png') }}" alt="">
                    </div>
                    <div class="about__thumb-left mr-10">
                        @php
                            $images = $programs->whereNotNull('image')->take(3);
                        @endphp
                        @if ($images->isEmpty())
                        @else
                            @if ($images->count() > 0)
                                <div class="about__thumb-1 mb-10">
                                    <img src="{{ Storage::url($images[0]->image) }}" alt="{{ $images[0]->title }}" style="width: 241px; height: 280px;">
                                </div>
                            @endif
                            @if ($images->count() > 1)
                                <div class="about__thumb-1 mb-10 text-end">
                                    <img src="{{ Storage::url($images[1]->image) }}" alt="{{ $images[1]->title }}" style="width: 171px; height: 150px;">
                                </div>
                            @endif
                        @endif
                    </div>
                    @if ($images->count() > 2)
                        <div class="about__thumb-2 mb-10">
                            <img src="{{ Storage::url($images[2]->image) }}" alt="{{ $images[2]->title }}" style="width: 401px; height: 570px;">
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
