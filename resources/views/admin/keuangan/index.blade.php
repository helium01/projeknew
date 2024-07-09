@extends('admin.layout.core')

@section('content')
    <div class="container">
        <h1>Keuangan List</h1>
        <a href="{{ route('keuangan.create') }}" class="btn btn-primary">Create Keuangan</a>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Masuk</th>
                    <th>Keluar</th>
                    <th>Saldo</th>
                    <th>Deskripsi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($keuangans as $keuangan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $keuangan->masuk }}</td>
                        <td>{{ $keuangan->keluar }}</td>
                        <td>{{ $keuangan->saldo }}</td>
                        <td>{{ $keuangan->deskripsi }}</td>
                        <td>
                            <a href="{{ route('keuangan.show', $keuangan->id) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('keuangan.edit', $keuangan->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('keuangan.destroy', $keuangan->id) }}" method="POST" style="display:inline;">
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
