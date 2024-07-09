@extends('admin.layout.core')

@section('content')
    <div class="container">
        <h1>Layanan List</h1>
        <a href="{{ route('layanan.create') }}" class="btn btn-primary">Create Layanan</a>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Layanan</th>
                    <th>Deskripsi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($layanans as $layanan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $layanan->layanan }}</td>
                        <td>{{ $layanan->deskripsi }}</td>
                        <td>
                            <a href="{{ route('layanan.show', $layanan->id) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('layanan.edit', $layanan->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('layanan.destroy', $layanan->id) }}" method="POST" style="display:inline;">
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
