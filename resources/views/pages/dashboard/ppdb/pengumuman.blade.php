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
                            @if ($registration->status == 'approve')
                            <div class="card border-0 shadow-lg rounded-lg mt-4">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center mb-4">
                                        <div class="mr-3">
                                            <i class="fas fa-clipboard-check fa-3x text-success animate__animated animate__bounceIn"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1 font-weight-bold text-dark">Diterima Seleksi Administrasi</h5>
                                            <p class="text-muted mb-0">
                                                Pendaftaran Anda telah diterima, lakukan tes terlebih dahulu, untuk detailnya silahkan cek di <a href="{{ route('dashboard.ppdb_pendaftaran') }}" class="alert-link">halaman pendaftaran</a>.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @elseif ($registration->status == 'waiting')
                            <div class="card border-0 shadow-lg rounded-lg mt-4">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center mb-4">
                                        <div class="mr-3">
                                            <i class="fas fa-hourglass-half fa-3x text-warning animate__animated animate__pulse animate__infinite"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1 font-weight-bold text-dark">Menunggu Verifikasi</h5>
                                            <p class="text-muted mb-0">
                                                Pendaftaran Anda sedang ditinjau oleh tim kami. Anda akan menerima pembaruan segera. Silakan cek status pendaftaran Anda di <a href="{{ route('dashboard.ppdb_pendaftaran') }}" class="alert-link">halaman pendaftaran</a>.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @elseif ($registration->status == 'decline')
                            <div class="card border-0 shadow-lg rounded-lg mt-4">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center mb-4">
                                        <div class="mr-3">
                                            <i class="fas fa-times-circle fa-3x text-danger animate__animated animate__shakeX"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1 font-weight-bold text-dark">Pendaftaran Ditolak</h5>
                                            <p class="text-muted mb-0">
                                                Maaf, pendaftaran Anda tidak memenuhi kriteria. Silakan revisi dan mengirimkan kembali ke tim kami. Silahkan cek status pendaftaran Anda di <a href="{{ route('dashboard.ppdb_pendaftaran') }}" class="alert-link">halaman pendaftaran</a>.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @elseif ($registration->status == 'accepted')
                            <div class="card border-0 shadow-lg rounded-lg">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center mb-4">
                                        <div class="mr-3">
                                            <i class="fas fa-check-circle fa-3x text-success animate__animated animate__bounceIn"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1 font-weight-bold text-dark">Diterima</h5>
                                            <p class="text-muted mb-0">
                                                Selamat, Anda telah diterima di Smart Character Islamic School.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @elseif ($registration->status == 'not_accepted')
                            <div class="card border-0 shadow-lg rounded-lg">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center mb-4">
                                        <div class="mr-3">
                                            <i class="fas fa-times-circle fa-3x text-danger animate__animated animate__shakeX"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1 font-weight-bold text-dark">Tidak Diterima</h5>
                                            <p class="text-muted mb-0">
                                                Mohon maaf, Anda belum diterima di Smart Character Islamic School. Terima kasih atas partisipasinya.
                                            </p>
                                        </div>
                                    </div>
                                    @if ($registration->decline_reason)
                                    <hr class="my-4">
                                    <h6 class="font-weight-bold mb-3 text-dark">Alasan Penolakan</h6>
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-comment-alt fa-lg text-primary mr-3"></i>
                                        <div>
                                            <p class="mb-0">{{ $registration->decline_reason }}</p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endif
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

    // Download Kartu Penerimaan
    const downloadButton = document.getElementById('downloadKartuPenerimaan');
    if (downloadButton) {
        downloadButton.addEventListener('click', async function() {
            const {
                jsPDF
            } = window.jspdf;
            const doc = new jsPDF({
                orientation: 'portrait',
                unit: 'mm',
                format: 'a5'
            });

            const userData = {
                name: "{{ auth()->user()->name ?? 'Tidak diisi' }}",
                sd_mi_asal: "{{ auth()->user()->sd_mi_asal ?? 'Tidak diisi' }}",
                pasfoto_path: "{{ auth()->user()->pasfoto_path ? asset('storage/' . auth()->user()->pasfoto_path) : '' }}"
            };

            const registrationData = {
                no_peserta: "{{ $registration ? ($registration->no_peserta ?? 'Belum ditentukan') : 'Belum ditentukan' }}",
                jenjang: "{{ auth()->user()->level ? strtoupper(auth()->user()->level->name) : 'Belum diatur' }}"
            };

            try {
                const logoUrl = '/assets/img/logo/logo-white.png';
                const logoData = await loadImageAsBase64(logoUrl);
                doc.addImage(logoData, 'PNG', 10, 12, 20, 20);
            } catch (error) {
                console.error('Failed to load logo:', error);
            }

            doc.setFont("helvetica", "bold");
            doc.setFontSize(14);
            doc.text("Kartu Penerimaan PPDB", 74, 15, {
                align: "center"
            });
            doc.setFontSize(10);
            doc.text("Smart Character Islamic School", 74, 22, {
                align: "center"
            });

            doc.setFont("helvetica", "normal");
            doc.setFontSize(8);
            const address = "Sindangreret RT. 02 RW. 04, Blok Situ Bojong, Tamanjaya, Kec. Tamansari, Kota Tasikmalaya, Jawa Barat 46196";
            const addressLines = doc.splitTextToSize(address, 90);
            doc.text(addressLines, 74, 28, {
                align: "center"
            });
            doc.setLineWidth(0.5);
            doc.line(10, 35, 138, 35);

            if (userData.pasfoto_path) {
                try {
                    const imgData = await loadImageAsBase64(userData.pasfoto_path);
                    doc.addImage(imgData, 'JPEG', 108, 45, 30, 30);
                } catch (error) {
                    console.error('Failed to load photo:', error);
                }
            }

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
                    label: "Jenjang",
                    value: registrationData.jenjang
                },
                {
                    label: "Status",
                    value: "Diterima"
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

            doc.setFont("helvetica", "italic");
            doc.setFontSize(8);
            doc.text("© SCIS, 2025. Selamat bergabung di Smart Character Islamic School.", 74, 200, {
                align: "center"
            });

            doc.save(`Kartu_Penerimaan_${userData.name}.pdf`);
        });
    }
</script>
@endsection
