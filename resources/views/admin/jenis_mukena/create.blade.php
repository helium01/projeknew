@extends('admin.layout.core')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-6 ">
                <form method="post" action="/jenis_mukenas">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label  ">data pengunjung</label>
                        <input name="id_Jenis" type="text" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp">

                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label  ">Harga</label>
                        <input name="Harga" type="number" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp">


                        <button name="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
