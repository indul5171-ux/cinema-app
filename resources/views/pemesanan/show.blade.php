@extends('layouts.app')
@section('title', 'Detail Tiket')

@section('content')
<div class="row justify-content-center">
<div class="col-md-7">
<div class="card p-4 text-center">
    <div class="mb-3">
        <i class="bi bi-patch-check-fill text-success" style="font-size:3rem"></i>
    </div>
    <h4 class="text-success">Pemesanan Berhasil!</h4>
    <div class="border rounded p-3 my-3 bg-light">
        <p class="text-muted small mb-1">Kode Booking</p>
        <h2 class="fw-bold text-primary">{{ $pemesanan->kode_booking }}</h2>
    </div>
    <table class="table text-start">
        <tr><td class="text-muted">Film</td><td><strong>{{ $pemesanan->jadwal->film->judul }}</strong></td></tr>
        <tr><td class="text-muted">Studio</td><td>{{ $pemesanan->jadwal->studio->nama }}</td></tr>
        <tr><td class="text-muted">Tanggal</td><td>{{ \Carbon\Carbon::parse($pemesanan->jadwal->tanggal)->format('d M Y') }}</td></tr>
        <tr><td class="text-muted">Jam</td><td>{{ $pemesanan->jadwal->jam }}</td></tr>
        <tr><td class="text-muted">Jumlah Tiket</td><td>{{ $pemesanan->jumlah_tiket }} kursi</td></tr>
        <tr><td class="text-muted">Total Bayar</td><td><strong class="text-success">Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</strong></td></tr>
        <tr><td class="text-muted">Pemesan</td><td>{{ $pemesanan->user->name }}</td></tr>
    </table>
    <div class="d-flex gap-2 justify-content-center mt-2">
        <a href="/pemesanan" class="btn btn-outline-primary"><i class="bi bi-list"></i> Tiket Saya</a>
        <a href="/" class="btn btn-primary"><i class="bi bi-house"></i> Beranda</a>
    </div>
</div>
</div>
</div>
@endsection
