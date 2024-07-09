@extends('admin.layout.core')

@section('content')
    <div class="container">
        <h1>Edit Promo</h1>
        <form action="{{ route('promo.update', $promo->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="promosi">Promosi:</label>
                <input type="text" class="form-control" id="promosi" name="promosi" value="{{ $promo->promosi }}">
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="{{ $promo->deskripsi }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
