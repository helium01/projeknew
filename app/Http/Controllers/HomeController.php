<?php

namespace App\Http\Controllers;

use App\Models\Jenis_Mukena;
use App\Models\pengunjung;
use App\Models\layanan;
use App\Models\promo;
use App\Models\keuangan;

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
        $pengunjungCount = Pengunjung::count();
        $layananCount = Layanan::count();
        $promoCount = Promo::count();
        $keuanganCount = Keuangan::count();
        $view_data = [
            'pengunjung' => $pengunjungCount,
            'layanan' => $layananCount,
            'promo' => $promoCount,
            'keuangan' => $keuanganCount,
        ];
        return view('admin.dashboard', $view_data);
    }
}
