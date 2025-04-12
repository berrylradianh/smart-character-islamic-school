@extends('layouts.app')

@section('title', 'Pendaftaran PPDB')

@section('content')
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
                    <strong>Smart Character Islamic School (SCIS)</strong> membuka <strong>Penerimaan Peserta Didik Baru (PPDB)</strong> untuk Tahun Ajaran 2025–2026!
                    Kami berkomitmen mencetak generasi Qur'ani yang cerdas, berkarakter, dan siap menghadapi tantangan zaman.
                </p>

                <div class="mb-3">
                    <h5 class="text-primary">🌟 Program Unggulan:</h5>
                    <ul class="list-unstyled ps-3">
                        <li>✅ Tahfizh Qur’an dan pembiasaan adab Islami</li>
                        <li>✅ Pendidikan karakter berbasis Al-Qur’an dan Hadits</li>
                        <li>✅ Bahasa Inggris dan Arab sejak dini</li>
                        <li>✅ Pembelajaran berbasis proyek dan teknologi</li>
                        <li>✅ Ekstrakurikuler Islami dan pengembangan minat bakat</li>
                    </ul>
                </div>

                <div class="mb-3">
                    <h5 class="text-primary">📌 Jenjang Pendidikan:</h5>
                    <p>Taman Kanak-Kanak (TK), dan Sekolah Dasar (SD), Sekolah Menengah (SMP), dan Sekolah Menengah Atas (SMA)</p>
                </div>

                <div class="mb-3">
                    <h5 class="text-primary">🗓️ Jadwal Pendaftaran:</h5>
                    <p>1 November 2024 – 30 Juni 2025</p>
                </div>

                <div class="mb-3">
                    <h5 class="text-primary">📞 Informasi & Kontak:</h5>
                    <p>WhatsApp: <a href="https://wa.me/62812XXXXXXX" target="_blank">0812-XXXX-XXXX</a></p>
                </div>

                <a href="{{route('auth.register')}}" class="header-btn"
                    style="display: inline-flex; align-items: center; padding: 8px 15px; background-color: #E47804; color: #fff; text-decoration: none; border-radius: 4px; transition: background-color 0.3s ease-in-out;"
                    onmouseover="this.style.backgroundColor='#FF9800';"
                    onmouseout="this.style.backgroundColor='#E47804';">
                    Daftar Sekarang
                </a>
            </div>

            <!-- Right Side: Image -->
            <div class="col-lg-6 text-center">
                <img src="{{ asset('assets/img/ppdb.png') }}" alt="PPDB SCIS" class="rounded" style="max-width: 85%;">
            </div>
        </div>


        <!-- Form and Quota Section -->
        <div class="row mt-5">
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

            <!-- Quota Section -->
            <div class="col-lg-6">
                <div class="quota-section">
                    <h5 class="quota-heading mb-4">Sisa Kuota Pendaftaran</h5>
                    <div class="quota-item mb-3">
                        <div class="quota-label">TK</div>
                        <div class="progress custom-progress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 35%;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100">
                                <span class="progress-label">35%</span> 35%
                            </div>
                        </div>
                    </div>
                    <div class="quota-item mb-3">
                        <div class="quota-label">SD</div>
                        <div class="progress custom-progress">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 70%;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
                                <span class="progress-label">70%</span> 70%
                            </div>
                        </div>
                    </div>
                    <div class="quota-item mb-3">
                        <div class="quota-label">SMP</div>
                        <div class="progress custom-progress">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 40%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                <span class="progress-label">40%</span> 40%
                            </div>
                        </div>
                    </div>
                    <div class="quota-item mb-3">
                        <div class="quota-label">SMA</div>
                        <div class="progress custom-progress">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 20%;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                <span class="progress-label">20%</span> 20%
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Information Section with Accordion -->
        <div class="row mt-5">
            <div class="col-12">
                <!-- Highlighted Informasi PPDB Subheading -->
                <div class="ppdb-info-header mb-4">
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
                                    <li>Biaya Pendaftaran: Rp 500.000</li>
                                    <li>Uang Pangkal: Rp 5.000.000</li>
                                    <li>SPP Bulanan: Rp 1.000.000</li>
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
                                    <li>Pendaftaran: 1 Januari 2025 - 30 Juni 2025</li>
                                    <li>Tes Seleksi: 1 Juli 2025 - 5 Juli 2025</li>
                                    <li>Pengumuman: 10 Juli 2025</li>
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
                                    <li>Fotokopi Akta Kelahiran</li>
                                    <li>Fotokopi Kartu Keluarga</li>
                                    <li>Pas Foto 3x4 (2 lembar)</li>
                                    <li>Surat Keterangan Sehat</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- PPDB Section End -->

<style>
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

    /* Highlighted Informasi PPDB Subheading */
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

    /* Redesigned Quota Section */
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
</style>
@endsection
