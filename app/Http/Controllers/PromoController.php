<?php

namespace App\Http\Controllers;

use App\Models\promo;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    public function index()
    {
        $promos = Promo::all();
        return view('admin.promo.index', compact('promos'));
    }

    public function create()
    {
        return view('admin.promo.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'promosi' => 'required',
            'deskripsi' => 'required',
        ]);

        Promo::create($request->all());

        return redirect()->route('promo.index')
            ->with('success', 'Promo created successfully.');
    }

    public function show(Promo $promo)
    {
        return view('admin.promo.show', compact('promo'));
    }

    public function edit(Promo $promo)
    {
        return view('admin.promo.edit', compact('promo'));
    }

    public function update(Request $request, Promo $promo)
    {
        $request->validate([
            'promosi' => 'required',
            'deskripsi' => 'required',
        ]);

        $promo->update($request->all());

        return redirect()->route('promo.index')
            ->with('success', 'Promo updated successfully.');
    }

    public function destroy(Promo $promo)
    {
        $promo->delete();

        return redirect()->route('promo.index')
            ->with('success', 'Promo deleted successfully.');
    }
}
