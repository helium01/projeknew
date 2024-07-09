@extends('admin.layout.core')

@section('content')
    <div class="container">
        <h1>Pengunjung List</h1>
        <a href="{{ route('pengunjung.create') }}" class="btn btn-primary">Create Pengunjung</a>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pengunjung</th>
                    <th>Alamat</th>
                    <th>No HP</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengunjungs as $pengunjung)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pengunjung->nama_pengunjung }}</td>
                        <td>{{ $pengunjung->alamat }}</td>
                        <td>{{ $pengunjung->no_hp }}</td>
                        <td>
                            <a href="{{ route('pengunjung.show', $pengunjung->id) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('pengunjung.edit', $pengunjung->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('pengunjung.destroy', $pengunjung->id) }}" method="POST" style="display:inline;">
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
