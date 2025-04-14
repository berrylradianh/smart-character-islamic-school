@extends('layouts.dashboard.app')

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Informasi Pendaftaran</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">SCIS</li>
                            <li class="breadcrumb-item">PPDB</li>
                            <li class="breadcrumb-item active">Informasi Pendaftaran</li>
                        </ol>
                    </div>
                </div>
            </div>

            <!-- Filter Buttons -->
            <div class="row mb-3">
                <div class="col-12">
                    <div class="btn-group" role="group" aria-label="Filter Jenjang">
                        <button type="button" class="btn btn-primary filter-btn" data-filter="all">All</button>
                        @foreach ($levels as $level)
                            <button type="button" class="btn btn-secondary filter-btn" data-filter="{{ $level->slug }}">{{ $level->name }}</button>
                        @endforeach
                    </div>
                </div>
            </div>

            <div id="registration-info">
                @foreach ($levels as $level)
                    @if (isset($registrationInfos[$level->slug]))
                        <div class="row registration-section" data-jenjang="{{ $level->slug }}">
                            <div class="col-12">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <h4 class="mt-0 header-title">{{ $level->name }}</h4>
                                        <p class="sub-title">Informasi pendaftaran untuk jenjang {{ $level->name }}.</p>

                                        <div class="registration-content">
                                            <h5>Persyaratan</h5>
                                            <ul>
                                                @foreach ($registrationInfos[$level->slug]->requirements as $req)
                                                    <li>{{ $req }}</li>
                                                @endforeach
                                            </ul>

                                            <h5>Tahapan Pendaftaran</h5>
                                            <ol>
                                                @foreach ($registrationInfos[$level->slug]->stages as $stage)
                                                    <li>{{ $stage }}</li>
                                                @endforeach
                                            </ol>

                                            <h5>Biaya</h5>
                                            <ul>
                                                @foreach ($registrationInfos[$level->slug]->fees as $fee)
                                                    <li>{{ $fee }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <footer class="footer">
        © SCIS, 2024. All Right Reserved
    </footer>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('.filter-btn');
        const sections = document.querySelectorAll('.registration-section');

        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                const filter = this.getAttribute('data-filter');

                // Toggle active class on buttons
                filterButtons.forEach(btn => btn.classList.remove('btn-primary'));
                filterButtons.forEach(btn => btn.classList.add('btn-secondary'));
                this.classList.remove('btn-secondary');
                this.classList.add('btn-primary');

                // Show/hide sections based on filter
                sections.forEach(section => {
                    const jenjang = section.getAttribute('data-jenjang');
                    if (filter === 'all' || jenjang === filter) {
                        section.style.display = 'block';
                    } else {
                        section.style.display = 'none';
                    }
                });
            });
        });

        // Default: Show all sections
        sections.forEach(section => section.style.display = 'block');
        filterButtons[0].classList.remove('btn-secondary');
        filterButtons[0].classList.add('btn-primary');
    });
</script>
@endsection
