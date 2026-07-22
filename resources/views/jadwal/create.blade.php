@extends('layouts.app')
@section('title', 'Tambah Jadwal')

@section('content')
<div class="row justify-content-center">
<div class="col-md-7">
<div class="card p-4">
    <h4 class="mb-4"><i class="bi bi-calendar-plus"></i> Tambah Jadwal Tayang</h4>
    <form action="/jadwal" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-bold">Film <span class="text-danger">*</span></label>
            <select name="film_id" class="form-select @error('film_id') is-invalid @enderror">
                <option value="">-- Pilih Film --</option>
                @foreach($films as $film)
                <option value="{{ $film->id }}" {{ old('film_id') == $film->id ? 'selected' : '' }}>
                    {{ $film->judul }} ({{ $film->durasi }} menit)
                </option>
                @endforeach
            </select>
            @error('film_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Studio <span class="text-danger">*</span></label>
            <select name="studio_id" class="form-select @error('studio_id') is-invalid @enderror">
                <option value="">-- Pilih Studio --</option>
                @foreach($studios as $studio)
                <option value="{{ $studio->id }}" {{ old('studio_id') == $studio->id ? 'selected' : '' }}>
                    {{ $studio->nama }} ({{ $studio->kapasitas }} kursi)
                </option>
                @endforeach
            </select>
            @error('studio_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Tanggal Tayang <span class="text-danger">*</span></label>
                <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror"
                       value="{{ old('tanggal') }}" min="{{ date('Y-m-d') }}">
                @error('tanggal') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Jam Tayang <span class="text-danger">*</span></label>
                <input type="time" name="jam" class="form-control @error('jam') is-invalid @enderror"
                       value="{{ old('jam') }}">
                @error('jam') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>
        <div class="mb-4">
            <label class="form-label fw-bold">Harga Tiket (Rp) <span class="text-danger">*</span></label>
            <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror"
                   value="{{ old('harga') }}" placeholder="50000" min="1000">
            @error('harga') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary px-4">Simpan Jadwal</button>
            <a href="/jadwal" class="btn btn-outline-secondary px-4">Batal</a>
        </div>
    </form>
</div>
</div>
</div>
@endsection
