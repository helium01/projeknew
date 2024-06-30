@extends('admin.layout.core')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col">
                                <h6>Data Peramalan</h6>
                                <form method="get" action="/data/peramalan/view/data2">
                                    @csrf
                                    <legend>View Data</legend>
                                    <div class="mb-3">
                                        <label class="form-label">Alpa</label>
                                        <select name="alpa" class="form-select">
                                            <option>{{ $alp }}</option>
                                            @foreach ($alpa as $al)
                                                <option value="{{ $al }}">{{ $al }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">data pengunjung</label>
                                        <select name="jenis" class="form-select">
                                            <option>{{ $jenis2 }}</option>
                                            @foreach ($jenis as $jen)
                                                <option value="{{ $jen->id_Jenis }}">{{ $jen->id_Jenis }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>

                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center ">
                                <tbody>
                                    <tr>
                                        <td class="w-30">
                                            <div class="d-flex px-2 py-1 align-items-center">

                                                <div class="ms-4">
                                                    <h6 class="text-sm mb-0">No</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="w-30">
                                            <div class="d-flex px-2 py-1 align-items-center">

                                                <div class="ms-4">
                                                    <h6 class="text-sm mb-0">Jenis</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="w-30">
                                            <div class="d-flex px-2 py-1 align-items-center">

                                                <div class="ms-4">
                                                    <h6 class="text-sm mb-0">Bulan</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="w-30">
                                            <div class="d-flex px-2 py-1 align-items-center">

                                                <div class="ms-4">
                                                    <h6 class="text-sm mb-0">Tahun</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="w-30">
                                            <div class="d-flex px-2 py-1 align-items-center">

                                                <div class="ms-4">
                                                    <h6 class="text-sm mb-0">Aktual</h6>
                                                </div>
                                            </div>
                                        </td>

                                        {{-- <td class="w-30">
                                            <div class="d-flex px-2 py-1 align-items-center">

                                                <div class="ms-4">
                                                    <h6 class="text-sm mb-0">Harga</h6>
                                                </div>
                                            </div>
                                        </td> --}}
                                        <td class="w-30">
                                            <div class="d-flex px-2 py-1 align-items-center">

                                                <div class="ms-4">
                                                    <h6 class="text-sm mb-0">Forecast</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="w-30">
                                            <div class="d-flex px-2 py-1 align-items-center">

                                                <div class="ms-4">
                                                    <h6 class="text-sm mb-0">PE</h6>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    @foreach ($peramalan as $index => $pr)
                                        <tr>
                                            <td class="w-30">
                                                <div class="d-flex px-2 py-1 align-items-center">
                                                    <div class="ms-4">
                                                        <h6 class="text-sm mb-0">{{ $index + 1 }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="w-30">
                                                <div class="d-flex px-2 py-1 align-items-center">
                                                    <div class="ms-4">
                                                        <h6 class="text-sm mb-0">{{ $pr->Jenis_Mukena }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="w-30">
                                                <div class="d-flex px-2 py-1 align-items-center">
                                                    <div class="ms-4">
                                                        <h6 class="text-sm mb-0">{{ $pr->Bulan }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="w-30">
                                                <div class="d-flex px-2 py-1 align-items-center">
                                                    <div class="ms-4">
                                                        <h6 class="text-sm mb-0">{{ $pr->Tahun }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="w-30">
                                                <div class="d-flex px-2 py-1 align-items-center">
                                                    <div class="ms-4">
                                                        <h6 class="text-sm mb-0">{{ $pr->aktual }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            {{-- <td class="w-30">
                                                <div class="d-flex px-2 py-1 align-items-center">
                                                    <div class="ms-4">
                                                        <h6 class="text-sm mb-0">{{ $pr->Harga }}</h6>
                                                    </div>
                                                </div>
                                            </td> --}}
                                            <td class="w-30">
                                                <div class="d-flex px-2 py-1 align-items-center">
                                                    <div class="ms-4">
                                                        <h6 class="text-sm mb-0">{{ $pr->Jumlah }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="w-30">
                                                <div class="d-flex px-2 py-1 align-items-center">
                                                    <div class="ms-4">
                                                        <h6 class="text-sm mb-0">{{ $pr->pe }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="w-30">
                                                <div class="d-flex px-2 py-1 align-items-center">
                                                    <div class="ms-4">
                                                        <h6 class="text-sm mb-0">{{ $pr->Total }}</h6>
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Tampilkan links paginasi -->
                            @if ($jenis2 == null)
                                {{ $peramalan->links() }}
                            @else
                                {{ $peramalan->appends(['alpa' => $alp, 'jenis' => $jenis2])->links() }}
                            @endif
                        </div>

                    </div>

                </div>
                @if ($jenis2 == null)
                @else
                    @foreach ($hasilpe as $pe)
                        <p>Alpa : {{ $pe->alpa }}</p>
                        <p>Nilai Jumlah Pe= {{ $pe->jumlah_pe }}</p>
                    @endforeach

                    @foreach ($rekompe as $pe)
                        <p>Nilai Alpa yang di Rekomendasikan adalah:</p>
                        <p>Alpa : {{ $pe->alpa }}</p>
                        <p>Nilai Jumlah Pe= {{ $pe->jumlah_pe }}</p>
                        <hr><br>
                    @endforeach
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <canvas id="grafik"></canvas>
                    <script>
                        $(document).ready(function() {
                            $.ajax({
                                url: '/grafik/{{ $jenis2 }}/{{ $alp }}',
                                method: 'GET',
                                dataType: 'json',
                                success: function(response) {
                                    var labels = response.labels;
                                    var dataAktual = response.dataAktual;
                                    var dataPeramalan = response.dataPeramalan;

                                    var ctx = document.getElementById('grafik').getContext('2d');
                                    var chart = new Chart(ctx, {
                                        type: 'line',
                                        data: {
                                            labels: labels,
                                            datasets: [{
                                                label: 'Data Aktual',
                                                data: dataAktual,
                                                backgroundColor: 'rgba(0, 123, 255, 0.5)',
                                                borderColor: 'rgba(0, 123, 255, 1)',
                                                borderWidth: 1
                                            }, {
                                                label: 'Data Peramalan',
                                                data: dataPeramalan,
                                                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                                                borderColor: 'rgba(255, 99, 132, 1)',
                                                borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            responsive: true,
                                            scales: {
                                                y: {
                                                    beginAtZero: true
                                                }
                                            }
                                        }
                                    });
                                }
                            });
                        });
                    </script>
                @endif
            </div>
        </div>
    </div>
@endsection
