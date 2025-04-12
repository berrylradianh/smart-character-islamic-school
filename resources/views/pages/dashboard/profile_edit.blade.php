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
                                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                                </div>
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
                                @if ($user->jenjang !== 'kuliah')
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
                                    <label for="jenjang">Jenjang</label>
                                    <select name="jenjang" id="jenjang" class="form-control">
                                        <option value="">Pilih Jenjang</option>
                                        <option value="tk" {{ old('jenjang', $user->jenjang) == 'tk' ? 'selected' : '' }}>TK</option>
                                        <option value="sd" {{ old('jenjang', $user->jenjang) == 'sd' ? 'selected' : '' }}>SD</option>
                                        <option value="smp" {{ old('jenjang', $user->jenjang) == 'smp' ? 'selected' : '' }}>SMP</option>
                                        <option value="sma" {{ old('jenjang', $user->jenjang) == 'sma' ? 'selected' : '' }}>SMA</option>
                                        <option value="kuliah" {{ old('jenjang', $user->jenjang) == 'kuliah' ? 'selected' : '' }}>Kuliah</option>
                                    </select>
                                </div>

                                <!-- Dokumen -->
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
                                <div class="form-group">
                                    <label for="pasfoto_path">Pasfoto</label>
                                    <input type="file" name="pasfoto_path" id="pasfoto_path" class="form-control-file">
                                    @if ($user->pasfoto_path)
                                    <small class="form-text text-muted">File saat ini: <a href="{{ Storage::url($user->pasfoto_path) }}" target="_blank">Lihat Pasfoto</a></small>
                                    @endif
                                </div>
                                <!-- Dokumen Ijazah -->
                                <div class="form-group dokumen-ijazah" id="ijazah_tk_group" style="display: none;">
                                    <label for="ijazah_tk_path">Ijazah TK</label>
                                    <input type="file" name="ijazah_tk_path" id="ijazah_tk_path" class="form-control-file">
                                    @if ($user->ijazah_tk_path)
                                    <small class="form-text text-muted">File saat ini: <a href="{{ Storage::url($user->ijazah_tk_path) }}" target="_blank">Lihat Ijazah TK</a></small>
                                    @endif
                                </div>
                                <div class="form-group dokumen-ijazah" id="ijazah_sd_group" style="display: none;">
                                    <label for="ijazah_sd_path">Ijazah SD</label>
                                    <input type="file" name="ijazah_sd_path" id="ijazah_sd_path" class="form-control-file">
                                    @if ($user->ijazah_sd_path)
                                    <small class="form-text text-muted">File saat ini: <a href="{{ Storage::url($user->ijazah_sd_path) }}" target="_blank">Lihat Ijazah SD</a></small>
                                    @endif
                                </div>
                                <div class="form-group dokumen-ijazah" id="ijazah_smp_group" style="display: none;">
                                    <label for="ijazah_smp_path">Ijazah SMP</label>
                                    <input type="file" name="ijazah_smp_path" id="ijazah_smp_path" class="form-control-file">
                                    @if ($user->ijazah_smp_path)
                                    <small class="form-text text-muted">File saat ini: <a href="{{ Storage::url($user->ijazah_smp_path) }}" target="_blank">Lihat Ijazah SMP</a></small>
                                    @endif
                                </div>
                                <div class="form-group dokumen-ijazah" id="ijazah_sma_group" style="display: none;">
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
        const jenjangSelect = document.getElementById('jenjang');
        const ijazahTkGroup = document.getElementById('ijazah_tk_group');
        const ijazahSdGroup = document.getElementById('ijazah_sd_group');
        const ijazahSmpGroup = document.getElementById('ijazah_smp_group');
        const ijazahSmaGroup = document.getElementById('ijazah_sma_group');

        function updateDokumenFields() {
            // Sembunyikan semua field ijazah
            ijazahTkGroup.style.display = 'none';
            ijazahSdGroup.style.display = 'none';
            ijazahSmpGroup.style.display = 'none';
            ijazahSmaGroup.style.display = 'none';

            // Tampilkan field sesuai jenjang
            const jenjang = jenjangSelect.value;
            if (jenjang === 'sd') {
                ijazahTkGroup.style.display = 'block';
            } else if (jenjang === 'smp') {
                ijazahSdGroup.style.display = 'block';
            } else if (jenjang === 'sma') {
                ijazahSdGroup.style.display = 'block';
                ijazahSmpGroup.style.display = 'block';
            } else if (jenjang === 'kuliah') {
                ijazahSdGroup.style.display = 'block';
                ijazahSmpGroup.style.display = 'block';
                ijazahSmaGroup.style.display = 'block';
            }
            // Untuk TK atau kosong, tidak ada ijazah yang ditampilkan
        }

        // Panggil fungsi saat halaman dimuat
        updateDokumenFields();

        // Panggil fungsi saat jenjang berubah
        jenjangSelect.addEventListener('change', updateDokumenFields);
    });
</script>
@endsection
