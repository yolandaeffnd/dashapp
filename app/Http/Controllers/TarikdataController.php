<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class TarikdataController extends Controller
{
    public function tarikdata(Request $request)
    {

        // Query from the second database
        $mahasiswa_fti = DB::connection('mysql2')->table('mahasiswa')->get();

        $mahasiswa_teknik = DB::connection('mysql3')->table('mahasiswa')->limit(10)->get();

        $mahasiswa_fkep = DB::connection('mysql4')->table('mahasiswa')->limit(10)->get();


        foreach($mahasiswa_fti as $mhsfti){


            if(!empty($mhsfti->mhsNiu && $mhsfti->mhsAngkatan == '2021')){

                $insertData = [
                    'mhsNiu' => $mhsfti->mhsNiu,
                    'mhsNif' => $mhsfti->mhsNif,
                    'mhsAngkatan' => $mhsfti->mhsAngkatan,
                ];

                DB::connection('mysql')->table('mahasiswa')->insert($insertData);
            }


        }

         dd($mahasiswa_fti);


    }

    public function mahasiswa(Request $request)
    {
        // Ambil data dari API
        $response = Http::get('http://127.0.0.1:8000/api/mhs/data-mahasiswa'); // Ganti dengan URL API yang sesuai
        $data = $response->json();

       if ($data['code'] == 200) {
            $mahasiswas = $data['data'];
            $selectedProdi = $request->query('prodi'); // Ambil prodi dari query string

            // Filter berdasarkan Prodi jika dipilih
            if ($selectedProdi) {
                $mahasiswas = array_filter($mahasiswas, function ($mhs) use ($selectedProdi) {
                    return $mhs['prodiNamaResmi'] === $selectedProdi;
                });
            }

            // Mengelompokkan data berdasarkan Angkatan
            $chartData = [];
            foreach ($mahasiswas as $mhs) {
                $angkatan = $mhs['mhsAngkatan'];
                if (!isset($chartData[$angkatan])) {
                    $chartData[$angkatan] = 0;
                }
                $chartData[$angkatan]++;
            }

            // Ambil daftar prodi unik untuk filter dropdown
            $listProdi = array_unique(array_column($data['data'], 'prodiNamaResmi'));

            return view('chart.chart_mahasiswa', [
                'mahasiswas' => $mahasiswas,
                'chartLabels' => json_encode(array_keys($chartData)), // Tahun angkatan
                'chartData' => json_encode(array_values($chartData)), // Jumlah mahasiswa per angkatan
                'listProdi' => $listProdi,
                'selectedProdi' => $selectedProdi
            ]);
        }

        return abort(404, 'Data tidak ditemukan');
    }

}
