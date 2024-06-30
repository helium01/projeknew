@extends('admin.layout.core')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-6 ">
                <form method="post" action="/post/transaksis/{{ $transaksi->id }}">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label  ">ID Transaksi</label>
                        <input name="id_Transaksi" type="text" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" readonly value="{{ $transaksi->id_Transaksi }}">

                    </div>
                    <div class="mb-3">
                        <label for="input-harga" class="form-label">data pengunjung</label>
                        <select class="form-select" id="input-harga" name="id_Jenis" aria-label="Default select example">
                            @foreach ($jenis_mukena as $ps)
                                <option data-harga="{{ $ps->Harga }}" value="{{ $ps->id_Jenis }}"
                                    {{ $transaksi->id_Jenis == $ps->id_Jenis ? 'selected' : '' }}>
                                    {{ $ps->id_Jenis }} | Rp{{ $ps->Harga }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label  ">Tanggal</label>
                        <input name="Tanggal" type="date" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" value="{{ $transaksi->Tanggal }}">
                    </div>
                    {{-- <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label  ">Harga</label>
                        <input name="Harga" type="string" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" value="{{ $transaksi->Harga }}">
                    </div> --}}
                    <div class="mb-3">
                        <label for="input-jumlah" class="form-label  ">Jumlah</label>
                        <input name="Jumlah" type="string" class="form-control" id="input-jumlah"
                            aria-describedby="emailHelp" value="{{ $transaksi->Jumlah }}">
                    </div>
                    <div class="mb-3">
                        <label for="input-total" class="form-label  ">Total</label>
                        <input name="Total" type="string" class="form-control" id="input-total"
                            aria-describedby="emailHelp" value="{{ $transaksi->Total }}">
                    </div>

                    <button name="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
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
