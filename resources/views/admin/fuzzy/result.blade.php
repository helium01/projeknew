@extends('admin.layout.core')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="container mt-5">
                        <h2 class="mb-4">Hasil Prediksi Jumlah Pelanggan</h2>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Hasil Prediksi</h5>
                                <p class="card-text">Jumlah pelanggan yang diprediksi berkisar: {{ $result }} Orang</p>
                                <canvas id="lineChart" width="100" height="50"></canvas>
                                <canvas id="barChart" width="100" height="50"></canvas>
                                <canvas id="radarChart" width="100" height="50"></canvas>

                            </div>
                        </div>
                        <a href="{{ route('prediksi') }}" class="btn btn-primary mt-3">Kembali ke Halaman Utama</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    var fuzzyData = @json($fuzzyData);

    // Line Chart
    var ctxLine = document.getElementById('lineChart').getContext('2d');
    var lineChart = new Chart(ctxLine, {
        type: 'line',
        data: {
            labels: fuzzyData.labels,
            datasets: fuzzyData.datasets
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Nilai Fuzzy'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Derajat Keanggotaan'
                    },
                    beginAtZero: true,
                    max: 1
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Grafik Himpunan Fuzzy (Line Chart)'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': ' + context.raw.toFixed(2);
                        }
                    }
                }
            }
        }
    });

    // Bar Chart
    var ctxBar = document.getElementById('barChart').getContext('2d');
    var barChart = new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: fuzzyData.labels,
            datasets: fuzzyData.datasets
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Nilai Fuzzy'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Derajat Keanggotaan'
                    },
                    beginAtZero: true,
                    max: 1
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Grafik Himpunan Fuzzy (Bar Chart)'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': ' + context.raw.toFixed(2);
                        }
                    }
                }
            }
        }
    });

    // Radar Chart
    var ctxRadar = document.getElementById('radarChart').getContext('2d');
    var radarChart = new Chart(ctxRadar, {
        type: 'radar',
        data: {
            labels: fuzzyData.labels,
            datasets: fuzzyData.datasets
        },
        options: {
            responsive: true,
            scales: {
                r: {
                    angleLines: {
                        display: true
                    },
                    suggestedMin: 0,
                    suggestedMax: 1
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Grafik Himpunan Fuzzy (Radar Chart)'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': ' + context.raw.toFixed(2);
                        }
                    }
                }
            }
        }
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById('kualitasChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: Array.from({
                length: 101
            }, (_, i) => i), // 0 to 100
            datasets: [{
                    label: 'Rendah',
                    data: Array.from({
                        length: 51
                    }, (_, i) => (50 - i) / 50).concat(Array(50).fill(0)), // Rendah
                    borderColor: 'rgba(255, 99, 132, 1)',
                    fill: false
                },
                {
                    label: 'Sedang',
                    data: Array(25).fill(0).concat(Array.from({
                        length: 26
                    }, (_, i) => i / 25)).concat(Array.from({
                        length: 25
                    }, (_, i) => (25 - i) / 25)).concat(Array(25).fill(0)), // Sedang
                    borderColor: 'rgba(54, 162, 235, 1)',
                    fill: false
                },
                {
                    label: 'Tinggi',
                    data: Array(50).fill(0).concat(Array.from({
                        length: 51
                    }, (_, i) => i / 50)), // Tinggi
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
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById('promosiChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: Array.from({
                length: 101
            }, (_, i) => i), // 0 to 100
            datasets: [{
                    label: 'Rendah',
                    data: Array.from({
                        length: 51
                    }, (_, i) => (50 - i) / 50).concat(Array(50).fill(0)), // Rendah
                    borderColor: 'rgba(255, 99, 132, 1)',
                    fill: false
                },
                {
                    label: 'Sedang',
                    data: Array(25).fill(0).concat(Array.from({
                        length: 26
                    }, (_, i) => i / 25)).concat(Array.from({
                        length: 25
                    }, (_, i) => (25 - i) / 25)).concat(Array(25).fill(0)), // Sedang
                    borderColor: 'rgba(54, 162, 235, 1)',
                    fill: false
                },
                {
                    label: 'Tinggi',
                    data: Array(50).fill(0).concat(Array.from({
                        length: 51
                    }, (_, i) => i / 50)), // Tinggi
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
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById('tarifChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: Array.from({
                length: 101
            }, (_, i) => i), // 0 to 100
            datasets: [{
                    label: 'Rendah',
                    data: Array.from({
                        length: 51
                    }, (_, i) => (50 - i) / 50).concat(Array(50).fill(0)), // Rendah
                    borderColor: 'rgba(255, 99, 132, 1)',
                    fill: false
                },
                {
                    label: 'Sedang',
                    data: Array(25).fill(0).concat(Array.from({
                        length: 26
                    }, (_, i) => i / 25)).concat(Array.from({
                        length: 25
                    }, (_, i) => (25 - i) / 25)).concat(Array(25).fill(0)), // Sedang
                    borderColor: 'rgba(54, 162, 235, 1)',
                    fill: false
                },
                {
                    label: 'Tinggi',
                    data: Array(50).fill(0).concat(Array.from({
                        length: 51
                    }, (_, i) => i / 50)), // Tinggi
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
});
</script>

@endsection