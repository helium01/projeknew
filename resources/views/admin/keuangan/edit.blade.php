@extends('admin.layout.core')

@section('content')
    <div class="container">
        <h1>Edit Keuangan</h1>
        <form action="{{ route('keuangan.update', $keuangan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="masuk">Masuk:</label>
                <input type="text" class="form-control" id="masuk" name="masuk" value="{{ $keuangan->masuk }}">
            </div>
            <div class="form-group">
                <label for="keluar">Keluar:</label>
                <input type="text" class="form-control" id="keluar" name="keluar" value="{{ $keuangan->keluar }}">
            </div>
            <div class="form-group">
                <label for="saldo">Saldo:</label>
                <input type="text" class="form-control" id="saldo" name="saldo" value="{{ $keuangan->saldo }}">
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="{{ $keuangan->deskripsi }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
