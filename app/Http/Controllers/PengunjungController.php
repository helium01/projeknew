<?php

namespace App\Http\Controllers;

use App\Models\pengunjung;
use Illuminate\Http\Request;

class PengunjungController extends Controller
{
    public function index()
    {
        $pengunjungs = Pengunjung::all();
        return view('admin.pengunjung.index', compact('pengunjungs'));
    }

    public function create()
    {
        return view('admin.pengunjung.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pengunjung' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
        ]);

        Pengunjung::create($request->all());

        return redirect()->route('pengunjung.index')
            ->with('success', 'Pengunjung created successfully.');
    }

    public function show(Pengunjung $pengunjung)
    {
        return view('admin.pengunjung.show', compact('pengunjung'));
    }

    public function edit(Pengunjung $pengunjung)
    {
        return view('admin.pengunjung.edit', compact('pengunjung'));
    }

    public function update(Request $request, Pengunjung $pengunjung)
    {
        $request->validate([
            'nama_pengunjung' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
        ]);

        $pengunjung->update($request->all());

        return redirect()->route('pengunjung.index')
            ->with('success', 'Pengunjung updated successfully.');
    }

    public function destroy(Pengunjung $pengunjung)
    {
        $pengunjung->delete();

        return redirect()->route('pengunjung.index')
            ->with('success', 'Pengunjung deleted successfully.');
    }
}
