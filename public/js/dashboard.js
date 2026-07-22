const ctx = document.getElementById('myChart');

new Chart(ctx, {

    type: 'bar',

    data: {

        labels: [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'Mei'
        ],

        datasets: [{

            label: 'Penjualan Tiket',

            data: [
                12,
                19,
                30,
                25,
                40
            ]

        }]

    }

});