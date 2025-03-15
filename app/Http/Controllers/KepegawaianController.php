<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
class KepegawaianController extends Controller
{

    public function chartDosen(Request $request)
    {
        // $response = Http::get('http://127.0.0.1:8000/api/kepegawaian/data-jumlah-dosen');
        // $data = $response->json()['data'];

        $path = database_path('json/data-dosen.json');

        // Cek apakah file JSON ada
        if (!File::exists($path)) {
            return response()->json(['message' => 'File tidak ditemukan'], 404);
        }

        // Ambil isi file JSON
        $json = File::get($path);

        // Ubah ke array PHP
        $data_temp = json_decode($json, true);


        $data = $data_temp['data'];


         return view('chart.kepegawaian.chart_dosen', compact('data'));
    }


    public function chartDosenJabatan(Request $request)
    {
        // $response = Http::get('http://127.0.0.1:8000/api/kepegawaian/data-jumlah-dosen-jabatan');
        // $data = $response->json()['data'];

        $path = database_path('json/data-dosen-jabatan.json');

        // Cek apakah file JSON ada
        if (!File::exists($path)) {
            return response()->json(['message' => 'File tidak ditemukan'], 404);
        }

        // Ambil isi file JSON
        $json = File::get($path);

        // Ubah ke array PHP
        $data_temp = json_decode($json, true);


        $data = $data_temp['data'];



         return view('chart.kepegawaian.chart_dosen_jabatan', compact('data'));
    }

    public function chartTendik(Request $request)
    {
        // $response = Http::get('http://127.0.0.1:8000/api/kepegawaian/data-jumlah-tendik-jabatan');
        // $data = $response->json()['data'];

        $path = database_path('json/data-tendik.json');

        // Cek apakah file JSON ada
        if (!File::exists($path)) {
            return response()->json(['message' => 'File tidak ditemukan'], 404);
        }

        // Ambil isi file JSON
        $json = File::get($path);

        // Ubah ke array PHP
        $data_temp = json_decode($json, true);


        $data = $data_temp['data'];



         return view('chart.kepegawaian.chart_tendik', compact('data'));
    }

    public function chartTendikJabatan(Request $request)
    {
        // $response = Http::get('http://127.0.0.1:8000/api/kepegawaian/data-jumlah-tendik-jabatan');
        // $data = $response->json()['data'];

        $path = database_path('json/data-tendik.json');

        // Cek apakah file JSON ada
        if (!File::exists($path)) {
            return response()->json(['message' => 'File tidak ditemukan'], 404);
        }

        // Ambil isi file JSON
        $json = File::get($path);

        // Ubah ke array PHP
        $data_temp = json_decode($json, true);


        $data = $data_temp['data'];



         return view('chart.kepegawaian.chart_tendik_jabatan', compact('data'));
    }


}
