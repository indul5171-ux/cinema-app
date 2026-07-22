@extends('layouts.app')
@section('title', 'Pesan Tiket')

@section('content')
<div class="row justify-content-center">
<div class="col-md-10">
    <div class="card p-4 mb-4">
        <h4 class="mb-3"><i class="bi bi-ticket-perforated"></i> Pemesanan Tiket</h4>
        <div class="row">
            <div class="col-md-6">
                <p><strong><i class="bi bi-film"></i> Film:</strong> {{ $jadwal->film->judul }}</p>
                <p><strong><i class="bi bi-building"></i> Studio:</strong> {{ $jadwal->studio->nama }}</p>
            </div>
            <div class="col-md-6">
                <p><strong><i class="bi bi-calendar3"></i> Tanggal:</strong>
                    {{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d M Y') }}</p>
                <p><strong><i class="bi bi-clock"></i> Jam:</strong> {{ $jadwal->jam }}</p>
                <p><strong><i class="bi bi-tag"></i> Harga per kursi:</strong>
                    <span class="text-success fw-bold">Rp {{ number_format($jadwal->harga, 0, ',', '.') }}</span></p>
            </div>
        </div>
    </div>

    <form action="/pemesanan" method="POST" id="form-pesan">
        @csrf
        <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">

        <div class="card p-4">
            <h5 class="mb-3"><i class="bi bi-grid"></i> Pilih Kursi</h5>
            <div class="mb-3 p-3 bg-light rounded d-flex gap-3 align-items-center">
                <span><span class="badge bg-success px-3">&nbsp;</span> Tersedia</span>
                <span><span class="badge bg-danger px-3">&nbsp;</span> Sudah Dipesan</span>
                <span><span class="badge bg-primary px-3">&nbsp;</span> Dipilih</span>
            </div>

            <div class="d-flex flex-wrap gap-2 mb-4">
                @foreach($seats as $seat)
                    @if($seat->status === 'booked')
                        <button type="button"
                            class="btn btn-danger btn-sm"
                            style="width:58px;font-size:.75rem"
                            disabled>
                            {{ $seat->kode_kursi }}
                        </button>
                    @else
                        <button type="button"
                            class="btn btn-outline-success btn-sm kursi-btn"
                            style="width:58px;font-size:.75rem"
                            data-seat-id="{{ $seat->id }}"
                            data-selected="0">
                            {{ $seat->kode_kursi }}
                        </button>
                    @endif
                @endforeach
            </div>

            {{-- Hidden inputs untuk seat_ids akan diisi oleh JS --}}
            <div id="seat-inputs"></div>

            <div class="alert alert-info">
                <strong>Total Dipilih: <span id="jumlah-kursi">0</span> kursi</strong> |
                Total Harga: <strong>Rp <span id="total-harga">0</span></strong>
            </div>

            <button type="submit" class="btn btn-success btn-lg w-100" id="btn-pesan" disabled>
                <i class="bi bi-cart-check"></i> Pesan Sekarang
            </button>
        </div>
    </form>
</div>
</div>
@endsection

@push('scripts')
<script>
const hargaPerKursi = {{ $jadwal->harga }};
const jumlahEl      = document.getElementById('jumlah-kursi');
const totalEl       = document.getElementById('total-harga');
const btnPesan      = document.getElementById('btn-pesan');
const seatInputs    = document.getElementById('seat-inputs');

document.querySelectorAll('.kursi-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
        const seatId   = this.getAttribute('data-seat-id');
        const selected = this.getAttribute('data-selected') === '1';

        if (selected) {
            // Unselect
            this.setAttribute('data-selected', '0');
            this.classList.remove('btn-primary');
            this.classList.add('btn-outline-success');
            // Hapus hidden input
            const inp = document.getElementById('seat-input-' + seatId);
            if (inp) inp.remove();
        } else {
            // Select
            this.setAttribute('data-selected', '1');
            this.classList.remove('btn-outline-success');
            this.classList.add('btn-primary');
            // Tambah hidden input
            const inp = document.createElement('input');
            inp.type  = 'hidden';
            inp.name  = 'seat_ids[]';
            inp.value = seatId;
            inp.id    = 'seat-input-' + seatId;
            seatInputs.appendChild(inp);
        }

        hitung();
    });
});

function hitung() {
    const jumlah = document.querySelectorAll('#seat-inputs input').length;
    jumlahEl.textContent = jumlah;
    totalEl.textContent  = (jumlah * hargaPerKursi).toLocaleString('id-ID');
    btnPesan.disabled    = jumlah === 0;
}
</script>
@endpush