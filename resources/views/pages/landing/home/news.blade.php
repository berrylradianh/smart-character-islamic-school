@php
    use Illuminate\Support\Facades\Storage;
@endphp

<section class="course__area pt-120 grey-bg-3" style="background-color: white;">
    <div class="container">
        <div class="row">
            <div class="col-xxl-12">
                <div class="section__title-wrapper text-center mb-60">
                    <h2 class="section__title section__title-44">Berita Terkini</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @forelse ($news as $item)
            <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-6">
                <div class="course__item white-bg transition-3 mb-30">
                    <div class="course__thumb w-img fix">
                        <a href="#">
                            <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('assets/img/news/default.png') }}" alt="{{ $item->title }}" style="width: 320px; height: 220px;">
                        </a>
                    </div>
                    <div class="course__content p-relative">
                        <h3 class="course__title">
                            <a href="#">{{ $item->title }}</a>
                        </h3>
                        <p class="truncate-text">{{ $item->description }}</p>
                        <div class="course__bottom d-sm-flex align-items-center justify-content-between">
                            <div class="blog__meta">
                                <ul>
                                    <li>
                                        <span>
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M16.4998 9C16.4998 13.14 13.1398 16.5 8.99976 16.5C4.85976 16.5 1.49976 13.14 1.49976 9C1.49976 4.86 4.85976 1.5 8.99976 1.5C13.1398 1.5 16.4998 4.86 16.4998 9Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M11.7822 11.3848L9.45723 9.99732C9.05223 9.75732 8.72223 9.17982 8.72223 8.70732V5.63232" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <a href="#">{{ $item->date->format('d F Y') }}</a>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p>Tidak ada berita tersedia saat ini.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<style>
    .course__item {
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .course__thumb {
        width: 100%;
        overflow: hidden;
    }

    .course__thumb img {
        width: 100%;
        height: 220px;
        object-fit: cover;
    }

    .course__content {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        padding: 20px;
    }

    .course__title {
        font-size: 18px;
        line-height: 1.2;
        margin-bottom: 10px;
        min-height: 48px;
    }

    .truncate-text {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: normal;
        max-width: 100%;
        word-break: break-word;
        flex-grow: 1;
    }

    .course__bottom {
        margin-top: auto;
    }
</style>
