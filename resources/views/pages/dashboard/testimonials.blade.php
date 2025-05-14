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
                            <li class="breadcrumb-item active">Testimonials</li>
                        </ol>
                    </div>
                </div>
            </div>

            @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div id="testimonial-sections">
                <form action="{{ route('dashboard.testimonials.store') }}" method="POST" enctype="multipart/form-data" id="testimonial-form">
                    @csrf
                    <div id="input-sections">
                        <div class="row testimonial-item" data-testimonial-index="0">
                            <div class="col-12">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <h4 class="mt-0 header-title">Add Testimonial Content</h4>
                                        <p class="sub-title">This content will be shown in the Testimonial section of the Landing Page.</p>
                                        <div class="testimonial-card">
                                            <div class="form-group row">
                                                <label for="name_0" class="col-sm-2 col-form-label">Name</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" placeholder="Type the name here...." id="name_0" name="testimonials[0][name]" value="{{ old('testimonials.0.name') }}">
                                                    @error('testimonials.0.name') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="position_0" class="col-sm-2 col-form-label">Position</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" placeholder="Type the position here...." id="position_0" name="testimonials[0][position]" value="{{ old('testimonials.0.position') }}">
                                                    @error('testimonials.0.position') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="text_0" class="col-sm-2 col-form-label">Testimonial Text</label>
                                                <div class="col-sm-10">
                                                    <textarea class="form-control" placeholder="Type the testimonial text here...." id="text_0" name="testimonials[0][text]">{{ old('testimonials.0.text') }}</textarea>
                                                    @error('testimonials.0.text') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="rating_0" class="col-sm-2 col-form-label">Rating (1-5)</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="number" min="1" max="5" placeholder="Enter rating (1-5)" id="rating_0" name="testimonials[0][rating]" value="{{ old('testimonials.0.rating', 5) }}">
                                                    @error('testimonials.0.rating') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="order_0" class="col-sm-2 col-form-label">Order</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="number" placeholder="Order (e.g., 1, 2, 3...)" id="order_0" name="testimonials[0][order]" value="{{ old('testimonials.0.order', 0) }}">
                                                    @error('testimonials.0.order') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Image</label>
                                                <div class="col-sm-10">
                                                    <input type="file" name="testimonials[0][file]" id="image_0" accept="image/*" class="form-control-file image-input">
                                                    <div id="imagePreview_0" class="mt-3" style="max-width: 300px; display: none;">
                                                        <img id="previewImg_0" src="#" alt="Image Preview" class="img-fluid rounded" style="max-width: 100%;">
                                                    </div>
                                                    @error('testimonials.0.file') <span class="text-danger">{{ $message }}</span> @enderror
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
                            <button type="button" class="btn btn-success waves-effect waves-light mb-3" id="add-testimonial">+ Add Testimonial</button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light mb-3">Submit All</button>
                        </div>
                    </div>
                </form>

                @foreach ($testimonials as $index => $item)
                <div class="row testimonial-item" data-testimonial-index="{{ $index }}">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Testimonial #{{ $index + 1 }}</h4>
                                <form action="{{ route('dashboard.testimonials.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="testimonial-card">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" value="{{ $item->name }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Position</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" value="{{ $item->position }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Testimonial Text</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" disabled>{{ $item->text }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Rating</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" value="{{ $item->rating }} stars" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Order</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" value="{{ $item->order }}" disabled>
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
    let testimonialCount = 1;

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

    document.getElementById('add-testimonial').addEventListener('click', function() {
        const inputSections = document.getElementById('input-sections');
        const newRow = document.createElement('div');
        newRow.className = 'row testimonial-item';
        newRow.setAttribute('data-testimonial-index', testimonialCount);
        newRow.innerHTML = `
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Add Testimonial Content</h4>
                        <p class="sub-title">This content will be shown in the Testimonial section of the Landing Page.</p>
                        <div class="testimonial-card">
                            <div class="form-group row">
                                <label for="name_${testimonialCount}" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Type the name here...." id="name_${testimonialCount}" name="testimonials[${testimonialCount}][name]">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="position_${testimonialCount}" class="col-sm-2 col-form-label">Position</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Type the position here...." id="position_${testimonialCount}" name="testimonials[${testimonialCount}][position]">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="text_${testimonialCount}" class="col-sm-2 col-form-label">Testimonial Text</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" placeholder="Type the testimonial text here...." id="text_${testimonialCount}" name="testimonials[${testimonialCount}][text]"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="rating_${testimonialCount}" class="col-sm-2 col-form-label">Rating (1-5)</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="number" min="1" max="5" placeholder="Enter rating (1-5)" id="rating_${testimonialCount}" name="testimonials[${testimonialCount}][rating]" value="5">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="order_${testimonialCount}" class="col-sm-2 col-form-label">Order</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="number" placeholder="Order (e.g., 1, 2, 3...)" id="order_${testimonialCount}" name="testimonials[${testimonialCount}][order]" value="0">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Image</label>
                                <div class="col-sm-10">
                                    <input type="file" name="testimonials[${testimonialCount}][file]" id="image_${testimonialCount}" accept="image/*" class="form-control-file image-input">
                                    <div id="imagePreview_${testimonialCount}" class="mt-3" style="max-width: 300px; display: none;">
                                        <img id="previewImg_${testimonialCount}" src="#" alt="Image Preview" class="img-fluid rounded" style="max-width: 100%;">
                                    </div>
                                </div>
                            </div>
                            <div class="text-center m-t-15">
                                <button type="button" class="btn btn-danger waves-effect waves-light remove-testimonial">Remove</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;

        inputSections.appendChild(newRow);

        const newImageInput = document.getElementById(`image_${testimonialCount}`);
        setupImagePreview(newImageInput, testimonialCount);

        newRow.querySelector('.remove-testimonial').addEventListener('click', function() {
            newRow.remove();
        });

        testimonialCount++;
    });
</script>
@endsection
