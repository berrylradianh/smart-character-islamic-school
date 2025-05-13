@extends('layouts.dashboard.app')

@section('content')
<!-- Custom CSS -->
<style>
    .color-input-group {
        position: relative;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .color-preview {
        display: inline-block;
        width: 24px;
        height: 24px;
        border: 2px solid #e0e0e0;
        border-radius: 50%;
        margin-left: 8px;
        vertical-align: middle;
        transition: transform 0.2s ease;
    }

    .color-preview:hover {
        transform: scale(1.15);
    }

    .form-control.colorpicker-input {
        width: 80px;
        padding: 4px;
    }

    .form-control.color-code-input {
        width: 120px;
    }

    .icon-container {
        display: inline-block;
        padding: 8px;
        border-radius: 50%;
        width: 56px;
        height: 56px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .icon-image {
        width: 36px;
        height: 36px;
        object-fit: contain;
    }

    .table-values {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .table-values th,
    .table-values td {
        padding: 12px 16px;
        vertical-align: middle;
        border-bottom: 1px solid #e9ecef;
    }

    .table-values th {
        background-color: #f8f9fa;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        color: #495057;
    }

    .table-values tr:hover {
        background-color: #f1f3f5;
        transition: background-color 0.2s ease;
    }

    .table-values .color-cell {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .table-values .action-buttons {
        display: flex;
        gap: 8px;
    }

    .table-values .btn-icon {
        padding: 6px;
        line-height: 1;
        border-radius: 4px;
        font-size: 0.9rem;
    }

    @media (max-width: 768px) {
        .table-values .color-code {
            display: none;
        }

        .table-values .color-preview {
            margin-left: 0;
        }

        .table-values td,
        .table-values th {
            padding: 8px;
        }

        .color-input-group {
            flex-wrap: wrap;
        }
    }
</style>

<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Manage Values</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Values</li>
                        </ol>
                    </div>
                </div>
            </div>

            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <!-- Tabel Values -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Daftar Values</h4>
                            <div class="table-responsive">
                                <table class="table table-values">
                                    <thead>
                                        <tr>
                                            <th>Judul</th>
                                            <th>Deskripsi</th>
                                            <th>Ikon</th>
                                            <th>Warna Latar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($values as $value)
                                        <tr>
                                            <td>{{ $value->title }}</td>
                                            <td>{{ $value->description }}</td>
                                            <td>
                                                @if ($value->icon)
                                                <div class="icon-container" style="background-color: {{ $value->color ?? '#4A90E2' }};">
                                                    <img src="{{ asset('storage/' . $value->icon) }}" alt="{{ $value->title }}" class="icon-image">
                                                </div>
                                                @else
                                                Tidak ada ikon
                                                @endif
                                            </td>
                                            <td>
                                                <div class="color-cell">
                                                    <span class="color-code">{{ $value->color ?? '#4A90E2' }}</span>
                                                    <span class="color-preview" style="background-color: {{ $value->color ?? '#4A90E2' }};" title="{{ $value->color ?? '#4A90E2' }}"></span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="action-buttons">
                                                    <button class="btn btn-warning btn-icon" data-toggle="modal" data-target="#editModal{{ $value->id }}" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="editModal{{ $value->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $value->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel{{ $value->id }}">Edit Value</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('dashboard.values.update', $value->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label>Judul</label>
                                                                <input type="text" name="title" class="form-control" value="{{ $value->title }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Deskripsi</label>
                                                                <input type="text" name="description" class="form-control" value="{{ $value->description }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Warna Latar</label>
                                                                <div class="color-input-group">
                                                                    <input type="text" name="color" class="form-control color-code-input" value="{{ $value->color ?? '#4A90E2' }}" placeholder="#RRGGBB" pattern="^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$">
                                                                    <input type="color" class="form-control colorpicker-input color-sync" data-sync-target="color" value="{{ $value->color ?? '#4A90E2' }}">
                                                                    <span class="color-preview" style="background-color: {{ $value->color ?? '#4A90E2' }};"></span>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Ikon</label>
                                                                <input type="file" name="icon" class="form-control-file">
                                                                @if ($value->icon)
                                                                <div class="icon-container mt-2" style="background-color: {{ $value->color ?? '#4A90E2' }};">
                                                                    <img src="{{ asset('storage/' . $value->icon) }}" alt="{{ $value->title }}" class="icon-image">
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
    </div>

    <footer class="footer">
        © SCIS, 2024. All Right Reserved
    </footer>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const colorSyncInputs = document.querySelectorAll('.color-sync');

        colorSyncInputs.forEach(colorInput => {
            const targetName = colorInput.getAttribute('data-sync-target');
            const textInput = colorInput.closest('.color-input-group').querySelector(`input[name="${targetName}"]`);
            const preview = colorInput.closest('.color-input-group').querySelector('.color-preview');

            colorInput.addEventListener('input', function() {
                textInput.value = this.value;
                preview.style.backgroundColor = this.value;
            });

            textInput.addEventListener('input', function() {
                const colorValue = this.value;
                if (/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/.test(colorValue)) {
                    colorInput.value = colorValue;
                    preview.style.backgroundColor = colorValue;
                }
            });
        });
    });
</script>
@endsection
