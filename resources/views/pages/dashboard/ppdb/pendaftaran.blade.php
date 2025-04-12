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
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Formulir Pendaftaran</h4>
                            <p class="sub-title">Silakan unggah bukti pembayaran di bawah ini.</p>

                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                            @endif

                            <form enctype="multipart/form-data" action="{{ route('dashboard.ppdb_pendaftaran.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="level_id" value="{{ Auth::user()->level_id }}">

                                <div class="form-group">
                                    <label>Jenjang</label>
                                    <input type="text" class="form-control" value="{{ Auth::user()->level ? strtoupper(Auth::user()->level->name) : 'Belum diatur' }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Biaya Pendaftaran</label>
                                    <input type="text" class="form-control" value="{{ Auth::user()->level && Auth::user()->level->biaya ? 'Rp. ' . number_format(Auth::user()->level->biaya, 0, ',', '.') : 'Biaya belum diatur' }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Upload Bukti Pembayaran</label>
                                    <input type="file" class="form-control-file" name="bukti_pembayaran" accept=".pdf,.jpg,.png" required>
                                    <small class="text-muted">Upload bukti pembayaran biaya pendaftaran {{ Auth::user()->level && Auth::user()->level->biaya ? 'Rp. ' . number_format(Auth::user()->level->biaya, 0, ',', '.') : '' }}</small>
                                </div>

                                <button type="submit" class="btn btn-primary">Daftar</button>
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
