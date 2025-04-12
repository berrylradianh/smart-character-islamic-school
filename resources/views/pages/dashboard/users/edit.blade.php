@php
use Illuminate\Support\Facades\Storage;
@endphp

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

                            <form action="{{ route('dashboard.users.update', $selectedUser->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $selectedUser->name) }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="role_id">Role</label>
                                    <input type="text" class="form-control" id="role_id" value="{{ $selectedUser->role->name }}" readonly>
                                    <input type="hidden" name="role_id" value="{{ $selectedUser->role_id }}">
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
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $selectedUser->tanggal_lahir ? $selectedUser->tanggal_lahir->format('Y-m-d') : '') }}">
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
                                    <label for="level_id">Jenjang</label>
                                    <select class="form-control" id="level_id" name="level_id">
                                        @foreach ($levels as $level)
                                        <option value="{{ $level->id }}" {{ old('level_id', $selectedUser->level_id) == $level->id ? 'selected' : '' }}>{{ $level->name }}</option>
                                        @endforeach
                                    </select>
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
