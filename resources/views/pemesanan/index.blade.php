@extends('layouts.app')
@section('title', 'Tiket Saya')

@section('content')
<h3 class="mb-4"><i class="bi bi-ticket-perforated"></i> Tiket Saya</h3>

@forelse($pemesanans as $p)
<div class="card mb-3">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h5>{{ $p->jadwal->film->judul }}</h5>
                <p class="text-muted mb-1">
                    <i class="bi bi-building"></i> {{ $p->jadwal->studio->nama }} &nbsp;|&nbsp;
                    <i class="bi bi-calendar3"></i> {{ \Carbon\Carbon::parse($p->jadwal->tanggal)->format('d M Y') }}
                    {{ $p->jadwal->jam }}
                </p>
                <p class="mb-0">
                    <i class="bi bi-ticket"></i> {{ $p->jumlah_tiket }} tiket &nbsp;|&nbsp;
                    <strong>Rp {{ number_format($p->total_harga, 0, ',', '.') }}</strong>
                </p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <div class="badge bg-success mb-2 p-2 fs-6">{{ $p->kode_booking }}</div>
                <br>
                <a href="/pemesanan/{{ $p->id }}" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-eye"></i> Detail
                </a>
                <form action="/pemesanan/{{ $p->id }}" method="POST"
              onsubmit="return confirm('Yakin ingin membatalkan tiket ini? kursi akan tersedia kembali.')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger btn-sm">
                <i class="bi bi-x-circle"></i> Batalkan
            </button>
                </form>
            </div>
        </div>
    </div>
</div>
@empty
<div class="text-center py-5 text-muted">
    <i class="bi bi-ticket-perforated" style="font-size:3rem"></i>
    <p class="mt-2">Belum ada pemesanan. <a href="/">Cari film sekarang</a></p>
</div>
@endforelse
@endsection
