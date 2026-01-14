@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('style/home.css') }}">
@endpush

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ route('menu.image', ['id' => $product->id_menu]) }}" alt="{{ $product->nama_menu }}" class="cart-product-img">
        </div>
        <div class="col-md-6">
            <h1>{{ $product->nama_menu }}</h1>
            <p class="lead">{{ $product->desc_menu }}</p>
            <h3 class="text-primary">Rp {{ number_format($product->harga_menu, 0, ',', '.') }}</h3>
            <a href="{{ route('add.to.cart', $product->id_menu) }}" class="btn btn-primary btn-lg">Add to Cart</a>
            <a href="{{ route('home') }}" class="btn btn-secondary btn-lg ms-2">Back to Menu</a>
        </div>
    </div>
</div>
@endsection