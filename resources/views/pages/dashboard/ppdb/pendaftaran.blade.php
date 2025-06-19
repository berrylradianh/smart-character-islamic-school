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
                            <h5 class="mt-0 header-title" style="padding-bottom: 10px;">Form Pendaftaran</h5>

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
                                            <i class="fas fa-check-circle fa-3x text-success animate__animated animate__bounceIn"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1 font-weight-bold text-dark">Diterima Seleksi Administrasi</h5>
                                            <p class="text-muted mb-0">
                                                Selamat! Pendaftaran Anda telah diterima. Silakan periksa detail tes di bawah ini.
                                            </p>
                                        </div>
                                    </div>
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
                                    <div class="mt-4">
                                        <a id="downloadKartuPeserta" href="{{ route('dashboard.ppdb_pendaftaran.download_kartu') }}" class="btn btn-success btn-sm rounded-pill px-4">
                                            <i class="fas fa-download mr-2"></i> Download Kartu Peserta
                                        </a>
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
                                                Pendaftaran Anda sedang ditinjau oleh tim kami. Anda akan menerima pembaruan segera.
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
                                                Maaf, pendaftaran Anda tidak memenuhi kriteria. Silakan revisi dan mengirimkan kembali ke tim kami.
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
                                    <div class="mt-4">
                                        <a id="buttonRevisiData" href="{{ route('dashboard.ppdb_pendaftaran.revisi') }}" class="btn btn-primary btn-sm rounded-pill px-4">
                                            <i class="fas fa-edit mr-2"></i> Revisi Data
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @elseif ($registration->status == 'accepted')
                            <div class="card border-0 shadow-lg rounded-lg mt-4">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center mb-4">
                                        <div class="mr-3">
                                            <i class="fas fa-check-circle fa-3x text-success animate__animated animate__bounceIn"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1 font-weight-bold text-dark">Diterima Seleksi Administrasi</h5>
                                            <p class="text-muted mb-0">
                                                Selamat! Pendaftaran Anda telah diterima. Silakan periksa detail tes di bawah ini.
                                            </p>
                                        </div>
                                    </div>
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
                                    <div class="mt-4">
                                        <a id="downloadKartuPeserta" href="{{ route('dashboard.ppdb_pendaftaran.download_kartu') }}" class="btn btn-success btn-sm rounded-pill px-4">
                                            <i class="fas fa-download mr-2"></i> Download Kartu Peserta
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @elseif ($registration->status == 'not_accepted')
                            <div class="card border-0 shadow-lg rounded-lg mt-4">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center mb-4">
                                        <div class="mr-3">
                                            <i class="fas fa-check-circle fa-3x text-success animate__animated animate__bounceIn"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1 font-weight-bold text-dark">Diterima Seleksi Administrasi</h5>
                                            <p class="text-muted mb-0">
                                                Selamat! Pendaftaran Anda telah diterima. Silakan periksa detail tes di bawah ini.
                                            </p>
                                        </div>
                                    </div>
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
                                    <div class="mt-4">
                                        <a id="downloadKartuPeserta" href="{{ route('dashboard.ppdb_pendaftaran.download_kartu') }}" class="btn btn-success btn-sm rounded-pill px-4">
                                            <i class="fas fa-download mr-2"></i> Download Kartu Peserta
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="alert alert-info" role="alert">
                                Anda sudah mendaftar. Silakan cek status pendaftaran Anda di <a href="{{ route('dashboard.ppdb_pengumuman') }}" class="alert-link">halaman pengumuman</a>.
                            </div>
                            @endif
                            @else
                            <!-- Multi-Step Form -->
                            <div class="wizard">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#step1" data-toggle="tab">1. Data Siswa</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link disabled" href="#step2" data-toggle="tab">2. Orang Tua Kandung</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link disabled" href="#step3" data-toggle="tab">3. Orang Tua Wali</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link disabled" href="#step4" data-toggle="tab">4. Pembayaran</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link disabled" href="#step5" data-toggle="tab">5. Preview</a>
                                    </li>
                                </ul>

                                <form enctype="multipart/form-data" action="{{ route('dashboard.ppdb_pendaftaran.store') }}" method="POST" class="needs-validation" novalidate id="registrationForm">
                                    @csrf
                                    <input type="hidden" name="level_id" value="{{ auth()->user()->level_id }}">

                                    <div class="tab-content mt-4">
                                        <!-- Step 1: Data Siswa -->
                                        <div class="tab-pane active" id="step1">
                                            <h6>Data Siswa</h6>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="name">Nama Lengkap</label>
                                                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" required>
                                                        <div class="invalid-feedback">Harap masukkan nama lengkap.</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama_panggilan">Nama Panggilan</label>
                                                        <input type="text" class="form-control" id="nama_panggilan" name="nama_panggilan" value="{{ old('nama_panggilan') }}" required>
                                                        <div class="invalid-feedback">Harap masukkan nama panggilan.</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nomor_induk_asal">Nomor Induk Asal</label>
                                                        <input type="number" class="form-control" id="nomor_induk_asal" name="nomor_induk_asal" value="{{ old('nomor_induk_asal') }}" required pattern="[0-9]+" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                                        <div class="invalid-feedback">Harap masukkan nomor induk asal (hanya angka).</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nisn">NISN</label>
                                                        <input type="number" class="form-control" id="nisn" name="nisn" value="{{ old('nisn') }}" required pattern="[0-9]+" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                                        <div class="invalid-feedback">Harap masukkan NISN (hanya angka).</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="tempat_lahir">Tempat Lahir</label>
                                                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required>
                                                        <div class="invalid-feedback">Harap masukkan tempat lahir.</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="tanggal_lahir_display">Tanggal Lahir</label>
                                                        <div style="position: relative;">
                                                            <input type="text" id="tanggal_lahir_display" class="form-control" value="{{ old('tanggal_lahir', auth()->user()->tanggal_lahir ? \Carbon\Carbon::parse(auth()->user()->tanggal_lahir)->format('d/m/Y') : '') }}" placeholder="dd/mm/yyyy" required>
                                                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', auth()->user()->tanggal_lahir ? \Carbon\Carbon::parse(auth()->user()->tanggal_lahir)->format('Y-m-d') : '') }}" style="position: absolute; opacity: 0; width: 100%; z-index: -1;" required>
                                                        </div>
                                                        <small class="form-text text-muted">Format: DD/MM/YYYY</small>
                                                        <div class="invalid-feedback">Harap masukkan tanggal lahir dalam format DD/MM/YYYY.</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="jenis_kelamin">Jenis Kelamin</label>
                                                        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                                            <option value="">Pilih...</option>
                                                            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                                        </select>
                                                        <div class="invalid-feedback">Harap pilih jenis kelamin.</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="agama">Agama</label>
                                                        <select class="form-control" id="agama" name="agama" required>
                                                            <option value="">Pilih...</option>
                                                            <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                                            <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                                            <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                                            <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                                            <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                                            <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                                        </select>
                                                        <div class="invalid-feedback">Harap pilih agama.</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="anak_ke">Anak ke</label>
                                                        <input type="number" class="form-control" id="anak_ke" name="anak_ke" value="{{ old('anak_ke') }}" required pattern="[0-9]+" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                                        <div class="invalid-feedback">Harap masukkan anak ke (hanya angka).</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="status_anak">Status Anak dalam Keluarga</label>
                                                        <input type="text" class="form-control" id="status_anak" name="status_anak" value="{{ old('status_anak') }}" required>
                                                        <small class="text-muted">Anak Kandung / Anak Angkat / Lainnya</small>
                                                        <div class="invalid-feedback">Harap masukkan status anak.</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="alamat">Alamat Siswa</label>
                                                        <textarea class="form-control" id="alamat" name="alamat" required>{{ old('alamat', auth()->user()->alamat) }}</textarea>
                                                        <div class="invalid-feedback">Harap masukkan alamat siswa.</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="no_hp">No HP Siswa</label>
                                                        <input type="number" class="form-control" id="no_hp" name="no_hp" value="{{ old('no_hp', auth()->user()->no_hp) }}" required pattern="[0-9]+" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                                        <div class="invalid-feedback">Harap masukkan nomor HP siswa (hanya angka).</div>
                                                    </div>
                                                    @if (auth()->user()->level->id == 1)
                                                    <!-- TK: Tidak menampilkan apa pun -->
                                                    @elseif (auth()->user()->level->id == 2)
                                                    <!-- SD: Menampilkan RA/TK asal dan alamat RA/TK -->
                                                    <div class="form-group">
                                                        <label for="ra_tk_asal">Nama RA/TK Asal</label>
                                                        <input type="text" class="form-control" id="ra_tk_asal" name="ra_tk_asal" value="{{ old('ra_tk_asal') }}">
                                                        <div class="invalid-feedback">Harap masukkan nama RA/TK asal.</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="alamat_ra_tk">Alamat RA/TK Asal</label>
                                                        <textarea class="form-control" id="alamat_ra_tk" name="alamat_ra_tk">{{ old('alamat_ra_tk') }}</textarea>
                                                        <div class="invalid-feedback">Harap masukkan alamat RA/TK asal.</div>
                                                    </div>
                                                    @elseif (auth()->user()->level->id == 3)
                                                    <!-- SMP: Menampilkan RA/TK asal, alamat RA/TK, SD/MI asal, alamat SD/MI -->
                                                    <div class="form-group">
                                                        <label for="ra_tk_asal">Nama RA/TK Asal</label>
                                                        <input type="text" class="form-control" id="ra_tk_asal" name="ra_tk_asal" value="{{ old('ra_tk_asal') }}">
                                                        <div class="invalid-feedback">Harap masukkan nama RA/TK asal.</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="alamat_ra_tk">Alamat RA/TK Asal</label>
                                                        <textarea class="form-control" id="alamat_ra_tk" name="alamat_ra_tk">{{ old('alamat_ra_tk') }}</textarea>
                                                        <div class="invalid-feedback">Harap masukkan alamat RA/TK asal.</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="sd_mi_asal">Nama SD/MI Asal</label>
                                                        <input type="text" class="form-control" id="sd_mi_asal" name="sd_mi_asal" value="{{ old('sd_mi_asal') }}">
                                                        <div class="invalid-feedback">Harap masukkan nama SD/MI asal.</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="alamat_sd_mi">Alamat SD/MI Asal</label>
                                                        <textarea class="form-control" id="alamat_sd_mi" name="alamat_sd_mi">{{ old('alamat_sd_mi') }}</textarea>
                                                        <div class="invalid-feedback">Harap masukkan alamat SD/MI asal.</div>
                                                    </div>
                                                    @elseif (auth()->user()->level->id == 4)
                                                    <!-- SMA: Menampilkan RA/TK asal, alamat RA/TK, SD/MI asal, alamat SD/MI, SMP/MTS asal -->
                                                    <div class="form-group">
                                                        <label for="ra_tk_asal">Nama RA/TK Asal</label>
                                                        <input type="text" class="form-control" id="ra_tk_asal" name="ra_tk_asal" value="{{ old('ra_tk_asal') }}">
                                                        <div class="invalid-feedback">Harap masukkan nama RA/TK asal.</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="alamat_ra_tk">Alamat RA/TK Asal</label>
                                                        <textarea class="form-control" id="alamat_ra_tk" name="alamat_ra_tk">{{ old('alamat_ra_tk') }}</textarea>
                                                        <div class="invalid-feedback">Harap masukkan alamat RA/TK asal.</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="sd_mi_asal">Nama SD/MI Asal</label>
                                                        <input type="text" class="form-control" id="sd_mi_asal" name="sd_mi_asal" value="{{ old('sd_mi_asal') }}">
                                                        <div class="invalid-feedback">Harap masukkan nama SD/MI asal.</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="alamat_sd_mi">Alamat SD/MI Asal</label>
                                                        <textarea class="form-control" id="alamat_sd_mi" name="alamat_sd_mi">{{ old('alamat_sd_mi') }}</textarea>
                                                        <div class="invalid-feedback">Harap masukkan alamat SD/MI asal.</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="asal_smp_mts">Nama SMP/MTS Asal</label>
                                                        <input type="text" class="form-control" id="asal_smp_mts" name="asal_smp_mts" value="{{ old('asal_smp_mts') }}">
                                                        <div class="invalid-feedback">Harap masukkan nama SMP/MTS asal.</div>
                                                    </div>
                                                    @elseif (auth()->user()->level->id == 5)
                                                    <!-- Kuliah: Menampilkan semua input termasuk SMK asal -->
                                                    <div class="form-group">
                                                        <label for="ra_tk_asal">Nama RA/TK Asal</label>
                                                        <input type="text" class="form-control" id="ra_tk_asal" name="ra_tk_asal" value="{{ old('ra_tk_asal') }}">
                                                        <div class="invalid-feedback">Harap masukkan nama RA/TK asal.</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="alamat_ra_tk">Alamat RA/TK Asal</label>
                                                        <textarea class="form-control" id="alamat_ra_tk" name="alamat_ra_tk">{{ old('alamat_ra_tk') }}</textarea>
                                                        <div class="invalid-feedback">Harap masukkan alamat RA/TK asal.</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="sd_mi_asal">Nama SD/MI Asal</label>
                                                        <input type="text" class="form-control" id="sd_mi_asal" name="sd_mi_asal" value="{{ old('sd_mi_asal') }}">
                                                        <div class="invalid-feedback">Harap masukkan nama SD/MI asal.</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="alamat_sd_mi">Alamat SD/MI Asal</label>
                                                        <textarea class="form-control" id="alamat_sd_mi" name="alamat_sd_mi">{{ old('alamat_sd_mi') }}</textarea>
                                                        <div class="invalid-feedback">Harap masukkan alamat SD/MI asal.</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="asal_smp_mts">Nama SMP/MTS Asal</label>
                                                        <input type="text" class="form-control" id="asal_smp_mts" name="asal_smp_mts" value="{{ old('asal_smp_mts') }}">
                                                        <div class="invalid-feedback">Harap masukkan nama SMP/MTS asal.</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="asal_sma_smk">Nama SMA/SMK Asal</label>
                                                        <input type="text" class="form-control" id="asal_sma_smk" name="asal_sma_smk" value="{{ old('asal_sma_smk') }}">
                                                        <div class="invalid-feedback">Harap masukkan nama SMA/SMK asal.</div>
                                                    </div>
                                                    @endif
                                                    <div class="form-group">
                                                        <label for="pasfoto_path">Upload Pas Foto</label>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="pasfoto_path" name="pasfoto_path" accept=".jpg,.png" required>
                                                            <label class="custom-file-label" for="pasfoto_path">Pilih file...</label>
                                                            <small class="text-muted">Maks. 2MB, format: JPG, PNG</small>
                                                            <div class="invalid-feedback">Harap unggah pas foto yang valid.</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <button type="button" class="btn btn-primary next-step">Selanjutnya <i class="fas fa-arrow-right ml-2"></i></button>
                                            </div>
                                        </div>

                                        <!-- Step 2: Orang Tua Kandung -->
                                        <div class="tab-pane" id="step2">
                                            <h6>Data Orang Tua Kandung</h6>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="nama_ayah">Nama Lengkap Ayah</label>
                                                        <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" value="{{ old('nama_ayah') }}" required>
                                                        <div class="invalid-feedback">Harap masukkan nama ayah.</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="alamat_ayah">Alamat Ayah</label>
                                                        <textarea class="form-control" id="alamat_ayah" name="alamat_ayah" required>{{ old('alamat_ayah') }}</textarea>
                                                        <div class="invalid-feedback">Harap masukkan alamat ayah.</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pekerjaan_ayah">Pekerjaan Ayah</label>
                                                        <input type="text" class="form-control" id="pekerjaan_ayah" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah') }}" required>
                                                        <div class="invalid-feedback">Harap masukkan pekerjaan ayah.</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pendidikan_ayah">Pendidikan Terakhir Ayah</label>
                                                        <input type="text" class="form-control" id="pendidikan_ayah" name="pendidikan_ayah" value="{{ old('pendidikan_ayah') }}" required>
                                                        <div class="invalid-feedback">Harap masukkan pendidikan ayah.</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="penghasilan_ayah">Penghasilan Per Bulan Ayah</label>
                                                        <input type="number" class="form-control" id="penghasilan_ayah" name="penghasilan_ayah" value="{{ old('penghasilan_ayah') }}" required pattern="[0-9]+" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                                        <div class="invalid-feedback">Harap masukkan penghasilan ayah (hanya angka).</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="nama_ibu">Nama Lengkap Ibu</label>
                                                        <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" value="{{ old('nama_ibu') }}" required>
                                                        <div class="invalid-feedback">Harap masukkan nama ibu.</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="alamat_ibu">Alamat Ibu</label>
                                                        <textarea class="form-control" id="alamat_ibu" name="alamat_ibu" required>{{ old('alamat_ibu') }}</textarea>
                                                        <div class="invalid-feedback">Harap masukkan alamat ibu.</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pekerjaan_ibu">Pekerjaan Ibu</label>
                                                        <input type="text" class="form-control" id="pekerjaan_ibu" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu') }}" required>
                                                        <div class="invalid-feedback">Harap masukkan pekerjaan ibu.</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pendidikan_ibu">Pendidikan Terakhir Ibu</label>
                                                        <input type="text" class="form-control" id="pendidikan_ibu" name="pendidikan_ibu" value="{{ old('pendidikan_ibu') }}" required>
                                                        <div class="invalid-feedback">Harap masukkan pendidikan ibu.</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="penghasilan_ibu">Penghasilan Per Bulan Ibu</label>
                                                        <input type="number" class="form-control" id="penghasilan_ibu" name="penghasilan_ibu" value="{{ old('penghasilan_ibu') }}" required pattern="[0-9]+" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                                        <div class="invalid-feedback">Harap masukkan penghasilan ibu (hanya angka).</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="telepon_ortu">Telepon/HP Orang Tua</label>
                                                        <input type="number" class="form-control" id="telepon_ortu" name="telepon_ortu" value="{{ old('telepon_ortu') }}" required pattern="[0-9]+" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                                        <div class="invalid-feedback">Harap masukkan telepon orang tua (hanya angka).</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <button type="button" class="btn btn-secondary prev-step mr-2"><i class="fas fa-arrow-left mr-2"></i> Kembali</button>
                                                <button type="button" class="btn btn-primary next-step">Selanjutnya <i class="fas fa-arrow-right ml-2"></i></button>
                                            </div>
                                        </div>

                                        <!-- Step 3: Orang Tua Wali -->
                                        <div class="tab-pane" id="step3">
                                            <h6>Data Orang Tua Wali</h6>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="nama_ayah_wali">Nama Ayah Wali</label>
                                                        <input type="text" class="form-control" id="nama_ayah_wali" name="nama_ayah_wali" value="{{ old('nama_ayah_wali') }}">
                                                        <div class="invalid-feedback">Harap masukkan nama ayah wali.</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="alamat_ayah_wali">Alamat Ayah Wali</label>
                                                        <textarea class="form-control" id="alamat_ayah_wali" name="alamat_ayah_wali">{{ old('alamat_ayah_wali') }}</textarea>
                                                        <div class="invalid-feedback">Harap masukkan alamat ayah wali.</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pekerjaan_ayah_wali">Pekerjaan Ayah Wali</label>
                                                        <input type="text" class="form-control" id="pekerjaan_ayah_wali" name="pekerjaan_ayah_wali" value="{{ old('pekerjaan_ayah_wali') }}">
                                                        <div class="invalid-feedback">Harap masukkan pekerjaan ayah wali.</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pendidikan_ayah_wali">Pendidikan Terakhir Ayah Wali</label>
                                                        <input type="text" class="form-control" id="pendidikan_ayah_wali" name="pendidikan_ayah_wali" value="{{ old('pendidikan_ayah_wali') }}">
                                                        <div class="invalid-feedback">Harap masukkan pendidikan ayah wali.</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="penghasilan_ayah_wali">Penghasilan Per Bulan Ayah Wali</label>
                                                        <input type="number" class="form-control" id="penghasilan_ayah_wali" name="penghasilan_ayah_wali" value="{{ old('penghasilan_ayah_wali') }}" pattern="[0-9]+" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                                        <div class="invalid-feedback">Harap masukkan penghasilan ayah wali (hanya angka).</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="nama_ibu_wali">Nama Ibu Wali</label>
                                                        <input type="text" class="form-control" id="nama_ibu_wali" name="nama_ibu_wali" value="{{ old('nama_ibu_wali') }}">
                                                        <div class="invalid-feedback">Harap masukkan nama ibu wali.</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="alamat_ibu_wali">Alamat Ibu Wali</label>
                                                        <textarea class="form-control" id="alamat_ibu_wali" name="alamat_ibu_wali">{{ old('alamat_ibu_wali') }}</textarea>
                                                        <div class="invalid-feedback">Harap masukkan alamat ibu wali.</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pekerjaan_ibu_wali">Pekerjaan Ibu Wali</label>
                                                        <input type="text" class="form-control" id="pekerjaan_ibu_wali" name="pekerjaan_ibu_wali" value="{{ old('pekerjaan_ibu_wali') }}">
                                                        <div class="invalid-feedback">Harap masukkan pekerjaan ibu wali.</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pendidikan_ibu_wali">Pendidikan Terakhir Ibu Wali</label>
                                                        <input type="text" class="form-control" id="pendidikan_ibu_wali" name="pendidikan_ibu_wali" value="{{ old('pendidikan_ibu_wali') }}">
                                                        <div class="invalid-feedback">Harap masukkan pendidikan ibu wali.</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="penghasilan_ibu_wali">Penghasilan Per Bulan Ibu Wali</label>
                                                        <input type="number" class="form-control" id="penghasilan_ibu_wali" name="penghasilan_ibu_wali" value="{{ old('penghasilan_ibu_wali') }}" pattern="[0-9]+" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                                        <div class="invalid-feedback">Harap masukkan penghasilan ibu wali (hanya angka).</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="telepon_wali">Telepon/HP Wali</label>
                                                        <input type="number" class="form-control" id="telepon_wali" name="telepon_wali" value="{{ old('telepon_wali') }}" pattern="[0-9]+" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                                        <div class="invalid-feedback">Harap masukkan telepon wali (hanya angka).</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <button type="button" class="btn btn-secondary prev-step mr-2"><i class="fas fa-arrow-left mr-2"></i> Kembali</button>
                                                <button type="button" class="btn btn-primary next-step">Selanjutnya <i class="fas fa-arrow-right ml-2"></i></button>
                                            </div>
                                        </div>

                                        <!-- Step 4: Pembayaran -->
                                        <div class="tab-pane" id="step4">
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
                                                    <div class="invalid-feedback">Harap unggah bukti pembayaran yang valid.</div>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <button type="button" class="btn btn-secondary prev-step mr-2"><i class="fas fa-arrow-left mr-2"></i> Kembali</button>
                                                <button type="button" class="btn btn-primary next-step">Selanjutnya <i class="fas fa-arrow-right ml-2"></i></button>
                                            </div>
                                        </div>

                                        <!-- Step 5: Preview -->
                                        <div class="tab-pane" id="step5">
                                            <h6>Preview Data Pendaftaran</h6>
                                            <div class="card">
                                                <div class="card-body">
                                                    <h6 class="font-weight-bold">Data Siswa</h6>
                                                    <p><strong>Nama Lengkap:</strong> <span id="preview_name"></span></p>
                                                    <p><strong>Nama Panggilan:</strong> <span id="preview_nama_panggilan"></span></p>
                                                    <p><strong>Nomor Induk Asal:</strong> <span id="preview_nomor_induk_asal"></span></p>
                                                    <p><strong>NISN:</strong> <span id="preview_nisn"></span></p>
                                                    <p><strong>Tempat Tanggal Lahir:</strong> <span id="preview_tempat_lahir"></span>, <span id="preview_tanggal_lahir"></span></p>
                                                    <p><strong>Jenis Kelamin:</strong> <span id="preview_jenis_kelamin"></span></p>
                                                    <p><strong>Agama:</strong> <span id="preview_agama"></span></p>
                                                    <p><strong>Anak ke:</strong> <span id="preview_anak_ke"></span></p>
                                                    <p><strong>Status Anak:</strong> <span id="preview_status_anak"></span></p>
                                                    <p><strong>Alamat Siswa:</strong> <span id="preview_alamat"></span></p>
                                                    <p><strong>No HP Siswa:</strong> <span id="preview_no_hp"></span></p>
                                                    <p><strong>RA/TK Asal:</strong> <span id="preview_ra_tk_asal"></span></p>
                                                    <p><strong>Alamat RA/TK:</strong> <span id="preview_alamat_ra_tk"></span></p>
                                                    <p><strong>SD/MI Asal:</strong> <span id="preview_sd_mi_asal"></span></p>
                                                    <p><strong>Alamat SD/MI:</strong> <span id="preview_alamat_sd_mi"></span></p>
                                                    <p><strong>SMP/MTS Asal:</strong> <span id="preview_asal_smp_mts"></span></p>
                                                    <p><strong>SMK Asal:</strong> <span id="preview_asal_sma_smk"></span></p>
                                                    <p><strong>Pas Foto:</strong>
                                                        <button type="button" class="btn btn-outline-primary btn-sm view-file" id="preview_pasfoto_path" disabled>Lihat Pas Foto</button>
                                                    </p>

                                                    <hr>
                                                    <h6 class="font-weight-bold">Data Orang Tua Kandung</h6>
                                                    <p><strong>Nama Ayah:</strong> <span id="preview_nama_ayah"></span></p>
                                                    <p><strong>Nama Ibu:</strong> <span id="preview_nama_ibu"></span></p>
                                                    <p><strong>Alamat Ayah:</strong> <span id="preview_alamat_ayah"></span></p>
                                                    <p><strong>Alamat Ibu:</strong> <span id="preview_alamat_ibu"></span></p>
                                                    <p><strong>Telepon Orang Tua:</strong> <span id="preview_telepon_ortu"></span></p>
                                                    <p><strong>Pekerjaan Ayah:</strong> <span id="preview_pekerjaan_ayah"></span></p>
                                                    <p><strong>Pekerjaan Ibu:</strong> <span id="preview_pekerjaan_ibu"></span></p>
                                                    <p><strong>Pendidikan Ayah:</strong> <span id="preview_pendidikan_ayah"></span></p>
                                                    <p><strong>Pendidikan Ibu:</strong> <span id="preview_pendidikan_ibu"></span></p>
                                                    <p><strong>Penghasilan Ayah:</strong> <span id="preview_penghasilan_ayah"></span></p>
                                                    <p><strong>Penghasilan Ibu:</strong> <span id="preview_penghasilan_ibu"></span></p>

                                                    <hr>
                                                    <h6 class="font-weight-bold">Data Orang Tua Wali</h6>
                                                    <p><strong>Nama Ayah Wali:</strong> <span id="preview_nama_ayah_wali"></span></p>
                                                    <p><strong>Nama Ibu Wali:</strong> <span id="preview_nama_ibu_wali"></span></p>
                                                    <p><strong>Alamat Ayah Wali:</strong> <span id="preview_alamat_ayah_wali"></span></p>
                                                    <p><strong>Alamat Ibu Wali:</strong> <span id="preview_alamat_ibu_wali"></span></p>
                                                    <p><strong>Telepon Wali:</strong> <span id="preview_telepon_wali"></span></p>
                                                    <p><strong>Pekerjaan Ayah Wali:</strong> <span id="preview_pekerjaan_ayah_wali"></span></p>
                                                    <p><strong>Pekerjaan Ibu Wali:</strong> <span id="preview_pekerjaan_ibu_wali"></span></p>
                                                    <p><strong>Pendidikan Ayah Wali:</strong> <span id="preview_pendidikan_ayah_wali"></span></p>
                                                    <p><strong>Pendidikan Ibu Wali:</strong> <span id="preview_pendidikan_ibu_wali"></span></p>
                                                    <p><strong>Penghasilan Ayah Wali:</strong> <span id="preview_penghasilan_ayah_wali"></span></p>
                                                    <p><strong>Penghasilan Ibu Wali:</strong> <span id="preview_penghasilan_ibu_wali"></span></p>

                                                    <hr>
                                                    <h6 class="font-weight-bold">Pembayaran</h6>
                                                    <p><strong>Jenjang:</strong> {{ auth()->user()->level ? strtoupper(auth()->user()->level->name) : 'Belum diatur' }}</p>
                                                    <p><strong>Biaya Pendaftaran:</strong> {{ optional(auth()->user()->level)->biaya ? 'Rp. ' . number_format(auth()->user()->level->biaya, 0, ',', '.') : 'Biaya belum diatur' }}</p>
                                                    <p><strong>Bukti Pembayaran:</strong>
                                                        <button type="button" class="btn btn-outline-primary btn-sm view-file" id="preview_bukti_pembayaran" disabled>Lihat Bukti Pembayaran</button>
                                                    </p>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Store file Data URLs for preview in a global scope
        window.pasFotoDataUrl = '';
        window.buktiPembayaranDataUrl = '';

        // Update file input label and preview for pasfoto_path
        const pasFotoInput = document.getElementById('pasfoto_path');
        if (pasFotoInput) {
            pasFotoInput.addEventListener('change', function() {
                const file = this.files[0];
                const label = this.nextElementSibling;
                const previewButton = document.getElementById('preview_pasfoto_path');

                if (file) {
                    // Validate file type and size
                    if (!['image/jpeg', 'image/png'].includes(file.type)) {
                        alert('Harap unggah file dalam format JPG atau PNG.');
                        this.value = '';
                        label.textContent = 'Pilih file...';
                        label.classList.remove('selected');
                        window.pasFotoDataUrl = '';
                        previewButton.disabled = true;
                        previewButton.onclick = null;
                        this.classList.add('is-invalid');
                        return;
                    }
                    if (file.size > 2 * 1024 * 1024) { // 2MB limit
                        alert('Ukuran file maksimum adalah 2MB.');
                        this.value = '';
                        label.textContent = 'Pilih file...';
                        label.classList.remove('selected');
                        window.pasFotoDataUrl = '';
                        previewButton.disabled = true;
                        previewButton.onclick = null;
                        this.classList.add('is-invalid');
                        return;
                    }

                    label.textContent = file.name;
                    label.classList.add('selected');
                    this.classList.remove('is-invalid');

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        window.pasFotoDataUrl = e.target.result;
                        console.log('Pas Foto Data URL:', window.pasFotoDataUrl.substring(0, 50) + '...'); // Debug
                        previewButton.disabled = false;
                        previewButton.onclick = function(e) {
                            e.preventDefault();
                            if (window.pasFotoDataUrl) {
                                const win = window.open();
                                if (win) {
                                    win.document.write('<img src="' + window.pasFotoDataUrl + '" style="max-width:100%;height:auto;">');
                                    win.document.close();
                                } else {
                                    alert('Popup diblokir oleh browser. Silakan izinkan popup untuk melihat file.');
                                }
                            } else {
                                console.error('Pas Foto Data URL is empty');
                                alert('Tidak ada file pas foto untuk dipreview.');
                            }
                        };
                    };
                    reader.onerror = function(e) {
                        console.error('Error reading pas foto:', e);
                        alert('Gagal membaca file pas foto. Silakan coba file lain.');
                        this.classList.add('is-invalid');
                    };
                    reader.readAsDataURL(file);
                } else {
                    window.pasFotoDataUrl = '';
                    label.textContent = 'Pilih file...';
                    label.classList.remove('selected');
                    previewButton.disabled = true;
                    previewButton.onclick = null;
                    this.classList.add('is-invalid');
                }
            });
        }

        // Update file input label and preview for bukti_pembayaran
        const buktiPembayaranInput = document.getElementById('bukti_pembayaran');
        if (buktiPembayaranInput) {
            buktiPembayaranInput.addEventListener('change', function() {
                const file = this.files[0];
                const label = this.nextElementSibling;
                const previewButton = document.getElementById('preview_bukti_pembayaran');

                if (file) {
                    // Validate file type and size
                    if (!['image/jpeg', 'image/png', 'application/pdf'].includes(file.type)) {
                        alert('Harap unggah file dalam format JPG, PNG, atau PDF.');
                        this.value = '';
                        label.textContent = 'Pilih file...';
                        label.classList.remove('selected');
                        window.buktiPembayaranDataUrl = '';
                        previewButton.disabled = true;
                        previewButton.onclick = null;
                        this.classList.add('is-invalid');
                        return;
                    }
                    if (file.size > 2 * 1024 * 1024) { // 2MB limit
                        alert('Ukuran file maksimum adalah 2MB.');
                        this.value = '';
                        label.textContent = 'Pilih file...';
                        label.classList.remove('selected');
                        window.buktiPembayaranDataUrl = '';
                        previewButton.disabled = true;
                        previewButton.onclick = null;
                        this.classList.add('is-invalid');
                        return;
                    }

                    label.textContent = file.name;
                    label.classList.add('selected');
                    this.classList.remove('is-invalid');

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        window.buktiPembayaranDataUrl = e.target.result;
                        console.log('Bukti Pembayaran Data URL:', window.buktiPembayaranDataUrl.substring(0, 50) + '...'); // Debug
                        previewButton.disabled = false;
                        previewButton.onclick = function(e) {
                            e.preventDefault();
                            if (window.buktiPembayaranDataUrl) {
                                const win = window.open();
                                if (win) {
                                    if (file.type === 'application/pdf') {
                                        win.document.write('<iframe src="' + window.buktiPembayaranDataUrl + '" style="width:100%;height:100%;"></iframe>');
                                    } else {
                                        win.document.write('<img src="' + window.buktiPembayaranDataUrl + '" style="max-width:100%;height:auto;">');
                                    }
                                    win.document.close();
                                } else {
                                    alert('Popup diblokir oleh browser. Silakan izinkan popup untuk melihat file.');
                                }
                            } else {
                                console.error('Bukti Pembayaran Data URL is empty');
                                alert('Tidak ada file bukti pembayaran untuk dipreview.');
                            }
                        };
                    };
                    reader.onerror = function(e) {
                        console.error('Error reading bukti pembayaran:', e);
                        alert('Gagal membaca file bukti pembayaran. Silakan coba file lain.');
                        this.classList.add('is-invalid');
                    };
                    reader.readAsDataURL(file);
                } else {
                    window.buktiPembayaranDataUrl = '';
                    label.textContent = 'Pilih file...';
                    label.classList.remove('selected');
                    previewButton.disabled = true;
                    previewButton.onclick = null;
                    this.classList.add('is-invalid');
                }
            });
        }

        // Wizard navigation
        const nextButtons = document.querySelectorAll('.next-step');
        const prevButtons = document.querySelectorAll('.prev-step');
        const tabs = document.querySelectorAll('.nav-link');
        const form = document.getElementById('registrationForm');

        if (form) {
            function validateTab(tabId) {
                const tab = document.getElementById(tabId);
                const inputs = tab.querySelectorAll('input[required], select[required], textarea[required]');
                let isValid = true;

                inputs.forEach(input => {
                    if (input.type === 'file') {
                        if (input.id === 'pasfoto_path' && !window.pasFotoDataUrl) {
                            input.classList.add('is-invalid');
                            isValid = false;
                        } else if (input.id === 'bukti_pembayaran' && !window.buktiPembayaranDataUrl) {
                            input.classList.add('is-invalid');
                            isValid = false;
                        } else {
                            input.classList.remove('is-invalid');
                        }
                    } else {
                        if (!input.value.trim()) {
                            input.classList.add('is-invalid');
                            isValid = false;
                        } else {
                            input.classList.remove('is-invalid');
                        }
                    }
                });

                return isValid;
            }

            nextButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const currentTab = document.querySelector('.tab-pane.active');
                    const currentTabId = currentTab.id;
                    const nextTabId = 'step' + (parseInt(currentTabId.replace('step', '')) + 1);

                    if (validateTab(currentTabId)) {
                        const nextTabLink = document.querySelector(`a[href="#${nextTabId}"]`);
                        if (nextTabLink) {
                            tabs.forEach(tab => tab.classList.remove('active'));
                            nextTabLink.classList.add('active');
                            nextTabLink.classList.remove('disabled');

                            document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('active'));
                            document.getElementById(nextTabId).classList.add('active');

                            if (nextTabId === 'step5') {
                                updatePreview();
                            }
                        }
                    }
                });
            });

            prevButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const currentTab = document.querySelector('.tab-pane.active');
                    const currentTabId = currentTab.id;
                    const prevTabId = 'step' + (parseInt(currentTabId.replace('step', '')) - 1);

                    const prevTabLink = document.querySelector(`a[href="#${prevTabId}"]`);
                    if (prevTabLink) {
                        tabs.forEach(tab => tab.classList.remove('active'));
                        prevTabLink.classList.add('active');

                        document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('active'));
                        document.getElementById(prevTabId).classList.add('active');
                    }
                });
            });

            function updatePreview() {
                const fields = [
                    'name', 'nama_panggilan', 'nomor_induk_asal', 'nisn', 'tempat_lahir', 'tanggal_lahir_display',
                    'jenis_kelamin', 'agama', 'anak_ke', 'status_anak', 'alamat', 'no_hp', 'ra_tk_asal',
                    'alamat_ra_tk', 'sd_mi_asal', 'alamat_sd_mi', 'asal_smp_mts', 'asal_sma_smk',
                    'nama_ayah', 'alamat_ayah', 'pekerjaan_ayah', 'pendidikan_ayah', 'penghasilan_ayah',
                    'nama_ibu', 'alamat_ibu', 'pekerjaan_ibu', 'pendidikan_ibu', 'penghasilan_ibu', 'telepon_ortu',
                    'nama_ayah_wali', 'alamat_ayah_wali', 'pekerjaan_ayah_wali', 'pendidikan_ayah_wali', 'penghasilan_ayah_wali',
                    'nama_ibu_wali', 'alamat_ibu_wali', 'pekerjaan_ibu_wali', 'pendidikan_ibu_wali', 'penghasilan_ibu_wali', 'telepon_wali'
                ];

                fields.forEach(field => {
                    const input = document.getElementById(field);
                    const preview = document.getElementById(`preview_${field}`);
                    if (input && preview) {
                        preview.textContent = input.value || 'Tidak diisi';
                    }
                });

                const pasFotoPreviewButton = document.getElementById('preview_pasfoto_path');
                if (window.pasFotoDataUrl) {
                    pasFotoPreviewButton.disabled = false;
                    pasFotoPreviewButton.onclick = function(e) {
                        e.preventDefault();
                        const win = window.open();
                        if (win) {
                            win.document.write('<img src="' + window.pasFotoDataUrl + '" style="max-width:100%;height:auto;">');
                            win.document.close();
                        } else {
                            alert('Popup diblokir oleh browser. Silakan izinkan popup untuk melihat file.');
                        }
                    };
                } else {
                    pasFotoPreviewButton.disabled = true;
                    pasFotoPreviewButton.onclick = null;
                    pasFotoPreviewButton.textContent = 'Tidak ada file';
                }

                const buktiPembayaranPreviewButton = document.getElementById('preview_bukti_pembayaran');
                if (window.buktiPembayaranDataUrl) {
                    buktiPembayaranPreviewButton.disabled = false;
                    buktiPembayaranPreviewButton.onclick = function(e) {
                        e.preventDefault();
                        const win = window.open();
                        if (win) {
                            const fileInput = document.getElementById('bukti_pembayaran');
                            const file = fileInput.files[0];
                            if (file && file.type === 'application/pdf') {
                                win.document.write('<iframe src="' + window.buktiPembayaranDataUrl + '" style="width:100%;height:100%;"></iframe>');
                            } else {
                                win.document.write('<img src="' + window.buktiPembayaranDataUrl + '" style="max-width:100%;height:auto;">');
                            }
                            win.document.close();
                        } else {
                            alert('Popup diblokir oleh browser. Silakan izinkan popup untuk melihat file.');
                        }
                    };
                } else {
                    buktiPembayaranPreviewButton.disabled = true;
                    buktiPembayaranPreviewButton.onclick = null;
                    buktiPembayaranPreviewButton.textContent = 'Tidak ada file';
                }
            }

            // Form submission validation
            form.addEventListener('submit', function(e) {
                if (!form.checkValidity() || !window.pasFotoDataUrl || !window.buktiPembayaranDataUrl) {
                    e.preventDefault();
                    e.stopPropagation();
                    form.classList.add('was-validated');
                    if (!window.pasFotoDataUrl) {
                        document.getElementById('pasfoto_path').classList.add('is-invalid');
                    }
                    if (!window.buktiPembayaranDataUrl) {
                        document.getElementById('bukti_pembayaran').classList.add('is-invalid');
                    }
                    alert('Harap lengkapi semua field yang diperlukan, termasuk unggahan file.');
                }
            });

            const tanggalLahirInput = document.getElementById('tanggal_lahir');
            const tanggalLahirDisplay = document.getElementById('tanggal_lahir_display');
            if (tanggalLahirInput && tanggalLahirDisplay) {
                tanggalLahirInput.addEventListener('change', function() {
                    if (this.value) {
                        const date = new Date(this.value);
                        const day = String(date.getDate()).padStart(2, '0');
                        const month = String(date.getMonth() + 1).padStart(2, '0');
                        const year = date.getFullYear();
                        tanggalLahirDisplay.value = `${day}/${month}/${year}`;
                    }
                });
                tanggalLahirDisplay.addEventListener('input', function() {
                    const value = this.value.replace(/[^0-9\/]/g, '');
                    if (value.match(/^(\d{2})\/(\d{2})\/(\d{4})$/)) {
                        const [_, day, month, year] = value.match(/^(\d{2})\/(\d{2})\/(\d{4})$/);
                        const date = new Date(`${year}-${month}-${day}`);
                        if (!isNaN(date.getTime())) {
                            tanggalLahirInput.value = `${year}-${month}-${day}`;
                        } else {
                            this.classList.add('is-invalid');
                        }
                    }
                });
            }
        }
    });
</script>
@endsection
