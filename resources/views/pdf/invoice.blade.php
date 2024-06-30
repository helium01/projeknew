<h2 align="center"><b>Laporan Transaksi Penjualan Mukena</b></h2>
<table class="table" align="center" border=1 style="width:95%">
    <thead>
        <tr>
            <th>No</th>
            <th>Id Transaksi</th>
            <th>data pengunjung</th>
            <th>Tanggal</th>
            <th>Jumlah</th>
            <th>Total</th>
        </tr>
    </thead>
    @foreach ($data as $index => $pr)
        <tbody>
            <tr class="table-active">
                <th>{{ $index + 1 }}</th>
                <th>{{ $pr->id_Transaksi }}</th>
                <th>{{ $pr->id_Jenis }}</th>
                <th>{{ $pr->Tanggal }}</th>
                <th>{{ $pr->Jumlah }}</th>
                <th>{{ $pr->Total }}</th>
            </tr>
    @endforeach
    </tbody>
</table>
