@extends('admin.layout.core')

@section('content')
    <div class="container">
        <h1>Create Layanan</h1>
        <form action="{{ route('layanan.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="layanan">Layanan:</label>
                <input type="text" class="form-control" id="layanan" name="layanan">
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <input type="text" class="form-control" id="deskripsi" name="deskripsi">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
