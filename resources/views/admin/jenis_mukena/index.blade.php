@extends('admin.layout.core')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6><a class="btn btn-success" href="/jenis_mukenas/create" role="button">Add Data</a></h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center ">
                                <tbody>
                                    <tr>
                                        <td class="w-30">
                                            <div class="d-flex px-2 py-1 align-items-center">

                                                <div class="ms-4">
                                                    <h6 class="text-sm mb-0">No</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="w-30">
                                            <div class="d-flex px-2 py-1 align-items-center">

                                                <div class="ms-4">
                                                    <h6 class="text-sm mb-0">data pengunjung</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="w-30">
                                            <div class="d-flex px-2 py-1 align-items-center">

                                                <div class="ms-4">
                                                    <h6 class="text-sm mb-0">Harga</h6>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="w-30">
                                            <div class="d-flex px-2 py-1 align-items-center">

                                                <div class="ms-4">
                                                    <h6 class="text-sm mb-0">Opsi</h6>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @foreach ($jenis_mukenas as $index => $pr)
                                        <tr>
                                            <td class="w-30">
                                                <div class="d-flex px-2 py-1 align-items-center">
                                                    <div class="ms-4">
                                                        <h6 class="text-sm mb-0">{{ $index + 1 }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="w-30">
                                                <div class="d-flex px-2 py-1 align-items-center">
                                                    <div class="ms-4">
                                                        <h6 class="text-sm mb-0">{{ $pr->id_Jenis }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="w-30">
                                                <div class="d-flex px-2 py-1 align-items-center">
                                                    <div class="ms-4">
                                                        <h6 class="text-sm mb-0">{{ $pr->Harga }}</h6>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="w-30">
                                                <div class="d-flex px-2 py-1 align-items-center">
                                                    <div class="ms-4">
                                                        <h6 class="text-sm mb-0">
                                                            <a class="btn btn-danger"
                                                                href="/delete/jenis_mukenas/{{ $pr->id }}"
                                                                role="button"
                                                                onclick="return confirm('Apakah Anda Yakin Menghapus Data?');"><i
                                                                    class="far fa-trash-alt me-2"></i>Delete</a>
                                                            <a class="btn btn-warning"
                                                                href="/jenis_mukenas/{{ $pr->id }}/edit"
                                                                role="button"><i class="fas fa-pencil-alt text-dark me-2"
                                                                    aria-hidden="true"></i>Edit</a>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
