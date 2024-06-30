<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\HasilPE;
use App\Models\Jenis_Mukena;
use App\Models\Peramalan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class perhitunganMetode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:perhitungan-metode';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $jenis=Jenis_Mukena::all();
        foreach($jenis as $jen){
            for($x=1;$x<=9;$x++){


                $data=$jen->id_Jenis;
                $alpa=$x/10;
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
    if($key>=0 && $key<=10){
    $hasil=$monthlyData[$key+1]->jumlah_data;
    }else{
    $hasil=$monthlyData[$key]->jumlah_data;
    }
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
            }
        }

    }
}
