@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('style/home.css') }}">
@endpush
@if(session('flash'))
    <div id="flash-message" class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('flash') }}
    </div>
@endif

<script>
    // otomatis hilang setelah 3 detik
    setTimeout(() => {
        let flash = document.getElementById('flash-message');
        if (flash) {
            flash.classList.remove('show'); // Bootstrap fade out
        }
    }, 3000);
</script>

@section('content')

@include('partials.hero')
@include('partials.menu')
@include('partials.testimoni')
@include('partials.aboutus')
@include('partials.ads')

@endsection
