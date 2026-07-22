@extends('layouts.app')
@section('title', 'Tambah Studio')

@section('content')
<div class="row justify-content-center">
<div class="col-md-6">
<div class="card p-4">
    <h4 class="mb-4"><i class="bi bi-building-add"></i> Tambah Studio Baru</h4>
    <form action="/studio" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-bold">Nama Studio <span class="text-danger">*</span></label>
            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                   value="{{ old('nama') }}" placeholder="Contoh: Studio 1">
            @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-4">
            <label class="form-label fw-bold">Kapasitas Kursi <span class="text-danger">*</span></label>
            <input type="number" name="kapasitas" class="form-control @error('kapasitas') is-invalid @enderror"
                   value="{{ old('kapasitas') }}" placeholder="50" min="1" max="200">
            @error('kapasitas') <div class="invalid-feedback">{{ $message }}</div> @enderror
            <small class="text-muted">Kursi akan dibuat otomatis (A1, A2, ..., B1, B2, ...)</small>
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary px-4">Buat Studio</button>
            <a href="/studio" class="btn btn-outline-secondary px-4">Batal</a>
        </div>
    </form>
</div>
</div>
</div>
@endsection
