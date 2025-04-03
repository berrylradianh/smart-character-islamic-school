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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">SCIS</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Content</a></li>
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
                            <p class="sub-title">This Content will be shown on the Perkenalan Section of the Landing Page.</p>

                            <form method="POST" action="/save-introduction">
                                @csrf
                                <div class="form-group">
                                    <textarea name="introduction" id="introduction" class="form-control summernote" rows="10"></textarea>
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
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
            ]
        });
    });
</script>
@endsection
