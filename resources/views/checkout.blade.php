@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Checkout</h2>
    @if(session('flash'))
        <div class="alert alert-info">{{ session('flash') }}</div>
    @endif
    <form method="POST" action="{{ route('checkout') }}">
        @csrf
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Penerima</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="mb-3">
            <label for="no_hp" class="form-label">No HP</label>
            <input type="text" class="form-control" id="no_hp" name="no_hp" required>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat Lengkap</label>
            <textarea class="form-control" id="alamat" name="alamat" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Pesan Sekarang</button>
    </form>
</div>
@endsection

