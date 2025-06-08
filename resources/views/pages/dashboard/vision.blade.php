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
                        <h4 class="page-title">Visi dan Misi</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">SCIS</li>
                            <li class="breadcrumb-item">Content</li>
                            <li class="breadcrumb-item active">Visi dan Misi</li>
                        </ol>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Edit Visi dan Misi</h4>
                            <p class="sub-title">This content will be shown in the Visi dan Misi section of the Landing Page.</p>

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

                            <form method="POST" action="{{ route('dashboard.vision.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="vision_text">Vision Text</label>
                                    <textarea name="vision_text" id="vision_text" class="form-control" rows="3">{{ old('vision_text', $vision->vision_text) }}</textarea>
                                    @error('vision_text')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="mission_items">Mission Items</label>
                                    <textarea name="mission_items" id="mission_items" class="form-control" rows="5" placeholder="Enter each mission item on a new line (e.g., SMART adalah : Specific, Measurable, Achievable, Relevant dan Timebound.)">{{ old('mission_items', implode("\n", $vision->mission_items ?? [])) }}</textarea>
                                    @error('mission_items')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="commitment_text">Commitment Text</label>
                                    <textarea name="commitment_text" id="commitment_text" class="form-control" rows="3">{{ old('commitment_text', $vision->commitment_text) }}</textarea>
                                    @error('commitment_text')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="poster_image">Poster Image</label>
                                    <input type="file" name="poster_image" id="poster_image" class="form-control-file" accept="image/*">
                                    @if ($vision->poster_image)
                                    <div class="mt-2">
                                        <p>Current Poster:</p>
                                        <img src="{{ Storage::url($vision->poster_image) }}" alt="Current Poster" style="max-width: 200px; border-radius: 15px;">
                                    </div>
                                    @endif
                                    @error('poster_image')
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
