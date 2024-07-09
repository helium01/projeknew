@extends('admin.layout.core')

@section('content')
    <div class="container">
        <h1>Show Layanan</h1>
        <div class="form-group">
            <strong>Layanan:</strong>
            {{ $layanan->layanan }}
        </div>
        <div class="form-group">
            <strong>Deskripsi:</strong>
            {{ $layanan->deskripsi }}
        </div>
        <a href="{{ route('layanan.index') }}" class="btn btn-primary">Back</a>
    </div>
@endsection
