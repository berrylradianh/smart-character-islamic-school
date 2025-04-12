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
                            <li class="breadcrumb-item active">Berita</li>
                        </ol>
                    </div>
                </div>
            </div>

            @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div id="news-sections">
                <form action="{{ route('dashboard.news.store') }}" method="POST" enctype="multipart/form-data" id="news-form">
                    @csrf
                    <div id="input-sections">
                        <div class="row news-item" data-news-index="0">
                            <div class="col-12">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <h4 class="mt-0 header-title">Edit or Add Berita Content</h4>
                                        <p class="sub-title">This Content will be shown on the Berita Section of the Landing Page.</p>
                                        <div class="news-card">
                                            <div class="form-group row">
                                                <label for="title_0" class="col-sm-2 col-form-label">Title</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" placeholder="Type your title here...." id="title_0" name="news[0][title]" value="{{ old('news.0.title') }}">
                                                    @error('news.0.title') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="description_0" class="col-sm-2 col-form-label">Description</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" placeholder="Type your description here...." id="description_0" name="news[0][description]" value="{{ old('news.0.description') }}">
                                                    @error('news.0.description') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="date_0" class="col-sm-2 col-form-label">Date</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="date" id="date_0" name="news[0][date]" value="{{ old('news.0.date') }}">
                                                    @error('news.0.date') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Image</label>
                                                <div class="col-sm-10">
                                                    <div class="m-b-30">
                                                        <input type="file" name="news[0][file]" id="image_0" accept="image/*" class="form-control-file image-input">
                                                        <div id="imagePreview_0" class="mt-3" style="max-width: 300px; display: none;">
                                                            <img id="previewImg_0" src="#" alt="Image Preview" class="img-fluid rounded" style="max-width: 100%;">
                                                        </div>
                                                        @error('news.0.file') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
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
                            <button type="button" class="btn btn-success waves-effect waves-light mb-3" id="add-news">+ Add Berita Section</button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light mb-3">Submit All</button>
                        </div>
                    </div>
                </form>

                @foreach ($news as $index => $item)
                <div class="row news-item" data-news-index="{{ $index }}">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Berita Content #{{ $index + 1 }}</h4>
                                <form action="{{ route('news.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="news-card">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Title</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" value="{{ $item->title }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Description</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" value="{{ $item->description }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Date</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" value="{{ \Carbon\Carbon::parse($item->date)->format('d F Y') }}" disabled>
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
        © SCIS, 2024. All Right Reserved
    </footer>
</div>

<script>
    let newsCount = 1;

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

    document.getElementById('add-news').addEventListener('click', function() {
        const inputSections = document.getElementById('input-sections');
        const newRow = document.createElement('div');
        newRow.className = 'row news-item';
        newRow.setAttribute('data-news-index', newsCount);
        newRow.innerHTML = `
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Edit or Add Berita Content</h4>
                        <p class="sub-title">This Content will be shown on the Berita Section of the Landing Page.</p>
                        <div class="news-card">
                            <div class="form-group row">
                                <label for="title_${newsCount}" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Type your title here...." id="title_${newsCount}" name="news[${newsCount}][title]">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description_${newsCount}" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Type your description here...." id="description_${newsCount}" name="news[${newsCount}][description]">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="date_${newsCount}" class="col-sm-2 col-form-label">Date</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="date" id="date_${newsCount}" name="news[${newsCount}][date]">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Image</label>
                                <div class="col-sm-10">
                                    <div class="m-b-30">
                                        <input type="file" name="news[${newsCount}][file]" id="image_${newsCount}" accept="image/*" class="form-control-file image-input">
                                        <div id="imagePreview_${newsCount}" class="mt-3" style="max-width: 300px; display: none;">
                                            <img id="previewImg_${newsCount}" src="#" alt="Image Preview" class="img-fluid rounded" style="max-width: 100%;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center m-t-15">
                                <button type="button" class="btn btn-danger waves-effect waves-light remove-news">Remove</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;

        inputSections.appendChild(newRow);

        const newImageInput = document.getElementById(`image_${newsCount}`);
        setupImagePreview(newImageInput, newsCount);

        newRow.querySelector('.remove-news').addEventListener('click', function() {
            newRow.remove();
        });

        newsCount++;
    });
</script>
@endsection
