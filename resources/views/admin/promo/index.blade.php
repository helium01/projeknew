@extends('admin.layout.core')

@section('content')
    <div class="container">
        <h1>Promo List</h1>
        <a href="{{ route('promo.create') }}" class="btn btn-primary">Create Promo</a>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Promosi</th>
                    <th>Deskripsi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($promos as $promo)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $promo->promosi }}</td>
                        <td>{{ $promo->deskripsi }}</td>
                        <td>
                            <a href="{{ route('promo.show', $promo->id) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('promo.edit', $promo->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('promo.destroy', $promo->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
