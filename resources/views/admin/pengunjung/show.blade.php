@extends('admin.layout.core')

@section('content')
    <div class="container">
        <h1>Show Pengunjung</h1>
        <div class="form-group">
            <strong>Nama Pengunjung:</strong>
            {{ $pengunjung->nama_pengunjung }}
        </div>
        <div class="form-group">
            <strong>Alamat:</strong>
            {{ $pengunjung->alamat }}
        </div>
        <div class="form-group">
            <strong>No HP:</strong>
            {{ $pengunjung->no_hp }}
        </div>
        <a href="{{ route('pengunjung.index') }}" class="btn btn-primary">Back</a>
    </div>
@endsection
