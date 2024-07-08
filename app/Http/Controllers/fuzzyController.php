<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class fuzzyController extends Controller
{
    public function view_predict(){
        return view('admin.fuzzy.view');
    }
    public function predict(Request $request)
    {
        // var_dump($request->kualitas);die;
        // Ambil input dari request
        $tarif = (int)$request->tarif;
        $kualitas = (int)$request->kualitas;
        $promosi = (int)$request->promosi;

        // Fuzzifikasi
        $fuzzyTarif = $this->fuzzifyTarif($tarif);
        $fuzzyKualitas = $this->fuzzifyKualitas($kualitas);
        $fuzzyPromosi = $this->fuzzifyPromosi($promosi);

// dd($fuzzy['rendah']);
        // Inferensi
        $result = $this->inference($fuzzyTarif, $fuzzyKualitas, $fuzzyPromosi);
        $fuzzyData = [
            'labels' => ['rendah', 'sedang', 'tinggi'],
            'datasets' => [
                [
                    'label' => 'Tarif',
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 1,
                    'data' => [$fuzzyTarif['rendah'], $fuzzyTarif['sedang'], $fuzzyTarif['tinggi']]
                ],
                [
                    'label' => 'Kualitas',
                    'backgroundColor' => 'rgba(255, 99, 132, 0.2)',
                    'borderColor' => 'rgba(255, 99, 132, 1)',
                    'borderWidth' => 1,
                    'data' => [$fuzzyKualitas['rendah'], $fuzzyKualitas['sedang'], $fuzzyKualitas['tinggi']]
                ],
                [
                    'label' => 'Promosi',
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'borderWidth' => 1,
                    'data' => [$fuzzyPromosi['tidak_ada'], $fuzzyPromosi['sedikit'], $fuzzyPromosi['banyak']]
                ]
            ]
        ];

        // Defuzzifikasi (dalam kasus Sugeno, hasil inferensi biasanya sudah berupa nilai defuzzifikasi)
       return view('admin.fuzzy.result',compact('result','fuzzyData','fuzzyKualitas','fuzzyTarif','fuzzyPromosi'));
    }

    private function fuzzifyTarif($value)
    {
        $rendah = max(0, min(1, (100 - $value) / 100));
        $sedang = max(0, min(($value - 50) / 50, (150 - $value) / 50));
        $tinggi = max(0, min(($value - 100) / 100, 1));
    
        return ['rendah' => $rendah, 'sedang' => $sedang, 'tinggi' => $tinggi];
    }
    

    private function fuzzifyKualitas($value)
{
    $rendah = max(0, min(1, (50 - $value) / 50));
    $sedang = max(0, min(($value - 25) / 25, (75 - $value) / 25));
    $tinggi = max(0, min(($value - 50) / 50, 1));

    return ['rendah' => $rendah, 'sedang' => $sedang, 'tinggi' => $tinggi];
}


private function fuzzifyPromosi($value)
{
    $tidak_ada = max(0, min(1, (3 - $value) / 2)); 
    $sedikit = max(0, min(($value - 3) / 2, (7 - $value) / 2)); 
    $banyak = max(0, min(($value - 5) / 2, 1)); 
    
    return ['tidak_ada' => $tidak_ada, 'sedikit' => $sedikit, 'banyak' => $banyak];
}

    

    private function inference($fuzzyTarif, $fuzzyKualitas, $fuzzyPromosi)
{
    // Definisikan aturan fuzzy
    $rules = [
        ['if' => ['tarif' => 'rendah', 'kualitas' => 'tinggi', 'promosi' => 'banyak'], 'then' => 'tinggi'],
        ['if' => ['tarif' => 'tinggi', 'kualitas' => 'rendah', 'promosi' => 'tidak_ada'], 'then' => 'rendah'],
        ['if' => ['tarif' => 'sedang', 'kualitas' => 'sedang', 'promosi' => 'sedikit'], 'then' => 'sedang'],
        // Tambahkan aturan umum untuk input tinggi
        ['if' => ['tarif' => 'tinggi', 'kualitas' => 'tinggi', 'promosi' => 'banyak'], 'then' => 'tinggi'],
        // Tambahkan aturan untuk kombinasi input sedang, tinggi, banyak
        ['if' => ['tarif' => 'sedang', 'kualitas' => 'tinggi', 'promosi' => 'banyak'], 'then' => 'tinggi'],
        ['if' => ['tarif' => 'sedang', 'kualitas' => 'tinggi', 'promosi' => 'sedikit'], 'then' => 'sedang'],
        ['if' => ['tarif' => 'sedang', 'kualitas' => 'sedang', 'promosi' => 'banyak'], 'then' => 'sedang']
    ];

    // Implementasi aturan fuzzy
    $outputs = [];
    foreach ($rules as $rule) {
        $minValue = min($fuzzyTarif[$rule['if']['tarif']], $fuzzyKualitas[$rule['if']['kualitas']], $fuzzyPromosi[$rule['if']['promosi']]);
        $outputs[$rule['then']][] = $minValue;
    }

    // Agregasi output
    $aggregatedOutput = [
        'rendah' => isset($outputs['rendah']) ? max($outputs['rendah']) : 0,
        'sedang' => isset($outputs['sedang']) ? max($outputs['sedang']) : 0,
        'tinggi' => isset($outputs['tinggi']) ? max($outputs['tinggi']) : 0,
    ];

    // Jumlah dari nilai agregasi
    $sumAggregatedOutput = array_sum($aggregatedOutput);

    // Defuzzifikasi (untuk Sugeno, biasanya output adalah weighted average)
    if ($sumAggregatedOutput == 0) {
        // Menghindari division by zero
        return 0;
    }

    $defuzzifiedOutput = (
        $aggregatedOutput['rendah'] * 30 +
        $aggregatedOutput['sedang'] * 50 +
        $aggregatedOutput['tinggi'] * 80
    ) / $sumAggregatedOutput;

    return $defuzzifiedOutput;
}
public function showFuzzifikasi(Request $request)
{
    // Nilai input untuk uji coba, bisa disesuaikan dengan nilai yang diinginkan
    $kualitasValue = $request->input('kualitas', 50); // Default value adalah 50
    $tarifValue = $request->input('tarif', 100); // Default value adalah 100
    $promosiValue = $request->input('promosi', 1); // Default value adalah 5

    // Panggil fungsi fuzzify untuk mendapatkan derajat keanggotaan
    $fuzzyKualitas = $this->fuzzifyKualitas_himpunan($kualitasValue);
    $fuzzyTarif = $this->fuzzifyTarif_himpunan($tarifValue);
    $fuzzyPromosi = $this->fuzzifyPromosi_himpunan($promosiValue);

    // Generate data points for fuzzy sets
    $labels = range(0, 100);
    $labels_promo = range(0, 50);
    $dataKualitasRendah = array_map([$this, 'fuzzifyKualitasRendah'], $labels);
    $dataKualitasSedang = array_map([$this, 'fuzzifyKualitasSedang'], $labels);
    $dataKualitasTinggi = array_map([$this, 'fuzzifyKualitasTinggi'], $labels);
    // dd($fuzzyKualitas);

    $dataTarifRendah = array_map([$this, 'fuzzifyTarifRendah'], $labels);
    $dataTarifSedang = array_map([$this, 'fuzzifyTarifSedang'], $labels);
    $dataTarifTinggi = array_map([$this, 'fuzzifyTarifTinggi'], $labels);

    $dataPromosiTidakAda = array_map([$this, 'fuzzifyPromosiTidakAda'], $labels);
    $dataPromosiSedikit = array_map([$this, 'fuzzifyPromosiSedikit'], $labels);
    $dataPromosiBanyak = array_map([$this, 'fuzzifyPromosiBanyak'], $labels);

    return view('admin.fuzzy.himpunanfuzzy', compact(
        'labels','labels_promo',
        'dataKualitasRendah', 'dataKualitasSedang', 'dataKualitasTinggi',
        'dataTarifRendah', 'dataTarifSedang', 'dataTarifTinggi',
        'dataPromosiTidakAda', 'dataPromosiSedikit', 'dataPromosiBanyak'
    ));
}

private function fuzzifyKualitas_himpunan($value)
{
    return [
        'rendah' => $this->fuzzifyKualitasRendah($value),
        'sedang' => $this->fuzzifyKualitasSedang($value),
        'tinggi' => $this->fuzzifyKualitasTinggi($value)
    ];
}

private function fuzzifyKualitasRendah($value)
{
    return max(0, min(1, (50 - $value) / 50));
}

private function fuzzifyKualitasSedang($value)
{
    return max(0, min(($value - 25) / 25, (75 - $value) / 25));
}

private function fuzzifyKualitasTinggi($value)
{
    return max(0, min(($value - 50) / 50, 1));
}

private function fuzzifyTarif_himpunan($value)
{
    return [
        'rendah' => $this->fuzzifyTarifRendah($value),
        'sedang' => $this->fuzzifyTarifSedang($value),
        'tinggi' => $this->fuzzifyTarifTinggi($value)
    ];
}

private function fuzzifyTarifRendah($value)
{
    return max(0, min(1, (50 - $value) / 100));
}

private function fuzzifyTarifSedang($value)
{
    return max(0, min(($value - 50) / 100, (150 - $value) / 50));
}

private function fuzzifyTarifTinggi($value)
{
    return max(0, min(($value - 50) / 100, 1));
}

private function fuzzifyPromosi_himpunan($value)
{
    return [
        'tidak_ada' => $this->fuzzifyPromosiTidakAda($value),
        'sedikit' => $this->fuzzifyPromosiSedikit($value),
        'banyak' => $this->fuzzifyPromosiBanyak($value)
    ];
}

private function fuzzifyPromosiTidakAda($value)
{
    return max(0, min(1, (2 - $value) / 2));
}

private function fuzzifyPromosiSedikit($value)
{
    return max(0, min(($value - 1) / 4, (7 - $value) / 2));
}

private function fuzzifyPromosiBanyak($value)
{
    return max(0, min(($value - 5) / 5, 1));
}


    
}