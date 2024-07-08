<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JenisMukenaController;

use App\Http\Controllers\KonsumenController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PeramalanController;
use App\Models\Konsumen;
use App\Models\Transaksi;
use App\Models\Jenis_Mukena;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\fuzzyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/jenis_mukenas', [JenisMukenaController::class, 'index'])->name('jenis_mukena.index');
// Menampilkan form tambah produk
Route::get('/jenis_mukenas/create', [JenisMukenaController::class, 'create'])->name('jenis_mukena.create');
// Menyimpan produk yang baru ditambahkan
Route::post('/jenis_mukenas', [JenisMukenaController::class, 'store'])->name('jenis_mukena.store');
// Menampilkan form edit produk
Route::get('/jenis_mukenas/{jenis_mukena}/edit', [JenisMukenaController::class, 'edit'])->name('jenis_mukena.edit');
// Mengupdate data produk yang diubah
Route::post('/post/jenis_mukenas/{jenis_mukena}', [JenisMukenaController::class, 'update'])->name('jenis_mukena.update');
// Menghapus produk
Route::get('/delete/jenis_mukenas/{jenis_mukena}', [JenisMukenaController::class, 'destroy'])->name('jenis_mukena.destroy');


Route::get('/konsumens', [KonsumenController::class, 'index'])->name('konsumen.index');
Route::get('/konsumens/create', [KonsumenController::class, 'create'])->name('konsumen.create');
Route::post('/konsumens', [KonsumenController::class, 'store'])->name('konsumen.store');
Route::get('/konsumens/{konsumen}/edit', [KonsumenController::class, 'edit'])->name('konsumen.edit');
Route::post('/post/konsumens/{konsumen}', [KonsumenController::class, 'update'])->name('konsumen.update');
Route::get('/delete/konsumens/{konsumen}', [KonsumenController::class, 'destroy'])->name('konsumen.destroy');


Route::get('/cetak', [TransaksiController::class, 'cetak']);
Route::get('/transaksis', [TransaksiController::class, 'index'])->name('transaksi.index');
Route::get('/transaksis/create', [TransaksiController::class, 'create'])->name('transaksi.create');
Route::post('/transaksis', [TransaksiController::class, 'store'])->name('transaksi.store');
Route::get('/transaksis/{transaksi}/edit', [TransaksiController::class, 'edit'])->name('transaksi.edit');
Route::put('post/transaksis/{transaksi}', [TransaksiController::class, 'update'])->name('transaksi.update');
Route::get('/delete/transaksis/{transaksi}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');



Route::get('/peramalan/{data}/{alpa}', [PeramalanController::class, 'index'])->name('permalan.index');
Route::get('/pe/{data}/{alpa}', [PeramalanController::class, 'index_pe']);
Route::get('/data/peramalan/view/data', [PeramalanController::class, 'index_view']);
Route::get('/data/peramalan/view/data2', [PeramalanController::class, 'index_view2']);
Route::get('/cari/data', [PeramalanController::class, 'index_cari']);
Route::get('/grafik/{data}/{alpa}', [PeramalanController::class, 'grafik']);
// Route::get('/input_datas/create', [InputDataController::class, 'create'])->name('input_data.create');
// Route::post('/input_datas', [InputDataController::class, 'store'])->name('input_data.store');
// Route::get('/input_datas/{input_data}/edit', [InputDataController::class, 'edit'])->name('input_data.edit');
// Route::post('/post/input_datas/{input_data}', [InputDataController::class, 'update'])->name('input_data.update');
// Route::get('/delete/input_datas/{input_data}', [InputDataController::class, 'destroy'])->name('input_data.destroy');



// Route::get('/penjualan_details', [PenjualanDetailController::class, 'index'])->name('penjualan_detail.index');
// Route::get('/penjualan_details/create', [PenjualanDetailController::class, 'create'])->name('penjualan_detail.create');
// Route::post('/penjualan_details', [PenjualanDetailController::class, 'store'])->name('penjualan_detail.store');
// Route::get('/penjualan_details/{penjualan_detail}/edit', [PenjualanDetailController::class, 'edit'])->name('penjualan_detail.edit');
// Route::post('/post/penjualan_details/{penjualan_detail}', [PenjualanDetailController::class, 'update'])->name('penjualan_detail.update');
// Route::get('/delete/penjualan_details/{penjualanDetail}', [PenjualanDetailController::class, 'destroy'])->name('penjualan_detail.destroy');

// prediksi
Route::post('/predict', [fuzzyController::class, 'predict'])->name('predict');
Route::get('/view/predict', [fuzzyController::class, 'view_predict'])->name('prediksi');
Route::get('/view/himpunan', [fuzzyController::class, 'showFuzzifikasi'])->name('prediksi');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    return view('auth.login');
});