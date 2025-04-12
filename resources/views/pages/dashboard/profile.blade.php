@php
use Illuminate\Support\Facades\Storage;
@endphp

@extends('layouts.dashboard.app')
@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <!-- Start Page Title -->
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Profil Pengguna</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">SCIS</li>
                            <li class="breadcrumb-item active">Profil Pengguna</li>
                        </ol>
                        <div class="float-right mr-3">
                            <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-sm"><i class="fas fa-edit mr-1"></i> Edit Profil</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Page Title -->

            <!-- Notification -->
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

            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <!-- Informasi Pribadi -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4"><i class="fas fa-user mr-2"></i> Informasi Pribadi</h4>
                            <div class="table-responsive">
                                <table class="table table-borderless mb-0">
                                    <tbody>
                                        <tr>
                                            <th scope="row" style="width: 30%;">Nama Lengkap</th>
                                            <td>{{ $user->name ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Email</th>
                                            <td>{{ $user->email ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Tanggal Lahir</th>
                                            <td>{{ $user->tanggal_lahir ? \Carbon\Carbon::parse($user->tanggal_lahir)->format('d F Y') : '-' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Kontak -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4"><i class="fas fa-phone mr-2"></i> Informasi Kontak</h4>
                            <div class="table-responsive">
                                <table class="table table-borderless mb-0">
                                    <tbody>
                                        <tr>
                                            <th scope="row" style="width: 30%;">Nomor Telepon</th>
                                            <td>{{ $user->no_hp ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Alamat</th>
                                            <td>{{ $user->alamat ?? '-' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Orang Tua -->
                    @if ($user->jenjang !== 'kuliah')
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4"><i class="fas fa-users mr-2"></i> Informasi Orang Tua</h4>
                            <div class="table-responsive">
                                <table class="table table-borderless mb-0">
                                    <tbody>
                                        <tr>
                                            <th scope="row" style="width: 30%;">Nama Orang Tua/Wali</th>
                                            <td>{{ $user->nama_orang_tua ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Nomor Telepon Orang Tua/Wali</th>
                                            <td>{{ $user->no_hp_orang_tua ?? '-' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Jenjang -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4"><i class="fas fa-graduation-cap mr-2"></i> Jenjang Pendaftaran</h4>
                            <div class="table-responsive">
                                <table class="table table-borderless mb-0">
                                    <tbody>
                                        <tr>
                                            <th scope="row" style="width: 30%;">Jenjang</th>
                                            <td>
                                                @if ($user->jenjang)
                                                {{ strtoupper($user->jenjang) }}
                                                @else
                                                <span class="text-muted">Belum dipilih</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Dokumen -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4"><i class="fas fa-file-alt mr-2"></i> Dokumen Pendaftaran</h4>
                            <div class="table-responsive">
                                <table class="table table-borderless mb-0">
                                    <tbody>
                                        <tr>
                                            <th scope="row" style="width: 30%;">Kartu Keluarga (KK)</th>
                                            <td>
                                                @if ($user->kk_path)
                                                <a href="{{ Storage::url($user->kk_path) }}" target="_blank" class="text-primary"><i class="fas fa-file mr-1"></i> Lihat KK</a>
                                                @else
                                                <span class="text-muted">Belum diunggah</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Akta Kelahiran</th>
                                            <td>
                                                @if ($user->akta_path)
                                                <a href="{{ Storage::url($user->akta_path) }}" target="_blank" class="text-primary"><i class="fas fa-file mr-1"></i> Lihat Akta</a>
                                                @else
                                                <span class="text-muted">Belum diunggah</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Pasfoto</th>
                                            <td>
                                                @if ($user->pasfoto_path)
                                                <a href="{{ Storage::url($user->pasfoto_path) }}" target="_blank" class="text-primary"><i class="fas fa-image mr-1"></i> Lihat Pasfoto</a>
                                                @else
                                                <span class="text-muted">Belum diunggah</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @if ($user->jenjang === 'smp')
                                        <tr>
                                            <th scope="row">Ijazah SD</th>
                                            <td>
                                                @if ($user->ijazah_sd_path)
                                                <a href="{{ Storage::url($user->ijazah_sd_path) }}" target="_blank" class="text-primary"><i class="fas fa-file mr-1"></i> Lihat Ijazah SD</a>
                                                @else
                                                <span class="text-muted">Belum diunggah</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @elseif ($user->jenjang === 'sma')
                                        <tr>
                                            <th scope="row">Ijazah SD</th>
                                            <td>
                                                @if ($user->ijazah_sd_path)
                                                <a href="{{ Storage::url($user->ijazah_sd_path) }}" target="_blank" class="text-primary"><i class="fas fa-file mr-1"></i> Lihat Ijazah SD</a>
                                                @else
                                                <span class="text-muted">Belum diunggah</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Ijazah SMP</th>
                                            <td>
                                                @if ($user->ijazah_smp_path)
                                                <a href="{{ Storage::url($user->ijazah_smp_path) }}" target="_blank" class="text-primary"><i class="fas fa-file mr-1"></i> Lihat Ijazah SMP</a>
                                                @else
                                                <span class="text-muted">Belum diunggah</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @elseif ($user->jenjang === 'kuliah')
                                        <tr>
                                            <th scope="row">Ijazah SD</th>
                                            <td>
                                                @if ($user->ijazah_sd_path)
                                                <a href="{{ Storage::url($user->ijazah_sd_path) }}" target="_blank" class="text-primary"><i class="fas fa-file mr-1"></i> Lihat Ijazah SD</a>
                                                @else
                                                <span class="text-muted">Belum diunggah</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Ijazah SMP</th>
                                            <td>
                                                @if ($user->ijazah_smp_path)
                                                <a href="{{ Storage::url($user->ijazah_smp_path) }}" target="_blank" class="text-primary"><i class="fas fa-file mr-1"></i> Lihat Ijazah SMP</a>
                                                @else
                                                <span class="text-muted">Belum diunggah</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Ijazah SMA</th>
                                            <td>
                                                @if ($user->ijazah_sma_path)
                                                <a href="{{ Storage::url($user->ijazah_sma_path) }}" target="_blank" class="text-primary"><i class="fas fa-file mr-1"></i> Lihat Ijazah SMA</a>
                                                @else
                                                <span class="text-muted">Belum diunggah</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <th scope="row">Piagam Penghargaan</th>
                                            <td>
                                                @if ($user->piagam_path)
                                                <a href="{{ Storage::url($user->piagam_path) }}" target="_blank" class="text-primary"><i class="fas fa-file mr-1"></i> Lihat Piagam</a>
                                                @else
                                                <span class="text-muted">Belum diunggah (opsional)</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Peringatan jika data tidak lengkap -->
                    @if (!$user->isProfileComplete())
                    <div class="alert alert-warning" role="alert">
                        <i class="fas fa-exclamation-circle mr-2"></i> Profil Anda belum lengkap. Silakan <a href="{{ route('profile.edit') }}" class="alert-link">lengkapi profil</a> untuk melanjutkan pendaftaran.
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        © SCIS, 2024. All Right Reserved
    </footer>
</div>
@endsection
