@extends('layouts.app')
@section('title', 'Daftar Film')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3><i class="bi bi-film"></i> Daftar Film</h3>
    @auth
    <a href="/film/create" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Tambah Film</a>
    @endauth
</div>

<div class="row g-4">
@forelse($films as $film)
    <div class="col-md-4">
        <div class="card h-100">
            @if($film->poster)
                <img src="{{ asset('posters/' . $film->poster) }}" class="card-img-top" 
     style="height:280px; object-fit:contain; background-color:#000000;" 
     alt="{{ $film->judul }}">
            @else
                <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" style="height:220px">
                    <i class="bi bi-film text-white" style="font-size:3rem"></i>
                </div>
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ $film->judul }}</h5>
                <p class="mb-1"><span class="badge-genre">{{ $film->genre }}</span></p>
                <p class="text-muted small mt-2"><i class="bi bi-clock"></i> {{ $film->durasi }} menit</p>
                <p class="card-text small">{{ Str::limit($film->deskripsi, 100) }}</p>
            </div>
            <div class="card-footer bg-transparent">
                <div class="d-flex gap-2">
                    <a href="{{ route('pemesanan.create', ['jadwal_id' => $film->jadwals->first()?->id]) }}"
                       class="btn btn-success btn-sm flex-fill"
                       @if(!$film->jadwals->count()) disabled @endif>
                        <i class="bi bi-ticket"></i> Pesan Tiket
                    </a>
                    @auth
                    <a href="/film/{{ $film->id }}/edit" class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil"></i></a>
                    <form action="/film/{{ $film->id }}" method="POST" onsubmit="return confirm('Hapus film ini?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i></button>
                    </form>
                    @endauth
                </div>
            </div>
        </div>
    </div>
@empty
    <div class="col-12 text-center py-5 text-muted">
        <i class="bi bi-film" style="font-size:3rem"></i>
        <p class="mt-2">Belum ada film. <a href="/film/create">Tambah sekarang</a></p>
    </div>
@endforelse
</div>
@endsection
