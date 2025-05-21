@php
use Illuminate\Support\Facades\Storage;
@endphp

@extends('layouts.app')

@section('content')
<style>
    .program-card {
        height: 400px; /* Fixed height for all cards */
        display: flex;
        flex-direction: column;
    }
    .program-card .card-img-top {
        height: 200px; /* Fixed height for the image */
        object-fit: cover; /* Ensure image covers the area without distortion */
        cursor: pointer; /* Indicate image is clickable */
    }
    .program-card .card-body {
        flex: 1; /* Allow card-body to take remaining space */
        overflow-y: auto; /* Enable vertical scrolling for long content */
        max-height: 200px; /* Limit the height of the card body */
    }
    .modal-img {
        max-width: 100%; /* Ensure image fits modal */
        height: auto; /* Maintain aspect ratio */
    }
</style>

<section class="program-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Program Kami</h2>
            <hr class="w-25 mx-auto border-dark">
        </div>

        @if ($programs->isEmpty())
        <div class="text-center">
            <p>Belum ada program yang tersedia saat ini. Silahkan periksa lagi nanti!</p>
        </div>
        @else
        <div class="row">
            @foreach ($programs as $program)
            <div class="col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm program-card">
                    <img src="{{ $program->image ? Storage::url($program->image) : asset('assets/img/program/placeholder.png') }}"
                         class="card-img-top"
                         alt="{{ $program->title }}"
                         data-bs-toggle="modal"
                         data-bs-target="#imageModal"
                         data-img-src="{{ $program->image ? Storage::url($program->image) : asset('assets/img/program/placeholder.png') }}"
                         data-img-alt="{{ $program->title }}">
                    <div class="card-body">
                        <h5 class="card-title text-primary">{{ $program->title }}</h5>
                        <p>{{ $program->description }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    <!-- Modal for Image Preview -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Image Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" class="modal-img" alt="">
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const imageModal = document.getElementById('imageModal');
    imageModal.addEventListener('show.bs.modal', function (event) {
        const img = event.relatedTarget; // The image that triggered the modal
        const imgSrc = img.getAttribute('data-img-src');
        const imgAlt = img.getAttribute('data-img-alt');
        const modalImg = imageModal.querySelector('#modalImage');
        const modalTitle = imageModal.querySelector('#imageModalLabel');

        modalImg.src = imgSrc;
        modalImg.alt = imgAlt;
        modalTitle.textContent = imgAlt || 'Image Preview';
    });
});
</script>
@endsection
