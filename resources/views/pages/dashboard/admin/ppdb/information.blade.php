@extends('layouts.dashboard.app')

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Informasi Pendaftaran</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">SCIS</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">PPDB</a></li>
                            <li class="breadcrumb-item active">Informasi Pendaftaran</li>
                        </ol>
                    </div>
                </div>
            </div>

            <!-- Filter Buttons -->
            <div class="row mb-3">
                <div class="col-12">
                    <div class="btn-group" role="group" aria-label="Filter Jenjang">
                        <button type="button" class="btn btn-primary filter-btn" data-filter="all">All</button>
                        <button type="button" class="btn btn-secondary filter-btn" data-filter="tk">TK</button>
                        <button type="button" class="btn btn-secondary filter-btn" data-filter="sd">SD</button>
                        <button type="button" class="btn btn-secondary filter-btn" data-filter="smp">SMP</button>
                        <button type="button" class="btn btn-secondary filter-btn" data-filter="sma">SMA</button>
                    </div>
                </div>
            </div>

            <div id="registration-info">
                <!-- TK Section -->
                <div class="row registration-section" data-jenjang="tk">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Taman Kanak-Kanak (TK)</h4>
                                <p class="sub-title">Informasi pendaftaran untuk jenjang TK.</p>

                                <div class="registration-content">
                                    <h5>Persyaratan</h5>
                                    <ul>
                                        <li>Membayar biaya pendaftaran Rp. 450.000,-</li>
                                        <li>Mengisi formulir pendaftaran (online)</li>
                                        <li>Upload kartu keluarga</li>
                                        <li>Upload Kartu Keluarga (KK)</li>
                                        <li>Upload scan/foto Akta Kelahiran</li>
                                        <li>Upload pasfoto berukuran 3 x 4 berwarna</li>
                                        <li>Upload scan/foto piagam kejuaraan (jika ada)</li>
                                        <li>Usia minimal 4 tahun 10 bulan per 30 Juni 2025 (minimal kelahiran 31 Agustus 2019)</li>
                                    </ul>

                                    <h5>Tahapan Pendaftaran</h5>
                                    <ol>
                                        <li>Pengambilan formulir di sekretariat sekolah</li>
                                        <li>Pengisian dan pengembalian formulir</li>
                                        <li>Observasi anak oleh guru</li>
                                        <li>Pengumuman hasil seleksi</li>
                                    </ol>

                                    <h5>Biaya</h5>
                                    <ul>
                                        <li>Formulir Pendaftaran: Rp 150.000</li>
                                        <li>Uang Pangkal: Rp 3.000.000</li>
                                        <li>SPP Bulanan: Rp 350.000</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SD Section -->
                <div class="row registration-section" data-jenjang="sd">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Sekolah Dasar (SD)</h4>
                                <p class="sub-title">Informasi pendaftaran untuk jenjang SD.</p>

                                <div class="registration-content">
                                    <h5>Persyaratan</h5>
                                    <ul>
                                        <li>Membayar biaya pendaftaran Rp. 450.000,-</li>
                                        <li>Mengisi formulir pendaftaran (online)</li>
                                        <li>Upload kartu keluarga</li>
                                        <li>Upload Kartu Keluarga (KK)</li>
                                        <li>Upload scan/foto Akta Kelahiran</li>
                                        <li>Upload pasfoto berukuran 3 x 4 berwarna</li>
                                        <li>Upload scan/foto piagam kejuaraan (jika ada)</li>
                                        <li>Usia minimal 5 tahun 10 bulan per 30 Juni 2025 (minimal kelahiran 31 Agustus 2019)</li>
                                    </ul>

                                    <h5>Tahapan Pendaftaran</h5>
                                    <ol>
                                        <li>Pendaftaran online/offline</li>
                                        <li>Tes kemampuan dasar</li>
                                        <li>Wawancara orang tua</li>
                                        <li>Pengumuman hasil</li>
                                    </ol>

                                    <h5>Biaya</h5>
                                    <ul>
                                        <li>Formulir Pendaftaran: Rp 200.000</li>
                                        <li>Uang Pangkal: Rp 5.000.000</li>
                                        <li>SPP Bulanan: Rp 500.000</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SMP Section -->
                <div class="row registration-section" data-jenjang="smp">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Sekolah Menengah Pertama (SMP)</h4>
                                <p class="sub-title">Informasi pendaftaran untuk jenjang SMP.</p>

                                <div class="registration-content">
                                    <h5>Persyaratan</h5>
                                    <ul>
                                        <li>Fotokopi Ijazah SD (legalisir, 2 lembar)</li>
                                        <li>Fotokopi Akte Kelahiran (2 lembar)</li>
                                        <li>Fotokopi Kartu Keluarga (2 lembar)</li>
                                        <li>Pas foto 3x4 (2 lembar)</li>
                                    </ul>

                                    <h5>Tahapan Pendaftaran</h5>
                                    <ol>
                                        <li>Pendaftaran online/offline</li>
                                        <li>Tes tulis (Matematika & Bahasa)</li>
                                        <li>Wawancara siswa dan orang tua</li>
                                        <li>Pengumuman hasil</li>
                                    </ol>

                                    <h5>Biaya</h5>
                                    <ul>
                                        <li>Formulir Pendaftaran: Rp 250.000</li>
                                        <li>Uang Pangkal: Rp 7.000.000</li>
                                        <li>SPP Bulanan: Rp 700.000</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SMA Section -->
                <div class="row registration-section" data-jenjang="sma">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Sekolah Menengah Atas (SMA)</h4>
                                <p class="sub-title">Informasi pendaftaran untuk jenjang SMA.</p>

                                <div class="registration-content">
                                    <h5>Persyaratan</h5>
                                    <ul>
                                        <li>Fotokopi Ijazah SMP (legalisir, 2 lembar)</li>
                                        <li>Fotokopi Akte Kelahiran (2 lembar)</li>
                                        <li>Fotokopi Kartu Keluarga (2 lembar)</li>
                                        <li>Pas foto 3x4 (2 lembar)</li>
                                    </ul>

                                    <h5>Tahapan Pendaftaran</h5>
                                    <ol>
                                        <li>Pendaftaran online/offline</li>
                                        <li>Tes tulis (IPA/IPS, Matematika, Bahasa)</li>
                                        <li>Wawancara siswa</li>
                                        <li>Pengumuman hasil</li>
                                    </ol>

                                    <h5>Biaya</h5>
                                    <ul>
                                        <li>Formulir Pendaftaran: Rp 300.000</li>
                                        <li>Uang Pangkal: Rp 10.000.000</li>
                                        <li>SPP Bulanan: Rp 900.000</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        © SCIS, 2025. All Right Reserved
    </footer>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('.filter-btn');
        const sections = document.querySelectorAll('.registration-section');

        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                const filter = this.getAttribute('data-filter');

                // Toggle active class on buttons
                filterButtons.forEach(btn => btn.classList.remove('btn-primary'));
                filterButtons.forEach(btn => btn.classList.add('btn-secondary'));
                this.classList.remove('btn-secondary');
                this.classList.add('btn-primary');

                // Show/hide sections based on filter
                sections.forEach(section => {
                    const jenjang = section.getAttribute('data-jenjang');
                    if (filter === 'all' || jenjang === filter) {
                        section.style.display = 'block';
                    } else {
                        section.style.display = 'none';
                    }
                });
            });
        });

        // Default: Show all sections
        sections.forEach(section => section.style.display = 'block');
        filterButtons[0].classList.remove('btn-secondary');
        filterButtons[0].classList.add('btn-primary');
    });
</script>
@endsection
