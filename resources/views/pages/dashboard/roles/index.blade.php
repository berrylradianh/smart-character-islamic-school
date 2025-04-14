@extends('layouts.dashboard.app')

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Daftar Role</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">SCIS</li>
                            <li class="breadcrumb-item active">Daftar Role</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30 shadow-sm" style="border-radius: 10px;">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Daftar Role</h4>
                            <p class="sub-title">Berikut adalah daftar semua role dalam sistem.</p>

                            @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                            @endif

                            @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                            @endif

                            <!-- Create Role Button -->
                            <div class="mb-3">
                                <a href="{{ route('dashboard.roles.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus mr-1"></i> Tambah Role
                                </a>
                            </div>

                            <!-- DataTable -->
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="width:100%">
                                <thead class="thead-light">
                                    <tr>
                                        <th><i class="fas fa-hashtag mr-1"></i> No</th>
                                        <th><i class="fas fa-user-shield mr-1"></i> Nama Role</th>
                                        <th><i class="fas fa-info-circle mr-1"></i> Deskripsi</th>
                                        <th><i class="fas fa-users mr-1"></i> Jumlah Pengguna</th>
                                        <th><i class="fas fa-clock mr-1"></i> Dibuat Pada</th>
                                        <th><i class="fas fa-cog mr-1"></i> Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $index => $role)
                                    <tr class="table-row-hover">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>{{ $role->description ?? '-' }}</td>
                                        <td>{{ $role->users()->count() }}</td>
                                        <td>{{ \Carbon\Carbon::parse($role->created_at)->format('d F Y H:i') }}</td>
                                        <td>
                                            <a href="{{ route('dashboard.roles.show', $role->id) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye mr-1"></i> Detail
                                            </a>
                                            <a href="{{ route('dashboard.roles.edit', $role->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit mr-1"></i> Edit
                                            </a>
                                            <form action="{{ route('dashboard.roles.destroy', $role->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus role ini? Pengguna dengan role ini akan memiliki role null.')">
                                                    <i class="fas fa-trash mr-1"></i> Hapus
                                                </button>
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
@endsection

@section('styles')
<style>
    .table-row-hover:hover {
        background-color: #f1f3f5;
        transition: background-color 0.2s;
    }

    .thead-light th {
        background-color: #e9ecef;
        font-weight: 600;
    }

    .card {
        border: none;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .btn-primary,
    .btn-info,
    .btn-warning,
    .btn-danger {
        transition: background-color 0.2s;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-info:hover {
        background-color: #138496;
    }

    .btn-warning:hover {
        background-color: #e0a800;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }
</style>
@endsection

@section('scripts')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            "responsive": true,
            "autoWidth": false,
            "columnDefs": [{
                "orderable": false,
                "targets": 5
            }]
        });
    });
</script>
@endsection
