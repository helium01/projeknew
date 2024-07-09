@extends('admin.layout.core')

@section('content')
    <div class="container">
        <h1>Show Keuangan</h1>
        <div class="form-group">
            <strong>Masuk:</strong>
            {{ $keuangan->masuk }}
        </div>
        <div class="form-group">
            <strong>Keluar:</strong>
            {{ $keuangan->keluar }}
        </div>
        <div class="form-group">
            <strong>Saldo:</strong>
            {{ $keuangan->saldo }}
        </div>
        <div class="form-group">
            <strong>Deskripsi:</strong>
            {{ $keuangan->deskripsi }}
        </div>
        <a href="{{ route('keuangan.index') }}" class="btn btn-primary">Back</a>
    </div>
@endsection
