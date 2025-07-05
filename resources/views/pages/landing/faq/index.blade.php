@extends('layouts.app')

@section('title', 'FAQ')

@section('content')
<style>
    .content-page {
        padding: 40px 0;
        background-color: #f8f9fa;
        min-height: 100vh;
    }

    .page-title-box {
        padding: 30px 0;
        text-align: center;
    }

    .page-title-box h5 {
        font-size: 2rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 15px;
    }

    .page-title-box p {
        font-size: 1rem;
        line-height: 1.6;
        max-width: 600px;
        margin: 0 auto;
    }

    .faq-box {
        transition: all 0.3s ease;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        background-color: #fff;
        overflow: hidden;
        height: 300px; /* Fixed height for all cards */
        display: flex;
        flex-direction: column;
    }

    .faq-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .card-body {
        padding: 20px;
        position: relative;
        flex: 1; /* Allow card-body to take remaining space */
        overflow-y: auto; /* Enable vertical scrolling for long content */
        max-height: 300px; /* Limit the height of the card body */
    }

    .faq-icon {
        position: absolute;
        top: 20px;
        right: 20px;
        opacity: 0.3;
        transition: opacity 0.3s ease;
    }

    .faq-box:hover .faq-icon {
        opacity: 0.7;
    }

    .faq-box h5 {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .faq-box .font-16 {
        font-size: 1.1rem;
        font-weight: 500;
        color: #333;
    }

    .faq-box p {
        font-size: 0.95rem;
        line-height: 1.6;
        color: #555;
    }

    /* Category-specific border and text colors */
    .border-primary { border-left: 4px solid #007bff; }
    .border-success { border-left: 4px solid #28a745; }
    .border-warning { border-left: 4px solid #ffc107; }
    .border-danger { border-left: 4px solid #dc3545; }
    .text-primary { color: #007bff !important; }
    .text-success { color: #28a745 !important; }
    .text-warning { color: #ffc107 !important; }
    .text-danger { color: #dc3545 !important; }

    .footer {
        text-align: center;
        padding: 20px 0;
        font-size: 0.9rem;
        color: #777;
        border-top: 1px solid #e5e5e5;
        margin-top: 40px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .page-title-box h5 {
            font-size: 1.5rem;
        }

        .faq-box {
            margin-bottom: 15px;
            height: 250px; /* Slightly smaller height for mobile */
        }

        .card-body {
            max-height: 250px; /* Match the card height for mobile */
        }

        .col-lg-4 {
            margin-bottom: 20px;
        }
    }
</style>

<section class="faq-section py-5">
    <div class="container">
        <div class="page-title-box">
            <div class="text-center">
                <h5>Frequently Asked Questions</h5>
                <p class="text-muted">Kami siap membantu menjawab pertanyaan Anda seputar Penerimaan Peserta Didik Baru (PPDB) untuk jenjang TK, SD, SMP, dan SMA. Temukan informasi penting mengenai persyaratan, jadwal, biaya, dan prosedur pendaftaran di bawah ini.</p>
        </div>
        </div>

        <div class="row mt-4">
            @foreach($faqs as $faq)
            <div class="col-lg-4">
                <div class="card faq-box border-{{ $faq->category_color }}">
                    <div class="card-body">
                        <div class="faq-icon float-right">
                            <i class="fas fa-question-circle font-24 mt-2 text-{{ $faq->category_color }}"></i>
                        </div>
                        <h5 class="text-{{ $faq->category_color }}">{{ str_pad($faq->order_number, 2, '0', STR_PAD_LEFT) }}.</h5>
                        <h5 class="font-16 mb-3 mt-4">{{ $faq->question }}</h5>
                        <p class="text-muted mb-0">{{ $faq->answer }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
