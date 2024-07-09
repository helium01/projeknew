@extends('admin.layout.core')

@section('content')
    <div class="container">
        <h1>Edit Layanan</h1>
        <form action="{{ route('layanan.update', $layanan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="layanan">Layanan:</label>
                <input type="text" class="form-control" id="layanan" name="layanan" value="{{ $layanan->layanan }}">
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="{{ $layanan->deskripsi }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
