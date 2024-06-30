<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jenis_Mukena;

class JenisMukenaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $jenis_mukenas = Jenis_Mukena::all();
        return view('admin.jenis_mukena.index', compact('jenis_mukenas')); //database
    }

    public function create()
    {
        return view('admin.jenis_mukena.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_Jenis' => 'required',
            'Harga' => 'required|integer',
        ]);

        Jenis_Mukena::create($request->all()); //model

        return redirect()->route('jenis_mukena.index')->with('success', 'data pengunjung berhasil ditambahkan.');
    }

    public function edit(Jenis_Mukena $jenis_mukena)
    {
        return view('admin.jenis_mukena.edit', compact('jenis_mukena')); //compact ke model
    }

    public function update(Request $request, Jenis_Mukena $jenis_mukena)
    {
         $request->validate([
            'id_Jenis' => 'required',
            'Harga' => 'required|integer',
        ]);

        $jenis_mukena->update($request->all());

        return redirect()->route('jenis_mukena.index')->with('success', 'data pengunjung berhasil diperbarui.');
    }

    public function destroy(Jenis_Mukena $jenis_mukena) //model
    {
        $jenis_mukena->delete();

        return redirect()->route('jenis_mukena.index')->with('success', 'data pengunjung berhasil dihapus.');
    }
}
