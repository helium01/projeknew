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
                                <canvas id="fuzzyChart" width="100" height="50"></canvas>
                            </div>
                        </div>
                        <a href="{{ route('prediksi') }}" class="btn btn-primary mt-3">Kembali ke Halaman Utama</a>
                    </div>
                    <canvas id="fuzzyChart" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    

    // Inisialisasi chart
    var ctx = document.getElementById('fuzzyChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line', // Menggunakan line chart untuk menampilkan kurva
        data: {!! json_encode($fuzzyData) !!},
        options: {
            responsive: true,
            scales: {
                xAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Nilai Fuzzy'
                    }
                }],
                yAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Derajat Keanggotaan'
                    },
                    ticks: {
                        beginAtZero: true,
                        max: 1
                    }
                }]
            }
        }
    });
</script>
@endsection
