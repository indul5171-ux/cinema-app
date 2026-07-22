@extends('layouts.app')
@section('title', 'Beranda')

@section('content')

{{-- ===== HERO SECTION ===== --}}
<div class="hero-section mb-5" style="
    background: linear-gradient(135deg, #1a0a0a 0%, #0f0f13 50%, #0a0a1a 100%);
    border-radius: 16px;
    padding: 60px 40px;
    border: 1px solid #2a2a3a;
    position: relative;
    overflow: hidden;">

    {{-- Background dekorasi --}}
    <div style="position:absolute; top:-50px; right:-50px; width:300px; height:300px;
                background: radial-gradient(circle, rgba(230,57,70,0.15) 0%, transparent 70%);
                border-radius: 50%;"></div>

    <div class="row align-items-center">
        <div class="col-md-7">
            <p class="text-danger small fw-bold mb-2" style="letter-spacing:2px;">
                🎬 SELAMAT DATANG DI RENN.FLIX
            </p>
            <h1 class="text-white fw-bold mb-3" style="font-size:2.5rem; line-height:1.2;">
                Nonton Film Favoritmu <br>
                <span style="color:#E63946;">Kapan Saja, Di Mana Saja</span>
            </h1>
            <p class="mb-4" style="color:#999; font-size:1rem; max-width:480px;">
                Temukan film terbaru, pilih kursi favoritmu, dan nikmati pengalaman bioskop terbaik bersama Renn.Flix Premium.
            </p>
            <div class="d-flex gap-3 flex-wrap">
                <a href="/film" class="btn btn-danger px-4 py-2 fw-bold">
                    <i class="bi bi-play-circle"></i> Lihat Semua Film
                </a>
                @auth
                <a href="/jadwal" class="btn btn-outline-light px-4 py-2">
                    <i class="bi bi-calendar3"></i> Jadwal Tayang
                </a>
                @else
                <a href="{{ route('register') }}" class="btn btn-outline-light px-4 py-2">
                    <i class="bi bi-person-plus"></i> Daftar Gratis
                </a>
                @endauth
            </div>
        </div>
        <div class="col-md-5 text-center mt-4 mt-md-0">
            @if($filmUtama && $filmUtama->poster)
                <img src="{{ asset('posters/' . $filmUtama->poster) }}"
                     style="height:280px; object-fit:contain; border-radius:12px;
                            box-shadow: 0 20px 60px rgba(230,57,70,0.3);"
                     alt="{{ $filmUtama->judul }}">
                <p class="text-muted small mt-2">
                    <i class="bi bi-star-fill text-warning"></i> Film Terbaru
                </p>
            @else
                <div style="height:280px; background:#1a1a24; border-radius:12px;
                            display:flex; align-items:center; justify-content:center;
                            border: 1px dashed #333;">
                    <i class="bi bi-film text-secondary" style="font-size:4rem"></i>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- ===== STATS SECTION ===== --}}
<div class="row g-3 mb-5">
    <div class="col-6 col-md-3">
        <div class="text-center p-3" style="background:#1a1a24; border-radius:12px; border:1px solid #2a2a3a;">
            <div style="font-size:1.8rem; font-weight:800; color:#E63946;">{{ $films->count() }}</div>
            <div style="color:#888; font-size:0.82rem;">Total Film</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="text-center p-3" style="background:#1a1a24; border-radius:12px; border:1px solid #2a2a3a;">
            <div style="font-size:1.8rem; font-weight:800; color:#E63946;">{{ $jadwals->count() }}</div>
            <div style="color:#888; font-size:0.82rem;">Jadwal Tersedia</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="text-center p-3" style="background:#1a1a24; border-radius:12px; border:1px solid #2a2a3a;">
            <div style="font-size:1.8rem; font-weight:800; color:#E63946;">2</div>
            <div style="color:#888; font-size:0.82rem;">Studio Aktif</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="text-center p-3" style="background:#1a1a24; border-radius:12px; border:1px solid #2a2a3a;">
            <div style="font-size:1.8rem; font-weight:800; color:#E63946;">24/7</div>
            <div style="color:#888; font-size:0.82rem;">Layanan Aktif</div>
        </div>
    </div>
</div>

