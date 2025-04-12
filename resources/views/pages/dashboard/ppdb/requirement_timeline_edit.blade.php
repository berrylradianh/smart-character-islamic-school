@extends('layouts.dashboard.app')

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Edit Timeline Pendaftaran</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">SCIS</li>
                            <li class="breadcrumb-item">PPDB</li>
                            <li class="breadcrumb-item active">Edit Timeline</li>
                        </ol>
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Form for Editing -->
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Edit Timeline untuk {{ $timeline->level->name }}</h4>
                            <form action="{{ route('dashboard.requirement_timeline.update', $timeline->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="text" name="date_range" class="form-control" value="{{ $timeline->date_range }}" required placeholder="e.g., 1 - 15 Mei 2025">
                                </div>
                                <div class="form-group">
                                    <label>Judul</label>
                                    <input type="text" name="title" class="form-control" value="{{ $timeline->title }}" required placeholder="e.g., Pendaftaran Online TK">
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea name="description" class="form-control" required placeholder="e.g., Orang tua mendaftarkan anak...">{{ $timeline->description }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Perbarui</button>
                                <a href="{{ route('dashboard.requirement_timeline') }}" class="btn btn-secondary">Kembali</a>
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
