@extends('admin.layout.core')

@section('content')
    <div class="container">
        <h1>Create Pengunjung</h1>
        <form action="{{ route('pengunjung.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama_pengunjung">Nama Pengunjung:</label>
                <input type="text" class="form-control" id="nama_pengunjung" name="nama_pengunjung">
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" class="form-control" id="alamat" name="alamat">
            </div>
            <div class="form-group">
                <label for="no_hp">No HP:</label>
                <input type="text" class="form-control" id="no_hp" name="no_hp">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
