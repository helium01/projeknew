@extends('admin.layout.core')

@section('content')
    <div class="container">
        <h1>Edit Pengunjung</h1>
        <form action="{{ route('pengunjung.update', $pengunjung->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama_pengunjung">Nama Pengunjung:</label>
                <input type="text" class="form-control" id="nama_pengunjung" name="nama_pengunjung" value="{{ $pengunjung->nama_pengunjung }}">
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $pengunjung->alamat }}">
            </div>
            <div class="form-group">
                <label for="no_hp">No HP:</label>
                <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ $pengunjung->no_hp }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
