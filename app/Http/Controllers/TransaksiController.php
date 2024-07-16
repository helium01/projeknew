<?php

namespace App\Http\Controllers;

use App\Models\pengunjung;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use PDF;

class TransaksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $transaksis = Transaksi::simplePaginate(10);
        return view('admin.transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $jenis_mukena = Pengunjung::all();
        return view('admin.transaksi.create',compact('jenis_mukena'));
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'id_Transaksi' => 'required',
        //     'id_Jenis' => 'required',
        //     'Tanggal' => 'required|date',
        //     'Jumlah' => 'required|integer',
        //     'Harga' => 'required|integer',
        //     'Total' => 'required|integer',
        // ]);

        Transaksi::create($request->all());

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function edit($transaksi)
    {
        $transaksi = Transaksi::findOrFail($transaksi);
        $jenis_mukena = Jenis_Mukena::all();// Tambahkan kode untuk mengambil data data pengunjung
        return view('admin.transaksi.edit', compact('transaksi','jenis_mukena'));
    }

    public function update(Request $request, $transaksi)
    {
         $transaksi = Transaksi::findOrFail($transaksi);

        $request->validate([
            'id_Transaksi' => 'required',
            'id_Jenis' => 'required',
            'Tanggal' => 'required|date',
            'Jumlah' => 'required|integer',
          //  'Harga' => 'required|integer',
            'Total' => 'required|integer',
        ]);

        $transaksi->update($request->all());

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }

    public function cetak(){
        $data=Transaksi::all();
$pdf = PDF::loadView('pdf.invoice',compact( 'data'));
    return $pdf->download('invoice.pdf');
    }
}
