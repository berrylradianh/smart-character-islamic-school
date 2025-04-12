@extends('layouts.dashboard.app')

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Tambah Pengguna</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Daftar Pengguna</a></li>
                            <li class="breadcrumb-item active">Tambah Pengguna</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30 shadow-sm" style="border-radius: 10px;">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Form Tambah Pengguna</h4>

                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Konfirmasi Password</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                                </div>
                                <div class="form-group">
                                    <label for="no_hp">No HP</label>
                                    <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ old('no_hp') }}">
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea class="form-control" id="alamat" name="alamat">{{ old('alamat') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="nama_orang_tua">Nama Orang Tua</label>
                                    <input type="text" class="form-control" id="nama_orang_tua" name="nama_orang_tua" value="{{ old('nama_orang_tua') }}">
                                </div>
                                <div class="form-group">
                                    <label for="no_hp_orang_tua">No HP Orang Tua</label>
                                    <input type="text" class="form-control" id="no_hp_orang_tua" name="no_hp_orang_tua" value="{{ old('no_hp_orang_tua') }}">
                                </div>
                                <div class="form-group">
                                    <label for="jenjang">Jenjang</label>
                                    <select class="form-control" id="jenjang" name="jenjang">
                                        <option value="">Pilih Jenjang</option>
                                        <option value="tk" {{ old('jenjang') == 'tk' ? 'selected' : '' }}>TK</option>
                                        <option value="sd" {{ old('jenjang') == 'sd' ? 'selected' : '' }}>SD</option>
                                        <option value="smp" {{ old('jenjang') == 'smp' ? 'selected' : '' }}>SMP</option>
                                        <option value="sma" {{ old('jenjang') == 'sma' ? 'selected' : '' }}>SMA</option>
                                        <option value="kuliah" {{ old('jenjang') == 'kuliah' ? 'selected' : '' }}>Kuliah</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="kk_path">Kartu Keluarga</label>
                                    <input type="file" class="form-control-file" id="kk_path" name="kk_path" accept=".pdf,.jpg,.png">
                                </div>
                                <div class="form-group">
                                    <label for="akta_path">Akta Kelahiran</label>
                                    <input type="file" class="form-control-file" id="akta_path" name="akta_path" accept=".pdf,.jpg,.png">
                                </div>
                                <div class="form-group">
                                    <label for="pasfoto_path">Pas Foto</label>
                                    <input type="file" class="form-control-file" id="pasfoto_path" name="pasfoto_path" accept=".jpg,.png">
                                </div>
                                <div class="form-group">
                                    <label for="ijazah_sd_path">Ijazah SD</label>
                                    <input type="file" class="form-control-file" id="ijazah_sd_path" name="ijazah_sd_path" accept=".pdf,.jpg,.png">
                                </div>
                                <div class="form-group">
                                    <label for="ijazah_smp_path">Ijazah SMP</label>
                                    <input type="file" class="form-control-file" id="ijazah_smp_path" name="ijazah_smp_path" accept=".pdf,.jpg,.png">
                                </div>
                                <div class="form-group">
                                    <label for="ijazah_sma_path">Ijazah SMA</label>
                                    <input type="file" class="form-control-file" id="ijazah_sma_path" name="ijazah_sma_path" accept=".pdf,.jpg,.png">
                                </div>
                                <div class="form-group">
                                    <label for="piagam_path">Piagam</label>
                                    <input type="file" class="form-control-file" id="piagam_path" name="piagam_path" accept=".pdf,.jpg,.png">
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
