@extends('layouts.dashboard.app')

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Daftar Pendaftar</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">SCIS</li>
                            <li class="breadcrumb-item">PPDB</li>
                            <li class="breadcrumb-item active">Daftar Pendaftar</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30 shadow-sm" style="border-radius: 10px;">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Daftar Pendaftar</h4>
                            <p class="sub-title">Berikut adalah daftar pendaftar PPDB.</p>

                            @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                            @endif

                            <!-- Filter and Export Section -->
                            <div class="row mb-3 align-items-end">
                                <div class="col-md-4">
                                    <label for="jenjangFilter">Filter Jenjang:</label>
                                    <select id="jenjangFilter" class="form-control">
                                        <option value="">Semua Jenjang</option>
                                        <option value="tk">TK</option>
                                        <option value="sd">SD</option>
                                        <option value="smp">SMP</option>
                                        <option value="sma">SMA</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="statusFilter">Filter Status:</label>
                                    <select id="statusFilter" class="form-control">
                                        <option value="">Semua Status</option>
                                        <option value="waiting">Waiting</option>
                                        <option value="decline">Decline</option>
                                        <option value="approve">Approve</option>
                                    </select>
                                </div>
                                <div class="col-md-2 d-flex align-items-end">
                                    <button id="resetFilter" class="btn btn-secondary w-100">Reset Filter</button>
                                </div>
                                <div class="col-md-2 d-flex align-items-end">
                                    <div class="dropdown w-100">
                                        <button class="btn btn-primary dropdown-toggle w-100" type="button" id="exportDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-download mr-1"></i> Export Data
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="exportDropdown">
                                            <a class="dropdown-item" href="{{ route('dashboard.export', 'pdf') }}">PDF</a>
                                            <a class="dropdown-item" href="{{ route('dashboard.export', 'excel') }}">Excel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- DataTable -->
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="width:100%">
                                <thead class="thead-light">
                                    <tr>
                                        <th><i class="fas fa-hashtag mr-1"></i> No</th>
                                        <th><i class="fas fa-users mr-1"></i> No Peserta</th>
                                        <th><i class="fas fa-graduation-cap mr-1"></i> Jenjang</th>
                                        <th><i class="fas fa-user mr-1"></i> Nama Anak</th>
                                        <th><i class="fas fa-phone mr-1"></i> No HP</th>
                                        <th><i class="fas fa-clock mr-1"></i> Jadwal Tes</th>
                                        <th><i class="fas fa-map-marker-alt mr-1"></i> Lokasi Tes</th>
                                        <th><i class="fas fa-info-circle mr-1"></i> Status</th>
                                        <th><i class="fas fa-cog mr-1"></i> Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($registrations as $index => $registration)
                                    <tr class="table-row-hover">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $registration->no_peserta ?? 'Tidak Ditetapkan' }}</td>
                                        <td>{{ $registration->user->level ? strtoupper($registration->user->level->slug) : 'Tidak Ditetapkan' }}</td>
                                        <td>{{ $registration->user->name }}</td>
                                        <td>{{ $registration->user->no_hp ?? 'Tidak Ditetapkan' }}</td>
                                        <td>{{ $registration->jadwal_tes ? \Carbon\Carbon::parse($registration->jadwal_tes)->format('d F Y H:i') : 'Belum Ditentukan' }}</td>
                                        <td>{{ $registration->schoolLocation ? $registration->schoolLocation->nama_lokasi : 'Belum Ditentukan' }}</td>
                                        <td>
                                            @if ($registration->status == 'waiting')
                                            <span class="badge badge-warning" style="font-size: 15px"><i class="fas fa-hourglass-start mr-1"></i> Waiting</span>
                                            @elseif ($registration->status == 'decline')
                                            <span class="badge badge-danger" style="font-size: 15px"><i class="fas fa-times mr-1"></i> Decline</span>
                                            @elseif ($registration->status == 'approve')
                                            <span class="badge badge-success" style="font-size: 15px"><i class="fas fa-check mr-1"></i> Approve</span>
                                            @elseif ($registration->status == 'accepted')
                                            <span class="badge badge-success" style="font-size: 15px"><i class="fas fa-check-circle mr-1"></i> Diterima</span>
                                            @elseif ($registration->status == 'not_accepted')
                                            <span class="badge badge-danger" style="font-size: 15px"><i class="fas fa-times-circle mr-1"></i> Tidak Diterima</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('dashboard.show_pendaftar', $registration->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye mr-1"></i> Detail</a>
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

    .badge {
        font-size: 14px;
        padding: 6px 10px;
    }

    .thead-light th {
        background-color: #e9ecef;
        font-weight: 600;
    }

    .card {
        border: none;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    #resetFilter,
    .btn-primary {
        transition: background-color 0.2s;
    }

    #resetFilter:hover {
        background-color: #6c757d;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .dropdown-menu {
        min-width: 100%;
    }
</style>
@endsection

@section('scripts')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        var table = $('#datatable').DataTable({
            "responsive": true,
            "autoWidth": false,
            "columnDefs": [{
                "orderable": false,
                "targets": 8
            }]
        });

        $('#jenjangFilter').on('change', function() {
            var jenjangValue = $(this).val().toLowerCase();
            table.column(1).search(jenjangValue).draw();
        });

        $('#statusFilter').on('change', function() {
            var statusValue = $(this).val();
            table.column(7).search(statusValue).draw();
        });

        $('#resetFilter').on('click', function() {
            $('#jenjangFilter').val('');
            $('#statusFilter').val('');
            table.search('').columns().search('').draw();
        });
    });
</script>
@endsection
