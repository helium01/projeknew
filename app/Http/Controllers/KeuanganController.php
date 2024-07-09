<?php

namespace App\Http\Controllers;

use App\Models\keuangan;
use Illuminate\Http\Request;

class KeuanganController extends Controller
{
    public function index()
    {
        $keuangans = Keuangan::all();
        return view('admin.keuangan.index', compact('keuangans'));
    }

    public function create()
    {
        return view('admin.keuangan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'masuk' => 'required',
            'keluar' => 'required',
            'saldo' => 'required',
            'deskripsi' => 'required',
        ]);

        Keuangan::create($request->all());

        return redirect()->route('keuangan.index')
            ->with('success', 'Keuangan record created successfully.');
    }

    public function show(Keuangan $keuangan)
    {
        return view('admin.keuangan.show', compact('keuangan'));
    }

    public function edit(Keuangan $keuangan)
    {
        return view('admin.keuangan.edit', compact('keuangan'));
    }

    public function update(Request $request, Keuangan $keuangan)
    {
        $request->validate([
            'masuk' => 'required',
            'keluar' => 'required',
            'saldo' => 'required',
            'deskripsi' => 'required',
        ]);

        $keuangan->update($request->all());

        return redirect()->route('keuangan.index')
            ->with('success', 'Keuangan record updated successfully.');
    }

    public function destroy(Keuangan $keuangan)
    {
        $keuangan->delete();

        return redirect()->route('keuangan.index')
            ->with('success', 'Keuangan record deleted successfully.');
    }
}
