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
                                    <label for="tanggal_lahir_display">Tanggal Lahir</label>
                                    <div style="position: relative;">
                                        <input type="text" id="tanggal_lahir_display" class="form-control" value="{{ old('tanggal_lahir', $user->tanggal_lahir ? \Carbon\Carbon::parse($user->tanggal_lahir)->format('d/m/Y') : '') }}" placeholder="dd/mm/yyyy">
                                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $user->tanggal_lahir ? \Carbon\Carbon::parse($user->tanggal_lahir)->format('Y-m-d') : '') }}" style="position: absolute; opacity: 0; width: 100%; z-index: -1;">
                                    </div>
                                    <small class="form-text text-muted">Format: DD/MM/YYYY</small>
                                </div>

                                <!-- Informasi Kontak -->
                                <div class="form-group">
                                    <label for="no_hp">Nomor Telepon</label>
                                    <input type="number" name="no_hp" id="no_hp" class="form-control" value="{{ old('no_hp', $user->no_hp) }}">
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="alamat" id="alamat" class="form-control">{{ old('alamat', $user->alamat) }}</textarea>
                                </div>

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

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dateDisplay = document.getElementById('tanggal_lahir_display');
        const dateInput = document.getElementById('tanggal_lahir');

        // Ensure date input is positioned correctly for the picker
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

        // Prevent form submission if date format is invalid
        dateDisplay.closest('form').addEventListener('submit', function(event) {
            const value = dateDisplay.value;
            if (value && !/^\d{2}\/\d{2}\/\d{4}$/.test(value)) {
                event.preventDefault();
                alert('Tanggal Lahir harus dalam format DD/MM/YYYY.');
            }
        });
    });
</script>
@endsection
