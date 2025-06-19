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
