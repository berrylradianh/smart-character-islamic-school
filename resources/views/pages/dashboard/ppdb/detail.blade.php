@php
use Illuminate\Support\Facades\Storage;
@endphp

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
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.list_pendaftar') }}">Daftar Pendaftar</a></li>
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
                                                                    <span>{{ $registration->user->level ? strtoupper($registration->user->level->name) : 'Tidak Ditetapkan' }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="info-item d-flex align-items-center mb-3 p-3 bg-light rounded">
                                                                <i class="fas fa-user fa-2x mr-3 text-primary"></i>
                                                                <div>
                                                                    <strong>Nama Anak:</strong>
                                                                    <span>{{ $registration->user->name }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="info-item d-flex align-items-center mb-3 p-3 bg-light rounded">
                                                                <i class="fas fa-users fa-2x mr-3 text-primary"></i>
                                                                <div>
                                                                    <strong>Nama Orang Tua:</strong>
                                                                    <span>{{ $registration->user->nama_orang_tua ?? 'Tidak Ditetapkan' }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="info-item d-flex align-items-center mb-3 p-3 bg-light rounded">
                                                                <i class="fas fa-phone fa-2x mr-3 text-primary"></i>
                                                                <div>
                                                                    <strong>No HP Orang Tua:</strong>
                                                                    <span>{{ $registration->user->no_hp_orang_tua ?? 'Tidak Ditetapkan' }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="info-item d-flex align-items-center mb-3 p-3 bg-light rounded">
                                                                <i class="fas fa-calendar-alt fa-2x mr-3 text-primary"></i>
                                                                <div>
                                                                    <strong>Tanggal Lahir:</strong>
                                                                    <span>{{ $registration->user->tanggal_lahir ? \Carbon\Carbon::parse($registration->user->tanggal_lahir)->format('d/m/Y') : '-' }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="info-item d-flex align-items-center mb-3 p-3 bg-light rounded">
                                                                <i class="fas fa-clock fa-2x mr-3 text-primary"></i>
                                                                <div>
                                                                    <strong>Jadwal Tes:</strong>
                                                                    <span>{{ $registration->jadwal_tes ? \Carbon\Carbon::parse($registration->jadwal_tes)->format('d/m/Y H:i') : 'Belum Ditentukan' }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="info-item d-flex align-items-center mb-3 p-3 bg-light rounded">
                                                                <i class="fas fa-map-marker-alt fa-2x mr-3 text-primary"></i>
                                                                <div>
                                                                    <strong>Lokasi Tes:</strong>
                                                                    <span>{{ $registration->schoolLocation ? $registration->schoolLocation->nama_lokasi . ' - ' . $registration->schoolLocation->alamat : 'Belum Ditentukan' }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="info-item d-flex align-items-center mb-3 p-3 bg-light rounded">
                                                                <i class="fas fa-building fa-2x mr-3 text-primary"></i>
                                                                <div>
                                                                    <strong>Gedung:</strong>
                                                                    <span>{{ $registration->gedung ? $registration->gedung->nama_gedung : 'Belum Ditentukan' }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="info-item d-flex align-items-center mb-3 p-3 bg-light rounded">
                                                                <i class="fas fa-door-open fa-2x mr-3 text-primary"></i>
                                                                <div>
                                                                    <strong>Ruang:</strong>
                                                                    <span>{{ $registration->ruang ? $registration->ruang->nama_ruang : 'Belum Ditentukan' }}</span>
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
                                        @if ($registration->user->kk_path)
                                        <div class="col-md-4 document-item mb-3">
                                            <div class="card h-100 shadow-sm">
                                                <div class="card-body text-center">
                                                    <strong>Kartu Keluarga</strong>
                                                    <div class="mt-2 document-preview">
                                                        @if (pathinfo($registration->user->kk_path, PATHINFO_EXTENSION) == 'pdf')
                                                        <i class="fas fa-file-pdf fa-3x text-danger"></i>
                                                        @else
                                                        <img src="{{ asset('storage/' . $registration->user->kk_path) }}" alt="Kartu Keluarga" class="img-fluid" style="max-width: 300px; max-height: 300px;">
                                                        @endif
                                                    </div>
                                                    <div class="mt-3">
                                                        <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#previewModal" data-src="{{ asset('storage/' . $registration->user->kk_path) }}" data-type="{{ pathinfo($registration->user->kk_path, PATHINFO_EXTENSION) == 'pdf' ? 'pdf' : 'image' }}">Preview</button>
                                                        <a href="{{ asset('storage/' . $registration->user->kk_path) }}" download class="btn btn-sm btn-primary">Download</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                        <!-- Akta Kelahiran -->
                                        @if ($registration->user->akta_path)
                                        <div class="col-md-4 document-item mb-3">
                                            <div class="card h-100 shadow-sm">
                                                <div class="card-body text-center">
                                                    <strong>Akta Kelahiran</strong>
                                                    <div class="mt-2 document-preview">
                                                        @if (pathinfo($registration->user->akta_path, PATHINFO_EXTENSION) == 'pdf')
                                                        <i class="fas fa-file-pdf fa-3x text-danger"></i>
                                                        @else
                                                        <img src="{{ asset('storage/' . $registration->user->akta_path) }}" alt="Akta Kelahiran" class="img-fluid" style="max-width: 300px; max-height: 300px;">
                                                        @endif
                                                    </div>
                                                    <div class="mt-3">
                                                        <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#previewModal" data-src="{{ asset('storage/' . $registration->user->akta_path) }}" data-type="{{ pathinfo($registration->user->akta_path, PATHINFO_EXTENSION) == 'pdf' ? 'pdf' : 'image' }}">Preview</button>
                                                        <a href="{{ asset('storage/' . $registration->user->akta_path) }}" download class="btn btn-sm btn-primary">Download</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                        <!-- Pas Foto -->
                                        @if ($registration->user->pasfoto_path)
                                        <div class="col-md-4 document-item mb-3">
                                            <div class="card h-100 shadow-sm">
                                                <div class="card-body text-center">
                                                    <strong>Pas Foto</strong>
                                                    <div class="mt-2 document-preview">
                                                        <img src="{{ asset('storage/' . $registration->user->pasfoto_path) }}" alt="Pas Foto" class="img-fluid" style="max-width: 300px; max-height: 300px;">
                                                    </div>
                                                    <div class="mt-3">
                                                        <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#previewModal" data-src="{{ asset('storage/' . $registration->user->pasfoto_path) }}" data-type="image">Preview</button>
                                                        <a href="{{ asset('storage/' . $registration->user->pasfoto_path) }}" download class="btn btn-sm btn-primary">Download</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                        <!-- Piagam (Opsional) -->
                                        @if ($registration->user->piagam_path)
                                        <div class="col-md-4 document-item mb-3">
                                            <div class="card h-100 shadow-sm">
                                                <div class="card-body text-center">
                                                    <strong>Piagam</strong>
                                                    <div class="mt-2 document-preview">
                                                        @if (pathinfo($registration->user->piagam_path, PATHINFO_EXTENSION) == 'pdf')
                                                        <i class="fas fa-file-pdf fa-3x text-danger"></i>
                                                        @else
                                                        <img src="{{ asset('storage/' . $registration->user->piagam_path) }}" alt="Piagam" class="img-fluid" style="max-width: 300px; max-height: 300px;">
                                                        @endif
                                                    </div>
                                                    <div class="mt-3">
                                                        <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#previewModal" data-src="{{ asset('storage/' . $registration->user->piagam_path) }}" data-type="{{ pathinfo($registration->user->piagam_path, PATHINFO_EXTENSION) == 'pdf' ? 'pdf' : 'image' }}">Preview</button>
                                                        <a href="{{ asset('storage/' . $registration->user->piagam_path) }}" download class="btn btn-sm btn-primary">Download</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                        <!-- Ijazah (Berdasarkan Jenjang) -->
                                        @if ($registration->user->level && in_array($registration->user->level->slug, ['smp', 'sma']))
                                        @if ($registration->user->level->slug == 'smp' && $registration->user->ijazah_sd_path)
                                        <div class="col-md-4 document-item mb-3">
                                            <div class="card h-100 shadow-sm">
                                                <div class="card-body text-center">
                                                    <strong>Ijazah SD</strong>
                                                    <div class="mt-2 document-preview">
                                                        @if (pathinfo($registration->user->ijazah_sd_path, PATHINFO_EXTENSION) == 'pdf')
                                                        <i class="fas fa-file-pdf fa-3x text-danger"></i>
                                                        @else
                                                        <img src="{{ asset('storage/' . $registration->user->ijazah_sd_path) }}" alt="Ijazah SD" class="img-fluid" style="max-width: 300px; max-height: 300px;">
                                                        @endif
                                                    </div>
                                                    <div class="mt-3">
                                                        <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#previewModal" data-src="{{ asset('storage/' . $registration->user->ijazah_sd_path) }}" data-type="{{ pathinfo($registration->user->ijazah_sd_path, PATHINFO_EXTENSION) == 'pdf' ? 'pdf' : 'image' }}">Preview</button>
                                                        <a href="{{ asset('storage/' . $registration->user->ijazah_sd_path) }}" download class="btn btn-sm btn-primary">Download</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @elseif ($registration->user->level->slug == 'sma' && $registration->user->ijazah_smp_path)
                                        <div class="col-md-4 document-item mb-3">
                                            <div class="card h-100 shadow-sm">
                                                <div class="card-body text-center">
                                                    <strong>Ijazah SMP</strong>
                                                    <div class="mt-2 document-preview">
                                                        @if (pathinfo($registration->user->ijazah_smp_path, PATHINFO_EXTENSION) == 'pdf')
                                                        <i class="fas fa-file-pdf fa-3x text-danger"></i>
                                                        @else
                                                        <img src="{{ asset('storage/' . $registration->user->ijazah_smp_path) }}" alt="Ijazah SMP" class="img-fluid" style="max-width: 300px; max-height: 300px;">
                                                        @endif
                                                    </div>
                                                    <div class="mt-3">
                                                        <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#previewModal" data-src="{{ asset('storage/' . $registration->user->ijazah_smp_path) }}" data-type="{{ pathinfo($registration->user->ijazah_smp_path, PATHINFO_EXTENSION) == 'pdf' ? 'pdf' : 'image' }}">Preview</button>
                                                        <a href="{{ asset('storage/' . $registration->user->ijazah_smp_path) }}" download class="btn btn-sm btn-primary">Download</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
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
                                <div class="tab-pane fade" id="status" role="tabpanel" aria-labelledby="status-tab">
                                    <div class="mt-3">
                                        @if ($registration->status == 'waiting')
                                        <!-- Form Edit jika Status "Waiting" -->
                                        <form action="{{ route('dashboard.update_status', $registration->id) }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label>Status Pendaftaran</label>
                                                <select class="form-control" name="status" id="statusSelect" required>
                                                    <option value="waiting" {{ $registration->status == 'waiting' ? 'selected' : '' }}>Waiting</option>
                                                    <option value="decline" {{ $registration->status == 'decline' ? 'selected' : '' }}>Decline</option>
                                                    <option value="approve" {{ $registration->status == 'approve' ? 'selected' : '' }}>Approve</option>
                                                </select>
                                            </div>

                                            <div class="form-group" id="declineReason" @if($registration->status != 'decline') style="display: none;" @endif>
                                                <label for="decline_reason">Alasan Penolakan</label>
                                                <textarea class="form-control" name="decline_reason" id="decline_reason" rows="4" {{ $registration->status == 'decline' ? 'required' : '' }}>{{ old('decline_reason', $registration->decline_reason) }}</textarea>
                                                <small class="form-text text-muted">Masukkan alasan mengapa pendaftaran ditolak.</small>
                                            </div>

                                            <div id="testDetails" @if($registration->status == 'approve') style="display: block;" @else style="display: none;" @endif>
                                                <div class="row">
                                                    <div class="col-md-6 form-group">
                                                        <label>Jadwal Tes</label>
                                                        <div style="position: relative;">
                                                            <input type="text" id="jadwal_tes_display" class="form-control" value="{{ old('jadwal_tes', $registration->jadwal_tes ? \Carbon\Carbon::parse($registration->jadwal_tes)->format('d/m/Y H:i') : '') }}" placeholder="dd/mm/yyyy HH:mm" {{ $registration->status == 'approve' ? 'required' : '' }}>
                                                            <input type="datetime-local" name="jadwal_tes" id="jadwal_tes" class="form-control" value="{{ old('jadwal_tes', $registration->jadwal_tes ? \Carbon\Carbon::parse($registration->jadwal_tes)->format('Y-m-d\TH:i') : '') }}" style="position: absolute; opacity: 0; width: 100%; z-index: -1;" {{ $registration->status == 'approve' ? 'required' : '' }}>
                                                        </div>
                                                        <small class="form-text text-muted">Format: DD/MM/YYYY HH:MM</small>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label>Lokasi Tes</label>
                                                        <select class="form-control" name="school_location_id" id="school_location_id" {{ $registration->status == 'approve' ? 'required' : '' }}>
                                                            <option value="">-- Pilih Lokasi --</option>
                                                            @foreach ($locations as $location)
                                                            <option value="{{ $location->id }}" {{ $registration->school_location_id == $location->id ? 'selected' : '' }}>{{ $location->nama_lokasi }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label>Gedung</label>
                                                        <select class="form-control" name="gedung_id" id="gedung_id" {{ $registration->status == 'approve' ? 'required' : '' }} disabled>
                                                            <option value="">-- Pilih Gedung --</option>
                                                            @foreach ($gedungs as $gedung)
                                                            <option value="{{ $gedung->id }}" {{ $registration->gedung_id == $gedung->id ? 'selected' : '' }}>{{ $gedung->nama_gedung }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label>Ruang</label>
                                                        <select class="form-control" name="ruang_id" id="ruang_id" {{ $registration->status == 'approve' ? 'required' : '' }} disabled>
                                                            <option value="">-- Pilih Ruang --</option>
                                                            @foreach ($ruangs as $ruang)
                                                            <option value="{{ $ruang->id }}" {{ $registration->ruang_id == $ruang->id ? 'selected' : '' }}>{{ $ruang->nama_ruang }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group mt-3">
                                                <button type="submit" class="btn btn-primary">Simpan Status</button>
                                                <a href="{{ route('dashboard.list_pendaftar') }}" class="btn btn-secondary">Kembali</a>
                                            </div>
                                        </form>
                                        @elseif ($registration->status == 'approve' && $registration->jadwal_tes && now()->gte(\Carbon\Carbon::parse($registration->jadwal_tes)))
                                        <!-- Form Edit jika Status "Approve" dan Jadwal Tes sudah lewat -->
                                        <form action="{{ route('dashboard.update_status', $registration->id) }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label>Status Pendaftaran</label>
                                                <select class="form-control" name="status" id="statusSelect" required>
                                                    <option value="accepted">Accepted</option>
                                                    <option value="not_accepted">Not Accepted</option>
                                                </select>
                                            </div>

                                            <div class="form-group mt-3">
                                                <button type="submit" class="btn btn-primary">Simpan Status</button>
                                                <a href="{{ route('dashboard.list_pendaftar') }}" class="btn btn-secondary">Kembali</a>
                                            </div>
                                        </form>
                                        @else
                                        <!-- Tampilan Read-Only untuk Status Approve (sebelum jadwal tes lewat), Decline, Accepted, atau Not Accepted -->
                                        <div class="card shadow-sm" style="border-radius: 10px;">
                                            <div class="card-body p-4">
                                                <div class="info-item d-flex align-items-center mb-3 p-3 bg-light rounded">
                                                    <i class="fas fa-info-circle fa-2x mr-3 text-primary"></i>
                                                    <div>
                                                        <strong>Status Pendaftaran:</strong>
                                                        <span>
                                                            @if ($registration->status == 'waiting')
                                                            <span class="badge badge-warning" style="font-size: 12px"><i class="fas fa-hourglass-half mr-1"></i> Waiting</span>
                                                            @elseif ($registration->status == 'approve')
                                                            <span class="badge badge-success" style="font-size: 12px"><i class="fas fa-check mr-1"></i> Approve</span>
                                                            @elseif ($registration->status == 'decline')
                                                            <span class="badge badge-danger" style="font-size: 12px"><i class="fas fa-times mr-1"></i> Decline</span>
                                                            @elseif ($registration->status == 'accepted')
                                                            <span class="badge badge-success" style="font-size: 12px"><i class="fas fa-check-circle mr-1"></i> Accepted</span>
                                                            @elseif ($registration->status == 'not_accepted')
                                                            <span class="badge badge-danger" style="font-size: 12px"><i class="fas fa-times-circle mr-1"></i> Not Accepted</span>
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                                @if ($registration->status == 'accepted')
                                                <div class="info-item d-flex align-items-center mb-3 p-3 bg-light rounded">
                                                    <i class="fas fa-comment-alt fa-2x mr-3 text-primary"></i>
                                                    <div>
                                                        <strong>Pesan:</strong>
                                                        <span>Selamat, Anda telah diterima di Smart Character Islamic School.</span>
                                                    </div>
                                                </div>
                                                @elseif ($registration->status == 'not_accepted')
                                                <div class="info-item d-flex align-items-center mb-3 p-3 bg-light rounded">
                                                    <i class="fas fa-comment-alt fa-2x mr-3 text-primary"></i>
                                                    <div>
                                                        <strong>Pesan:</strong>
                                                        <span>Mohon maaf, Anda belum diterima di Smart Character Islamic School. Terima kasih atas partisipasinya.</span>
                                                    </div>
                                                </div>
                                                @elseif ($registration->status == 'decline' && $registration->decline_reason)
                                                <div class="info-item d-flex align-items-center mb-3 p-3 bg-light rounded">
                                                    <i class="fas fa-comment-alt fa-2x mr-3 text-primary"></i>
                                                    <div>
                                                        <strong>Alasan Penolakan:</strong>
                                                        <span>{{ $registration->decline_reason }}</span>
                                                    </div>
                                                </div>
                                                @endif
                                                @if (in_array($registration->status, ['approve', 'accepted', 'not_accepted']))
                                                <div class="info-item d-flex align-items-center mb-3 p-3 bg-light rounded">
                                                    <i class="fas fa-clock fa-2x mr-3 text-primary"></i>
                                                    <div>
                                                        <strong>Jadwal Tes:</strong>
                                                        <span>{{ $registration->jadwal_tes ? \Carbon\Carbon::parse($registration->jadwal_tes)->format('d/m/Y H:i') : 'Belum Ditentukan' }}</span>
                                                    </div>
                                                </div>
                                                <div class="info-item d-flex align-items-center mb-3 p-3 bg-light rounded">
                                                    <i class="fas fa-map-marker-alt fa-2x mr-3 text-primary"></i>
                                                    <div>
                                                        <strong>Lokasi Tes:</strong>
                                                        <span>{{ $registration->schoolLocation ? $registration->schoolLocation->nama_lokasi . ' - ' . $registration->schoolLocation->alamat : 'Belum Ditentukan' }}</span>
                                                    </div>
                                                </div>
                                                <div class="info-item d-flex align-items-center mb-3 p-3 bg-light rounded">
                                                    <i class="fas fa-building fa-2x mr-3 text-primary"></i>
                                                    <div>
                                                        <strong>Gedung:</strong>
                                                        <span>{{ $registration->gedung ? $registration->gedung->nama_gedung : 'Belum Ditentukan' }}</span>
                                                    </div>
                                                </div>
                                                <div class="info-item d-flex align-items-center mb-3 p-3 bg-light rounded">
                                                    <i class="fas fa-door-open fa-2x mr-3 text-primary"></i>
                                                    <div>
                                                        <strong>Ruang:</strong>
                                                        <span>{{ $registration->ruang ? $registration->ruang->nama_ruang : 'Belum Ditentukan' }}</span>
                                                    </div>
                                                </div>
                                                <!-- Bagian Dokumen Wajib Dibawa -->
                                                @if ($registration->status == 'approve')
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
                                                            @if ($registration->user->level && in_array($registration->user->level->slug, ['smp', 'sma']))
                                                            @if ($registration->user->level->slug == 'smp' && $registration->user->ijazah_sd_path)
                                                            <li class="document-item d-flex align-items-center py-2">
                                                                <i class="fas fa-check-circle mr-2 text-success"></i>
                                                                Ijazah SD (Asli dan Fotokopi)
                                                            </li>
                                                            @elseif ($registration->user->level->slug == 'sma' && $registration->user->ijazah_smp_path)
                                                            <li class="document-item d-flex align-items-center py-2">
                                                                <i class="fas fa-check-circle mr-2 text-success"></i>
                                                                Ijazah SMP (Asli dan Fotokopi)
                                                            </li>
                                                            @endif
                                                            @endif
                                                        </ol>
                                                    </div>
                                                </div>
                                                @endif
                                                @endif
                                                <div class="mt-3">
                                                    <a href="{{ route('dashboard.list_pendaftar') }}" class="btn btn-secondary">Kembali</a>
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
    $(document).ready(function() {
        // Preview Modal
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

        // Status Change Handler
        $('#statusSelect').on('change', function() {
            var status = $(this).val();
            if (status === 'approve') {
                $('#testDetails').show();
                $('#declineReason').hide();
                $('#testDetails input, #testDetails select').attr('required', 'required');
                $('#decline_reason').removeAttr('required');
                $('#school_location_id').prop('disabled', false);
                $('#gedung_id').prop('disabled', true).empty().append('<option value="">-- Pilih Gedung --</option>');
                $('#ruang_id').prop('disabled', true).empty().append('<option value="">-- Pilih Ruang --</option>');
            } else if (status === 'decline') {
                $('#testDetails').hide();
                $('#declineReason').show();
                $('#testDetails input, #testDetails select').removeAttr('required');
                $('#decline_reason').attr('required', 'required');
                $('#school_location_id').prop('disabled', false);
                $('#gedung_id').prop('disabled', true).empty().append('<option value="">-- Pilih Gedung --</option>');
                $('#ruang_id').prop('disabled', true).empty().append('<option value="">-- Pilih Ruang --</option>');
            } else {
                $('#testDetails').hide();
                $('#declineReason').hide();
                $('#testDetails input, #testDetails select').removeAttr('required');
                $('#decline_reason').removeAttr('required');
                $('#school_location_id').prop('disabled', false);
                $('#gedung_id').prop('disabled', true).empty().append('<option value="">-- Pilih Gedung --</option>');
                $('#ruang_id').prop('disabled', true).empty().append('<option value="">-- Pilih Ruang --</option>');
            }
        });

        // School Location Change Handler
        $('#school_location_id').on('change', function() {
            var schoolLocationId = $(this).val();
            $('#gedung_id').empty().append('<option value="">-- Pilih Gedung --</option>').prop('disabled', true);
            $('#ruang_id').empty().append('<option value="">-- Pilih Ruang --</option>').prop('disabled', true);

            if (schoolLocationId) {
                $.ajax({
                    url: '{{ route("dashboard.get_gedungs", ":school_location_id") }}'.replace(':school_location_id', schoolLocationId),
                    type: 'GET',
                    success: function(data) {
                        if (data.length > 0) {
                            $.each(data, function(index, gedung) {
                                $('#gedung_id').append('<option value="' + gedung.id + '">' + gedung.nama_gedung + '</option>');
                            });
                            $('#gedung_id').prop('disabled', false);
                        } else {
                            alert('Tidak ada gedung tersedia untuk lokasi ini.');
                        }
                    },
                    error: function() {
                        alert('Gagal memuat daftar gedung.');
                    }
                });
            }
        });

        // Gedung Change Handler
        $('#gedung_id').on('change', function() {
            var gedungId = $(this).val();
            $('#ruang_id').empty().append('<option value="">-- Pilih Ruang --</option>').prop('disabled', true);

            if (gedungId) {
                $.ajax({
                    url: '{{ route("dashboard.get_ruangs", ":gedung_id") }}'.replace(':gedung_id', gedungId),
                    type: 'GET',
                    success: function(data) {
                        if (data.length > 0) {
                            $.each(data, function(index, ruang) {
                                $('#ruang_id').append('<option value="' + ruang.id + '">' + ruang.nama_ruang + '</option>');
                            });
                            $('#ruang_id').prop('disabled', false);
                        } else {
                            alert('Tidak ada ruang tersedia untuk gedung ini.');
                        }
                    },
                    error: function() {
                        alert('Gagal memuat daftar ruang.');
                    }
                });
            }
        });

        // Handle pre-selected values on page load
        var status = '{{ $registration->status }}';
        var schoolLocationId = '{{ $registration->school_location_id }}';
        var gedungId = '{{ $registration->gedung_id }}';
        var ruangId = '{{ $registration->ruang_id }}';

        if (status === 'approve' && schoolLocationId) {
            // Populate gedung_id
            $.ajax({
                url: '{{ route("dashboard.get_gedungs", ":school_location_id") }}'.replace(':school_location_id', schoolLocationId),
                type: 'GET'
            }).then(function(data) {
                if (data.length > 0) {
                    $('#gedung_id').empty().append('<option value="">-- Pilih Gedung --</option>');
                    $.each(data, function(index, gedung) {
                        $('#gedung_id').append('<option value="' + gedung.id + '">' + gedung.nama_gedung + '</option>');
                    });
                    $('#gedung_id').prop('disabled', false);
                    if (gedungId) {
                        $('#gedung_id').val(gedungId);
                        // Populate ruang_id
                        return $.ajax({
                            url: '{{ route("dashboard.get_ruangs", ":gedung_id") }}'.replace(':gedung_id', gedungId),
                            type: 'GET'
                        }).then(function(data) {
                            if (data.length > 0) {
                                $('#ruang_id').empty().append('<option value="">-- Pilih Ruang --</option>');
                                $.each(data, function(index, ruang) {
                                    $('#ruang_id').append('<option value="' + ruang.id + '">' + ruang.nama_ruang + '</option>');
                                });
                                $('#ruang_id').prop('disabled', false);
                                if (ruangId) {
                                    $('#ruang_id').val(ruangId);
                                }
                            }
                        });
                    }
                }
            }).fail(function() {
                alert('Gagal memuat data untuk pre-selected values.');
            });
        }

        // Jadwal Tes Handler
        const jadwalTesDisplay = document.getElementById('jadwal_tes_display');
        const jadwalTesInput = document.getElementById('jadwal_tes');

        // Trigger datetime picker when clicking the text input
        if (jadwalTesDisplay && jadwalTesInput) {
            jadwalTesDisplay.addEventListener('click', function() {
                jadwalTesInput.showPicker();
            });

            // Update text input when datetime picker changes
            jadwalTesInput.addEventListener('change', function() {
                if (jadwalTesInput.value) {
                    const date = new Date(jadwalTesInput.value);
                    const day = String(date.getDate()).padStart(2, '0');
                    const month = String(date.getMonth() + 1).padStart(2, '0');
                    const year = date.getFullYear();
                    const hours = String(date.getHours()).padStart(2, '0');
                    const minutes = String(date.getMinutes()).padStart(2, '0');
                    jadwalTesDisplay.value = `${day}/${month}/${year} ${hours}:${minutes}`;
                } else {
                    jadwalTesDisplay.value = '';
                }
            });

            // Update datetime picker when text input changes
            jadwalTesDisplay.addEventListener('input', function() {
                const value = jadwalTesDisplay.value;
                const regex = /^(\d{2})\/(\d{2})\/(\d{4})\s(\d{2}):(\d{2})$/;
                if (regex.test(value)) {
                    const [, day, month, year, hours, minutes] = value.match(regex);
                    const date = new Date(`${year}-${month}-${day}T${hours}:${minutes}`);
                    if (!isNaN(date.getTime())) {
                        jadwalTesInput.value = `${year}-${month}-${day}T${hours}:${minutes}`;
                    } else {
                        jadwalTesInput.value = '';
                    }
                } else {
                    jadwalTesInput.value = '';
                }
            });

            // Prevent form submission if datetime format is invalid
            jadwalTesDisplay.closest('form').addEventListener('submit', function(event) {
                const value = jadwalTesDisplay.value;
                if (value && !/^\d{2}\/\d{2}\/\d{4}\s\d{2}:\d{2}$/.test(value)) {
                    event.preventDefault();
                    alert('Jadwal Tes harus dalam format DD/MM/YYYY HH:MM.');
                }
            });
        }
    });
</script>
@endsection
