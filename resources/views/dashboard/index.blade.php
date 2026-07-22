@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<h3 class="mb-4"><i class="bi bi-speedometer2"></i> Dashboard Admin</h3>

<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card p-4 text-center border-0" style="background:linear-gradient(135deg,#667eea,#764ba2);color:white">
            <i class="bi bi-film" style="font-size:2rem"></i>
            <h2 class="my-1 fw-bold">{{ $totalFilm }}</h2>
            <p class="mb-0">Total Film</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-4 text-center border-0" style="background:linear-gradient(135deg,#f093fb,#f5576c);color:white">
            <i class="bi bi-people" style="font-size:2rem"></i>
            <h2 class="my-1 fw-bold">{{ $totalUser }}</h2>
            <p class="mb-0">Total User</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-4 text-center border-0" style="background:linear-gradient(135deg,#4facfe,#00f2fe);color:white">
            <i class="bi bi-ticket-perforated" style="font-size:2rem"></i>
            <h2 class="my-1 fw-bold">{{ $totalPemesanan }}</h2>
            <p class="mb-0">Total Pemesanan</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-4 text-center border-0" style="background:linear-gradient(135deg,#43e97b,#38f9d7);color:white">
            <i class="bi bi-cash-coin" style="font-size:2rem"></i>
            <h2 class="my-1 fw-bold" style="font-size:1.3rem">Rp {{ number_format($totalPendapatan,0,',','.') }}</h2>
            <p class="mb-0">Total Pendapatan</p>
        </div>
    </div>
</div>

<div class="card p-4">
    <h5 class="mb-4"><i class="bi bi-bar-chart"></i> Grafik Pemesanan 6 Bulan Terakhir</h5>
    <canvas id="chartPemesanan" style="max-height:300px"></canvas>
</div>
@endsection

@push('scripts')
<script>
new Chart(document.getElementById('chartPemesanan'), {
    type: 'bar',
    data: {
        labels: @json($bulanLabel),
        datasets: [{
            label: 'Jumlah Pemesanan',
            data: @json($bulanData),
            backgroundColor: 'rgba(102,126,234,0.7)',
            borderColor: 'rgba(102,126,234,1)',
            borderWidth: 1,
            borderRadius: 6
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
    }
});
</script>
@endpush
