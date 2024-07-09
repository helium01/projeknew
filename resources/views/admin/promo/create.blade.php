@extends('admin.layout.core')

@section('content')
    <div class="container">
        <h1>Create Promo</h1>
        <form action="{{ route('promo.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="promosi">Promosi:</label>
                <input type="text" class="form-control" id="promosi" name="promosi">
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <input type="text" class="form-control" id="deskripsi" name="deskripsi">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
