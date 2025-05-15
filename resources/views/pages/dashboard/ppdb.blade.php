@php
    use Illuminate\Support\Facades\Storage;
@endphp

@extends('layouts.dashboard.app')

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <!-- Page Title and Breadcrumb -->
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">PPDB</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">SCIS</li>
                            <li class="breadcrumb-item">Content</li>
                            <li class="breadcrumb-item active">PPDB</li>
                        </ol>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Edit PPDB</h4>
                            <p class="sub-title">This content will be shown in the PPDB section of the Landing Page.</p>

                            @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                            @endif

                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <form method="POST" action="{{ route('dashboard.ppdb.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" class="form-control summernote" rows="5">{!! old('description', $ppdb->description) !!}</textarea>
                                    @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="program_unggulan">Program Unggulan</label>
                                    <textarea name="program_unggulan" id="program_unggulan" class="form-control" rows="5" placeholder="Enter each program on a new line">{{ old('program_unggulan', implode("\n", $ppdb->program_unggulan ?? [])) }}</textarea>
                                    @error('program_unggulan')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="jenjang_pendidikan">Jenjang Pendidikan</label>
                                    <textarea name="jenjang_pendidikan" id="jenjang_pendidikan" class="form-control" rows="3">{{ old('jenjang_pendidikan', $ppdb->jenjang_pendidikan) }}</textarea>
                                    @error('jenjang_pendidikan')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="jadwal_pendaftaran">Jadwal Pendaftaran</label>
                                    <textarea name="jadwal_pendaftaran" id="jadwal_pendaftaran" class="form-control" rows="3">{{ old('jadwal_pendaftaran', $ppdb->jadwal_pendaftaran) }}</textarea>
                                    @error('jadwal_pendaftaran')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="contact_info">Informasi & Kontak</label>
                                    <textarea name="contact_info" id="contact_info" class="form-control summernote" rows="3">{!! old('contact_info', $ppdb->contact_info) !!}</textarea>
                                    @error('contact_info')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="image">PPDB Image</label>
                                    <input type="file" name="image" id="image" class="form-control-file" accept="image/*">
                                    @if ($ppdb->image)
                                        <div class="mt-2">
                                            <p>Current Image:</p>
                                            <img src="{{ Storage::url($ppdb->image) }}" alt="Current PPDB Image" style="max-width: 200px; border-radius: 15px;">
                                        </div>
                                    @endif
                                    @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- Registrant Counts Section -->
                                <div class="form-group">
                                    <label>Jumlah Pendaftar</label>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="registrant_counts_tk">TK</label>
                                            <input type="number" name="registrant_counts[tk]" id="registrant_counts_tk" class="form-control" value="{{ old('registrant_counts.tk', $ppdb->registrant_counts['tk'] ?? 0) }}" min="0">
                                            @error('registrant_counts.tk')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label for="registrant_counts_sd">SD</label>
                                            <input type="number" name="registrant_counts[sd]" id="registrant_counts_sd" class="form-control" value="{{ old('registrant_counts.sd', $ppdb->registrant_counts['sd'] ?? 0) }}" min="0">
                                            @error('registrant_counts.sd')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label for="registrant_counts_smp">SMP</label>
                                            <input type="number" name="registrant_counts[smp]" id="registrant_counts_smp" class="form-control" value="{{ old('registrant_counts.smp', $ppdb->registrant_counts['smp'] ?? 0) }}" min="0">
                                            @error('registrant_counts.smp')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label for="registrant_counts_sma">SMA</label>
                                            <input type="number" name="registrant_counts[sma]" id="registrant_counts_sma" class="form-control" value="{{ old('registrant_counts.sma', $ppdb->registrant_counts['sma'] ?? 0) }}" min="0">
                                            @error('registrant_counts.sma')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="rincian_biaya">Rincian Biaya</label>
                                    <textarea name="rincian_biaya" id="rincian_biaya" class="form-control" rows="5" placeholder="Enter each item on a new line">{{ old('rincian_biaya', implode("\n", $ppdb->rincian_biaya ?? [])) }}</textarea>
                                    @error('rincian_biaya')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="jadwal_ppdb">Jadwal PPDB</label>
                                    <textarea name="jadwal_ppdb" id="jadwal_ppdb" class="form-control" rows="5" placeholder="Enter each item on a new line">{{ old('jadwal_ppdb', implode("\n", $ppdb->jadwal_ppdb ?? [])) }}</textarea>
                                    @error('jadwal_ppdb')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="dokumen_diperlukan">Dokumen yang Diperlukan</label>
                                    <textarea name="dokumen_diperlukan" id="dokumen_diperlukan" class="form-control" rows="5" placeholder="Enter each item on a new line">{{ old('dokumen_diperlukan', implode("\n", $ppdb->dokumen_diperlukan ?? [])) }}</textarea>
                                    @error('dokumen_diperlukan')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        © SCIS, 2025. All Right Reserved
    </footer>
</div>
@endsection

@section('scripts')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<script>
    $(document).ready(function() {
        $('#description, #contact_info').summernote({
            height: 200,
            minHeight: null,
            maxHeight: null,
            focus: true,
            toolbar: [
                ['style', ['style', 'removeformat']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['color', ['color']],
                ['fontsize', ['fontsize']],
                ['view', ['fullscreen', 'codeview', 'help']],
            ],
            callbacks: {
                onImageUpload: function(files) {
                    for (let i = 0; i < files.length; i++) {
                        let formData = new FormData();
                        formData.append('file', files[i]);
                        $.ajax({
                            url: '/upload-image',
                            method: 'POST',
                            data: formData,
                            contentType: false,
                            processData: false,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(url) {
                                $('#description, #contact_info').summernote('insertImage', url);
                            },
                            error: function() {
                                alert('Image upload failed.');
                            }
                        });
                    }
                }
            }
        });
    });
</script>
@endsection
