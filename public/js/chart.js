<script src="{{ asset('js/chart.js') }}"></script>

const ctx = document.getElementById('chartPenjualan');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar'],
        datasets: [{
            label: 'Penjualan',
            data: [12, 19, 30]
        }]
    }
});