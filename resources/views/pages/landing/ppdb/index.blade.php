@php
use Illuminate\Support\Facades\Storage;
@endphp

@extends('layouts.app')

@section('title', 'Pendaftaran PPDB')

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
        height: 300px;
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
        flex: 1;
        overflow-y: auto;
        max-height: 300px;
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

    .border-primary {
        border-left: 4px solid #007bff;
    }

    .border-success {
        border-left: 4px solid #28a745;
    }

    .border-warning {
        border-left: 4px solid #ffc107;
    }

    .border-danger {
        border-left: 4px solid #dc3545;
    }

    .text-primary {
        color: #007bff !important;
    }

    .text-success {
        color: #28a745 !important;
    }

    .text-warning {
        color: #ffc107 !important;
    }

    .text-danger {
        color: #dc3545 !important;
    }

    .footer {
        text-align: center;
        padding: 20px 0;
        font-size: 0.9rem;
        color: #777;
        border-top: 1px solid #e5e5e5;
        margin-top: 40px;
    }

    @media (max-width: 768px) {
        .page-title-box h5 {
            font-size: 1.5rem;
        }

        .faq-box {
            margin-bottom: 15px;
            height: 250px;
        }

        .card-body {
            max-height: 250px;
        }

        .col-lg-4 {
            margin-bottom: 20px;
        }
    }

    .quota-section {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .quota-heading {
        font-size: 1.5rem;
        font-weight: 700;
        color: #2c3e50;
        position: relative;
        display: inline-block;
    }

    .stat-card {
        background-color: #f8f9fa;
        border: none;
        border-radius: 8px;
        transition: transform 0.2s ease-in-out;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-card .card-body {
        padding: 15px;
    }

    .stat-card .card-title {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .stat-card .card-text {
        font-size: 2rem;
        margin-bottom: 5px;
    }

    .stat-card .card-subtitle {
        font-size: 0.9rem;
        margin-bottom: 0;
    }

    .ppdb-section {
        background-color: #f8f9fa;
    }

    .ppdb-section h2 {
        font-size: 2.5rem;
        font-weight: bold;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
    }

    .btn-warning {
        background-color: #f0ad4e;
        border: none;
    }

    .accordion-button {
        background-color: #fff;
        color: #000;
        font-weight: bold;
    }

    .accordion-button:not(.collapsed) {
        background-color: #e9ecef;
        color: #000;
    }

    .accordion-button::after {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23000'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
    }

    .accordion-button:not(.collapsed)::after {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23000'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
        transform: rotate(180deg);
    }

    .ppdb-info-header {
        text-align: center;
        position: relative;
        padding-bottom: 10px;
        padding-top: 40px;
    }

    .ppdb-info-header .subheading {
        font-size: 2rem;
        font-weight: 700;
        color: #2c3e50;
        display: inline-block;
        position: relative;
        padding: 10px 20px;
    }

    .ppdb-info-header .subheading::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 50px;
        height: 4px;
        background: #f0ad4e;
        border-radius: 2px;
    }

    .ppdb-info-header::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(to right, transparent, #007bff, transparent);
        z-index: -1;
    }

    .quota-item {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .quota-label {
        font-size: 1.1rem;
        font-weight: 600;
        color: #2c3e50;
        width: 60px;
    }

    .custom-progress {
        height: 30px;
        background-color: #f0ad4e;
        border-radius: 15px;
        overflow: hidden;
        flex: 1;
        box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .custom-progress .progress-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 15px;
        font-weight: 600;
        color: #fff;
        transition: width 1s ease-in-out;
    }

    .progress-label {
        font-size: 0.9rem;
        font-weight: 500;
    }

    .no-faq-message {
        text-align: center;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
    }

    .no-faq-message p {
        font-size: 1.1rem;
        color: #555;
        margin: 0;
    }
</style>

<!-- PPDB Section Start -->
<section class="ppdb-section py-5">
    <div class="container">
        <!-- Header Section -->
        <div class="text-center mb-5">
            <h2 class="section-title">Pendaftaran Peserta Didik Baru</h2>
            <hr class="w-25 mx-auto border-dark">
        </div>

        <!-- Main Content -->
        <div class="row align-items-center" style="padding-top: 30px; padding-bottom: 30px;">
            <!-- Left Side: PPDB Information -->
            <div class="col-lg-6">
                <h3 class="text-primary fw-bold text-center mb-4">
                    Smart Character Islamic School<br>Tahun Ajaran 2025-2026
                </h3>
                <p class="text-justify">
                    {!! $ppdb->description !!}
                </p>

                <div class="mb-3">
                    <h5 class="text-primary">🌟 Program Unggulan:</h5>
                    <ul class="list-unstyled ps-3">
                        @foreach ($ppdb->program_unggulan as $program)
                        <li>✅ {{ $program }}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="mb-3">
                    <h5 class="text-primary">📌 Jenjang Pendidikan:</h5>
                    <p>{{ $ppdb->jenjang_pendidikan }}</p>
                </div>

                <div class="mb-3">
                    <h5 class="text-primary">🗓️ Jadwal Pendaftaran:</h5>
                    <p>{{ $ppdb->jadwal_pendaftaran }}</p>
                </div>

                <div class="mb-3">
                    <h5 class="text-primary">📞 Informasi & Kontak:</h5>
                    <p>{!! $ppdb->contact_info !!}</p>
                </div>

                <a href="{{route('login')}}" class="header-btn"
                    style="display: inline-flex; align-items: center; padding: 8px 15px; background-color: #E47804; color: #fff; text-decoration: none; border-radius: 4px; transition: background-color 0.3s ease-in-out;"
                    onmouseover="this.style.backgroundColor='#FF9800';"
                    onmouseout="this.style.backgroundColor='#E47804';">
                    Daftar Sekarang
                </a>
            </div>

            <!-- Right Side: Image -->
            <div class="col-lg-6 text-center">
                @if ($ppdb->image)
                <img src="{{ Storage::url($ppdb->image) }}" alt="PPDB SCIS" class="rounded" style="max-width: 85%;">
                @else
                <img src="{{ asset('assets/img/ppdb.png') }}" alt="PPDB SCIS" class="rounded" style="max-width: 85%;">
                @endif
            </div>
        </div>

        <!-- Additional Information Section with Accordion -->
        <div class="row mt-5">
            <div class="col-12">
                <!-- Highlighted Informasi PPDB Subheading -->
                <div class="ppdb-info-header mb-2">
                    <h5 class="subheading">📚 Informasi PPDB Lainnya</h5>
                </div>

                <div class="accordion" id="ppdbAccordion">
                    <!-- Rincian Biaya -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                Rincian Biaya
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#ppdbAccordion">
                            <div class="accordion-body">
                                <ul>
                                    @foreach ($ppdb->rincian_biaya as $biaya)
                                    <li>{{ $biaya }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Jadwal PPDB -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Jadwal PPDB
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#ppdbAccordion">
                            <div class="accordion-body">
                                <ul>
                                    @foreach ($ppdb->jadwal_ppdb as $jadwal)
                                    <li>{{ $jadwal }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Dokumen yang Diperlukan -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Dokumen yang Diperlukan
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#ppdbAccordion">
                            <div class="accordion-body">
                                <ul>
                                    @foreach ($ppdb->dokumen_diperlukan as $dokumen)
                                    <li>{{ $dokumen }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="row mt-5">
            <div class="container">
                <div class="page-title-box">
                    <div class="text-center">
                        <div class="ppdb-info-header mb-2">
                            <h5 class="subheading"> ⁉️ Frequently Asked Questions</h5>
                        </div>
                        <p class="text-muted">Kami siap membantu menjawab pertanyaan Anda seputar Penerimaan Peserta Didik Baru (PPDB) untuk jenjang TK, SD, SMP, dan SMA. Temukan informasi penting mengenai persyaratan, jadwal, biaya, dan prosedur pendaftaran di bawah ini.</p>
                    </div>
                </div>

                <div class="row mt-4">
                    @if ($faqs->isEmpty())
                    <div class="col-12">
                        <div class="no-faq-message">
                            <p>Belum ada FAQ yang tersedia saat ini. Silakan hubungi kami untuk informasi lebih lanjut.</p>
                        </div>
                    </div>
                    @else
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
                    @endif
                </div>
            </div>
        </div>

        <!-- Form and Quota Section -->
        <div class="row mt-5">
            <div class="page-title-box">
                <div class="text-center">
                    <div class="ppdb-info-header mb-2">
                        <h5 class="subheading">🔎 Hubungi Kami</h5>
                    </div>
                    <p class="text-muted">Kami siap membantu Anda mendapatkan informasi lengkap mengenai PPDB untuk jenjang TK, SD, SMP, dan SMA. Silahkan hubungi kami untuk mendapatkan bantuan terkait PPDB.</p>
                </div>
            </div>
            <!-- Form Section -->
            <div class="col-lg-6">
                <div class="card p-4 shadow-sm">
                    <h5 class="mb-3">Untuk informasi lebih lanjut silahkan isi formulir dibawah ini</h5>
                    @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <form action="{{ route('ppdb') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="namaSiswa" class="form-label">Nama Siswa/Anak *</label>
                            <input type="text" class="form-control" id="namaSiswa" name="namaSiswa" required>
                        </div>
                        <div class="mb-3">
                            <label for="asalSekolah" class="form-label">Asal Sekolah *</label>
                            <input type="text" class="form-control" id="asalSekolah" name="asalSekolah" required>
                        </div>
                        <div class="mb-3">
                            <label for="namaOrangTua" class="form-label">Nama Orang Tua/Wali *</label>
                            <input type="text" class="form-control" id="namaOrangTua" name="namaOrangTua" required>
                        </div>
                        <div class="mb-3">
                            <label for="nomorHP" class="form-label">Nomor HP/WhatsApp *</label>
                            <input type="text" class="form-control" id="nomorHP" name="nomorHP" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email *</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenjang Pendidikan *</label><br>
                            @foreach (\App\Models\Level::orderByRaw("FIELD(slug, 'tk', 'sd', 'smp', 'sma', 'kuliah')")->orderBy('name')->get() as $level)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenjang" id="{{ $level->slug }}" value="{{ $level->slug }}" {{ old('jenjang') == $level->slug ? 'checked' : '' }} required>
                                <label class="form-check-label" for="{{ $level->slug }}">{{strtoupper($level->slug)}}</label>
                            </div>
                            @endforeach
                        </div>
                        <div class="mb-3">
                            <label for="pesan" class="form-label">Pesan Tambahan</label>
                            <textarea class="form-control" id="pesan" name="pesan" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-warning text-white" style="display: inline-flex; align-items: center; padding: 8px 15px; background-color: #E47804; color: #fff; text-decoration: none; border-radius: 4px; transition: background-color 0.3s ease-in-out;"
                            onmouseover="this.style.backgroundColor='#FF9800';"
                            onmouseout="this.style.backgroundColor='#E47804';">Kirim</button>
                    </form>
                </div>
            </div>

            <!-- Jumlah Pendaftar Section -->
            <div class="col-lg-6">
                <div class="quota-section">
                    <h5 class="quota-heading mb-4">Jumlah Pendaftar</h5>
                    <div class="row g-3">
                        <!-- TK Card -->
                        <div class="col-md-6">
                            <div class="card stat-card shadow-sm text-center">
                                <div class="card-body">
                                    <h6 class="card-title text-uppercase text-primary">TK</h6>
                                    <h3 class="card-text fw-bold text-dark">{{ $ppdb->registrant_counts['tk'] ?? 0 }}</h3>
                                    <p class="card-subtitle text-muted">Pendaftar</p>
                                </div>
                            </div>
                        </div>
                        <!-- SD Card -->
                        <div class="col-md-6">
                            <div class="card stat-card shadow-sm text-center">
                                <div class="card-body">
                                    <h6 class="card-title text-uppercase text-primary">SD</h6>
                                    <h3 class="card-text fw-bold text-dark">{{ $ppdb->registrant_counts['sd'] ?? 0 }}</h3>
                                    <p class="card-subtitle text-muted">Pendaftar</p>
                                </div>
                            </div>
                        </div>
                        <!-- SMP Card -->
                        <div class="col-md-6">
                            <div class="card stat-card shadow-sm text-center">
                                <div class="card-body">
                                    <h6 class="card-title text-uppercase text-primary">SMP</h6>
                                    <h3 class="card-text fw-bold text-dark">{{ $ppdb->registrant_counts['smp'] ?? 0 }}</h3>
                                    <p class="card-subtitle text-muted">Pendaftar</p>
                                </div>
                            </div>
                        </div>
                        <!-- SMA Card -->
                        <div class="col-md-6">
                            <div class="card stat-card shadow-sm text-center">
                                <div class="card-body">
                                    <h6 class="card-title text-uppercase text-primary">SMA</h6>
                                    <h3 class="card-text fw-bold text-dark">{{ $ppdb->registrant_counts['sma'] ?? 0 }}</h3>
                                    <p class="card-subtitle text-muted">Pendaftar</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- PPDB Section End -->
@endsection
