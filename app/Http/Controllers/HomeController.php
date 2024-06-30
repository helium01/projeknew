<?php

namespace App\Http\Controllers;

use App\Models\Jenis_Mukena;
use App\Models\Konsumen;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $jenis_mukenas = Jenis_Mukena::all();
        $konsumens = Konsumen::get();
        $transaksis = Transaksi::get();
        $view_data = [
            'jenis_mukenas' => $jenis_mukenas,
            'konsumens' => $konsumens,
            'transaksis' => $transaksis
        ];
        return view('admin.dashboard', $view_data);
    }
}
