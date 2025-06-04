@php
use Illuminate\Support\Facades\Storage;
@endphp

@extends('layouts.app')

@section('content')
<style>
    .poster-placeholder img {
        max-width: 100%;
        max-height: 550px;
        width: 100%;
        height: auto;
        object-fit: contain;
    }

    .vision-mission-section {
        background-color: #f8f9fa;
        padding: 60px 0;
    }

    .section-title {
        font-size: 2.5rem;
        font-weight: bold;
        color: #333;
    }

    .vision-title,
    .mission-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #007bff;
        margin-bottom: 15px;
    }

    .vision-text,
    .mission-text {
        font-size: 1.1rem;
        color: #555;
    }

    .mission-text {
        padding-left: 20px;
    }

    .mission-text li {
        margin-bottom: 10px;
    }

    .poster-placeholder {
        width: 100%;
        height: 100%;
    }

    .placeholder-box {
        border: 2px dashed #ccc;
        padding: 20px;
        border-radius: 10px;
        background-color: #fff;
        min-height: 300px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        color: #888;
    }

    .commitment-box {
        background-color: #f5f5f5;
        padding: 20px;
        border-radius: 10px;
        border-left: 5px solid #f4a261;
        display: inline-block;
    }

    .commitment-text {
        font-size: 1.2rem;
        font-style: italic;
        color: #333;
        margin: 0;
    }
</style>
<section class="vision-mission-section py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-6 col-md-12 mb-4">
                <h2 class="section-title mb-4">Visi Misi {{ $vision->title ?? 'Smart Character Islamic School' }}</h2>

                <div class="vision-box mb-4">
                    <h4 class="vision-title"><i class="fas fa-eye me-2"></i> Visi</h4>
                    <p class="vision-text">
                        {{ $vision->vision_text }}
                    </p>
                </div>

                <div class="mission-box">
                    <h4 class="mission-title"><i class="fas fa-bullseye me-2"></i> Misi</h4>
                    <ul class="mission-text">
                        @foreach ($vision->mission_items as $mission)
                        <li>{{ $mission }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 mb-4 d-flex align-items-center justify-content-center">
                <div class="poster-placeholder text-center">
                    @if ($vision->poster_image)
                    <img src="{{ Storage::url($vision->poster_image) }}" alt="Poster Visi dan Misi" class="img-fluid">
                    @else
                    <img src="{{ asset('assets/img/visi dan misi.png') }}" alt="Poster Visi dan Misi" class="img-fluid">
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 text-center">
                <div class="commitment-box">
                    <p class="commitment-text">
                        {{ $vision->commitment_text }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
