@extends('layouts.dashboard.app')

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Edit Pengguna</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.users.index') }}">Daftar Pengguna</a></li>
                            <li class="breadcrumb-item active">Edit Pengguna</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30 shadow-sm" style="border-radius: 10px;">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Form Edit Pengguna</h4>

                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <form action="{{ route('dashboard.users.update', $selectedUser->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $selectedUser->name) }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="role_id">Role</label>
                                    <select class="form-control" id="role_id" name="role_id" required>
                                        <option value="">Pilih Role</option>
                                        @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" {{ old('role_id', $selectedUser->role_id) == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $selectedUser->email) }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password (Kosongkan jika tidak ingin mengubah)</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Konfirmasi Password</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $selectedUser->tanggal_lahir) }}">
                                </div>
                                <div class="form-group">
                                    <label for="no_hp">No HP</label>
                                    <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ old('no_hp', $selectedUser->no_hp) }}">
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea class="form-control" id="alamat" name="alamat">{{ old('alamat', $selectedUser->alamat) }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="nama_orang_tua">Nama Orang Tua</label>
                                    <input type="text" class="form-control" id="nama_orang_tua" name="nama_orang_tua" value="{{ old('nama_orang_tua', $selectedUser->nama_orang_tua) }}">
                                </div>
                                <div class="form-group">
                                    <label for="no_hp_orang_tua">No HP Orang Tua</label>
                                    <input type="text" class="form-control" id="no_hp_orang_tua" name="no_hp_orang_tua" value="{{ old('no_hp_orang_tua', $selectedUser->no_hp_orang_tua) }}">
                                </div>
                                <div class="form-group">
                                    <label for="jenjang">Jenjang</label>
                                    <select class="form-control" id="jenjang" name="jenjang">
                                        <option value="">Pilih Jenjang</option>
                                        <option value="tk" {{ old('jenjang', $selectedUser->jenjang) == 'tk' ? 'selected' : '' }}>TK</option>
                                        <option value="sd" {{ old('jenjang', $selectedUser->jenjang) == 'sd' ? 'selected' : '' }}>SD</option>
                                        <option value="smp" {{ old('jenjang', $selectedUser->jenjang) == 'smp' ? 'selected' : '' }}>SMP</option>
                                        <option value="sma" {{ old('jenjang', $selectedUser->jenjang) == 'sma' ? 'selected' : '' }}>SMA</option>
                                        <option value="kuliah" {{ old('jenjang', $selectedUser->jenjang) == 'kuliah' ? 'selected' : '' }}>Kuliah</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="kk_path">Kartu Keluarga (Kosongkan jika tidak ingin mengubah)</label>
                                    <input type="file" class="form-control-file" id="kk_path" name="kk_path" accept=".pdf,.jpg,.png">
                                    @if ($selectedUser->kk_path)
                                    <small class="form-text text-muted">File saat ini: <a href="{{ Storage::url($selectedUser->kk_path) }}" target="_blank">Lihat</a></small>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="akta_path">Akta Kelahiran (Kosongkan jika tidak ingin mengubah)</label>
                                    <input type="file" class="form-control-file" id="akta_path" name="akta_path" accept=".pdf,.jpg,.png">
                                    @if ($selectedUser->akta_path)
                                    <small class="form-text text-muted">File saat ini: <a href="{{ Storage::url($selectedUser->akta_path) }}" target="_blank">Lihat</a></small>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="pasfoto_path">Pas Foto (Kosongkan jika tidak ingin mengubah)</label>
                                    <input type="file" class="form-control-file" id="pasfoto_path" name="pasfoto_path" accept=".jpg,.png">
                                    @if ($selectedUser->pasfoto_path)
                                    <small class="form-text text-muted">File saat ini: <a href="{{ Storage::url($selectedUser->pasfoto_path) }}" target="_blank">Lihat</a></small>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="ijazah_sd_path">Ijazah SD (Kosongkan jika tidak ingin mengubah)</label>
                                    <input type="file" class="form-control-file" id="ijazah_sd_path" name="ijazah_sd_path" accept=".pdf,.jpg,.png">
                                    @if ($selectedUser->ijazah_sd_path)
                                    <small class="form-text text-muted">File saat ini: <a href="{{ Storage::url($selectedUser->ijazah_sd_path) }}" target="_blank">Lihat</a></small>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="ijazah_smp_path">Ijazah SMP (Kosongkan jika tidak ingin mengubah)</label>
                                    <input type="file" class="form-control-file" id="ijazah_smp_path" name="ijazah_smp_path" accept=".pdf,.jpg,.png">
                                    @if ($selectedUser->ijazah_smp_path)
                                    <small class="form-text text-muted">File saat ini: <a href="{{ Storage::url($selectedUser->ijazah_smp_path) }}" target="_blank">Lihat</a></small>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="ijazah_sma_path">Ijazah SMA (Kosongkan jika tidak ingin mengubah)</label>
                                    <input type="file" class="form-control-file" id="ijazah_sma_path" name="ijazah_sma_path" accept=".pdf,.jpg,.png">
                                    @if ($selectedUser->ijazah_sma_path)
                                    <small class="form-text text-muted">File saat ini: <a href="{{ Storage::url($selectedUser->ijazah_sma_path) }}" target="_blank">Lihat</a></small>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="piagam_path">Piagam (Kosongkan jika tidak ingin mengubah)</label>
                                    <input type="file" class="form-control-file" id="piagam_path" name="piagam_path" accept=".pdf,.jpg,.png">
                                    @if ($selectedUser->piagam_path)
                                    <small class="form-text text-muted">File saat ini: <a href="{{ Storage::url($selectedUser->piagam_path) }}" target="_blank">Lihat</a></small>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('dashboard.users.index') }}" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
