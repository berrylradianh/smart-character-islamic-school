@extends('layouts.dashboard.app')

@section('content')
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Timeline Pendaftaran Seleksi Sekolah</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">SCIS</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">PPDB</a></li>
                            <li class="breadcrumb-item active">Timeline</li>
                        </ol>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end page-title -->

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

            <div class="row">
                <!-- TK Card -->
                <div class="col-lg-12 timeline-card" data-category="tk">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Timeline TK</h5>
                            <section class="cd-container">
                                <div class="main-timeline">
                                    <div class="timeline">
                                        <span class="timeline-icon"></span>
                                        <span class="year">1 - 15 Mei 2025</span>
                                        <div class="timeline-content">
                                            <h3 class="title">Pendaftaran Online TK</h3>
                                            <p class="description text-muted">
                                                Orang tua mendaftarkan anak usia 4-6 tahun melalui website resmi sekolah.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="timeline">
                                        <span class="timeline-icon"></span>
                                        <span class="year">16 - 20 Mei 2025</span>
                                        <div class="timeline-content">
                                            <h3 class="title">Pengumpulan Berkas</h3>
                                            <p class="description text-muted">
                                                Penyerahan akta kelahiran, KK, dan foto anak ke sekolah.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="timeline">
                                        <span class="timeline-icon"></span>
                                        <span class="year">25 - 27 Mei 2025</span>
                                        <div class="timeline-content">
                                            <h3 class="title">Observasi Anak</h3>
                                            <p class="description text-muted">
                                                Observasi kemampuan motorik dan sosial anak oleh guru TK.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="timeline">
                                        <span class="timeline-icon"></span>
                                        <span class="year">30 Mei 2025</span>
                                        <div class="timeline-content">
                                            <h3 class="title">Pengumuman Hasil</h3>
                                            <p class="description text-muted">
                                                Pengumuman siswa diterima diumumkan melalui website dan papan pengumuman.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="timeline">
                                        <span class="timeline-icon"></span>
                                        <span class="year">5 - 10 Juni 2025</span>
                                        <div class="timeline-content">
                                            <h3 class="title">Daftar Ulang</h3>
                                            <p class="description text-muted">
                                                Pembayaran biaya masuk dan pengambilan seragam sekolah.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="timeline">
                                        <span class="timeline-icon"></span>
                                        <span class="year">1 Juli 2025</span>
                                        <div class="timeline-content">
                                            <h3 class="title">Masuk Sekolah</h3>
                                            <p class="description text-muted">
                                                Hari pertama masuk sekolah untuk siswa TK.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>

                <!-- SD Card -->
                <div class="col-lg-12 timeline-card" data-category="sd">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Timeline SD</h5>
                            <section class="cd-container">
                                <div class="main-timeline">
                                    <div class="timeline">
                                        <span class="timeline-icon"></span>
                                        <span class="year">1 - 20 Juni 2025</span>
                                        <div class="timeline-content">
                                            <h3 class="title">Pendaftaran Online SD</h3>
                                            <p class="description text-muted">
                                                Pendaftaran untuk anak usia 6-7 tahun melalui portal sekolah.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="timeline">
                                        <span class="timeline-icon"></span>
                                        <span class="year">21 - 25 Juni 2025</span>
                                        <div class="timeline-content">
                                            <h3 class="title">Pengumpulan Berkas</h3>
                                            <p class="description text-muted">
                                                Penyerahan akta kelahiran, KK, dan rapor TK ke sekolah.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="timeline">
                                        <span class="timeline-icon"></span>
                                        <span class="year">28 - 30 Juni 2025</span>
                                        <div class="timeline-content">
                                            <h3 class="title">Tes Masuk SD</h3>
                                            <p class="description text-muted">
                                                Tes membaca, menulis, dan berhitung untuk calon siswa.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="timeline">
                                        <span class="timeline-icon"></span>
                                        <span class="year">5 Juli 2025</span>
                                        <div class="timeline-content">
                                            <h3 class="title">Pengumuman Hasil</h3>
                                            <p class="description text-muted">
                                                Pengumuman siswa diterima melalui website resmi.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="timeline">
                                        <span class="timeline-icon"></span>
                                        <span class="year">10 - 15 Juli 2025</span>
                                        <div class="timeline-content">
                                            <h3 class="title">Daftar Ulang</h3>
                                            <p class="description text-muted">
                                                Pembayaran biaya masuk dan pengukuran seragam.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="timeline">
                                        <span class="timeline-icon"></span>
                                        <span class="year">20 Juli 2025</span>
                                        <div class="timeline-content">
                                            <h3 class="title">Masuk Sekolah</h3>
                                            <p class="description text-muted">
                                                Hari pertama masuk sekolah untuk siswa SD.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>

                <!-- SMP Card -->
                <div class="col-lg-12 timeline-card" data-category="smp">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Timeline SMP</h5>
                            <section class="cd-container">
                                <div class="main-timeline">
                                    <div class="timeline">
                                        <span class="timeline-icon"></span>
                                        <span class="year">1 - 25 Juli 2025</span>
                                        <div class="timeline-content">
                                            <h3 class="title">Pendaftaran Online SMP</h3>
                                            <p class="description text-muted">
                                                Pendaftaran untuk lulusan SD melalui website sekolah.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="timeline">
                                        <span class="timeline-icon"></span>
                                        <span class="year">26 - 30 Juli 2025</span>
                                        <div class="timeline-content">
                                            <h3 class="title">Pengumpulan Berkas</h3>
                                            <p class="description text-muted">
                                                Penyerahan ijazah SD, SKHUN, dan rapor terakhir.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="timeline">
                                        <span class="timeline-icon"></span>
                                        <span class="year">2 - 5 Agustus 2025</span>
                                        <div class="timeline-content">
                                            <h3 class="title">Ujian Masuk SMP</h3>
                                            <p class="description text-muted">
                                                Ujian tertulis: Matematika, IPA, dan Bahasa Indonesia.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="timeline">
                                        <span class="timeline-icon"></span>
                                        <span class="year">10 Agustus 2025</span>
                                        <div class="timeline-content">
                                            <h3 class="title">Pengumuman Hasil</h3>
                                            <p class="description text-muted">
                                                Pengumuman siswa diterima di website dan sekolah.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="timeline">
                                        <span class="timeline-icon"></span>
                                        <span class="year">15 - 20 Agustus 2025</span>
                                        <div class="timeline-content">
                                            <h3 class="title">Daftar Ulang</h3>
                                            <p class="description text-muted">
                                                Pembayaran biaya masuk dan pengambilan buku pelajaran.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="timeline">
                                        <span class="timeline-icon"></span>
                                        <span class="year">1 September 2025</span>
                                        <div class="timeline-content">
                                            <h3 class="title">Masuk Sekolah</h3>
                                            <p class="description text-muted">
                                                Hari pertama masuk sekolah untuk siswa SMP.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>

                <!-- SMA Card -->
                <div class="col-lg-12 timeline-card" data-category="sma">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Timeline SMA</h5>
                            <section class="cd-container">
                                <div class="main-timeline">
                                    <div class="timeline">
                                        <span class="timeline-icon"></span>
                                        <span class="year">1 - 20 Agustus 2025</span>
                                        <div class="timeline-content">
                                            <h3 class="title">Pendaftaran Online SMA</h3>
                                            <p class="description text-muted">
                                                Pendaftaran untuk lulusan SMP melalui portal resmi.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="timeline">
                                        <span class="timeline-icon"></span>
                                        <span class="year">21 - 25 Agustus 2025</span>
                                        <div class="timeline-content">
                                            <h3 class="title">Pengumpulan Berkas</h3>
                                            <p class="description text-muted">
                                                Penyerahan ijazah SMP, SKHUN, dan rapor terakhir.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="timeline">
                                        <span class="timeline-icon"></span>
                                        <span class="year">28 - 31 Agustus 2025</span>
                                        <div class="timeline-content">
                                            <h3 class="title">Tes Masuk SMA</h3>
                                            <p class="description text-muted">
                                                Tes akademik: Matematika, Bahasa Inggris, dan IPA/IPS sesuai jurusan.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="timeline">
                                        <span class="timeline-icon"></span>
                                        <span class="year">5 September 2025</span>
                                        <div class="timeline-content">
                                            <h3 class="title">Pengumuman Hasil</h3>
                                            <p class="description text-muted">
                                                Pengumuman siswa diterima diumumkan secara online.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="timeline">
                                        <span class="timeline-icon"></span>
                                        <span class="year">10 - 15 September 2025</span>
                                        <div class="timeline-content">
                                            <h3 class="title">Daftar Ulang</h3>
                                            <p class="description text-muted">
                                                Pembayaran biaya masuk dan orientasi siswa baru.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="timeline">
                                        <span class="timeline-icon"></span>
                                        <span class="year">20 September 2025</span>
                                        <div class="timeline-content">
                                            <h3 class="title">Masuk Sekolah</h3>
                                            <p class="description text-muted">
                                                Hari pertama masuk sekolah untuk siswa SMA.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- container-fluid -->
    </div>
    <!-- content -->

    <footer class="footer">
        © SCIS, 2024. All Right Reserved
    </footer>
</div>

<!-- JavaScript untuk Filter -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('.filter-btn');
        const timelineCards = document.querySelectorAll('.timeline-card');

        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                const filter = this.getAttribute('data-filter');

                // Toggle active class on buttons
                filterButtons.forEach(btn => btn.classList.remove('btn-primary'));
                filterButtons.forEach(btn => btn.classList.add('btn-secondary'));
                this.classList.remove('btn-secondary');
                this.classList.add('btn-primary');

                // Show/hide cards based on filter
                timelineCards.forEach(card => {
                    const category = card.getAttribute('data-category');
                    if (filter === 'all' || category === filter) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });

        // Default: Show all cards
        timelineCards.forEach(card => card.style.display = 'block');
        filterButtons[0].classList.remove('btn-secondary');
        filterButtons[0].classList.add('btn-primary');
    });
</script>
@endsection
