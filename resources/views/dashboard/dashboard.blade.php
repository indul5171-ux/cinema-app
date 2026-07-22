@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row g-4">

        <div class="col-md-4">
            <div class="card shadow p-4">
                <h5>Total Film</h5>
                <h2>{{ $film }}</h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow p-4">
                <h5>Total User</h5>
                <h2>{{ $user }}</h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow p-4">
                <h5>Total Pemesanan</h5>
                <h2>{{ $pemesanan }}</h2>
            </div>
        </div>

    </div>

    <canvas id="chartPenjualan"></canvas>

</div>

@endsection