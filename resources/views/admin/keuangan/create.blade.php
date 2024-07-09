@extends('admin.layout.core')

@section('content')
    <div class="container">
        <h1>Create Keuangan</h1>
        <form action="{{ route('keuangan.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="masuk">Masuk:</label>
                <input type="text" class="form-control" id="masuk" name="masuk">
            </div>
            <div class="form-group">
                <label for="keluar">Keluar:</label>
                <input type="text" class="form-control" id="keluar" name="keluar">
            </div>
            <div class="form-group">
                <label for="saldo">Saldo:</label>
                <input type="text" class="form-control" id="saldo" name="saldo">
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <input type="text" class="form-control" id="deskripsi" name="deskripsi">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
