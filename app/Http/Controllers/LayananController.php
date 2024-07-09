<?php

namespace App\Http\Controllers;

use App\Models\layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index()
    {
        $layanans = Layanan::all();
        return view('admin.layanan.index', compact('layanans'));
    }

    public function create()
    {
        return view('admin.layanan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'layanan' => 'required',
            'deskripsi' => 'required',
        ]);

        Layanan::create($request->all());

        return redirect()->route('layanan.index')
            ->with('success', 'Layanan created successfully.');
    }

    public function show(Layanan $layanan)
    {
        return view('admin.layanan.show', compact('layanan'));
    }

    public function edit(Layanan $layanan)
    {
        return view('admin.layanan.edit', compact('layanan'));
    }

    public function update(Request $request, Layanan $layanan)
    {
        $request->validate([
            'layanan' => 'required',
            'deskripsi' => 'required',
        ]);

        $layanan->update($request->all());

        return redirect()->route('layanan.index')
            ->with('success', 'Layanan updated successfully.');
    }

    public function destroy(Layanan $layanan)
    {
        $layanan->delete();

        return redirect()->route('layanan.index')
            ->with('success', 'Layanan deleted successfully.');
    }
}
