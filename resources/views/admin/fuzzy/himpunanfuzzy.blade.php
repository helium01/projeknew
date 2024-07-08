@extends('admin.layout.core')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="container">
    <h2 class="mt-4">Grafik Himpunan Fuzzy</h2>

    <h3 class="mt-10">Kualitas</h3>
    <canvas id="kualitasChart" width="100" height="50"></canvas>

    <h3>Tarif</h3>
    <canvas id="tarifChart" width="100" height="50"></canvas>

    <h3>Promosi</h3>
    <canvas id="promosiChart" width="100" height="50"></canvas>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var labels = @json($labels);
    var labels_promo = @json($labels_promo);

    // Kualitas Chart
    var ctxKualitas = document.getElementById('kualitasChart').getContext('2d');
    var kualitasChart = new Chart(ctxKualitas, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                    label: 'Rendah',
                    data: @json($dataKualitasRendah),
                    borderColor: 'rgba(255, 99, 132, 1)',
                    fill: false
                },
                {
                    label: 'Sedang',
                    data: @json($dataKualitasSedang),
                    borderColor: 'rgba(54, 162, 235, 1)',
                    fill: false
                },
                {
                    label: 'Tinggi',
                    data: @json($dataKualitasTinggi),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    fill: false
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Himpunan Fuzzy untuk Kualitas'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 1,
                    title: {
                        display: true,
                        text: 'Derajat Keanggotaan'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Nilai Kualitas'
                    }
                }
            }
        }
    });

    // Tarif Chart
    var ctxTarif = document.getElementById('tarifChart').getContext('2d');
    var tarifChart = new Chart(ctxTarif, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                    label: 'Rendah',
                    data: @json($dataTarifRendah),
                    borderColor: 'rgba(255, 99, 132, 1)',
                    fill: false
                },
                {
                    label: 'Sedang',
                    data: @json($dataTarifSedang),
                    borderColor: 'rgba(54, 162, 235, 1)',
                    fill: false
                },
                {
                    label: 'Tinggi',
                    data: @json($dataTarifTinggi),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    fill: false
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Himpunan Fuzzy untuk Tarif'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 1,
                    title: {
                        display: true,
                        text: 'Derajat Keanggotaan'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Nilai Tarif'
                    }
                }
            }
        }
    });

    // Promosi Chart
    var ctxPromosi = document.getElementById('promosiChart').getContext('2d');
    var promosiChart = new Chart(ctxPromosi, {
        type: 'line',
        data: {
            labels: labels_promo,
            datasets: [{
                    label: 'Tidak Ada',
                    data: @json($dataPromosiTidakAda),
                    borderColor: 'rgba(255, 99, 132, 1)',
                    fill: false
                },
                {
                    label: 'Sedikit',
                    data: @json($dataPromosiSedikit),
                    borderColor: 'rgba(54, 162, 235, 1)',
                    fill: false
                },
                {
                    label: 'Banyak',
                    data: @json($dataPromosiBanyak),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    fill: false
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Himpunan Fuzzy untuk Promosi'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 1,
                    title: {
                        display: true,
                        text: 'Derajat Keanggotaan'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Nilai Promosi'
                    }
                }
            }
        }
    });
});
</script>
@endsection