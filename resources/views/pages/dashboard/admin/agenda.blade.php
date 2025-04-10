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
                            <li class="breadcrumb-item active">Agenda</li>
                        </ol>
                    </div>
                </div>
            </div>

            @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div id="agenda-sections">
                <div class="row" id="initial-input">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Edit or Add Agenda Content</h4>
                                <p class="sub-title">This Content will be shown on the Agenda Section of the Landing Page.</p>
                                <form action="{{ route('agenda.store') }}" method="POST" enctype="multipart/form-data" class="agenda-form" data-index="0">
                                    @csrf
                                    <div class="agenda-card">
                                        <div class="form-group row">
                                            <label for="title_0" class="col-sm-2 col-form-label">Title</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" placeholder="Type your title here...." id="title_0" name="title" value="{{ old('title') }}">
                                                @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="description_0" class="col-sm-2 col-form-label">Description</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" placeholder="Type your description here...." id="description_0" name="description" value="{{ old('description') }}">
                                                @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="date_0" class="col-sm-2 col-form-label">Date</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="date" id="date_0" name="date" value="{{ old('date') }}">
                                                @error('date') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Image</label>
                                            <div class="col-sm-10">
                                                <div class="m-b-30">
                                                    <input type="file" name="file" id="image_0" accept="image/*" class="form-control-file image-input">
                                                    <div id="imagePreview_0" class="mt-3" style="max-width: 300px; display: none;">
                                                        <img id="previewImg_0" src="#" alt="Image Preview" class="img-fluid rounded" style="max-width: 100%;">
                                                    </div>
                                                    @error('file') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center m-t-15">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="new-agenda-sections"></div>

                <div class="row" id="add-agenda-container">
                    <div class="col-12">
                        <button type="button" class="btn btn-success waves-effect waves-light mb-3" id="add-agenda">+ Add Agenda Section</button>
                    </div>
                </div>

                @foreach ($agendas as $index => $item)
                <div class="row agenda-item" data-agenda-index="{{ $index }}">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Agenda Content #{{ $index + 1 }}</h4>
                                <form action="{{ route('agenda.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="agenda-card">
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
    let agendaCount = 1;

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

    document.getElementById('add-agenda').addEventListener('click', function() {
        const newAgendaSections = document.getElementById('new-agenda-sections');
        const addAgendaContainer = document.getElementById('add-agenda-container');
        const newRow = document.createElement('div');
        newRow.className = 'row agenda-item';
        newRow.setAttribute('data-agenda-index', agendaCount);
        newRow.innerHTML = `
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Edit or Add Agenda Content</h4>
                        <p class="sub-title">This Content will be shown on the Agenda Section of the Landing Page.</p>
                        <form action="{{ route('agenda.store') }}" method="POST" enctype="multipart/form-data" class="agenda-form" data-index="${agendaCount}">
                            @csrf
                            <div class="agenda-card">
                                <div class="form-group row">
                                    <label for="title_${agendaCount}" class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" placeholder="Type your title here...." id="title_${agendaCount}" name="title">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="description_${agendaCount}" class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" placeholder="Type your description here...." id="description_${agendaCount}" name="description">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date_${agendaCount}" class="col-sm-2 col-form-label">Date</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="date" id="date_${agendaCount}" name="date">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-10">
                                        <div class="m-b-30">
                                            <input type="file" name="file" id="image_${agendaCount}" accept="image/*" class="form-control-file image-input">
                                            <div id="imagePreview_${agendaCount}" class="mt-3" style="max-width: 300px; display: none;">
                                                <img id="previewImg_${agendaCount}" src="#" alt="Image Preview" class="img-fluid rounded" style="max-width: 100%;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center m-t-15">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                                    <button type="button" class="btn btn-danger waves-effect waves-light ml-2 remove-agenda">Remove</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        `;

        newAgendaSections.appendChild(newRow);

        newAgendaSections.appendChild(addAgendaContainer);

        const newImageInput = document.getElementById(`image_${agendaCount}`);
        setupImagePreview(newImageInput, agendaCount);

        newRow.querySelector('.remove-agenda').addEventListener('click', function() {
            newRow.remove();
            const remainingCards = newAgendaSections.querySelectorAll('.agenda-item');
            if (remainingCards.length > 0) {
                newAgendaSections.appendChild(addAgendaContainer);
            } else {
                document.getElementById('agenda-sections').insertBefore(addAgendaContainer, document.getElementById('new-agenda-sections').nextSibling);
            }
        });

        agendaCount++;
    });
</script>
@endsection