{{-- ===== JADWAL TAYANG ===== --}}
@if($jadwals->count() > 0)
<div class="mb-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <p class="text-danger small fw-bold mb-0" style="letter-spacing:2px;">🗓 COMING UP</p>
            <h4 class="text-white fw-bold mb-0">Jadwal Tayang Terdekat</h4>
        </div>
        <a href="/jadwal" class="btn btn-outline-danger btn-sm">Lihat Semua</a>
    </div>

    <div class="row g-3">
        @foreach($jadwals as $jadwal)
        <div class="col-md-4">
            <div style="background:#1a1a24; border-radius:12px; border:1px solid #2a2a3a; padding:16px;">
                <div class="d-flex gap-3 align-items-center">

                    {{-- Poster kecil --}}
                    @if($jadwal->film->poster)
                        <img src="{{ asset('posters/' . $jadwal->film->poster) }}"
                             style="width:55px; height:75px; object-fit:cover;
                                    border-radius:8px; flex-shrink:0;"
                             alt="{{ $jadwal->film->judul }}">
                    @else
                        <div style="width:55px; height:75px; background:#12121a;
                                    border-radius:8px; display:flex; align-items:center;
                                    justify-content:center; flex-shrink:0;">
                            <i class="bi bi-film text-secondary"></i>
                        </div>
                    @endif

                    {{-- Info --}}
                    <div class="flex-fill">
                        <div class="text-white fw-bold" style="font-size:0.9rem;">
                            {{ $jadwal->film->judul }}
                        </div>
                        <div class="text-muted small">
                            <i class="bi bi-building"></i> {{ $jadwal->studio->nama }}
                        </div>
                        <div class="text-muted small">
                            <i class="bi bi-calendar3"></i>
                            {{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d M Y') }}
                            · {{ substr($jadwal->jam, 0, 5) }}
                        </div>
                        <div class="mt-2 d-flex justify-content-between align-items-center">
                            <span style="color:#E63946; font-weight:700; font-size:0.85rem;">
                                Rp {{ number_format($jadwal->harga, 0, ',', '.') }}
                            </span>
                            @auth
                            <a href="{{ route('pemesanan.create', ['jadwal_id' => $jadwal->id]) }}"
                               class="btn btn-danger btn-sm" style="font-size:0.75rem; padding:3px 10px;">
                                Pesan
                            </a>
                            @else
                            <a href="{{ route('login') }}"
                               class="btn btn-danger btn-sm" style="font-size:0.75rem; padding:3px 10px;">
                                Pesan
                            </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

{{-- ===== FILM PILIHAN ===== --}}
<div class="mb-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <p class="text-danger small fw-bold mb-0" style="letter-spacing:2px;">🎬 NOW SHOWING</p>
            <h4 class="text-white fw-bold mb-0">Film Pilihan</h4>
        </div>
        <a href="/film" class="btn btn-outline-danger btn-sm">Lihat Semua</a>
    </div>

    <div class="row g-3">
        @foreach($films->take(3) as $film)
        <div class="col-md-4">
            <div style="background:#1a1a24; border-radius:12px; border:1px solid #2a2a3a; overflow:hidden;">
                @if($film->poster)
                    <img src="{{ asset('posters/' . $film->poster) }}"
                         style="width:100%; height:220px; object-fit:cover;"
                         alt="{{ $film->judul }}">
                @else
                    <div style="height:220px; background:#12121a; display:flex;
                                align-items:center; justify-content:center;">
                        <i class="bi bi-film text-secondary" style="font-size:3rem"></i>
                    </div>
                @endif
                <div style="padding:14px;">
                    <div class="d-flex justify-content-between align-items-start mb-1">
                        <span class="text-white fw-bold" style="font-size:0.95rem;">
                            {{ $film->judul }}
                        </span>
                        <span class="badge bg-danger ms-2" style="font-size:0.7rem;">
                            {{ $film->genre }}
                        </span>
                    </div>
                    <p class="text-muted small mb-2">
                        <i class="bi bi-clock"></i> {{ $film->durasi }} menit
                    </p>
                    @if($film->jadwals->count() > 0)
                        <a href="{{ route('pemesanan.create', ['jadwal_id' => $film->jadwals->first()->id]) }}"
                           class="btn btn-danger btn-sm w-100">
                            <i class="bi bi-ticket-perforated"></i> Pesan Tiket
                        </a>
                    @else
                        <button class="btn btn-secondary btn-sm w-100" disabled>
                            Belum Ada Jadwal
                        </button>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- ===== CTA SECTION (kalau belum login) ===== --}}
@guest
<div class="text-center py-5 mt-4" style="background:#1a1a24; border-radius:16px; border:1px solid #2a2a3a;">
    <i class="bi bi-ticket-perforated" style="font-size:3rem; color:#E63946;"></i>
    <h4 class="text-white fw-bold mt-3">Siap Memesan Tiket?</h4>
    <p class="text-muted mb-4">Daftar sekarang dan nikmati kemudahan memesan tiket bioskop online!</p>
    <div class="d-flex gap-3 justify-content-center">
        <a href="{{ route('register') }}" class="btn btn-danger px-4">
            <i class="bi bi-person-plus"></i> Daftar Sekarang
        </a>
        <a href="{{ route('login') }}" class="btn btn-outline-light px-4">
            <i class="bi bi-box-arrow-in-right"></i> Login
        </a>
    </div>
</div>
@endguest

@endsection