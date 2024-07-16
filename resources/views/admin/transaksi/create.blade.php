@extends('admin.layout.core')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-6 ">
                <form method="post" action="/transaksis">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label  ">ID Transaksi</label>
                        <input id="form-id-transaksi"name="id_Transaksi" type="text" class="form-control"
                            id="exampleInputEmail1" aria-describedby="emailHelp" readonly>

                    </div>
                    <div class="mb-3">
                        <label for="input-harga" class="form-label  ">data pengunjung</label>
                        <select class="form-select" id="input-harga" name="id_Jenis" aria-label="Default select example">
                            @foreach ($jenis_mukena as $ps)
                                <option value="{{ $ps->nama_pengunjung }}">
                                    {{ $ps->nama_pengunjung }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label  ">data pengunjung</label>
                        <input name="id_Jenis" type="text" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp">

                    </div> --}}
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label  ">Tanggal</label>
                        <input name="Tanggal" type="date" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp">

                    </div>
                    {{-- <div class="mb-3">
                        <label for="input-harga" class="form-label  ">Harga</label>
                        <input name="Harga" type="number" class="form-control" id="input-harga"
                            aria-describedby="emailHelp">

                    </div> --}}
                    <div class="mb-3">
                        <label for="input-jumlah" class="form-label  ">Jumlah</label>
                        <input name="Jumlah" type="number" class="form-control" id="input-jumlah"
                            aria-describedby="emailHelp">

                    </div>
                    <div class="mb-3">
                        <label for="input-total" class="form-label  ">Total</label>
                        <input name="Total" type="number" class="form-control" id="input-total"
                            aria-describedby="emailHelp">

                    </div>
                    {{-- <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label  ">ID Jenis</label>
                        <select class="form-select" name="kode_produk" aria-label="Default select example">
                            @foreach ($produk as $ps)
                                <option value="{{ $ps->kode_produk }}">{{ $ps->nama_produk }}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    {{-- <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label  ">Stok</label>
                        <input name="jumlah_stok" type="text" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp">
                    </div> --}}

                    <button name="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        const formidTransaksi = document.getElementById('form-id-transaksi');
        formidTransaksi.value = 'TR-' + Math.floor(Math.random() * 10000)
    </script>
    <script>
        const inputHarga = document.getElementById('input-harga');
        const inputJumlah = document.getElementById('input-jumlah');
        const inputTotal = document.getElementById('input-total');
        let hargaDipilih = 1;
        console.log(inputHarga);
        console.log(inputJumlah);
        console.log(inputTotal);

        // inputTotal.value = inputHarga * inputJumlah;
        function getTotal(harga, jumlah) {
            return harga * jumlah;
        }

        inputHarga.addEventListener('change', function(e) {
            // options[1].dataset.harga = 12000
            hargaDipilih = e.target.options[event.target.selectedIndex].dataset.harga;
            inputTotal.value = getTotal(hargaDipilih, inputJumlah.value);
        });

        inputJumlah.addEventListener('keyup', function(e) {
            inputTotal.value = getTotal(hargaDipilih, e.target.value);
        });
    </script>
@endpush
