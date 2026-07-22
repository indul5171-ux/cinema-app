@extends('layouts.app')
@section('title', 'Tambah Film')

@section('content')
<div class="row justify-content-center">
<div class="col-md-8">
<div class="card p-4">
    <h4 class="mb-4"><i class="bi bi-plus-circle"></i> Tambah Film Baru</h4>

    <form action="/film" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label fw-bold">Judul Film <span class="text-danger">*</span></label>
            <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                   value="{{ old('judul') }}" placeholder="Contoh: Avengers Endgame">
            @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Genre <span class="text-danger">*</span></label>
                <input type="text" name="genre" class="form-control @error('genre') is-invalid @enderror"
                       value="{{ old('genre') }}" placeholder="Action, Drama, dll">
                @error('genre') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Durasi (menit) <span class="text-danger">*</span></label>
                <input type="number" name="durasi" class="form-control @error('durasi') is-invalid @enderror"
                       value="{{ old('durasi') }}" placeholder="120">
                @error('durasi') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Deskripsi <span class="text-danger">*</span></label>
            <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror"
                      rows="4" placeholder="Sinopsis film...">{{ old('deskripsi') }}</textarea>
            @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
            <label class="form-label fw-bold">Poster Film (opsional)</label>
            <input type="file" name="poster" class="form-control" accept="image/*">
            <small class="text-muted">Format: JPG, PNG, WEBP. Maks 2MB.</small>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary px-4"><i class="bi bi-check-lg"></i> Simpan</button>
            <a href="/film" class="btn btn-outline-secondary px-4">Batal</a>
        </div>
    </form>
</div>
</div>
</div>
@endsection
