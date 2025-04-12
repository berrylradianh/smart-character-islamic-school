@extends('layouts.dashboard.app')

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Kelola Informasi Pendaftaran</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">SCIS</li>
                            <li class="breadcrumb-item">PPDB</li>
                            <li class="breadcrumb-item active">Kelola Informasi</li>
                        </ol>
                    </div>
                </div>
            </div>

            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            @if ($errors->has('level_id'))
            <div class="alert alert-danger">
                {{ $errors->first('level_id') }}
            </div>
            @endif

            <!-- Form for Adding Jenjang -->
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Tambah Jenjang</h4>
                            <form action="{{ route('dashboard.levels.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Nama Jenjang</label>
                                    <input type="text" name="name" id="name" class="form-control" required placeholder="e.g., Taman Kanak-Kanak (TK)">
                                </div>
                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input type="text" name="slug" id="slug" class="form-control" required placeholder="e.g., tk">
                                </div>
                                <button type="submit" class="btn btn-primary">Tambah Jenjang</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form for Adding Registration Info -->
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Tambah Informasi Pendaftaran</h4>
                            <form action="{{ route('dashboard.requirement_information.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="level_id">Jenjang</label>
                                    <select name="level_id" id="level_id" class="form-control" required>
                                        <option value="">Pilih Jenjang</option>
                                        @foreach ($availableLevels as $level)
                                        <option value="{{ $level->id }}">{{ $level->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($availableLevels->isEmpty())
                                    <small class="text-muted">Semua jenjang sudah memiliki informasi pendaftaran. Tambah jenjang baru jika diperlukan.</small>
                                    @endif
                                </div>

                                <!-- Requirements -->
                                <div class="form-group">
                                    <label>Persyaratan</label>
                                    <div id="requirements-container">
                                        <div class="input-group mb-2">
                                            <input type="text" name="requirements[]" class="form-control" required>
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-danger remove-field"><i class="fas fa-trash"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-secondary add-field" data-target="requirements">Tambah Persyaratan</button>
                                </div>

                                <!-- Stages -->
                                <div class="form-group">
                                    <label>Tahapan Pendaftaran</label>
                                    <div id="stages-container">
                                        <div class="input-group mb-2">
                                            <input type="text" name="stages[]" class="form-control" required>
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-danger remove-field"><i class="fas fa-trash"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-secondary add-field" data-target="stages">Tambah Tahapan</button>
                                </div>

                                <!-- Fees -->
                                <div class="form-group">
                                    <label>Biaya</label>
                                    <div id="fees-container">
                                        <div class="input-group mb-2">
                                            <input type="text" name="fees[]" class="form-control" required>
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-danger remove-field"><i class="fas fa-trash"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-secondary add-field" data-target="fees">Tambah Biaya</button>
                                </div>

                                <button type="submit" class="btn btn-primary" {{ $availableLevels->isEmpty() ? 'disabled' : '' }}>Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- List of Existing Levels -->
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Daftar Jenjang</h4>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Slug</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($levels as $level)
                                    <tr>
                                        <td>{{ $level->name }}</td>
                                        <td>{{ $level->slug }}</td>
                                        <td>
                                            <form action="{{ route('dashboard.levels.destroy', $level->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus jenjang ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- List of Existing Registration Info -->
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Daftar Informasi Pendaftaran</h4>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Jenjang</th>
                                        <th>Persyaratan</th>
                                        <th>Tahapan</th>
                                        <th>Biaya</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($registrationInfos as $info)
                                    <tr>
                                        <td>{{ $info->level->name }}</td>
                                        <td>
                                            <ul>
                                                @foreach ($info->requirements as $req)
                                                <li>{{ $req }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            <ol>
                                                @foreach ($info->stages as $stage)
                                                <li>{{ $stage }}</li>
                                                @endforeach
                                            </ol>
                                        </td>
                                        <td>
                                            <ul>
                                                @foreach ($info->fees as $fee)
                                                <li>{{ $fee }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            <a href="{{ route('dashboard.requirement_information.edit', $info->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('dashboard.requirement_information.destroy', $info->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add new field
        document.querySelectorAll('.add-field').forEach(button => {
            button.addEventListener('click', function() {
                const target = this.getAttribute('data-target');
                const container = document.getElementById(`${target}-container`);
                const newField = document.createElement('div');
                newField.classList.add('input-group', 'mb-2');
                newField.innerHTML = `
                    <input type="text" name="${target}[]" class="form-control" required>
                    <div class="input-group-append">
                        <button type="button" class="btn btn-danger remove-field">Hapus</button>
                    </div>
                `;
                container.appendChild(newField);
            });
        });

        // Remove field
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-field')) {
                const container = e.target.closest('.input-group').parentElement;
                if (container.children.length > 1) {
                    e.target.closest('.input-group').remove();
                }
            }
        });
    });
</script>
@endsection
