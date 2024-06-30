@extends('admin.layout.core')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-6 ">
                <form method="post" action="/konsumens">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label  ">Kode Konsumen</label>
                        <input id="form-id-konsumen" name="id_Konsumen" type="text" class="form-control"
                            id="exampleInputEmail1" aria-describedby="emailHelp" readonly>

                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label  ">Nama</label>
                        <input name="Nama" type="text" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label  ">Alamat</label>
                        <input name="Alamat" type="text" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label  ">No.Hp</label>
                        <input name="NoHp" type="text" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp">
                    </div>
                    <button name="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        const formidKonsumen = document.getElementById('form-id-konsumen');
        formidKonsumen.value = 'KS-' + Math.floor(Math.random() * 10000)
    </script>
@endpush
