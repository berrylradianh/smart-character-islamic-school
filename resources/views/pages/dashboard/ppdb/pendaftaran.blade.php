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
                        <h4 class="page-title">Pendaftaran</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">SCIS</li>
                            <li class="breadcrumb-item">PPDB</li>
                            <li class="breadcrumb-item active">Form Pendaftaran</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30 shadow-sm">
                        <div class="card-body">
                            <h5 class="mt-0 header-title">Form Pendaftaran</h5>

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
                            <!-- Status Pendaftaran (unchanged) -->
                            <div class="mt-4">
                                <div class="card border-0 shadow-lg rounded-lg">
                                    <div class="card-body p-4">
                                        <div class="d-flex align-items-center mb-4">
                                            <div class="mr-3">
                                                @if ($registration->status == 'waiting')
                                                <i class="fas fa-hourglass-half fa-3x text-warning animate__animated animate__pulse animate__infinite"></i>
                                                @elseif ($registration->status == 'approve')
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
                                                    Diterima
                                                    @else
                                                    Ditolak
                                                    @endif
                                                </h5>
                                                <p class="text-muted mb-0">
                                                    @if ($registration->status == 'waiting')
                                                    Pendaftaran Anda sedang ditinjau oleh tim kami. Anda akan menerima pembaruan segera.
                                                    @elseif ($registration->status == 'approve')
                                                    Selamat! Anda telah diterima. Silakan periksa detail tes di bawah ini.
                                                    @else
                                                    Maaf, pendaftaran Anda tidak memenuhi kriteria. Hubungi kami untuk informasi lebih lanjut.
                                                    @endif
                                                </p>
                                            </div>
                                        </div>

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
                                        </div>
                                        @endif

                                        @if ($registration->status == 'decline')
                                        <div class="mt-4">
                                            <a href="mailto:support@scis.ac.id" class="btn btn-primary btn-sm rounded-pill px-4">
                                                <i class="fas fa-envelope mr-2"></i> Hubungi Admin
                                            </a>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @else
                            <!-- Multi-Step Form -->
                            <div class="wizard">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#step1" data-toggle="tab">1. Data Pribadi</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link disabled" href="#step2" data-toggle="tab">2. Dokumen</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link disabled" href="#step3" data-toggle="tab">3. Pembayaran</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link disabled" href="#step4" data-toggle="tab">4. Preview</a>
                                    </li>
                                </ul>

                                <form enctype="multipart/form-data" action="{{ route('dashboard.ppdb_pendaftaran.store') }}" method="POST" class="needs-validation" novalidate id="registrationForm">
                                    @csrf
                                    <input type="hidden" name="level_id" value="{{ auth()->user()->level_id }}">

                                    <div class="tab-content mt-4">
                                        <!-- Step 1: Data Pribadi -->
                                        <div class="tab-pane active" id="step1">
                                            <h6>Data Pribadi</h6>
                                            @if (auth()->user()->level && auth()->user()->level->slug !== 'kuliah')
                                            <div class="form-group">
                                                <label for="nama_orang_tua">Nama Orang Tua</label>
                                                <input type="text" class="form-control" id="nama_orang_tua" name="nama_orang_tua" value="{{ old('nama_orang_tua') }}" required>
                                                <div class="invalid-feedback">
                                                    Harap masukkan nama orang tua.
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="no_hp_orang_tua">No. HP Orang Tua</label>
                                                <input type="text" class="form-control" id="no_hp_orang_tua" name="no_hp_orang_tua" value="{{ old('no_hp_orang_tua') }}" required>
                                                <div class="invalid-feedback">
                                                    Harap masukkan nomor HP orang tua.
                                                </div>
                                            </div>
                                            @endif
                                            <div class="form-group">
                                                <label for="pasfoto_path">Upload Pas Foto</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="pasfoto_path" name="pasfoto_path" accept=".jpg,.png" required>
                                                    <label class="custom-file-label" for="pasfoto_path">Pilih file...</label>
                                                    <small class="text-muted">Maks. 2MB, format: JPG, PNG</small>
                                                    <div class="invalid-feedback">
                                                        Harap unggah pas foto yang valid.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <button type="button" class="btn btn-primary next-step">Selanjutnya <i class="fas fa-arrow-right ml-2"></i></button>
                                            </div>
                                        </div>

                                        <!-- Step 2: Dokumen -->
                                        <div class="tab-pane" id="step2">
                                            <h6>Upload Dokumen</h6>
                                            <div class="form-group">
                                                <label for="kk_path">Upload Kartu Keluarga</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="kk_path" name="kk_path" accept=".pdf,.jpg,.png" required>
                                                    <label class="custom-file-label" for="kk_path">Pilih file...</label>
                                                    <small class="text-muted">Maks. 2MB, format: PDF, JPG, PNG</small>
                                                    <div class="invalid-feedback">
                                                        Harap unggah kartu keluarga yang valid.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="akta_path">Upload Akta Kelahiran</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="akta_path" name="akta_path" accept=".pdf,.jpg,.png" required>
                                                    <label class="custom-file-label" for="akta_path">Pilih file...</label>
                                                    <small class="text-muted">Maks. 2MB, format: PDF, JPG, PNG</small>
                                                    <div class="invalid-feedback">
                                                        Harap unggah akta kelahiran yang valid.
                                                    </div>
                                                </div>
                                            </div>
                                            @if (auth()->user()->level && in_array(auth()->user()->level->slug, ['smp', 'sma', 'kuliah']))
                                            <div class="form-group">
                                                <label for="ijazah_sd_path">Upload Ijazah SD</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="ijazah_sd_path" name="ijazah_sd_path" accept=".pdf,.jpg,.png" required>
                                                    <label class="custom-file-label" for="ijazah_sd_path">Pilih file...</label>
                                                    <small class="text-muted">Maks. 2MB, format: PDF, JPG, PNG</small>
                                                    <div class="invalid-feedback">
                                                        Harap unggah ijazah SD yang valid.
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @if (auth()->user()->level && in_array(auth()->user()->level->slug, ['sma', 'kuliah']))
                                            <div class="form-group">
                                                <label for="ijazah_smp_path">Upload Ijazah SMP</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="ijazah_smp_path" name="ijazah_smp_path" accept=".pdf,.jpg,.png" required>
                                                    <label class="custom-file-label" for="ijazah_smp_path">Pilih file...</label>
                                                    <small class="text-muted">Maks. 2MB, format: PDF, JPG, PNG</small>
                                                    <div class="invalid-feedback">
                                                        Harap unggah ijazah SMP yang valid.
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @if (auth()->user()->level && auth()->user()->level->slug === 'kuliah')
                                            <div class="form-group">
                                                <label for="ijazah_sma_path">Upload Ijazah SMA</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="ijazah_sma_path" name="ijazah_sma_path" accept=".pdf,.jpg,.png" required>
                                                    <label class="custom-file-label" for="ijazah_sma_path">Pilih file...</label>
                                                    <small class="text-muted">Maks. 2MB, format: PDF, JPG, PNG</small>
                                                    <div class="invalid-feedback">
                                                        Harap unggah ijazah SMA yang valid.
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            <div class="form-group">
                                                <label for="piagam_path">Upload Piagam (Opsional)</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="piagam_path" name="piagam_path" accept=".pdf,.jpg,.png">
                                                    <label class="custom-file-label" for="piagam_path">Pilih file...</label>
                                                    <small class="text-muted">Maks. 2MB, format: PDF, JPG, PNG</small>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <button type="button" class="btn btn-secondary prev-step mr-2"><i class="fas fa-arrow-left mr-2"></i> Kembali</button>
                                                <button type="button" class="btn btn-primary next-step">Selanjutnya <i class="fas fa-arrow-right ml-2"></i></button>
                                            </div>
                                        </div>

                                        <!-- Step 3: Pembayaran -->
                                        <div class="tab-pane" id="step3">
                                            <h6>Pembayaran</h6>
                                            <div class="form-group">
                                                <label for="jenjang">Jenjang</label>
                                                <input type="text" class="form-control" id="jenjang" value="{{ auth()->user()->level ? strtoupper(auth()->user()->level->name) : 'Belum diatur' }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="biaya">Biaya Pendaftaran</label>
                                                <input type="text" class="form-control" id="biaya" value="{{ optional(auth()->user()->level)->biaya ? 'Rp. ' . number_format(auth()->user()->level->biaya, 0, ',', '.') : 'Biaya belum diatur' }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="bukti_pembayaran">Upload Bukti Pembayaran</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="bukti_pembayaran" name="bukti_pembayaran" accept=".pdf,.jpg,.png" required>
                                                    <label class="custom-file-label" for="bukti_pembayaran">Pilih file...</label>
                                                    <small class="text-muted">
                                                        Upload bukti pembayaran biaya pendaftaran
                                                        {{ optional(auth()->user()->level)->biaya ? 'Rp. ' . number_format(auth()->user()->level->biaya, 0, ',', '.') : 'Biaya belum diatur' }}
                                                        (maks. 2MB, format: PDF, JPG, PNG)
                                                    </small>
                                                    <div class="invalid-feedback">
                                                        Harap unggah bukti pembayaran yang valid.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <button type="button" class="btn btn-secondary prev-step mr-2"><i class="fas fa-arrow-left mr-2"></i> Kembali</button>
                                                <button type="button" class="btn btn-primary next-step">Selanjutnya <i class="fas fa-arrow-right ml-2"></i></button>
                                            </div>
                                        </div>

                                        <!-- Step 4: Preview -->
                                        <div class="tab-pane" id="step4">
                                            <h6>Preview Data Pendaftaran</h6>
                                            <div class="card">
                                                <div class="card-body">
                                                    <h6 class="font-weight-bold">Data Pribadi</h6>
                                                    @if (auth()->user()->level && auth()->user()->level->slug !== 'kuliah')
                                                    <p><strong>Nama Orang Tua:</strong> <span id="preview_nama_orang_tua"></span></p>
                                                    <p><strong>No. HP Orang Tua:</strong> <span id="preview_no_hp_orang_tua"></span></p>
                                                    @endif
                                                    <p><strong>Pas Foto:</strong> <a href="#" id="preview_pasfoto_path" target="_blank">Lihat Pas Foto</a></p>

                                                    <hr>
                                                    <h6 class="font-weight-bold">Dokumen</h6>
                                                    <p><strong>Kartu Keluarga:</strong> <a href="#" id="preview_kk_path" target="_blank">Lihat Kartu Keluarga</a></p>
                                                    <p><strong>Akta Kelahiran:</strong> <a href="#" id="preview_akta_path" target="_blank">Lihat Akta Kelahiran</a></p>
                                                    @if (auth()->user()->level && in_array(auth()->user()->level->slug, ['smp', 'sma', 'kuliah']))
                                                    <p><strong>Ijazah SD:</strong> <a href="#" id="preview_ijazah_sd_path" target="_blank">Lihat Ijazah SD</a></p>
                                                    @endif
                                                    @if (auth()->user()->level && in_array(auth()->user()->level->slug, ['sma', 'kuliah']))
                                                    <p><strong>Ijazah SMP:</strong> <a href="#" id="preview_ijazah_smp_path" target="_blank">Lihat Ijazah SMP</a></p>
                                                    @endif
                                                    @if (auth()->user()->level && auth()->user()->level->slug === 'kuliah')
                                                    <p><strong>Ijazah SMA:</strong> <a href="#" id="preview_ijazah_sma_path" target="_blank">Lihat Ijazah SMA</a></p>
                                                    @endif
                                                    <p><strong>Piagam (Opsional):</strong> <a href="#" id="preview_piagam_path" target="_blank">Belum diunggah</a></p>

                                                    <hr>
                                                    <h6 class="font-weight-bold">Pembayaran</h6>
                                                    <p><strong>Jenjang:</strong> {{ auth()->user()->level ? strtoupper(auth()->user()->level->name) : 'Belum diatur' }}</p>
                                                    <p><strong>Biaya Pendaftaran:</strong> {{ optional(auth()->user()->level)->biaya ? 'Rp. ' . number_format(auth()->user()->level->biaya, 0, ',', '.') : 'Biaya belum diatur' }}</p>
                                                    <p><strong>Bukti Pembayaran:</strong> <a href="#" id="preview_bukti_pembayaran" target="_blank">Lihat Bukti Pembayaran</a></p>
                                                </div>
                                            </div>
                                            <div class="text-right mt-3">
                                                <button type="button" class="btn btn-secondary prev-step mr-2"><i class="fas fa-arrow-left mr-2"></i> Kembali</button>
                                                <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane mr-2"></i> Daftar Sekarang</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
