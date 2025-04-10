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
                        <h4 class="page-title">{{ $title }}</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">SCIS</li>
                            <li class="breadcrumb-item">Content</li>
                            <li class="breadcrumb-item active">Hero</li>
                        </ol>
                    </div>
                </div>
            </div>

            @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div id="hero-sections">
                <form action="{{ route('hero.store') }}" method="POST" enctype="multipart/form-data" id="hero-form">
                    @csrf
                    <div id="hero-input-section">
                        <div class="row hero-item" data-hero-index="0">
                            <div class="col-12">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <h4 class="mt-0 header-title">Edit or Add Hero Content</h4>
                                        <p class="sub-title">This Content will be shown on the Hero Section of the Landing Page.</p>
                                        <div class="hero-card">
                                            <div class="form-group row">
                                                <label for="title_0" class="col-sm-2 col-form-label">Title</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" placeholder="Type your title here...." id="title_0" name="heroes[0][title]" value="{{ old('heroes.0.title') }}">
                                                    @error('heroes.0.title') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="description_0" class="col-sm-2 col-form-label">Description</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" placeholder="Type your description here...." id="description_0" name="heroes[0][description]" value="{{ old('heroes.0.description') }}">
                                                    @error('heroes.0.description') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Image</label>
                                                <div class="col-sm-10">
                                                    <input type="file" name="heroes[0][file]" id="image_0" accept="image/*" class="form-control-file image-input">
                                                    <div id="imagePreview_0" class="mt-3" style="max-width: 300px; display: none;">
                                                        <img id="previewImg_0" src="#" alt="Image Preview" class="img-fluid rounded" style="max-width: 100%;">
                                                    </div>
                                                    @error('heroes.0.file') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="button" class="btn btn-success waves-effect waves-light mb-3" id="add-hero">+ Add Hero Section</button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light mb-3">Submit All</button>
                        </div>
                    </div>
                </form>

                <div id="hero-existing-section">
                    @foreach ($heroes as $index => $hero)
                    <div class="row hero-item" data-hero-index="{{ $index }}">
                        <div class="col-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <h4 class="mt-0 header-title">Hero Content #{{ $index + 1 }}</h4>
                                    <form action="{{ route('hero.destroy', $hero->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="hero-card">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Title</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" value="{{ $hero->title }}" disabled>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Description</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" value="{{ $hero->description }}" disabled>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Image</label>
                                                <div class="col-sm-10">
                                                    @if ($hero->image)
                                                    <img src="{{ Storage::url($hero->image) }}" alt="{{ $hero->title }}" class="img-fluid rounded" style="max-width: 300px;">
                                                    @else
                                                    <p>No image available</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="text-center m-t-15">
                                                <button type="submit" class="btn btn-danger waves-effect waves-light">Remove</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        © SCIS, 2024. All Right Reserved
    </footer>
</div>

<script>
    let heroCount = 1;

    function setupImagePreview(input, index) {
        input.addEventListener('change', function(e) {
            const file = e.target.files[0];
            const previewContainer = document.getElementById(`imagePreview_${index}`);
            const previewImg = document.getElementById(`previewImg_${index}`);

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    previewContainer.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                previewContainer.style.display = 'none';
            }
        });
    }

    setupImagePreview(document.getElementById('image_0'), 0);

    document.getElementById('add-hero').addEventListener('click', function() {
        const heroInputSection = document.getElementById('hero-input-section');
        const newRow = document.createElement('div');
        newRow.className = 'row hero-item';
        newRow.setAttribute('data-hero-index', heroCount);
        newRow.innerHTML = `
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Edit or Add Hero Content</h4>
                        <p class="sub-title">This Content will be shown on the Hero Section of the Landing Page.</p>
                        <div class="hero-card">
                            <div class="form-group row">
                                <label for="title_${heroCount}" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Type your title here...." id="title_${heroCount}" name="heroes[${heroCount}][title]">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description_${heroCount}" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Type your description here...." id="description_${heroCount}" name="heroes[${heroCount}][description]">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Image</label>
                                <div class="col-sm-10">
                                    <input type="file" name="heroes[${heroCount}][file]" id="image_${heroCount}" accept="image/*" class="form-control-file image-input">
                                    <div id="imagePreview_${heroCount}" class="mt-3" style="max-width: 300px; display: none;">
                                        <img id="previewImg_${heroCount}" src="#" alt="Image Preview" class="img-fluid rounded" style="max-width: 100%;">
                                    </div>
                                </div>
                            </div>
                            <div class="text-center m-t-15">
                                <button type="button" class="btn btn-danger waves-effect waves-light remove-hero">Remove</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        heroInputSection.appendChild(newRow);

        const newImageInput = document.getElementById(`image_${heroCount}`);
        setupImagePreview(newImageInput, heroCount);

        newRow.querySelector('.remove-hero').addEventListener('click', function() {
            newRow.remove();
        });

        heroCount++;
    });
</script>
@endsection
