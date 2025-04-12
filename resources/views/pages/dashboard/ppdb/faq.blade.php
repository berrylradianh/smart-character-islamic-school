@extends('layouts.dashboard.app')
@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Faqs</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">SCIS</li>
                            <li class="breadcrumb-item">PPDB</li>
                            <li class="breadcrumb-item active">FAQs</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-center">
                        <h5>Frequently Asked Questions</h5>
                        <p class="text-muted">Kami siap membantu menjawab pertanyaan Anda seputar Penerimaan Peserta Didik Baru (PPDB) untuk jenjang TK, SD, SMP, dan SMA. Temukan informasi penting mengenai persyaratan, jadwal, biaya, dan prosedur pendaftaran di bawah ini.</p>
                    </div>
                </div>
            </div>

            <div class="row m-t-30">
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
    </div>
    <footer class="footer">
        © SCIS, 2024. All Right Reserved
    </footer>
</div>
@endsection
