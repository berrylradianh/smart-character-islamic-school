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
                        <h4 class="page-title">Perkenalan</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">SCIS</li>
                            <li class="breadcrumb-item">Content</li>
                            <li class="breadcrumb-item active">Perkenalan</li>
                        </ol>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Edit Perkenalan</h4>
                            <p class="sub-title">This content will be shown in the Perkenalan section of the Landing Page.</p>

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

                            <form method="POST" action="{{ route('dashboard.introduction.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="image">Introduction Image</label>
                                    <input type="file" name="image" id="image" class="form-control-file" accept="image/*">
                                    @if ($introduction->image)
                                        <div class="mt-2">
                                            <p>Current Image:</p>
                                            <img src="{{ Storage::url($introduction->image) }}" alt="Current Introduction Image" style="max-width: 200px; border-radius: 15px;">
                                        </div>
                                    @endif
                                    @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="introduction">Introduction Content</label>
                                    <textarea name="introduction" id="introduction" class="form-control summernote" rows="10">{!! $introduction->content !!}</textarea>
                                    @error('introduction')
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
        © SCIS, 2024. All Right Reserved
    </footer>
</div>
@endsection

@section('scripts')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<script>
    $(document).ready(function() {
        $('#introduction').summernote({
            height: 400,
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
                            url: '/upload-image', // You need to create this route and controller method
                            method: 'POST',
                            data: formData,
                            contentType: false,
                            processData: false,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(url) {
                                $('#introduction').summernote('insertImage', url);
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
