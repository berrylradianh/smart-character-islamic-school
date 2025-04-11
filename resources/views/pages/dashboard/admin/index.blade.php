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
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">SCIS</li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach ($stats as $stat)
                <div class="col-sm-6 col-xl-3">
                    <div class="card">
                        <div class="card-heading p-4">
                            <div class="mini-stat-icon float-right" @if($stat->color) style="background-color: {{ $stat->color }}; border-radius: 50%; width: 60px; height: 60px; display: flex; justify-content: center; align-items: center;" @else style="background-color: #3b82f6; border-radius: 50%; width: 60px; height: 60px; display: flex; justify-content: center; align-items: center;" @endif>
                                <img src="{{ $stat->icon ? asset('storage/' . $stat->icon) : asset('dashboard/assets/images/default.png') }}" alt="{{ $stat->name }}" style="width: 34px; height: 34px;">
                            </div>
                            <div>
                                <h5 class="font-16">{{ $stat->name }}</h5>
                            </div>
                            <h3 class="mt-4">{{ number_format($stat->value, 0, ',', '.') }}</h3>
                            <div class="progress mt-4" style="height: 4px;">
                                <div class="progress-bar bg-{{ $stat->name == 'Staff' ? 'primary' : ($stat->name == 'Peserta Didik' ? 'success' : ($stat->name == 'Alumni' ? 'warning' : 'danger')) }}" role="progressbar" style="width: {{ $stat->previous_period_percentage }}%" aria-valuenow="{{ $stat->previous_period_percentage }}" ಎ aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="text-muted mt-2 mb-0">Previous period<span class="float-right">{{ $stat->previous_period_percentage }}%</span></p>
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
@endsection
