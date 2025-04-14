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
                        <h4 class="page-title">Edit Profil</h4>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right">
                            <a href="{{ route('profile.show') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left mr-1"></i> Kembali ke Profil</a>
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
            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            @endif

            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4"><i class="fas fa-user-edit mr-2"></i> Edit Informasi Profil</h4>
                            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- Informasi Pribadi -->
                                <div class="form-group">
                                    <label for="name">Nama Lengkap</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}"
                                        {{ $user->role && $user->role->name !== 'Superadmin' ? 'readonly' : '' }} required>
                                    @if ($user->role && $user->role->name !== 'Superadmin')
                                    <small class="form-text text-muted">Email hanya dapat diubah oleh Superadmin.</small>
                                    @endif
                                </div>

                                @if (!$user->role || !in_array($user->role->name, ['Admin', 'Superadmin']))
                                <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $user->tanggal_lahir ? \Carbon\Carbon::parse($user->tanggal_lahir)->format('Y-m-d') : '') }}">
                                </div>

                                <!-- Informasi Kontak -->
                                <div class="form-group">
                                    <label for="no_hp">Nomor Telepon</label>
                                    <input type="text" name="no_hp" id="no_hp" class="form-control" value="{{ old('no_hp', $user->no_hp) }}">
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="alamat" id="alamat" class="form-control">{{ old('alamat', $user->alamat) }}</textarea>
                                </div>

                                <!-- Informasi Orang Tua -->
                                @if (!$user->level || $user->level->slug !== 'kuliah')
                                <div class="form-group">
                                    <label for="nama_orang_tua">Nama Orang Tua/Wali</label>
                                    <input type="text" name="nama_orang_tua" id="nama_orang_tua" class="form-control" value="{{ old('nama_orang_tua', $user->nama_orang_tua) }}">
                                </div>
                                <div class="form-group">
                                    <label for="no_hp_orang_tua">Nomor Telepon Orang Tua/Wali</label>
                                    <input type="text" name="no_hp_orang_tua" id="no_hp_orang_tua" class="form-control" value="{{ old('no_hp_orang_tua', $user->no_hp_orang_tua) }}">
                                </div>
                                @endif

                                <!-- Jenjang -->
                                <div class="form-group">
                                    <label for="level_id">Jenjang</label>
                                    <input type="text" class="form-control" value="{{ $user->level ? $user->level->name : 'Belum dipilih' }}" readonly>
                                    <input type="hidden" name="level_id" value="{{ $user->level_id }}">
                                    @if ($user->role && $user->role->name !== 'Superadmin')
                                    <small class="form-text text-muted">Jenjang hanya dapat diubah oleh Superadmin.</small>
                                    @endif
                                </div>
                                @endif

                                <!-- Dokumen -->
                                <div class="form-group">
                                    <label for="pasfoto_path">Pasfoto</label>
                                    <input type="file" name="pasfoto_path" id="pasfoto_path" class="form-control-file">
                                    @if ($user->pasfoto_path)
                                    <small class="form-text text-muted">File saat ini: <a href="{{ Storage::url($user->pasfoto_path) }}" target="_blank">Lihat Pasfoto</a></small>
                                    @endif
                                </div>

                                @if (!$user->role || !in_array($user->role->name, ['Admin', 'Superadmin']))
                                <div class="form-group">
                                    <label for="kk_path">Kartu Keluarga (KK)</label>
                                    <input type="file" name="kk_path" id="kk_path" class="form-control-file">
                                    @if ($user->kk_path)
                                    <small class="form-text text-muted">File saat ini: <a href="{{ Storage::url($user->kk_path) }}" target="_blank">Lihat KK</a></small>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="akta_path">Akta Kelahiran</label>
                                    <input type="file" name="akta_path" id="akta_path" class="form-control-file">
                                    @if ($user->akta_path)
                                    <small class="form-text text-muted">File saat ini: <a href="{{ Storage::url($user->akta_path) }}" target="_blank">Lihat Akta</a></small>
                                    @endif
                                </div>
                                <!-- Dokumen Ijazah -->
                                <div class="form-group dokumen-ijazah" id="ijazah_sd_group" @if($user->level && in_array($user->level->slug, ['smp', 'sma', 'kuliah'])) style="display: block;" @else style="display: none;" @endif>
                                    <label for="ijazah_sd_path">Ijazah SD</label>
                                    <input type="file" name="ijazah_sd_path" id="ijazah_sd_path" class="form-control-file">
                                    @if ($user->ijazah_sd_path)
                                    <small class="form-text text-muted">File saat ini: <a href="{{ Storage::url($user->ijazah_sd_path) }}" target="_blank">Lihat Ijazah SD</a></small>
                                    @endif
                                </div>
                                <div class="form-group dokumen-ijazah" id="ijazah_smp_group" @if($user->level && in_array($user->level->slug, ['sma', 'kuliah'])) style="display: block;" @else style="display: none;" @endif>
                                    <label for="ijazah_smp_path">Ijazah SMP</label>
                                    <input type="file" name="ijazah_smp_path" id="ijazah_smp_path" class="form-control-file">
                                    @if ($user->ijazah_smp_path)
                                    <small class="form-text text-muted">File saat ini: <a href="{{ Storage::url($user->ijazah_smp_path) }}" target="_blank">Lihat Ijazah SMP</a></small>
                                    @endif
                                </div>
                                <div class="form-group dokumen-ijazah" id="ijazah_sma_group" @if($user->level && $user->level->slug === 'kuliah') style="display: block;" @else style="display: none;" @endif>
                                    <label for="ijazah_sma_path">Ijazah SMA</label>
                                    <input type="file" name="ijazah_sma_path" id="ijazah_sma_path" class="form-control-file">
                                    @if ($user->ijazah_sma_path)
                                    <small class="form-text text-muted">File saat ini: <a href="{{ Storage::url($user->ijazah_sma_path) }}" target="_blank">Lihat Ijazah SMA</a></small>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="piagam_path">Piagam Penghargaan (Opsional)</label>
                                    <input type="file" name="piagam_path" id="piagam_path" class="form-control-file">
                                    @if ($user->piagam_path)
                                    <small class="form-text text-muted">File saat ini: <a href="{{ Storage::url($user->piagam_path) }}" target="_blank">Lihat Piagam</a></small>
                                    @endif
                                </div>
                                @endif

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        © SCIS, 2024. All Right Reserved
    </footer>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Logika untuk memastikan field ijazah ditampilkan sesuai jenjang saat halaman dimuat
        const jenjangValue = '{{ $user->level ? $user->level->slug : '
        ' }}';

        const ijazahSdGroup = document.getElementById('ijazah_sd_group');
        const ijazahSmpGroup = document.getElementById('ijazah_smp_group');
        const ijazahSmaGroup = document.getElementById('ijazah_sma_group');

        // Tampilkan field ijazah berdasarkan jenjang
        if (['smp', 'sma', 'kuliah'].includes(jenjangValue)) {
            ijazahSdGroup.style.display = 'block';
        }
        if (['sma', 'kuliah'].includes(jenjangValue)) {
            ijazahSmpGroup.style.display = 'block';
        }
        if (jenjangValue === 'kuliah') {
            ijazahSmaGroup.style.display = 'block';
        }
    });
</script>
@endsection
