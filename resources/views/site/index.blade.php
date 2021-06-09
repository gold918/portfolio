@extends('layouts.site')

@section('header')
    @include('site.header.nav-bar')
    @include('site.header.hero')
@endsection

@section('content')
    @include('site.content.about')
    @include('site.content.clients')
    @include('site.content.features')
    @include('site.content.services')
    @include('site.content.cta')
    @include('site.content.portfolio')
    @include('site.content.counts')
    @include('site.content.testimonials')
    @include('site.content.team')
    @include('site.content.contact')
@endsection

@section('footer')
    @include('site.footer.footer')
@endsection
