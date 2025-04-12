@extends('layouts.dashboard.app')

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Detail Pengguna</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.users.index') }}">Daftar Pengguna</a></li>
                            <li class="breadcrumb-item active">Detail Pengguna</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30 shadow-sm" style="border-radius: 10px;">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Informasi Pengguna</h4>

                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Nama:</strong> {{ $selectedUser->name }}</p>
                                    <p><strong>Email:</strong> {{ $selectedUser->email }}</p>
                                    <p><strong>Role:</strong> {{ $selectedUser->role ? $selectedUser->role->name : '-' }}</p>
                                    <p><strong>Tanggal Lahir:</strong> {{ $selectedUser->tanggal_lahir ? \Carbon\Carbon::parse($selectedUser->tanggal_lahir)->format('d F Y') : '-' }}</p>
                                    <p><strong>No HP:</strong> {{ $selectedUser->no_hp ?? '-' }}</p>
                                    <p><strong>Alamat:</strong> {{ $selectedUser->alamat ?? '-' }}</p>
                                    <p><strong>Nama Orang Tua:</strong> {{ $selectedUser->nama_orang_tua ?? '-' }}</p>
                                    <p><strong>No HP Orang Tua:</strong> {{ $selectedUser->no_hp_orang_tua ?? '-' }}</p>
                                    <p><strong>Jenjang:</strong> {{ $selectedUser->jenjang ? strtoupper($selectedUser->jenjang) : '-' }}</p>
                                    <p><strong>Dibuat Pada:</strong> {{ \Carbon\Carbon::parse($selectedUser->created_at)->format('d F Y H:i') }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Kartu Keluarga:</strong>
                                        @if ($selectedUser->kk_path)
                                            <a href="{{ Storage::url($selectedUser->kk_path) }}" target="_blank">Lihat File</a>
                                        @else
                                            -
                                        @endif
                                    </p>
                                    <p><strong>Akta Kelahiran:</strong>
                                        @if ($selectedUser->akta_path)
                                            <a href="{{ Storage::url($selectedUser->akta_path) }}" target="_blank">Lihat File</a>
                                        @else
                                            -
                                        @endif
                                    </p>
                                    <p><strong>Pas Foto:</strong>
                                        @if ($selectedUser->pasfoto_path)
                                            <a href="{{ Storage::url($selectedUser->pasfoto_path) }}" target="_blank">Lihat File</a>
                                        @else
                                            -
                                        @endif
                                    </p>
                                    <p><strong>Ijazah SD:</strong>
                                        @if ($selectedUser->ijazah_sd_path)
                                            <a href="{{ Storage::url($selectedUser->ijazah_sd_path) }}" target="_blank">Lihat File</a>
                                        @else
                                            -
                                        @endif
                                    </p>
                                    <p><strong>Ijazah SMP:</strong>
                                        @if ($selectedUser->ijazah_smp_path)
                                            <a href="{{ Storage::url($selectedUser->ijazah_smp_path) }}" target="_blank">Lihat File</a>
                                        @else
                                            -
                                        @endif
                                    </p>
                                    <p><strong>Ijazah SMA:</strong>
                                        @if ($selectedUser->ijazah_sma_path)
                                            <a href="{{ Storage::url($selectedUser->ijazah_sma_path) }}" target="_blank">Lihat File</a>
                                        @else
                                            -
                                        @endif
                                    </p>
                                    <p><strong>Piagam:</strong>
                                        @if ($selectedUser->piagam_path)
                                            <a href="{{ Storage::url($selectedUser->piagam_path) }}" target="_blank">Lihat File</a>
                                        @else
                                            -
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <a href="{{ route('dashboard.users.edit', $selectedUser->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </a>
                            <a href="{{ route('dashboard.users.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
