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
                            <h5 class="mt-0 header-title">Status Pendaftaran</h5>

                            @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
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
                            <!-- Formulir Pendaftaran -->
                            <p class="sub-title text-muted mb-4">Silakan unggah bukti pembayaran untuk menyelesaikan pendaftaran Anda.</p>
                            <form enctype="multipart/form-data" action="{{ route('dashboard.ppdb_pendaftaran.store') }}" method="POST" class="needs-validation" novalidate>
                                @csrf
                                <input type="hidden" name="level_id" value="{{ auth()->user()->level_id }}">

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

                                <button type="submit" class="btn btn-primary rounded-pill px-4">
                                    <i class="fas fa-paper-plane mr-2"></i> Daftar Sekarang
                                </button>
                            </form>
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
@endsection
