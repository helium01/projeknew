@extends('admin.layout.core')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="container mt-5">
                        <h2 class="mb-4">Prediksi Jumlah Pelanggan</h2>
                        <form method="POST" action="{{ route('predict') }}">
                            @csrf
                            <div class="form-group">
                                <label for="tarif">Tarif</label>
                                <select class="form-control" id="tarif" name="tarif">
                                    <option value="150">Tarif Rendah</option>
                                    <option value="100">Tarif Sedang</option>
                                    <option value="50">Tarif Tinggi</option>
                                    <!-- Tambahkan value lainnya sesuai kebutuhan -->
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kualitas">Kualitas</label>
                                <select class="form-control" id="kualitas" name="kualitas">
                                    <option value="25">Kualitas Pelayanan Buruk</option>
                                    <option value="50">Kualitas Pelayanan Sedang</option>
                                    <option value="75">Kualitas Pelayanan Baik</option>
                                    <!-- Tambahkan value lainnya sesuai kebutuhan -->
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="promosi">Promosi</label>
                                <select class="form-control" id="promosi" name="promosi">
                                    <option value="1">Promosi Tidak Ada</option>
                                    <option value="5">Promosi Sedikit</option>
                                    <option value="7">Promosi Banyak</option>
                                    <!-- Tambahkan value lainnya sesuai kebutuhan -->
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Predict</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection