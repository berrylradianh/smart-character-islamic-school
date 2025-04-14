@extends('layouts.dashboard.app')

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Edit Informasi Pendaftaran</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">SCIS</li>
                            <li class="breadcrumb-item">PPDB</li>
                            <li class="breadcrumb-item active">Edit Informasi</li>
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

            <!-- Form for Editing -->
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Edit Informasi untuk {{ $registrationInfo->level->name }}</h4>
                            <form action="{{ route('dashboard.requirement_information.update', $registrationInfo->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="level_id">Jenjang</label>
                                    <select name="level_id" id="level_id" class="form-control" required>
                                        <option value="">Pilih Jenjang</option>
                                        @foreach ($availableLevels as $level)
                                            <option value="{{ $level->id }}" {{ $registrationInfo->level_id == $level->id ? 'selected' : '' }}>{{ $level->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Requirements -->
                                <div class="form-group">
                                    <label>Persyaratan</label>
                                    <div id="requirements-container">
                                        @foreach ($registrationInfo->requirements as $req)
                                            <div class="input-group mb-2">
                                                <input type="text" name="requirements[]" class="form-control" value="{{ $req }}" required>
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-danger remove-field">Hapus</button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="button" class="btn btn-secondary add-field" data-target="requirements">Tambah Persyaratan</button>
                                </div>

                                <!-- Stages -->
                                <div class="form-group">
                                    <label>Tahapan Pendaftaran</label>
                                    <div id="stages-container">
                                        @foreach ($registrationInfo->stages as $stage)
                                            <div class="input-group mb-2">
                                                <input type="text" name="stages[]" class="form-control" value="{{ $stage }}" required>
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-danger remove-field">Hapus</button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="button" class="btn btn-secondary add-field" data-target="stages">Tambah Tahapan</button>
                                </div>

                                <!-- Fees -->
                                <div class="form-group">
                                    <label>Biaya</label>
                                    <div id="fees-container">
                                        @foreach ($registrationInfo->fees as $fee)
                                            <div class="input-group mb-2">
                                                <input type="text" name="fees[]" class="form-control" value="{{ $fee }}" required>
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-danger remove-field">Hapus</button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="button" class="btn btn-secondary add-field" data-target="fees">Tambah Biaya</button>
                                </div>

                                <button type="submit" class="btn btn-primary">Perbarui</button>
                                <a href="{{ route('dashboard.requirement_information') }}" class="btn btn-secondary">Kembali</a>
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
