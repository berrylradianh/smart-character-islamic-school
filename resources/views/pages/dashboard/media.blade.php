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
                            <li class="breadcrumb-item active">Media</li>
                        </ol>
                    </div>
                </div>
            </div>

            @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div id="media-sections">
                <form action="{{ route('dashboard.media.store') }}" method="POST" enctype="multipart/form-data" id="media-form">
                    @csrf
                    <div id="input-sections">
                        <div class="row media-item" data-media-index="0">
                            <div class="col-12">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <h4 class="mt-0 header-title">Add Media Coverage</h4>
                                        <p class="sub-title">This content will be shown in the Media section of the Landing Page.</p>
                                        <div class="media-card">
                                            <div class="form-group row">
                                                <label for="name_0" class="col-sm-2 col-form-label">Media Name</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" placeholder="Type the media name here...." id="name_0" name="media[0][name]" value="{{ old('media.0.name') }}">
                                                    @error('media.0.name') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Image</label>
                                                <div class="col-sm-10">
                                                    <input type="file" name="media[0][file]" id="image_0" accept="image/*" class="form-control-file image-input">
                                                    <div id="imagePreview_0" class="mt-3" style="max-width: 300px; display: none;">
                                                        <img id="previewImg_0" src="#" alt="Image Preview" class="img-fluid rounded" style="max-width: 100%;">
                                                    </div>
                                                    @error('media.0.file') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="order_0" class="col-sm-2 col-form-label">Order</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="number" placeholder="Order (e.g., 1, 2, 3...)" id="order_0" name="media[0][order]" value="{{ old('media.0.order', 0) }}">
                                                    @error('media.0.order') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="add-button-container">
                        <div class="col-12">
                            <button type="button" class="btn btn-success waves-effect waves-light mb-3" id="add-media">+ Add Media</button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light mb-3">Submit All</button>
                        </div>
                    </div>
                </form>

                @foreach ($media as $index => $item)
                <div class="row media-item" data-media-index="{{ $index }}">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Media #{{ $index + 1 }}</h4>
                                <form action="{{ route('dashboard.media.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="media-card">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Media Name</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" value="{{ $item->name }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Image</label>
                                            <div class="col-sm-10">
                                                @if ($item->image)
                                                <img src="{{ Storage::url($item->image) }}" alt="{{ $item->name }}" class="img-fluid rounded" style="max-width: 300px;">
                                                @else
                                                <p>No image available</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Order</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" value="{{ $item->order }}" disabled>
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

    <footer class="footer">
        © SCIS, 2025. All Right Reserved
    </footer>
</div>

<script>
    let mediaCount = 1;

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

    document.getElementById('add-media').addEventListener('click', function() {
        const inputSections = document.getElementById('input-sections');
        const newRow = document.createElement('div');
        newRow.className = 'row media-item';
        newRow.setAttribute('data-media-index', mediaCount);
        newRow.innerHTML = `
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Add Media Coverage</h4>
                        <p class="sub-title">This content will be shown in the Media section of the Landing Page.</p>
                        <div class="media-card">
                            <div class="form-group row">
                                <label for="name_${mediaCount}" class="col-sm-2 col-form-label">Media Name</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Type the media name here...." id="name_${mediaCount}" name="media[${mediaCount}][name]">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Image</label>
                                <div class="col-sm-10">
                                    <input type="file" name="media[${mediaCount}][file]" id="image_${mediaCount}" accept="image/*" class="form-control-file image-input">
                                    <div id="imagePreview_${mediaCount}" class="mt-3" style="max-width: 300px; display: none;">
                                        <img id="previewImg_${mediaCount}" src="#" alt="Image Preview" class="img-fluid rounded" style="max-width: 100%;">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="order_${mediaCount}" class="col-sm-2 col-form-label">Order</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="number" placeholder="Order (e.g., 1, 2, 3...)" id="order_${mediaCount}" name="media[${mediaCount}][order]" value="0">
                                </div>
                            </div>
                            <div class="text-center m-t-15">
                                <button type="button" class="btn btn-danger waves-effect waves-light remove-media">Remove</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;

        inputSections.appendChild(newRow);

        const newImageInput = document.getElementById(`image_${mediaCount}`);
        setupImagePreview(newImageInput, mediaCount);

        newRow.querySelector('.remove-media').addEventListener('click', function() {
            newRow.remove();
        });

        mediaCount++;
    });
</script>
@endsection
