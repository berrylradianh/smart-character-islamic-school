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
                            <li class="breadcrumb-item active">Program Unggulan</li>
                        </ol>
                    </div>
                </div>
            </div>

            @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div id="program-sections">
                <form action="{{ route('dashboard.programs.store') }}" method="POST" enctype="multipart/form-data" id="program-form">
                    @csrf
                    <div id="input-sections">
                        <div class="row program-item" data-program-index="0">
                            <div class="col-12">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <h4 class="mt-0 header-title">Add Program Content</h4>
                                        <p class="sub-title">This content will be shown in the Program Unggulan section of the Landing Page.</p>
                                        <div class="program-card">
                                            <div class="form-group row">
                                                <label for="title_0" class="col-sm-2 col-form-label">Title</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" placeholder="Type your title here...." id="title_0" name="programs[0][title]" value="{{ old('programs.0.title') }}">
                                                    @error('programs.0.title') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="description_0" class="col-sm-2 col-form-label">Description</label>
                                                <div class="col-sm-10">
                                                    <textarea class="form-control" placeholder="Type your description here...." id="description_0" name="programs[0][description]">{{ old('programs.0.description') }}</textarea>
                                                    @error('programs.0.description') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Image</label>
                                                <div class="col-sm-10">
                                                    <input type="file" name="programs[0][file]" id="image_0" accept="image/*" class="form-control-file image-input">
                                                    <div id="imagePreview_0" class="mt-3" style="max-width: 300px; display: none;">
                                                        <img id="previewImg_0" src="#" alt="Image Preview" class="img-fluid rounded" style="max-width: 100%;">
                                                    </div>
                                                    @error('programs.0.file') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="order_0" class="col-sm-2 col-form-label">Order</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="number" placeholder="Order (e.g., 1, 2, 3...)" id="order_0" name="programs[0][order]" value="{{ old('programs.0.order', 0) }}">
                                                    @error('programs.0.order') <span class="text-danger">{{ $message }}</span> @enderror
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
                            <button type="button" class="btn btn-success waves-effect waves-light mb-3" id="add-program">+ Add Program Content</button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light mb-3">Submit All</button>
                        </div>
                    </div>
                </form>

                @foreach ($programs as $index => $item)
                <div class="row program-item" data-program-index="{{ $index }}">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Program Content #{{ $index + 1 }}</h4>
                                <form action="{{ route('dashboard.programs.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="program-card">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Title</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" value="{{ $item->title }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Description</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" disabled>{{ $item->description }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Image</label>
                                            <div class="col-sm-10">
                                                @if ($item->image)
                                                <img src="{{ Storage::url($item->image) }}" alt="{{ $item->title }}" class="img-fluid rounded" style="max-width: 300px;">
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
    let programCount = 1;

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

    document.getElementById('add-program').addEventListener('click', function() {
        const inputSections = document.getElementById('input-sections');
        const newRow = document.createElement('div');
        newRow.className = 'row program-item';
        newRow.setAttribute('data-program-index', programCount);
        newRow.innerHTML = `
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Add Program Content</h4>
                        <p class="sub-title">This content will be shown in the Program Unggulan section of the Landing Page.</p>
                        <div class="program-card">
                            <div class="form-group row">
                                <label for="title_${programCount}" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Type your title here...." id="title_${programCount}" name="programs[${programCount}][title]">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description_${programCount}" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" placeholder="Type your description here...." id="description_${programCount}" name="programs[${programCount}][description]"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Image</label>
                                <div class="col-sm-10">
                                    <input type="file" name="programs[${programCount}][file]" id="image_${programCount}" accept="image/*" class="form-control-file image-input">
                                    <div id="imagePreview_${programCount}" class="mt-3" style="max-width: 300px; display: none;">
                                        <img id="previewImg_${programCount}" src="#" alt="Image Preview" class="img-fluid rounded" style="max-width: 100%;">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="order_${programCount}" class="col-sm-2 col-form-label">Order</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="number" placeholder="Order (e.g., 1, 2, 3...)" id="order_${programCount}" name="programs[${programCount}][order]" value="0">
                                </div>
                            </div>
                            <div class="text-center m-t-15">
                                <button type="button" class="btn btn-danger waves-effect waves-light remove-program">Remove</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;

        inputSections.appendChild(newRow);

        const newImageInput = document.getElementById(`image_${programCount}`);
        setupImagePreview(newImageInput, programCount);

        newRow.querySelector('.remove-program').addEventListener('click', function() {
            newRow.remove();
        });

        programCount++;
    });
</script>
@endsection
