@extends('layouts.dashboard.app')

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Detail Pendaftar</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">SCIS</li>
                            <li class="breadcrumb-item">PPDB</li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.list_pendaftar') }}">Daftar Pendaftar</a></li>
                            <li class="breadcrumb-item active">Detail</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Detail Pendaftar</h4>

                            <!-- Tab Navigation -->
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="true">Informasi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="documents-tab" data-toggle="tab" href="#documents" role="tab" aria-controls="documents" aria-selected="false">Dokumen</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="status-tab" data-toggle="tab" href="#status" role="tab" aria-controls="status" aria-selected="false">Status</a>
                                </li>
                            </ul>

                            <!-- Tab Content -->
                            <div class="tab-content" id="myTabContent">
                                <!-- Tab Informasi -->
                                <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <div class="card shadow-sm" style="border-radius: 10px;">
                                                <div class="card-header bg-primary text-white" style="border-top-left-radius: 10px; border-top-right-radius: 10px;">
                                                    <h5 class="mb-0">Biodata Pendaftar</h5>
                                                </div>
                                                <div class="card-body p-4">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="info-item d-flex align-items-center mb-3 p-3 bg-light rounded">
                                                                <i class="fas fa-graduation-cap fa-2x mr-3 text-primary"></i>
                                                                <div>
                                                                    <strong>Jenjang:</strong>
                                                                    <span>{{ strtoupper($registration->jenjang) }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="info-item d-flex align-items-center mb-3 p-3 bg-light rounded">
                                                                <i class="fas fa-user fa-2x mr-3 text-primary"></i>
                                                                <div>
                                                                    <strong>Nama Anak:</strong>
                                                                    <span>{{ $registration->nama_anak }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="info-item d-flex align-items-center mb-3 p-3 bg-light rounded">
                                                                <i class="fas fa-users fa-2x mr-3 text-primary"></i>
                                                                <div>
                                                                    <strong>Nama Orang Tua:</strong>
                                                                    <span>{{ $registration->nama_orang_tua }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="info-item d-flex align-items-center mb-3 p-3 bg-light rounded">
                                                                <i class="fas fa-phone fa-2x mr-3 text-primary"></i>
                                                                <div>
                                                                    <strong>No HP Orang Tua:</strong>
                                                                    <span>{{ $registration->no_hp_orang_tua }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="info-item d-flex align-items-center mb-3 p-3 bg-light rounded">
                                                                <i class="fas fa-calendar-alt fa-2x mr-3 text-primary"></i>
                                                                <div>
                                                                    <strong>Tanggal Lahir:</strong>
                                                                    <span>{{ $registration->tanggal_lahir ? \Carbon\Carbon::parse($registration->tanggal_lahir)->format('d F Y') : '-' }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="info-item d-flex align-items-center mb-3 p-3 bg-light rounded">
                                                                <i class="fas fa-clock fa-2x mr-3 text-primary"></i>
                                                                <div>
                                                                    <strong>Jadwal Tes:</strong>
                                                                    <span>{{ $registration->jadwal_tes ? \Carbon\Carbon::parse($registration->jadwal_tes)->format('d F Y H:i') : 'Belum Ditentukan' }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="info-item d-flex align-items-center mb-3 p-3 bg-light rounded">
                                                                <i class="fas fa-map-marker-alt fa-2x mr-3 text-primary"></i>
                                                                <div>
                                                                    <strong>Lokasi Tes:</strong>
                                                                    <span>{{ $registration->schoolLocation ? $registration->schoolLocation->nama_lokasi . ' - ' . $registration->schoolLocation->alamat : 'Belum Ditentukan' }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tab Dokumen -->
                                <div class="tab-pane fade" id="documents" role="tabpanel" aria-labelledby="documents-tab">
                                    <div class="row mt-3">
                                        <!-- Kartu Keluarga -->
                                        <div class="col-md-4 document-item mb-3">
                                            <div class="card h-100 shadow-sm">
                                                <div class="card-body text-center">
                                                    <strong>Kartu Keluarga</strong>
                                                    <div class="mt-2 document-preview">
                                                        @if (pathinfo($registration->kk_path, PATHINFO_EXTENSION) == 'pdf')
                                                        <i class="fas fa-file-pdf fa-3x text-danger"></i>
                                                        @else
                                                        <img src="{{ asset('storage/' . $registration->kk_path) }}" alt="Kartu Keluarga" class="img-fluid" style="max-width: 300px; max-height: 300px;">
                                                        @endif
                                                    </div>
                                                    <div class="mt-3">
                                                        <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#previewModal" data-src="{{ asset('storage/' . $registration->kk_path) }}" data-type="{{ pathinfo($registration->kk_path, PATHINFO_EXTENSION) == 'pdf' ? 'pdf' : 'image' }}">Preview</button>
                                                        <a href="{{ asset('storage/' . $registration->kk_path) }}" download class="btn btn-sm btn-primary">Download</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Akta Kelahiran -->
                                        <div class="col-md-4 document-item mb-3">
                                            <div class="card h-100 shadow-sm">
                                                <div class="card-body text-center">
                                                    <strong>Akta Kelahiran</strong>
                                                    <div class="mt-2 document-preview">
                                                        @if (pathinfo($registration->akta_path, PATHINFO_EXTENSION) == 'pdf')
                                                        <i class="fas fa-file-pdf fa-3x text-danger"></i>
                                                        @else
                                                        <img src="{{ asset('storage/' . $registration->akta_path) }}" alt="Akta Kelahiran" class="img-fluid" style="max-width: 300px; max-height: 300px;">
                                                        @endif
                                                    </div>
                                                    <div class="mt-3">
                                                        <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#previewModal" data-src="{{ asset('storage/' . $registration->akta_path) }}" data-type="{{ pathinfo($registration->akta_path, PATHINFO_EXTENSION) == 'pdf' ? 'pdf' : 'image' }}">Preview</button>
                                                        <a href="{{ asset('storage/' . $registration->akta_path) }}" download class="btn btn-sm btn-primary">Download</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Pas Foto -->
                                        <div class="col-md-4 document-item mb-3">
                                            <div class="card h-100 shadow-sm">
                                                <div class="card-body text-center">
                                                    <strong>Pas Foto</strong>
                                                    <div class="mt-2 document-preview">
                                                        <img src="{{ asset('storage/' . $registration->pasfoto_path) }}" alt="Pas Foto" class="img-fluid" style="max-width: 300px; max-height: 300px;">
                                                    </div>
                                                    <div class="mt-3">
                                                        <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#previewModal" data-src="{{ asset('storage/' . $registration->pasfoto_path) }}" data-type="image">Preview</button>
                                                        <a href="{{ asset('storage/' . $registration->pasfoto_path) }}" download class="btn btn-sm btn-primary">Download</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Piagam (Opsional) -->
                                        @if ($registration->piagam_path)
                                        <div class="col-md-4 document-item mb-3">
                                            <div class="card h-100 shadow-sm">
                                                <div class="card-body text-center">
                                                    <strong>Piagam</strong>
                                                    <div class="mt-2 document-preview">
                                                        @if (pathinfo($registration->piagam_path, PATHINFO_EXTENSION) == 'pdf')
                                                        <i class="fas fa-file-pdf fa-3x text-danger"></i>
                                                        @else
                                                        <img src="{{ asset('storage/' . $registration->piagam_path) }}" alt="Piagam" class="img-fluid" style="max-width: 300px; max-height: 300px;">
                                                        @endif
                                                    </div>
                                                    <div class="mt-3">
                                                        <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#previewModal" data-src="{{ asset('storage/' . $registration->piagam_path) }}" data-type="{{ pathinfo($registration->piagam_path, PATHINFO_EXTENSION) == 'pdf' ? 'pdf' : 'image' }}">Preview</button>
                                                        <a href="{{ asset('storage/' . $registration->piagam_path) }}" download class="btn btn-sm btn-primary">Download</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                        <!-- Ijazah (Opsional) -->
                                        @if ($registration->ijazah_path)
                                        <div class="col-md-4 document-item mb-3">
                                            <div class="card h-100 shadow-sm">
                                                <div class="card-body text-center">
                                                    <strong>Ijazah</strong>
                                                    <div class="mt-2 document-preview">
                                                        @if (pathinfo($registration->ijazah_path, PATHINFO_EXTENSION) == 'pdf')
                                                        <i class="fas fa-file-pdf fa-3x text-danger"></i>
                                                        @else
                                                        <img src="{{ asset('storage/' . $registration->ijazah_path) }}" alt="Ijazah" class="img-fluid" style="max-width: 300px; max-height: 300px;">
                                                        @endif
                                                    </div>
                                                    <div class="mt-3">
                                                        <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#previewModal" data-src="{{ asset('storage/' . $registration->ijazah_path) }}" data-type="{{ pathinfo($registration->ijazah_path, PATHINFO_EXTENSION) == 'pdf' ? 'pdf' : 'image' }}">Preview</button>
                                                        <a href="{{ asset('storage/' . $registration->ijazah_path) }}" download class="btn btn-sm btn-primary">Download</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                        <!-- Bukti Pembayaran -->
                                        <div class="col-md-4 document-item mb-3">
                                            <div class="card h-100 shadow-sm">
                                                <div class="card-body text-center">
                                                    <strong>Bukti Pembayaran</strong>
                                                    <div class="mt-2 document-preview">
                                                        @if (pathinfo($registration->bukti_pembayaran_path, PATHINFO_EXTENSION) == 'pdf')
                                                        <i class="fas fa-file-pdf fa-3x text-danger"></i>
                                                        @else
                                                        <img src="{{ asset('storage/' . $registration->bukti_pembayaran_path) }}" alt="Bukti Pembayaran" class="img-fluid" style="max-width: 300px; max-height: 300px;">
                                                        @endif
                                                    </div>
                                                    <div class="mt-3">
                                                        <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#previewModal" data-src="{{ asset('storage/' . $registration->bukti_pembayaran_path) }}" data-type="{{ pathinfo($registration->bukti_pembayaran_path, PATHINFO_EXTENSION) == 'pdf' ? 'pdf' : 'image' }}">Preview</button>
                                                        <a href="{{ asset('storage/' . $registration->bukti_pembayaran_path) }}" download class="btn btn-sm btn-primary">Download</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tab Status -->
                                <!-- Tab Status -->
                                <div class="tab-pane fade" id="status" role="tabpanel" aria-labelledby="status-tab">
                                    <div class="mt-3">
                                        @if ($registration->status == 'waiting')
                                        <!-- Form Edit jika Status "Waiting" -->
                                        <form action="{{ route('admin.update_status', $registration->id) }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label>Status Pendaftaran</label>
                                                <select class="form-control" name="status" id="statusSelect" required>
                                                    <option value="waiting" {{ $registration->status == 'waiting' ? 'selected' : '' }}>Waiting</option>
                                                    <option value="decline" {{ $registration->status == 'decline' ? 'selected' : '' }}>Decline</option>
                                                    <option value="approve" {{ $registration->status == 'approve' ? 'selected' : '' }}>Approve</option>
                                                </select>
                                            </div>

                                            <div id="testDetails" @if($registration->status == 'approve') style="display: block;" @else style="display: none;" @endif>
                                                <div class="row">
                                                    <div class="col-md-6 form-group">
                                                        <label>Jadwal Tes</label>
                                                        <input type="datetime-local" class="form-control" name="jadwal_tes" value="{{ $registration->jadwal_tes ? \Carbon\Carbon::parse($registration->jadwal_tes)->format('Y-m-d\TH:i') : '' }}" {{ $registration->status == 'approve' ? 'required' : '' }}>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label>Lokasi Tes</label>
                                                        <select class="form-control" name="school_location_id" {{ $registration->status == 'approve' ? 'required' : '' }}>
                                                            <option value="">-- Pilih Lokasi --</option>
                                                            @foreach ($locations as $location)
                                                            <option value="{{ $location->id }}" {{ $registration->school_location_id == $location->id ? 'selected' : '' }}>{{ $location->nama_lokasi }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group mt-3">
                                                <button type="submit" class="btn btn-primary">Simpan Status</button>
                                                <a href="{{ route('admin.list_pendaftar') }}" class="btn btn-secondary">Kembali</a>
                                            </div>
                                        </form>
                                        @else
                                        <!-- Tampilan Read-Only jika Status Sudah Diupdate -->
                                        <div class="card shadow-sm" style="border-radius: 10px;">
                                            <div class="card-body p-4">
                                                <div class="info-item d-flex align-items-center mb-3 p-3 bg-light rounded">
                                                    <i class="fas fa-info-circle fa-2x mr-3 text-primary"></i>
                                                    <div>
                                                        <strong>Status Pendaftaran:</strong>
                                                        <span>
                                                            @if ($registration->status == 'approve')
                                                            <span class="badge badge-success" style="font-size: 12px"><i class="fas fa-check mr-1"></i> Approve</span>
                                                            @elseif ($registration->status == 'decline')
                                                            <span class="badge badge-danger" style="font-size: 12px"><i class="fas fa-times mr-1"></i> Decline</span>
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                                @if ($registration->status == 'approve')
                                                <div class="info-item d-flex align-items-center mb-3 p-3 bg-light rounded">
                                                    <i class="fas fa-clock fa-2x mr-3 text-primary"></i>
                                                    <div>
                                                        <strong>Jadwal Tes:</strong>
                                                        <span>{{ $registration->jadwal_tes ? \Carbon\Carbon::parse($registration->jadwal_tes)->format('d F Y H:i') : 'Belum Ditentukan' }}</span>
                                                    </div>
                                                </div>
                                                <div class="info-item d-flex align-items-center mb-3 p-3 bg-light rounded">
                                                    <i class="fas fa-map-marker-alt fa-2x mr-3 text-primary"></i>
                                                    <div>
                                                        <strong>Lokasi Tes:</strong>
                                                        <span>{{ $registration->schoolLocation ? $registration->schoolLocation->nama_lokasi . ' - ' . $registration->schoolLocation->alamat : 'Belum Ditentukan' }}</span>
                                                    </div>
                                                </div>
                                                <!-- Bagian Dokumen Wajib Dibawa -->
                                                <div class="card shadow-sm mt-4" style="border-radius: 10px;">
                                                    <div class="card-header bg-primary text-white" style="border-top-left-radius: 10px; border-top-right-radius: 10px;">
                                                        <h6 class="mb-0"><i class="fas fa-file-alt mr-2"></i>Dokumen Wajib Dibawa Saat Tes</h6>
                                                    </div>
                                                    <div class="card-body p-3">
                                                        <ol class="document-list pl-3">
                                                            <li class="document-item d-flex align-items-center py-2">
                                                                <i class="fas fa-check-circle mr-2 text-success"></i>
                                                                Kartu Keluarga (Asli dan Fotokopi)
                                                            </li>
                                                            <li class="document-item d-flex align-items-center py-2">
                                                                <i class="fas fa-check-circle mr-2 text-success"></i>
                                                                Akta Kelahiran (Asli dan Fotokopi)
                                                            </li>
                                                            <li class="document-item d-flex align-items-center py-2">
                                                                <i class="fas fa-check-circle mr-2 text-success"></i>
                                                                Pas Foto 3x4 (2 lembar)
                                                            </li>
                                                            <li class="document-item d-flex align-items-center py-2">
                                                                <i class="fas fa-check-circle mr-2 text-success"></i>
                                                                Bukti Pembayaran (Asli)
                                                            </li>
                                                            @if ($registration->ijazah_path)
                                                            <li class="document-item d-flex align-items-center py-2">
                                                                <i class="fas fa-check-circle mr-2 text-success"></i>
                                                                Ijazah (Asli dan Fotokopi)
                                                            </li>
                                                            @endif
                                                        </ol>
                                                    </div>
                                                </div>
                                                @endif
                                                <div class="mt-3">
                                                    <a href="{{ route('admin.list_pendaftar') }}" class="btn btn-secondary">Kembali</a>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk Preview Dokumen -->
    <div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="previewModalLabel">Preview Dokumen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="previewContent"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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
    .info-item {
        padding: 15px;
        margin-bottom: 10px;
        background-color: #f8f9fa;
        border-radius: 8px;
        display: flex;
        align-items: center;
        transition: background-color 0.2s;
    }

    .info-item:hover {
        background-color: #e9ecef;
    }

    .info-item i {
        width: 40px;
        font-size: 24px;
        color: #007bff;
    }

    .info-item strong {
        min-width: 150px;
        font-size: 16px;
        color: #343a40;
        font-weight: 600;
    }

    .info-item span {
        font-size: 16px;
        color: #495057;
    }

    .card-header {
        background-color: #007bff;
        color: white;
        font-weight: 500;
    }

    .card {
        border: none;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .nav-tabs .nav-link {
        border-radius: 0;
    }

    .nav-tabs .nav-link.active {
        background-color: #007bff;
        color: white;
    }

    .tab-content {
        padding: 20px;
        border: 1px solid #dee2e6;
        border-top: none;
    }

    .document-item .card {
        transition: transform 0.2s;
    }

    .document-item .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
    }

    .document-preview {
        min-height: 300px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .badge {
        font-size: 14px;
        padding: 6px 10px;
    }
</style>
@endsection

@section('scripts')
<script>
    $('#previewModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var src = button.data('src');
        var type = button.data('type');
        var modal = $(this);
        var content = modal.find('#previewContent');

        if (type === 'pdf') {
            content.html('<embed src="' + src + '" type="application/pdf" width="100%" height="500px" />');
        } else {
            content.html('<img src="' + src + '" class="img-fluid" alt="Preview Dokumen" />');
        }
    });

    $('#statusSelect').on('change', function() {
        var status = $(this).val();
        if (status === 'approve') {
            $('#testDetails').show();
            $('#testDetails input, #testDetails select').attr('required', 'required');
        } else {
            $('#testDetails').hide();
            $('#testDetails input, #testDetails select').removeAttr('required');
        }
    });
</script>
@endsection
