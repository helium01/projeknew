@extends('admin.layout.core')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6><a class="btn btn-success" href="/konsumens/create" role="button">Add Data</a></h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center ">
                                <tbody>
                                    <tr>
                                        <td class="w-5">
                                            <div class="d-flex px-2 py-1 align-items-center">

                                                <div class="ms-4">
                                                    <h6 class="text-sm mb-0">No</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="w-20">
                                            <div class="d-flex px-2 py-1 align-items-center">

                                                <div class="ms-4">
                                                    <h6 class="text-sm mb-0">Kode Konsumen</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="w-30">
                                            <div class="d-flex px-2 py-1 align-items-center">

                                                <div class="ms-4">
                                                    <h6 class="text-sm mb-0">Nama</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="w-20">
                                            <div class="d-flex px-2 py-1 align-items-center">
                                                <div class="ms-4">
                                                    <h6 class="text-sm mb-0">Alamat</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="w-30">
                                            <div class="d-flex px-2 py-1 align-items-center">
                                                <div class="ms-4">
                                                    <h6 class="text-sm mb-0">No.Hp</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="w-20">
                                            <div class="d-flex px-2 py-1 align-items-center">
                                                <div class="ms-4">
                                                    <h6 class="text-sm mb-0">Opsi</h6>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @foreach ($konsumens as $index => $pr)
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
                                                        <h6 class="text-sm mb-0">{{ $pr->id_Konsumen }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="w-30">
                                                <div class="d-flex px-2 py-1 align-items-center">
                                                    <div class="ms-4">
                                                        <h6 class="text-sm mb-0">{{ $pr->Nama }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="w-30">
                                                <div class="d-flex px-2 py-1 align-items-center">
                                                    <div class="ms-4">
                                                        <h6 class="text-sm mb-0">{{ $pr->Alamat }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="w-30">
                                                <div class="d-flex px-2 py-1 align-items-center">
                                                    <div class="ms-4">
                                                        <h6 class="text-sm mb-0"> {{ $pr->NoHp }}</h6>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="w-30">
                                                <div class="d-flex px-2 py-1 align-items-center">
                                                    <div class="ms-4">
                                                        <h6 class="text-sm mb-0">
                                                            <a class="btn btn-danger"
                                                                href="/delete/konsumens/{{ $pr->id }}" role="button"
                                                                onclick="return confirm('Apakah Anda Yakin Menghapus Data?');"><i
                                                                    class="far fa-trash-alt me-2"></i>Delete</a>
                                                            <a class="btn btn-warning"
                                                                href="/konsumens/{{ $pr->id }}/edit" role="button"><i
                                                                    class="fas fa-pencil-alt text-dark me-2"
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