<script>
// File input label update
document.querySelectorAll('.custom-file-input').forEach(input => {
    input.addEventListener('change', function(event) {
        const fileInput = event.target;
        const label = fileInput.nextElementSibling;
        if (fileInput.files.length > 0) {
            label.textContent = fileInput.files[0].name;
        } else {
            label.textContent = 'Pilih file...';
        }
    });
});

// Bootstrap form validation and step navigation
(function() {
    'use strict';
    const form = document.getElementById('registrationForm');
    const tabs = document.querySelectorAll('.nav-tabs .nav-link');
    const nextButtons = document.querySelectorAll('.next-step');
    const prevButtons = document.querySelectorAll('.prev-step');
    let currentStep = 0;
    let highestAccessibleStep = 0; // Tracks the highest step the user has validated

    // Validate current step
    function validateStep(step) {
        const currentPane = document.querySelector(`#step${step + 1}`);
        const inputs = currentPane.querySelectorAll('input[required]');
        let isValid = true;

        inputs.forEach(input => {
            if (!input.checkValidity()) {
                input.classList.add('is-invalid');
                isValid = false;
            } else {
                input.classList.remove('is-invalid');
            }
        });

        currentPane.classList.add('was-validated');
        return isValid;
    }

    // Update tab accessibility
    function updateTabAccessibility() {
        tabs.forEach((tab, index) => {
            if (index <= highestAccessibleStep) {
                tab.classList.remove('disabled');
                tab.style.pointerEvents = 'auto';
                tab.style.opacity = '1';
            } else {
                tab.classList.add('disabled');
                tab.style.pointerEvents = 'none';
                tab.style.opacity = '0.5';
            }
        });
    }

    // Update preview in Step 4
    function updatePreview() {
        const formData = new FormData(form);
        const fields = [
            { name: 'nama_orang_tua', isFile: false },
            { name: 'no_hp_orang_tua', isFile: false },
            { name: 'pasfoto_path', isFile: true, label: 'Lihat Pas Foto' },
            { name: 'kk_path', isFile: true, label: 'Lihat Kartu Keluarga' },
            { name: 'akta_path', isFile: true, label: 'Lihat Akta Kelahiran' },
            { name: 'ijazah_sd_path', isFile: true, label: 'Lihat Ijazah SD' },
            { name: 'ijazah_smp_path', isFile: true, label: 'Lihat Ijazah SMP' },
            { name: 'ijazah_sma_path', isFile: true, label: 'Lihat Ijazah SMA' },
            { name: 'piagam_path', isFile: true, label: 'Lihat Piagam', optional: true },
            { name: 'bukti_pembayaran', isFile: true, label: 'Lihat Bukti Pembayaran' }
        ];

        fields.forEach(field => {
            const element = document.getElementById(`preview_${field.name}`);
            if (element) {
                if (field.isFile) {
                    const file = formData.get(field.name);
                    if (file && file.size > 0) {
                        element.textContent = field.label;
                        element.href = URL.createObjectURL(file);
                        element.classList.remove('text-muted');
                    } else {
                        element.textContent = field.optional ? 'Belum diunggah' : 'Tidak ada file';
                        element.removeAttribute('href');
                        element.classList.add('text-muted');
                    }
                } else {
                    element.textContent = formData.get(field.name) || 'Tidak diisi';
                }
            }
        });
    }

    // Initialize tab states
    updateTabAccessibility();

    // Next step
    nextButtons.forEach(button => {
        button.addEventListener('click', () => {
            if (validateStep(currentStep)) {
                currentStep++;
                highestAccessibleStep = Math.max(highestAccessibleStep, currentStep);
                tabs[currentStep].click();
                updateTabAccessibility();
                if (currentStep === 3) {
                    updatePreview();
                }
            }
        });
    });

    // Previous step
    prevButtons.forEach(button => {
        button.addEventListener('click', () => {
            currentStep--;
            tabs[currentStep].click();
            updateTabAccessibility();
        });
    });

    // Form submission
    form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
            form.classList.add('was-validated');
        }
    });

    // Handle tab clicks
    tabs.forEach((tab, index) => {
        tab.addEventListener('click', (e) => {
            if (index > highestAccessibleStep) {
                e.preventDefault();
                return false;
            }
            currentStep = index;
            updateTabAccessibility();
            if (currentStep === 3) {
                updatePreview();
            }
        });
    });
})();
</script>
@endsection
