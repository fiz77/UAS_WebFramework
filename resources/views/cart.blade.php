@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('style/cart.css') }}">
@endpush

@section('content')

@include('partials.cart.index_cart')

@endsection
