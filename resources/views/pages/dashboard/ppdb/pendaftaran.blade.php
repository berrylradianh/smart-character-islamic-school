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
                                                    Pendaftaran Diterima
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
                                                    <div class="form-group">
                                                        <label for="diterima_kelas">Diterima di Madrasah Kelas</label>
                                                        <input type="text" class="form-control" id="diterima_kelas" name="diterima_kelas" value="{{ old('diterima_kelas') }}" required>
                                                        <div class="invalid-feedback">Harap masukkan kelas diterima.</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="diterima_tanggal_display">Diterima Tanggal</label>
                                                        <div style="position: relative;">
                                                            <input type="text" id="diterima_tanggal_display" class="form-control" value="{{ old('diterima_tanggal') ? \Carbon\Carbon::parse(old('diterima_tanggal'))->format('d/m/Y') : '' }}" placeholder="dd/mm/yyyy" required>
                                                            <input type="date" name="diterima_tanggal" id="diterima_tanggal" class="form-control" value="{{ old('diterima_tanggal') }}" style="position: absolute; opacity: 0; width: 100%; z-index: -1;" required>
                                                        </div>
                                                        <small class="form-text text-muted">Format: DD/MM/YYYY</small>
                                                        <div class="invalid-feedback">Harap masukkan tanggal diterima dalam format DD/MM/YYYY.</div>
                                                    </div>
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
                                                    <p><strong>Diterima Kelas:</strong> <span id="preview_diterima_kelas"></span></p>
                                                    <p><strong>Diterima Tanggal:</strong> <span id="preview_diterima_tanggal"></span></p>
                                                    <p><strong>RA/TK Asal:</strong> <span id="preview_ra_tk_asal"></span></p>
                                                    <p><strong>Alamat RA/TK:</strong> <span id="preview_alamat_ra_tk"></span></p>
                                                    <p><strong>SD/MI Asal:</strong> <span id="preview_sd_mi_asal"></span></p>
                                                    <p><strong>Alamat SD/MI:</strong> <span id="preview_alamat_sd_mi"></span></p>
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

    // Date picker handling
    document.addEventListener('DOMContentLoaded', function() {
        const dateFields = [{
                displayId: 'tanggal_lahir_display',
                inputId: 'tanggal_lahir'
            },
            {
                displayId: 'diterima_tanggal_display',
                inputId: 'diterima_tanggal'
            }
        ];

        dateFields.forEach(field => {
            const dateDisplay = document.getElementById(field.displayId);
            const dateInput = document.getElementById(field.inputId);

            if (dateDisplay && dateInput) {
                // Trigger date picker on display input click
                dateDisplay.addEventListener('click', function() {
                    dateInput.showPicker();
                });

                // Update text input when date picker changes
                dateInput.addEventListener('change', function() {
                    if (dateInput.value) {
                        const date = new Date(dateInput.value);
                        const day = String(date.getDate()).padStart(2, '0');
                        const month = String(date.getMonth() + 1).padStart(2, '0');
                        const year = date.getFullYear();
                        dateDisplay.value = `${day}/${month}/${year}`;
                    } else {
                        dateDisplay.value = '';
                    }
                });

                // Update date picker when text input changes
                dateDisplay.addEventListener('input', function() {
                    const value = dateDisplay.value;
                    const regex = /^(\d{2})\/(\d{2})\/(\d{4})$/;
                    if (regex.test(value)) {
                        const [, day, month, year] = value.match(regex);
                        const date = new Date(`${year}-${month}-${day}`);
                        if (!isNaN(date.getTime())) {
                            dateInput.value = `${year}-${month}-${day}`;
                        } else {
                            dateInput.value = '';
                        }
                    } else {
                        dateInput.value = '';
                    }
                });
            }
        });

        // Number-only input handling
        const numberFields = [
            'nomor_induk_asal',
            'nisn',
            'anak_ke',
            'no_hp',
            'penghasilan_ayah',
            'penghasilan_ibu',
            'telepon_ortu',
            'penghasilan_ayah_wali',
            'penghasilan_ibu_wali',
            'telepon_wali'
        ];

        numberFields.forEach(fieldId => {
            const input = document.getElementById(fieldId);
            if (input) {
                input.addEventListener('input', function() {
                    this.value = this.value.replace(/[^0-9]/g, '');
                });
                // Prevent pasting non-numeric content
                input.addEventListener('paste', function(event) {
                    const paste = (event.clipboardData || window.clipboardData).getData('text');
                    if (!/^\d*$/.test(paste)) {
                        event.preventDefault();
                    }
                });
            }
        });

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
                    lokasi: "{{ $registration && $registration->schoolLocation ?$registration->schoolLocation->alamat . ', ' . $registration->schoolLocation->nama_lokasi : 'Belum ditentukan' }}"
                };

                // Card Title
                doc.setFont("helvetica", "bold");
                doc.setFontSize(14);
                doc.text("Kartu Peserta PPDB", 74, 15, {
                    align: "center"
                });
                doc.setFontSize(10);
                doc.text("Smart Character Islamic School", 74, 22, {
                    align: "center"
                });

                // Add photo if available
                if (userData.pasfoto_path) {
                    try {
                        const imgData = await loadImageAsBase64(userData.pasfoto_path);
                        doc.addImage(imgData, 'JPEG', 108, 30, 30, 30); // Photo: 30x30mm at top-right
                    } catch (error) {
                        console.error('Failed to load photo:', error);
                    }
                }

                // Card Content (starting immediately below title, no gap)
                doc.setFont("helvetica", "bold");
                doc.setFontSize(12);
                doc.text(userData.name.toUpperCase(), 10, 35); // Name at top, no extra gap

                doc.setFont("helvetica", "normal");
                doc.setFontSize(10);
                 const details = [
                    { label: "No Peserta", value: registrationData.no_peserta },
                    { label: "Asal Sekolah", value: userData.sd_mi_asal },
                    { label: "Waktu Ujian", value: registrationData.jadwal_tes },
                    { label: "Gedung", value: registrationData.gedung },
                    { label: "Ruang", value: registrationData.ruang },
                    { label: "Lokasi", value: registrationData.lokasi }
                ];

                let y = 45;
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

        // Bootstrap form validation and step navigation
        const form = document.getElementById('registrationForm');
        const tabs = document.querySelectorAll('ul.nav-tabs .nav-link');
        const nextButtons = document.querySelectorAll('.next-step');
        const prevButtons = document.querySelectorAll('.prev-step');
        let currentStep = 0;
        let highestAccessibleStep = 0;

        function validateStep(step) {
            const currentPane = document.querySelector(`#step${step + 1}`);
            const inputs = currentPane.querySelectorAll('input[required], select[required], textarea[required]');
            let isValid = true;

            inputs.forEach(input => {
                if (!input.checkValidity()) {
                    console.log(`Input ${input.id} is invalid: ${input.validationMessage}`);
                    input.classList.add('is-invalid');
                    isValid = false;
                } else {
                    input.classList.remove('is-invalid');
                }
            });

            // Additional validation for date fields
            dateFields.forEach(field => {
                const dateDisplay = document.getElementById(field.displayId);
                if (dateDisplay && dateDisplay.hasAttribute('required')) {
                    const value = dateDisplay.value;
                    if (!/^\d{2}\/\d{2}\/\d{4}$/.test(value)) {
                        dateDisplay.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        dateDisplay.classList.remove('is-invalid');
                    }
                }
            });

            // Additional validation for number fields
            numberFields.forEach(fieldId => {
                const input = document.getElementById(fieldId);
                if (input && input.hasAttribute('required') && currentPane.contains(input)) {
                    const value = input.value;
                    if (value && !/^\d+$/.test(value)) {
                        input.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        input.classList.remove('is-invalid');
                    }
                }
            });

            currentPane.classList.add('was-validated');
            console.log(`Step ${step + 1} is ${isValid ? 'valid' : 'invalid'}`);
            return isValid;
        }

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

        function updatePreview() {
            const formData = new FormData(form);
            const fields = [{
                    name: 'name',
                    isFile: false
                },
                {
                    name: 'nama_panggilan',
                    isFile: false
                },
                {
                    name: 'nomor_induk_asal',
                    isFile: false
                },
                {
                    name: 'nisn',
                    isFile: false
                },
                {
                    name: 'tempat_lahir',
                    isFile: false
                },
                {
                    name: 'tanggal_lahir',
                    isFile: false
                },
                {
                    name: 'jenis_kelamin',
                    isFile: false
                },
                {
                    name: 'agama',
                    isFile: false
                },
                {
                    name: 'anak_ke',
                    isFile: false
                },
                {
                    name: 'status_anak',
                    isFile: false
                },
                {
                    name: 'alamat',
                    isFile: false
                },
                {
                    name: 'no_hp',
                    isFile: false
                },
                {
                    name: 'diterima_kelas',
                    isFile: false
                },
                {
                    name: 'diterima_tanggal',
                    isFile: false
                },
                {
                    name: 'ra_tk_asal',
                    isFile: false
                },
                {
                    name: 'alamat_ra_tk',
                    isFile: false
                },
                {
                    name: 'sd_mi_asal',
                    isFile: false
                },
                {
                    name: 'alamat_sd_mi',
                    isFile: false
                },
                {
                    name: 'nama_ayah',
                    isFile: false
                },
                {
                    name: 'nama_ibu',
                    isFile: false
                },
                {
                    name: 'alamat_ayah',
                    isFile: false
                },
                {
                    name: 'alamat_ibu',
                    isFile: false
                },
                {
                    name: 'telepon_ortu',
                    isFile: false
                },
                {
                    name: 'pekerjaan_ayah',
                    isFile: false
                },
                {
                    name: 'pekerjaan_ibu',
                    isFile: false
                },
                {
                    name: 'pendidikan_ayah',
                    isFile: false
                },
                {
                    name: 'pendidikan_ibu',
                    isFile: false
                },
                {
                    name: 'penghasilan_ayah',
                    isFile: false
                },
                {
                    name: 'penghasilan_ibu',
                    isFile: false
                },
                {
                    name: 'nama_ayah_wali',
                    isFile: false
                },
                {
                    name: 'nama_ibu_wali',
                    isFile: false
                },
                {
                    name: 'alamat_ayah_wali',
                    isFile: false
                },
                {
                    name: 'alamat_ibu_wali',
                    isFile: false
                },
                {
                    name: 'telepon_wali',
                    isFile: false
                },
                {
                    name: 'pekerjaan_ayah_wali',
                    isFile: false
                },
                {
                    name: 'pekerjaan_ibu_wali',
                    isFile: false
                },
                {
                    name: 'pendidikan_ayah_wali',
                    isFile: false
                },
                {
                    name: 'pendidikan_ibu_wali',
                    isFile: false
                },
                {
                    name: 'penghasilan_ayah_wali',
                    isFile: false
                },
                {
                    name: 'penghasilan_ibu_wali',
                    isFile: false
                },
                {
                    name: 'pasfoto_path',
                    isFile: true,
                    label: 'Lihat Pas Foto'
                },
                {
                    name: 'bukti_pembayaran',
                    isFile: true,
                    label: 'Lihat Bukti Pembayaran'
                }
            ];

            fields.forEach(field => {
                const element = document.getElementById(`preview_${field.name}`);
                if (element && !field.isFile) {
                    let value = formData.get(field.name) || 'Tidak diisi';
                    // Format date fields for preview
                    if (field.name === 'tanggal_lahir' || field.name === 'diterima_tanggal') {
                        if (value && value.match(/^\d{4}-\d{2}-\d{2}$/)) {
                            const date = new Date(value);
                            const day = String(date.getDate()).padStart(2, '0');
                            const month = String(date.getMonth() + 1).padStart(2, '0');
                            const year = date.getFullYear();
                            value = `${day}/${month}/${year}`;
                        }
                    }
                    element.textContent = value;
                } else if (element && field.isFile) {
                    const file = formData.get(field.name);
                    if (file && file.size > 0 && file.name) {
                        element.textContent = field.label;
                        element.disabled = false;
                        element.onclick = () => window.open(URL.createObjectURL(file), '_blank');
                    } else {
                        element.textContent = field.label;
                        element.disabled = true;
                    }
                }
            });
        }

        updateTabAccessibility();

        nextButtons.forEach(button => {
            button.addEventListener('click', () => {
                console.log(`Next button clicked on step ${currentStep}`);
                if (validateStep(currentStep)) {
                    console.log(`Moving to step ${currentStep + 1}`);
                    currentStep++;
                    highestAccessibleStep = Math.max(highestAccessibleStep, currentStep);
                    tabs[currentStep].click();
                    updateTabAccessibility();
                    if (currentStep === 4) {
                        updatePreview();
                    }
                }
            });
        });

        prevButtons.forEach(button => {
            button.addEventListener('click', () => {
                console.log(`Previous button clicked on step ${currentStep}`);
                currentStep--;
                tabs[currentStep].click();
                updateTabAccessibility();
            });
        });

        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
                form.classList.add('was-validated');
            }
            // Validate date formats
            dateFields.forEach(field => {
                const dateDisplay = document.getElementById(field.displayId);
                if (dateDisplay && dateDisplay.hasAttribute('required')) {
                    const value = dateDisplay.value;
                    if (value && !/^\d{2}\/\d{2}\/\d{4}$/.test(value)) {
                        event.preventDefault();
                        event.stopPropagation();
                        dateDisplay.classList.add('is-invalid');
                    }
                }
            });
            // Validate number fields
            numberFields.forEach(fieldId => {
                const input = document.getElementById(fieldId);
                if (input && input.hasAttribute('required')) {
                    const value = input.value;
                    if (value && !/^\d+$/.test(value)) {
                        event.preventDefault();
                        event.stopPropagation();
                        input.classList.add('is-invalid');
                    }
                }
            });
        });

        tabs.forEach((tab, index) => {
            tab.addEventListener('click', (e) => {
                if (index > highestAccessibleStep) {
                    e.preventDefault();
                    return false;
                }
                console.log(`Tab ${index + 1} clicked`);
                currentStep = index;
                updateTabAccessibility();
                if (currentStep === 4) {
                    updatePreview();
                }
            });
        });
    });
</script>
@endsection
