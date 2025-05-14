@php
    use Illuminate\Support\Facades\Storage;
@endphp

@extends('layouts.app')

@section('content')
<section class="program-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Program Kami</h2>
            <hr class="w-25 mx-auto border-dark">
        </div>

        @if ($programs->isEmpty())
            <div class="text-center">
                <p>No programs available at the moment. Please check back later!</p>
            </div>
        @else
            <div class="row">
                @foreach ($programs as $program)
                    <div class="col-md-6 mb-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <img src="{{ $program->image ? Storage::url($program->image) : asset('assets/img/program/placeholder.png') }}" class="card-img-top" alt="{{ $program->title }}">
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
</section>
@endsection
