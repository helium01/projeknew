<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konsumen;

class KonsumenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $konsumens = Konsumen::all();
        return view('admin.konsumen.index', compact('konsumens'));
    }

    public function create()
    {
        return view('admin.konsumen.create');
    }

    public function store(Request $request)
    {
         $request->validate([
            'id_Konsumen' => 'required',
            'Nama' => 'required',
            'Alamat' => 'required',
            'NoHp' => 'required',
        ]);

        Konsumen::create($request->all());

        return redirect()->route('konsumen.index')->with('success', 'Konsumen berhasil ditambahkan.');
    }

    public function edit(Konsumen $konsumen)
    {
        return view('admin.konsumen.edit', compact('konsumen'));
    }

    public function update(Request $request, Konsumen $konsumen)
    {
        $request->validate([
            'id_Konsumen' => 'required',
            'Nama' => 'required',
            'Alamat' => 'required',
            'NoHp' => 'required',
        ]);

        $konsumen->update($request->all());

        return redirect()->route('konsumen.index')->with('success', 'Konsumen berhasil diperbarui.');
    }

    public function destroy(Konsumen $konsumen)
    {
        $konsumen->delete();

        return redirect()->route('konsumen.index')->with('success', 'Konsumen berhasil dihapus.');
    }
}
