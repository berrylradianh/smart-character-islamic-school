@extends('layouts.app')

@section('content')
<section class="search-section py-5" style="background-color: #f8f9fa; min-height: 80vh;">
    <div class="container">
        <div class="search-container" style="max-width: 800px; margin: 0 auto;">
            <!-- Search Results -->
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h2 class="card-title mb-4" style="color: #031220; font-size: 1.8rem; font-weight: 600;">
                        Hasil Pencarian untuk "<span style="color: #28a745;">{{ $query }}</span>"
                    </h2>
                    <div class="search-results">
                        @if (!empty($results))
                        <ul class="list-group list-group-flush">
                            @foreach ($results as $result)
                            <li class="list-group-item border-0 py-3">
                                <a href="{{ $result['url'] }}" class="result-link" style="color: #031220; text-decoration: none; font-size: 1.1rem; transition: color 0.2s;">
                                    <i class="fa fa-angle-right me-2" style="color: #28a745;"></i> {{ $result['title'] }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                        @else
                        <div class="alert alert-warning" role="alert" style="background-color: #fff3cd; border-color: #ffeeba; color: #856404;">
                            <i class="fa fa-exclamation-circle me-2"></i> {{ $message }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Back to Home -->
            <div class="text-center mt-4">
                <a href="{{ route('landing.home') }}" class="btn-back-home" aria-label="Kembali ke halaman beranda">
                    <i class="fa fa-home me-2"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</section>

<style>
    .search-section {
        display: flex;
        align-items: center;
    }

    .search-container .card {
        border-radius: 10px;
        background: white;
    }

    .list-group-item {
        transition: background 0.2s;
    }

    .list-group-item:hover {
        background: #f8f9fa;
    }

    .result-link:hover {
        color: #28a745 !important;
        text-decoration: none;
    }

    /* Styling untuk tombol Kembali ke Beranda */
    .btn-back-home {
        display: inline-flex;
        align-items: center;
        padding: 12px 24px;
        font-size: 1rem;
        font-weight: 500;
        color: #E47804;
        background-color: transparent;
        border: 2px solid #E47804;
        border-radius: 50px;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .btn-back-home:hover {
        background-color: #E47804;
        color: white;
        border-color: #E47804;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(228, 120, 4, 0.3);
    }

    .btn-back-home .fa-home {
        transition: transform 0.3s ease;
    }

    .btn-back-home:hover .fa-home {
        transform: scale(1.2);
    }

    @media (max-width: 576px) {
        .search-container {
            padding: 15px;
        }

        .card-title {
            font-size: 1.5rem;
        }

        .btn-back-home {
            padding: 10px 20px;
            font-size: 0.9rem;
        }
    }
</style>
@endsection
