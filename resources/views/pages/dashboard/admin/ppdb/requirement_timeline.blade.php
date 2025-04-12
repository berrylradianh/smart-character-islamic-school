@extends('layouts.dashboard.app')

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Kelola Timeline Pendaftaran</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">SCIS</li>
                            <li class="breadcrumb-item">PPDB</li>
                            <li class="breadcrumb-item active">Kelola Timeline</li>
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

            <!-- Form for Adding Timelines -->
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Tambah Timeline</h4>
                            <form action="{{ route('admin.requirement_timeline.store') }}" method="POST">
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
                                        <small class="text-muted">Semua jenjang sudah memiliki timeline. Tambah di daftar atau edit/hapus timeline yang ada.</small>
                                    @endif
                                </div>

                                <!-- Timeline Entries -->
                                <div id="timelines-container">
                                    <div class="timeline-entry mb-3">
                                        <div class="form-group">
                                            <label>Tanggal</label>
                                            <input type="text" name="timelines[0][date_range]" class="form-control" required placeholder="e.g., 1 - 15 Mei 2025">
                                        </div>
                                        <div class="form-group">
                                            <label>Judul</label>
                                            <input type="text" name="timelines[0][title]" class="form-control" required placeholder="e.g., Pendaftaran Online TK">
                                        </div>
                                        <div class="form-group">
                                            <label>Deskripsi</label>
                                            <textarea name="timelines[0][description]" class="form-control" required placeholder="e.g., Orang tua mendaftarkan anak..."></textarea>
                                        </div>
                                        <button type="button" class="btn btn-danger remove-timeline">Hapus</button>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-secondary add-timeline">Tambah Timeline</button>
                                <hr>
                                <button type="submit" class="btn btn-primary" {{ $availableLevels->isEmpty() ? 'disabled' : '' }}>Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- List of Existing Timelines -->
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Daftar Timeline Pendaftaran</h4>
                            @foreach ($levels as $level)
                                @if (isset($timelines[$level->id]))
                                    <h5>{{ $level->name }}</h5>
                                    <table class="table table-bordered mb-4">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Judul</th>
                                                <th>Deskripsi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($timelines[$level->id] as $timeline)
                                                <tr>
                                                    <td>{{ $timeline->date_range }}</td>
                                                    <td>{{ $timeline->title }}</td>
                                                    <td>{{ $timeline->description }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.requirement_timeline.edit', $timeline->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                                        <form action="{{ route('admin.requirement_timeline.destroy', $timeline->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus timeline ini?');" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <!-- Form to Add New Timeline for This Jenjang -->
                                    <div class="mb-4">
                                        <h6>Tambah Timeline Baru untuk {{ $level->name }}</h6>
                                        <form action="{{ route('admin.requirement_timeline.add') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="level_id" value="{{ $level->id }}">
                                            <div class="form-group">
                                                <label>Tanggal</label>
                                                <input type="text" name="date_range" class="form-control" required placeholder="e.g., 1 - 15 Mei 2025">
                                            </div>
                                            <div class="form-group">
                                                <label>Judul</label>
                                                <input type="text" name="title" class="form-control" required placeholder="e.g., Pendaftaran Online TK">
                                            </div>
                                            <div class="form-group">
                                                <label>Deskripsi</label>
                                                <textarea name="description" class="form-control" required placeholder="e.g., Orang tua mendaftarkan anak..."></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-sm">Tambah</button>
                                        </form>
                                    </div>
                                @endif
                            @endforeach
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
        let timelineCount = 1;

        // Add new timeline entry in the top form
        document.querySelector('.add-timeline').addEventListener('click', function() {
            const container = document.getElementById('timelines-container');
            const newEntry = document.createElement('div');
            newEntry.classList.add('timeline-entry', 'mb-3');
            newEntry.innerHTML = `
                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="text" name="timelines[${timelineCount}][date_range]" class="form-control" required placeholder="e.g., 1 - 15 Mei 2025">
                </div>
                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" name="timelines[${timelineCount}][title]" class="form-control" required placeholder="e.g., Pendaftaran Online TK">
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="timelines[${timelineCount}][description]" class="form-control" required placeholder="e.g., Orang tua mendaftarkan anak..."></textarea>
                </div>
                <button type="button" class="btn btn-danger remove-timeline">Hapus</button>
            `;
            container.appendChild(newEntry);
            timelineCount++;
        });

        // Remove timeline entry from the top form
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-timeline')) {
                const container = document.getElementById('timelines-container');
                if (container.children.length > 1) {
                    e.target.closest('.timeline-entry').remove();
                }
            }
        });
    });
</script>
@endsection
