@extends('layouts.app')
@section('title', 'Studio')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3><i class="bi bi-building"></i> Manajemen Studio</h3>
    <a href="/studio/create" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Tambah Studio</a>
</div>

<div class="card">
<div class="card-body p-0">
<table class="table table-hover mb-0">
    <thead>
        <tr>
            <th>No</th><th>Nama Studio</th><th>Kapasitas Kursi</th><th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    @forelse($studios as $i => $studio)
        <tr>
            <td>{{ $i+1 }}</td>
            <td><i class="bi bi-building-fill text-primary"></i> {{ $studio->nama }}</td>
            <td><span class="badge bg-info text-dark"><i class="bi bi-people"></i> {{ $studio->kapasitas }} kursi</span></td>
            <td>
                <form action="/studio/{{ $studio->id }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Hapus studio ini? Semua kursi akan terhapus.')">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Hapus</button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="4" class="text-center text-muted py-4">Belum ada studio</td></tr>
    @endforelse
    </tbody>
</table>
</div>
</div>
@endsection
