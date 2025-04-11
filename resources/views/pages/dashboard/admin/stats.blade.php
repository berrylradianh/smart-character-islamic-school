@extends('layouts.dashboard.app')

@section('content')
<!-- Custom CSS untuk Color Picker dan Ikon -->
<style>
    .color-input-group {
        position: relative;
        display: flex;
        align-items: center;
    }

    .color-preview {
        display: inline-block;
        width: 30px;
        height: 30px;
        border: 2px solid #ccc;
        border-radius: 5px;
        margin-left: 10px;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .color-preview:hover {
        transform: scale(1.1);
    }

    .color-error {
        color: #e3342f;
        font-size: 0.875rem;
        margin-top: 5px;
        display: none;
    }

    .form-control.colorpicker-input {
        width: 150px;
    }

    /* Styling untuk ikon */
    .icon-container {
        display: inline-block;
        padding: 5px;
        border-radius: 50%;
    }

    .icon-image {
        width: 40px;
        height: 40px;
        object-fit: contain;
        /* Memastikan ikon tidak terdistorsi */
    }
</style>

<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Manage Dashboard Stats</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Stats</li>
                        </ol>
                    </div>
                </div>
            </div>

            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <!-- Form Tambah Statistik -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Tambah Statistik</h4>
                            <form action="{{ route('admin.stats.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Nama Statistik</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Nilai</label>
                                    <input type="number" name="value" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Persentase Periode Sebelumnya (%)</label>
                                    <input type="number" name="previous_period_percentage" class="form-control" min="0" max="100" required>
                                </div>
                                <div class="form-group">
                                    <label>Warna Latar</label>
                                    <input type="color" name="color" class="form-control" value="#3b82f6">
                                </div>
                                <div class="form-group">
                                    <label>Ikon</label>
                                    <input type="file" name="icon" class="form-control-file">
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Statistik -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Daftar Statistik</h4>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Nilai</th>
                                        <th>Persentase</th>
                                        <th>Ikon</th>
                                        <th>Warna</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($stats as $stat)
                                    <tr>
                                        <td>{{ $stat->name }}</td>
                                        <td>{{ number_format($stat->value, 0, ',', '.') }}</td>
                                        <td>{{ $stat->previous_period_percentage }}%</td>
                                        <td>
                                            @if ($stat->icon)
                                            <div class="icon-container" @if($stat->color) style="background-color: {{ $stat->color }}; border-radius: 50%; width: 60px; height: 60px; display: flex; justify-content: center; align-items: center;" @else style="background-color: #3b82f6; border-radius: 50%; width: 60px; height: 60px; display: flex; justify-content: center; align-items: center;" @endif>
                                                <img src="{{ asset('storage/' . $stat->icon) }}" alt="{{ $stat->name }}" class="icon-image">
                                            </div>
                                            @else
                                            Tidak ada ikon
                                            @endif
                                        </td>
                                        <td>{{ $stat->color }}</td>
                                        <td>
                                            <!-- Tombol Edit -->
                                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal{{ $stat->id }}">Edit</button>
                                            <!-- Tombol Hapus -->
                                            <form action="{{ route('admin.stats.destroy', $stat->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="editModal{{ $stat->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel">Edit Statistik</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('admin.stats.update', $stat->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Nama Statistik</label>
                                                            <input type="text" name="name" class="form-control" value="{{ $stat->name }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Nilai</label>
                                                            <input type="number" name="value" class="form-control" value="{{ $stat->value }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Persentase Periode Sebelumnya (%)</label>
                                                            <input type="number" name="previous_period_percentage" class="form-control" value="{{ $stat->previous_period_percentage }}" min="0" max="100" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Warna Latar</label>
                                                            <input type="text" name="color" class="form-control" value="{{ $stat->color }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Ikon</label>
                                                            <input type="file" name="icon" class="form-control-file">
                                                            @if ($stat->icon)
                                                            <div class="icon-container mt-2" @if($stat->color) style="background-color: {{ $stat->color }}; border-radius: 50%; width: 60px; height: 60px; display: flex; justify-content: center; align-items: center;" @else style="background-color: #3b82f6; border-radius: 50%; width: 60px; height: 60px; display: flex; justify-content: center; align-items: center;" @endif>
                                                                <img src="{{ asset('storage/' . $stat->icon) }}" alt="{{ $stat->name }}" class="icon-image">
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>
                            </table>
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
