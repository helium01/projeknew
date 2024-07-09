@extends('admin.layout.core')

@section('content')
    <div class="container">
        <h1>Show Promo</h1>
        <div class="form-group">
            <strong>Promosi:</strong>
            {{ $promo->promosi }}
        </div>
        <div class="form-group">
            <strong>Deskripsi:</strong>
            {{ $promo->deskripsi }}
        </div>
        <a href="{{ route('promo.index') }}" class="btn btn-primary">Back</a>
    </div>
@endsection
