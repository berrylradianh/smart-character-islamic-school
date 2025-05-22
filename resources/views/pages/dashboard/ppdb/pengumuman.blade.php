@php
use Illuminate\Support\Facades\Auth;
use App\Models\Level;
@endphp

@extends('layouts.dashboard.app')

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Pengumuman Pendaftaran</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">SCIS</li>
                            <li class="breadcrumb-item">PPDB</li>
                            <li class="breadcrumb-item active">Pengumuman</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30 shadow-sm">
                        <div class="card-body">
                            <h5 class="mt-0 header-title" style="padding-bottom: 10px;">Status Pendaftaran</h5>

                            @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            @endif
                            @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            @endif
                            @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            @endif

                            @if ($registration)
                            <!-- Status Pendaftaran -->
                            <div class="mt-4">
                                <div class="card border-0 shadow-lg rounded-lg">
                                    <div class="card-body p-4">
                                        <div class="d-flex align-items-center mb-4">
                                            <div class="mr-3">
                                                @if ($registration->status == 'waiting')
                                                <i class="fas fa-hourglass-half fa-3x text-warning animate__animated animate__pulse animate__infinite"></i>
                                                @elseif ($registration->status == 'approve' || $registration->status == 'accepted')
                                                <i class="fas fa-check-circle fa-3x text-success animate__animated animate__bounceIn"></i>
                                                @else
                                                <i class="fas fa-times-circle fa-3x text-danger animate__animated animate__shakeX"></i>
                                                @endif
                                            </div>
                                            <div>
                                                <h5 class="mb-1 font-weight-bold text-dark">
                                                    @if ($registration->status == 'waiting')
                                                    Menunggu Verifikasi
                                                    @elseif ($registration->status == 'approve')
                                                    Diterima Seleksi Administrasi
                                                    @elseif ($registration->status == 'decline')
                                                    Pendaftaran Ditolak
                                                    @elseif ($registration->status == 'accepted')
                                                    Diterima
                                                    @else
                                                    Tidak Diterima
                                                    @endif
                                                </h5>
                                                <p class="text-muted mb-0">
                                                    @if ($registration->status == 'waiting')
                                                    Pendaftaran Anda sedang ditinjau oleh tim kami. Anda akan menerima pembaruan segera.
                                                    @elseif ($registration->status == 'approve')
                                                    Selamat! Pendaftaran Anda telah diterima. Silakan periksa detail tes di bawah ini.
                                                    @elseif ($registration->status == 'decline')
                                                    Maaf, pendaftaran Anda tidak memenuhi kriteria. Silahkan segera revisi dan mengirimkan kembali ke tim kami.
                                                    @elseif ($registration->status == 'accepted')
                                                    Selamat, Anda telah diterima di Smart Character Islamic School.
                                                    @else
                                                    Mohon maaf, Anda belum diterima di Smart Character Islamic School. Terima kasih atas partisipasinya.
                                                    @endif
                                                </p>
                                            </div>
                                        </div>

                                        @if ($registration->status == 'decline' && $registration->decline_reason)
                                        <hr class="my-4">
                                        <h6 class="font-weight-bold mb-3 text-dark">Alasan Penolakan</h6>
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="fas fa-comment-alt fa-lg text-primary mr-3"></i>
                                            <div>
                                                <p class="mb-0">{{ $registration->decline_reason }}</p>
                                            </div>
                                        </div>
                                        @endif

                                        @if ($registration->status == 'approve' && $registration->jadwal_tes)
                                        <hr class="my-4">
                                        <h6 class="font-weight-bold mb-3 text-dark">Detail Tes</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-calendar-alt fa-lg text-primary mr-3"></i>
                                                    <div>
                                                        <strong>Jadwal Tes:</strong>
                                                        <p class="mb-0">{{ \Carbon\Carbon::parse($registration->jadwal_tes)->format('d M Y, H:i') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                @if ($registration->schoolLocation)
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-map-marker-alt fa-lg text-primary mr-3"></i>
                                                    <div>
                                                        <strong>Lokasi:</strong>
                                                        <p class="mb-0">{{ $registration->schoolLocation->nama_lokasi }}<br>{{ $registration->schoolLocation->alamat }}</p>
                                                    </div>
                                                </div>
                                                @else
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-map-marker-alt fa-lg text-muted mr-3"></i>
                                                    <div>
                                                        <strong>Lokasi:</strong>
                                                        <p class="mb-0 text-muted">Belum ditentukan</p>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                @if ($registration->gedung)
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-building fa-lg text-primary mr-3"></i>
                                                    <div>
                                                        <strong>Gedung:</strong>
                                                        <p class="mb-0">{{ $registration->gedung->nama_gedung }}</p>
                                                    </div>
                                                </div>
                                                @else
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-building fa-lg text-muted mr-3"></i>
                                                    <div>
                                                        <strong>Gedung:</strong>
                                                        <p class="mb-0 text-muted">Belum ditentukan</p>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                @if ($registration->ruang)
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-door-open fa-lg text-primary mr-3"></i>
                                                    <div>
                                                        <strong>Ruang:</strong>
                                                        <p class="mb-0">{{ $registration->ruang->nama_ruang }}</p>
                                                    </div>
                                                </div>
                                                @else
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-door-open fa-lg text-muted mr-3"></i>
                                                    <div>
                                                        <strong>Ruang:</strong>
                                                        <p class="mb-0 text-muted">Belum ditentukan</p>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        @endif

                                        @if ($registration->status == 'decline')
                                        <div class="mt-4">
                                            <a href="{{ route('dashboard.ppdb_pendaftaran.revisi') }}" class="btn btn-primary btn-sm rounded-pill px-4">
                                                <i class="fas fa-edit mr-2"></i> Revisi Data
                                            </a>
                                        </div>
                                        @elseif ($registration->status == 'approve')
                                        <div class="mt-4">
                                            <button id="downloadKartuPeserta" class="btn btn-success btn-sm rounded-pill px-4">
                                                <i class="fas fa-download mr-2"></i> Download Kartu Peserta
                                            </button>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="alert alert-info" role="alert">
                                Belum ada data pendaftaran. Silakan <a href="{{ route('dashboard.ppdb_pendaftaran') }}" class="alert-link">lakukan pendaftaran</a> terlebih dahulu.
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        © SCIS, 2025. All Rights Reserved
    </footer>
</div>

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
    // Function to load image as base64
    function loadImageAsBase64(url) {
        return new Promise((resolve, reject) => {
            const img = new Image();
            img.crossOrigin = 'Anonymous';
            img.onload = () => {
                const canvas = document.createElement('canvas');
                canvas.width = img.width;
                canvas.height = img.height;
                const ctx = canvas.getContext('2d');
                ctx.drawImage(img, 0, 0);
                resolve(canvas.toDataURL('image/jpeg'));
            };
            img.onerror = () => reject(new Error('Failed to load image'));
            img.src = url;
        });
    }

    // Download Kartu Peserta
    const downloadButton = document.getElementById('downloadKartuPeserta');
    if (downloadButton) {
        downloadButton.addEventListener('click', async function() {
            const {
                jsPDF
            } = window.jspdf;
            const doc = new jsPDF({
                orientation: 'portrait',
                unit: 'mm',
                format: 'a5' // A5 size: 148mm x 210mm
            });

            // Define user and registration data
            const userData = {
                name: "{{ auth()->user()->name ?? 'Tidak diisi' }}",
                sd_mi_asal: "{{ auth()->user()->sd_mi_asal ?? 'Tidak diisi' }}",
                pasfoto_path: "{{ auth()->user()->pasfoto_path ? asset('storage/' . auth()->user()->pasfoto_path) : '' }}"
            };

            const registrationData = {
                no_peserta: "{{ $registration ? ($registration->no_peserta ?? 'Belum ditentukan') : 'Belum ditentukan' }}",
                jadwal_tes: "{{ $registration ? ($registration->jadwal_tes ? \Carbon\Carbon::parse($registration->jadwal_tes)->format('d M Y, H:i') : 'Belum ditentukan') : 'Belum ditentukan' }}",
                gedung: "{{ $registration && $registration->schoolLocation ? $registration->gedung->nama_gedung : 'Belum ditentukan' }}",
                ruang: "{{ $registration && $registration->schoolLocation ? $registration->ruang->nama_ruang : 'Belum ditentukan' }}",
                lokasi: "{{ $registration && $registration->schoolLocation ? $registration->schoolLocation->alamat . ', ' . $registration->schoolLocation->nama_lokasi : 'Belum ditentukan' }}"
            };

            try {
                const logoUrl = '/assets/img/logo/logo-white.png'; // Hardcoded path relative to public directory
                const logoData = await loadImageAsBase64(logoUrl);
                doc.addImage(logoData, 'PNG', 10, 12, 20, 20); // Logo: 30x30mm at top-left
            } catch (error) {
                console.error('Failed to load logo:', error);
            }

            // Headings (centered)
            doc.setFont("helvetica", "bold");
            doc.setFontSize(14);
            doc.text("Kartu Peserta PPDB", 74, 15, {
                align: "center"
            }); // Centered on A5 (148mm width)
            doc.setFontSize(10);
            doc.text("Smart Character Islamic School", 74, 22, {
                align: "center"
            });

            // Address (centered, smaller font, wrapped)
            doc.setFont("helvetica", "normal");
            doc.setFontSize(8);
            const address = "Sindangreret RT. 02 RW. 04, Blok Situ Bojong, Tamanjaya, Kec. Tamansari, Kota Tasikmalaya, Jawa Barat 46196";
            const addressLines = doc.splitTextToSize(address, 90); // Wrap within 128mm (148mm - 10mm margins)
            doc.text(addressLines, 74, 28, {
                align: "center"
            }); // Start at y=28
            // Horizontal line to separate letterhead
            doc.setLineWidth(0.5);
            doc.line(10, 35, 138, 35); // Line from x=10 to x=138 (148mm - 10mm margins) at y=35

            // Add photo if available
            if (userData.pasfoto_path) {
                try {
                    const imgData = await loadImageAsBase64(userData.pasfoto_path);
                    doc.addImage(imgData, 'JPEG', 108, 45, 30, 30); // Photo: 30x30mm, adjusted y=45
                } catch (error) {
                    console.error('Failed to load photo:', error);
                }
            }

            // Card Content
            doc.setFont("helvetica", "bold");
            doc.setFontSize(12);
            doc.text(userData.name.toUpperCase(), 10, 45);

            doc.setFont("helvetica", "normal");
            doc.setFontSize(10);
            const details = [{
                    label: "No Peserta",
                    value: registrationData.no_peserta
                },
                {
                    label: "Asal Sekolah",
                    value: userData.sd_mi_asal
                },
                {
                    label: "Waktu Ujian",
                    value: registrationData.jadwal_tes
                },
                {
                    label: "Gedung",
                    value: registrationData.gedung
                },
                {
                    label: "Ruang",
                    value: registrationData.ruang
                },
                {
                    label: "Lokasi",
                    value: registrationData.lokasi
                }
            ];

            let y = 55;
            details.forEach(detail => {
                doc.setFont("helvetica", "bold");
                doc.text(`${detail.label}:`, 10, y);
                doc.setFont("helvetica", "normal");
                const splitText = doc.splitTextToSize(detail.value, 90);
                doc.text(splitText, 40, y);
                y += splitText.length * 5 + 3;
            });

            // Footer
            doc.setFont("helvetica", "italic");
            doc.setFontSize(8);
            doc.text("© SCIS, 2025. Harap bawa kartu ini saat tes.", 74, 200, {
                align: "center"
            });

            // Save the PDF
            doc.save(`Kartu_Peserta_${userData.name}.pdf`);
        });
    }
</script>
@endsection
