@extends('layouts.app')
@section('title', 'Daftar Akun')

@section('content')
<div class="row justify-content-center">
<div class="col-md-5">
<div class="card p-4">
    <div class="text-center mb-4">
        <h3>Renn.Flixx</h3>
        <p class="text-muted">Buat akun baru</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label fw-bold">Nama Lengkap</label>
            <input type="text" name="name"
                   class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name') }}"
                   placeholder="Contoh: Budi Santoso"
                   required autofocus>
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Email</label>
            <input type="email" name="email"
                   class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}"
                   placeholder="contoh@email.com"
                   required>
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Password</label>
            <input type="password" name="password"
                   class="form-control @error('password') is-invalid @enderror"
                   placeholder="Minimal 8 karakter"
                   required>
            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
            <label class="form-label fw-bold">Konfirmasi Password</label>
            <input type="password" name="password_confirmation"
                   class="form-control"
                   placeholder="Ulangi password"
                   required>
        </div>

        <button type="submit" class="btn btn-dark w-100 mb-3">
            <i class="bi bi-person-plus"></i> Daftar Sekarang
        </button>

        <div class="text-center">
            <small class="text-muted">Sudah punya akun?
                <a href="{{ route('login') }}">Login di sini</a>
            </small>
        </div>
    </form>
</div>
</div>
</div>
@endsection