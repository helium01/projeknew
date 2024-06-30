<?php

namespace App\Http\Controllers;

use App\Models\HasilPE;
use App\Models\Jenis_Mukena;
use App\Models\Peramalan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeramalanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   public function index($data,$alpa) {
    $nilai=Peramalan::where('Jenis_Mukena',$data)->get();
    foreach($nilai as $n){
    if($nilai->count()!=0 && $n->alpa==$alpa){
   Peramalan::where('Jenis_Mukena',$data)->delete();
//    dd("ok");
    }

    }
    $monthlyData = DB::table('transaksis')
        ->select(DB::raw('YEAR(tanggal) as tahun, MONTH(tanggal) as bulan, SUM(Jumlah) as jumlah_data'))
        ->groupBy('tahun', 'bulan')
        ->orderBy('tahun', 'asc')
        ->orderBy('bulan', 'asc')
        ->where('id_Jenis', $data)
        ->get();

    $alpha = $alpa;
    $forecasts = [];
    $previousForecast = null;

    foreach ($monthlyData as $key => $item) {
        if ($key == 0) {
            // Untuk data pertama, peramalan sama dengan nilai data pertama
            $forecast = $item->jumlah_data;
        } else {
            if ($previousForecast == $item->jumlah_data) {
                // Untuk data kedua, peramalan sama dengan nilai data kedua
                $forecast = $item->jumlah_data;
            } else {
                // Peramalan berikutnya dihitung menggunakan rumus SES
                $forecast = $alpha * $item->jumlah_data + (1 - $alpha) * $previousForecast;
            }
        }

        $previousForecast = $forecast;
        $forecasts[] = $forecast;
    }

    // Peramalan untuk 3 bulan ke depan
    $lastDataPoint = $monthlyData->last();
    $lastYear = $lastDataPoint->tahun;
    $lastMonth = $lastDataPoint->bulan-1;
    $nextForecasts = [];

    for ($i = 0; $i < 3; $i++) {
        $lastMonth++;
        if ($lastMonth > 12) {
            $lastMonth = 1;
            $lastYear++;
        }
        $nextForecast = $alpha * $lastDataPoint->jumlah_data + (1 - $alpha) * $previousForecast;
        $previousForecast = $nextForecast;
        $nextForecasts[] = $nextForecast;
    }

    // Menampilkan hasil peramalan
    $error=[];
   foreach ($forecasts as $key => $forecast) {
    $dataPoint = $monthlyData[$key];
    if($key<=10){
    $dataPoint2 = $monthlyData[$key+1];
    }
    // dd($dataPoint);
    $bulan = $dataPoint->bulan + 1;
    $tahun = $dataPoint->tahun;
    $namaBulan = date('F', mktime(0, 0, 0, $bulan, 1));
    // dd($dataPoint);
    $error=abs($dataPoint2->jumlah_data-$forecast)/$dataPoint2->jumlah_data*100;
    $hasil=$monthlyData[$key]->jumlah_data;
    // dd($error);
    if($namaBulan=="January"){
        $tahun="2023";
        $error=0;
        $hasil=0;

    }
    // dd($hasil);
    // echo "Peramalan untuk bulan $namaBulan $tahun adalah $forecast <br>";
    Peramalan::create([
        'Jenis_Mukena'=>$data,
        'Bulan'=>$namaBulan,
        'Tahun'=>$tahun,
        'Jumlah'=>$forecast,
        'pe'=>$error,
        'alpa'=>$alpa,
        'aktual'=>$hasil
    ]);
}

    // Menampilkan peramalan untuk 3 bulan ke depan
    $nextMonth = $lastMonth;
    $nextYear = $lastYear;

    foreach ($nextForecasts as $forecast) {
        if ($nextMonth > 12) {
            $nextMonth = 1;
            $nextYear++;
        }
        $namaBulan = date('F', mktime(0, 0, 0, $nextMonth, 1));
        // echo "Peramalan untuk bulan $namaBulan $nextYear adalah $forecast <br>";
        $nextMonth++;
        $error=0;
         Peramalan::create([
        'Jenis_Mukena'=>$data,
        'Bulan'=>$namaBulan,
        'Tahun'=>$nextYear,
        'Jumlah'=>$forecast,
        'pe'=>$error,
        'alpa'=>$alpa,
        'aktual'=>0,
    ]);
    }

    dd($monthlyData);
}
public function index_view(Request $request){
    // dd($request->jenis);
    if($request->alpa !=null && $request->jenis !=null){
    $peramalan=Peramalan::where('alpa',$request->alpa)->where('Jenis_Mukena',$request->jenis)->simplePaginate(10);
       $alp=$request->alpa;
    }else{
    $peramalan=Peramalan::simplePaginate(10);
        $alp="pilih alpa";
    }
    $alpa=[0.1,0.2,0.3,0.4,0.5,0.6,0.7,0.8,0.9];
    $jenis=Jenis_Mukena::all();
    $jenis2=$request->jenis;
    // dd($jenis2);
    return view('admin.peramalan.index',compact('peramalan','alpa','jenis','alp','jenis2'));
}
public function index_view2(Request $request){
    // dd($request->jenis);
    // if($request->alpa !=null && $request->jenis !=null){
        $hasilpe=HasilPE::where('alpa',$request->alpa)->where('nama',$request->jenis)->get();
        $rekompe=HasilPE::where('nama',$request->jenis)->orderBy('jumlah_pe','asc')->limit(1)->get();
        // dd($rekompe);
    $peramalan=Peramalan::where('alpa',$request->alpa)->where('Jenis_Mukena',$request->jenis)->simplePaginate(10);
       $alp=$request->alpa;
    // }
    $alpa=[0.1,0.2,0.3,0.4,0.5,0.6,0.7,0.8,0.9];
    $jenis=Jenis_Mukena::all();
    $jenis2=$request->jenis;
    return view('admin.peramalan.index',compact('peramalan','alpa','jenis','jenis2','alp','hasilpe','rekompe'));
}
public function index_cari(Request $request){
    // dd("o");
    $transaksis = Transaksi::where('id_Jenis', 'like', '%' . $request->cari . '%')->simplePaginate(10);
    $alpa=[0.1,0.2,0.3,0.4,0.5,0.6,0.7,0.8,0.9];
    // dd($alpa);
    return view('admin.transaksi.index',compact('transaksis','alpa'));
}
public function index_pe($data,$alpa){

    HasilPE::where('nama',$data)->where('alpa',$alpa)->delete();
    // dd($alpa,$data);
$totalPe = Peramalan::where('Jenis_Mukena',$data)->where('alpa',$alpa)
                    ->sum('pe');

$totalData = Peramalan::where('Jenis_Mukena',$data)->where('alpa',$alpa)->where('Tahun',2022)
                    ->count();

                    // dd($totalData);

if ($totalData > 0) {
    $averagePe = $totalPe / $totalData;
} else {
    $averagePe = 0;
}
HasilPE::create([
    'nama'=>$data,
    'alpa'=>$alpa,
    'jumlah_pe'=>$averagePe
]);

// Output nilai rata-rata pe
echo $averagePe;

}
public function grafik($data,$alpa){
//    $data = $data;
    // dd('ok');
    $monthlyData = DB::table('transaksis')
        ->select(DB::raw('YEAR(tanggal) as tahun, MONTH(tanggal) as bulan, SUM(Jumlah) as jumlah_data'))
        ->groupBy('tahun', 'bulan')
        ->orderBy('tahun', 'asc')
        ->orderBy('bulan', 'asc')
        ->where('id_Jenis', $data)
        ->get();

    $dataAktual = [];
    $dataPeramalan = [];
$peramalan = Peramalan::where('Jenis_Mukena', $data)
            ->where('alpa', $alpa)
            ->get();
    foreach ($monthlyData as $index=>$data) {
        $dataAktual[] = $data->jumlah_data;

        $dataPeramalan[] = $peramalan[$index]->Jumlah;
    }
$labels = $monthlyData->pluck('bulan')->map(function ($bulan) {
    return date('F', mktime(0, 0, 0, $bulan, 1));
});
// dd('ok');
    $response = [
        'labels' => $labels,
        'dataAktual' => $dataAktual,
        'dataPeramalan' => $dataPeramalan
    ];

    // dd($response);
    return Response()->json($response);

// Output data gabungan
// print_r($gabungData->toArray());
// dd($gabungData);

}

}
