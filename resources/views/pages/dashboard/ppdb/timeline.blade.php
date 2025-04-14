@extends('layouts.dashboard.app')

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Timeline Pendaftaran Seleksi Sekolah</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">SCIS</li>
                            <li class="breadcrumb-item">PPDB</li>
                            <li class="breadcrumb-item active">Timeline</li>
                        </ol>
                    </div>
                </div>
            </div>

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

            <div class="row">
                @foreach ($levels as $level)
                    @if ($level->timelines->isNotEmpty())
                        <div class="col-lg-12 timeline-card" data-category="{{ $level->slug }}">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Timeline {{ $level->name }}</h5>
                                    <section class="cd-container">
                                        <div class="main-timeline">
                                            @foreach ($level->timelines as $timeline)
                                                <div class="timeline">
                                                    <span class="timeline-icon"></span>
                                                    <span class="year">{{ $timeline->date_range }}</span>
                                                    <div class="timeline-content">
                                                        <h3 class="title">{{ $timeline->title }}</h3>
                                                        <p class="description text-muted">
                                                            {{ $timeline->description }}
                                                        </p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </section>
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
        const timelineCards = document.querySelectorAll('.timeline-card');

        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                const filter = this.getAttribute('data-filter');

                // Toggle active class on buttons
                filterButtons.forEach(btn => btn.classList.remove('btn-primary'));
                filterButtons.forEach(btn => btn.classList.add('btn-secondary'));
                this.classList.remove('btn-secondary');
                this.classList.add('btn-primary');

                // Show/hide cards based on filter
                timelineCards.forEach(card => {
                    const category = card.getAttribute('data-category');
                    if (filter === 'all' || category === filter) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });

        // Default: Show all cards
        timelineCards.forEach(card => card.style.display = 'block');
        filterButtons[0].classList.remove('btn-secondary');
        filterButtons[0].classList.add('btn-primary');
    });
</script>
@endsection
