@extends('layouts.app')
@section('title', 'Jadwal Tayang')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3><i class="bi bi-calendar3"></i> Jadwal Tayang</h3>
    <a href="/jadwal/create" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Tambah Jadwal</a>
</div>

<div class="card">
<div class="card-body p-0">
<table class="table table-hover mb-0">
    <thead>
        <tr><th>Film</th><th>Studio</th><th>Tanggal</th><th>Jam</th><th>Harga</th><th>Aksi</th></tr>
    </thead>
    <tbody>
    @forelse($jadwals as $jadwal)
        <tr>
            <td><strong>{{ $jadwal->film->judul }}</strong><br><small class="text-muted">{{ $jadwal->film->genre }}</small></td>
            <td>{{ $jadwal->studio->nama }}</td>
            <td>{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d M Y') }}</td>
            <td><span class="badge bg-secondary">{{ $jadwal->jam }}</span></td>
            <td>Rp {{ number_format($jadwal->harga, 0, ',', '.') }}</td>
            <td>
                <a href="{{ route('pemesanan.create', ['jadwal_id' => $jadwal->id]) }}" class="btn btn-success btn-sm">
                    <i class="bi bi-ticket"></i> Pesan
                </a>
                <form action="/jadwal/{{ $jadwal->id }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Hapus jadwal ini?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="6" class="text-center text-muted py-4">Belum ada jadwal</td></tr>
    @endforelse
    </tbody>
</table>
</div>
</div>
@endsection
