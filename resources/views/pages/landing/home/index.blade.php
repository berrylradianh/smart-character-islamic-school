@extends('layouts.app')

@section('content')

    @include('pages.landing.home.hero', ['heroes' => $heroes])
    @include('pages.landing.home.introduction')
    @include('pages.landing.home.values')
    @include('pages.landing.home.resource')
    @include('pages.landing.home.programs')
    @include('pages.landing.home.news', ['news' => $news])
    @include('pages.landing.home.agenda', ['agendas' => $agendas])
    @include('pages.landing.home.testimonials')
    @include('pages.landing.home.media')

@endsection
