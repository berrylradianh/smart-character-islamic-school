@php
    use Illuminate\Support\Facades\Storage;
@endphp

@extends('layouts.app')

@section('content')
<section class="profile-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h2 class="text-center mb-4">{{ $profile->title }}</h2>
                <div class="text-center mb-5">
                    <img src="{{ $profile->image ? Storage::url($profile->image) : asset('assets/img/program/program-1.png') }}" alt="SCIS Campus" class="img-fluid rounded" style="max-width: 100%; height: auto;">
                </div>
                <p class="text-center mb-5">
                    {{ $profile->title }}
                </p>

                <div class="profile-content">
                    <h4>Apa itu {{ $profile->title }}?</h4>
                    <p>
                        {!! $profile->content !!}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
