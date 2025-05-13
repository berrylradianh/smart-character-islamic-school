@extends('layouts.dashboard.app')

@section('content')
<!-- Custom CSS untuk Color Picker, Ikon, dan Tabel -->
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

    .color-error {
        color: #e3342f;
        font-size: 0.875rem;
        margin-top: 5px;
        display: none;
    }

    .form-control.colorpicker-input {
        width: 80px;
        padding: 4px;
    }

    .form-control.color-code-input {
        width: 120px;
    }

    /* Styling untuk ikon */
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

    /* Styling untuk tabel */
    .table-stats {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .table-stats th,
    .table-stats td {
        padding: 12px 16px;
        vertical-align: middle;
        border-bottom: 1px solid #e9ecef;
    }

    .table-stats th {
        background-color: #f8f9fa;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        color: #495057;
    }

    .table-stats tr:hover {
        background-color: #f1f3f5;
        transition: background-color 0.2s ease;
    }

    .table-stats .color-cell {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .table-stats .action-buttons {
        display: flex;
        gap: 8px;
    }

    .table-stats .btn-icon {
        padding: 6px;
        line-height: 1;
        border-radius: 4px;
        font-size: 0.9rem;
    }

    /* Responsivitas */
    @media (max-width: 768px) {
        .table-stats .color-code {
            display: none;
        }

        .table-stats .color-preview {
            margin-left: 0;
        }

        .table-stats td,
        .table-stats th {
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
                        <h4 class="page-title">Manage Dashboard Stats</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
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
            <!-- <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Tambah Statistik</h4>
                            <form action="{{ route('dashboard.stats.store') }}" method="POST" enctype="multipart/form-data">
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
                                    <div class="color-input-group">
                                        <input type="text" name="color" class="form-control color-code-input" value="#3b82f6" placeholder="#RRGGBB" pattern="^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$">
                                        <input type="color" class="form-control colorpicker-input color-sync" data-sync-target="color">
                                        <span class="color-preview" style="background-color: #3b82f6;"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Warna Progress Bar</label>
                                    <div class="color-input-group">
                                        <input type="text" name="progress_bar_color" class="form-control color-code-input" value="#3b82f6" placeholder="#RRGGBB" pattern="^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$">
                                        <input type="color" class="form-control colorpicker-input color-sync" data-sync-target="progress_bar_color">
                                        <span class="color-preview" style="background-color: #3b82f6;"></span>
                                    </div>
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
            </div> -->

            <!-- Tabel Statistik -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Daftar Statistik</h4>
                            <div class="table-responsive">
                                <table class="table table-stats">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Nilai</th>
                                            <th>Persentase</th>
                                            <th>Ikon</th>
                                            <th>Warna Latar</th>
                                            <th>Warna Progress</th>
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
                                                <div class="icon-container" @if($stat->color) style="background-color: {{ $stat->color }};" @else style="background-color: #3b82f6;" @endif>
                                                    <img src="{{ asset('storage/' . $stat->icon) }}" alt="{{ $stat->name }}" class="icon-image">
                                                </div>
                                                @else
                                                Tidak ada ikon
                                                @endif
                                            </td>
                                            <td>
                                                <div class="color-cell">
                                                    <span class="color-code">{{ $stat->color ?? '#3b82f6' }}</span>
                                                    <span class="color-preview"
                                                        @if($stat->color)
                                                        style="background-color: {{ $stat->color }};"
                                                        title="{{ $stat->color }}"
                                                        @else
                                                        style="background-color: #3b82f6;"
                                                        title="#3b82f6"
                                                        @endif
                                                        ></span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="color-cell">
                                                    <span class="color-code">{{ $stat->progress_bar_color ?? '#3b82f6' }}</span>
                                                    <span class="color-preview"
                                                        @if($stat->progress_bar_color)
                                                        style="background-color: {{ $stat->progress_bar_color }};"
                                                        title="{{ $stat->progress_bar_color }}"
                                                        @else
                                                        style="background-color: #3b82f6;"
                                                        title="#3b82f6"
                                                        @endif
                                                        ></span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="action-buttons">
                                                    <button class="btn btn-warning btn-icon" data-toggle="modal" data-target="#editModal{{ $stat->id }}" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <!-- <form action="{{ route('dashboard.stats.destroy', $stat->id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-icon" onclick="return confirm('Yakin ingin menghapus?')" title="Hapus">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form> -->
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="editModal{{ $stat->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $stat->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel{{ $stat->id }}">Edit Statistik</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('dashboard.stats.update', $stat->id) }}" method="POST" enctype="multipart/form-data">
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
                                                                <div class="color-input-group">
                                                                    <input type="text" name="color" class="form-control color-code-input" value="{{ $stat->color ?? '#3b82f6' }}" placeholder="#RRGGBB" pattern="^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$">
                                                                    <input type="color" class="form-control colorpicker-input color-sync" data-sync-target="color" value="{{ $stat->color ?? '#3b82f6' }}">
                                                                    <span class="color-preview"
                                                                        @if($stat->color)
                                                                        style="background-color: {{ $stat->color }};"
                                                                        @else
                                                                        style="background-color: #3b82f6;"
                                                                        @endif
                                                                        ></span>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Warna Progress Bar</label>
                                                                <div class="color-input-group">
                                                                    <input type="text" name="progress_bar_color" class="form-control color-code-input" value="{{ $stat->progress_bar_color ?? '#3b82f6' }}" placeholder="#RRGGBB" pattern="^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$">
                                                                    <input type="color" class="form-control colorpicker-input color-sync" data-sync-target="progress_bar_color" value="{{ $stat->progress_bar_color ?? '#3b82f6' }}">
                                                                    <span class="color-preview"
                                                                        @if($stat->progress_bar_color)
                                                                        style="background-color: {{ $stat->progress_bar_color }};"
                                                                        @else
                                                                        style="background-color: #3b82f6;"
                                                                        @endif
                                                                        ></span>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Ikon</label>
                                                                <input type="file" name="icon" class="form-control-file">
                                                                @if ($stat->icon)
                                                                <div class="icon-container mt-2" @if($stat->color) style="background-color: {{ $stat->color }};" @else style="background-color: #3b82f6;" @endif>
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
