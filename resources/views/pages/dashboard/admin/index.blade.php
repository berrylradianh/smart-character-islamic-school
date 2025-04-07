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
                <div class="col-sm-6 col-xl-3">
                    <div class="card">
                        <div class="card-heading p-4">
                            <div class="mini-stat-icon float-right" style="background-color: #3b82f6; border-radius: 50%; width: 60px; height: 60px; display: flex; justify-content: center; align-items: center;">
                                <img src="{{asset('dashboard/assets/images/staff.png')}}" alt="Staff" style="width: 34px; height: 34px;">
                            </div>
                            <div>
                                <h5 class="font-16">Staff</h5>
                            </div>
                            <h3 class="mt-4">43,225</h3>
                            <div class="progress mt-4" style="height: 4px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="text-muted mt-2 mb-0">Previous period<span class="float-right">75%</span></p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="card">
                        <div class="card-heading p-4">
                            <div class="mini-stat-icon float-right" style="background-color:rgb(25, 194, 22); border-radius: 50%; width: 60px; height: 60px; display: flex; justify-content: center; align-items: center;">
                                <img src="{{asset('dashboard/assets/images/student.png')}}" alt="Student" style="width: 34px; height: 34px;">
                            </div>
                            <div>
                                <h5 class="font-16">Peserta Didik</h5>
                            </div>
                            <h3 class="mt-4">73,265</h3>
                            <div class="progress mt-4" style="height: 4px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 88%" aria-valuenow="88" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="text-muted mt-2 mb-0">Previous period<span class="float-right">88%</span></p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="card">
                        <div class="card-heading p-4">
                            <div class="mini-stat-icon float-right" style="background-color:rgb(200, 200, 11); border-radius: 50%; width: 60px; height: 60px; display: flex; justify-content: center; align-items: center;">
                                <img src="{{asset('dashboard/assets/images/alumni.png')}}" alt="Student" style="width: 34px; height: 34px;">
                            </div>
                            <div>
                                <h5 class="font-16">Alumni</h5>
                            </div>
                            <h3 class="mt-4">447</h3>
                            <div class="progress mt-4" style="height: 4px;">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 68%" aria-valuenow="68" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="text-muted mt-2 mb-0">Previous period<span class="float-right">68%</span></p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="card">
                        <div class="card-heading p-4">
                            <div class="mini-stat-icon float-right" style="background-color:rgb(194, 22, 22); border-radius: 50%; width: 60px; height: 60px; display: flex; justify-content: center; align-items: center;">
                                <img src="{{asset('dashboard/assets/images/pendaftar.png')}}" alt="Student" style="width: 34px; height: 34px;">
                            </div>
                            <div>
                                <h5 class="font-16">Pendaftar</h5>
                            </div>
                            <h3 class="mt-4">86%</h3>
                            <div class="progress mt-4" style="height: 4px;">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 82%" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="text-muted mt-2 mb-0">Previous period<span class="float-right">82%</span></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <footer class="footer">
        © SCIS, 2024. All Right Reserved
    </footer>

</div>
@endsection
