@extends('layouts.app')
@section('title', 'Edit Film')

@section('content')
<div class="row justify-content-center">
<div class="col-md-8">
<div class="card p-4">
    <h4 class="mb-4"><i class="bi bi-pencil-square"></i> Edit Film</h4>

    <form action="/film/{{ $film->id }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="mb-3">
            <label class="form-label fw-bold">Judul Film</label>
            <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                   value="{{ old('judul', $film->judul) }}">
            @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Genre</label>
                <input type="text" name="genre" class="form-control" value="{{ old('genre', $film->genre) }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Durasi (menit)</label>
                <input type="number" name="durasi" class="form-control" value="{{ old('durasi', $film->durasi) }}">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="4">{{ old('deskripsi', $film->deskripsi) }}</textarea>
        </div>

        <div class="mb-4">
            <label class="form-label fw-bold">Poster Film</label>
            @if($film->poster)
                <div class="mb-2">
                    <img src="{{ asset('posters/' . $film->poster) }}" style="height:100px;border-radius:8px">
                    <small class="ms-2 text-muted">Poster saat ini</small>
                </div>
            @endif
            <input type="file" name="poster" class="form-control" accept="image/*">
            <small class="text-muted">Kosongkan jika tidak ingin mengubah poster.</small>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
            <a href="/film" class="btn btn-outline-secondary px-4">Batal</a>
        </div>
    </form>
</div>
</div>
</div>
@endsection
