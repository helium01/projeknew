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
       return view('admin.fuzzy.result',compact('result','fuzzyData'));
    }

    private function fuzzifyTarif($value)
    {
        $rendah = max(0, min(1, (100 - $value) / 100));
        $sedang = max(0, min(($value - 50) / 100, (200 - $value) / 50));
        $tinggi = max(0, min(($value - 150) / 100, 1));
    
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
        $tidak_ada = max(0, min(1, (2 - $value) / 2));
        $sedikit = max(0, min(($value - 1) / 4, (7 - $value) / 2));
        $banyak = max(0, min(($value - 5) / 5, 1));
    
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


    
}
