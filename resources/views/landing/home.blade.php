@extends('layouts.landing.app')

@push('css')

@endpush

@section('content')
    @include('landing.partials.home-product')
    @include('landing.partials.home-testimony')
    @include('landing.partials.home-faq')
    @include('landing.partials.home-blog')
@endsection

@push('js')

@endpush
