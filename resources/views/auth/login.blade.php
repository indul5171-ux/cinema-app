@extends('layouts.app')
@section('title', 'Login')

@section('content')
<div class="row justify-content-center">
<div class="col-md-5">
<div class="card p-4">
    <div class="text-center mb-4">
        <h3>Renn.Flixx</h3>
        <p class="text-muted">Masuk ke akun kamu</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-bold">Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" placeholder="admin@bioskop.com" required autofocus>
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Password</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                   placeholder="••••••••" required>
            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="remember" class="form-check-input" id="remember">
            <label class="form-check-label" for="remember">Ingat saya</label>
        </div>

        <button type="submit" class="btn btn-dark w-100 mb-3">
            <i class="bi bi-box-arrow-in-right"></i> Login
        </button>

        <div class="text-center">
            <small class="text-muted">Belum punya akun?
                <a href="{{ route('register') }}">Daftar sekarang</a>
            </small>
        </div>
    </form>
</div>
</div>
</div>
@endsection