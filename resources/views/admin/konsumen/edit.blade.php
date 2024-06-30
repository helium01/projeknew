@extends('admin.layout.core')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-6 ">
                <form method="post" action="/post/konsumens/{{ $konsumen->id }}">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label  ">Kode Konsumen</label>
                        <input name="id_Konsumen" type="text" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" value="{{ $konsumen->id_Konsumen }}">

                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label  "> Nama</label>
                        <input name="Nama" type="text" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" value="{{ $konsumen->Nama }}">

                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label  ">Alamat</label>
                        <input name="Alamat" type="text" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" value="{{ $konsumen->Alamat }}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label  ">No.Hp</label>
                        <input name="NoHp" type="text" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" value="{{ $konsumen->NoHp }}">
                    </div>
                    <button name="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
