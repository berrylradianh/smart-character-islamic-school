@extends('layouts.dashboard.app')

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Detail Role</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.roles.index') }}">Daftar Role</a></li>
                            <li class="breadcrumb-item active">Detail Role</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30 shadow-sm" style="border-radius: 10px;">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Informasi Role</h4>

                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Nama Role:</strong> {{ $role->name }}</p>
                                    <p><strong>Deskripsi:</strong> {{ $role->description ?? '-' }}</p>
                                    <p><strong>Jumlah Pengguna:</strong> {{ $role->users()->count() }}</p>
                                    <p><strong>Dibuat Pada:</strong> {{ \Carbon\Carbon::parse($role->created_at)->format('d F Y H:i') }}</p>
                                </div>
                            </div>

                            <a href="{{ route('dashboard.roles.edit', $role->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </a>
                            <a href="{{ route('dashboard.roles.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
