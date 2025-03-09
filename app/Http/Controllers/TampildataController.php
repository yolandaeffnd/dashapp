<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class TampildataController extends Controller
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

        $response = Http::get('http://127.0.0.1:8000/api/mhs/data-mahasiswa'); // Ganti dengan URL API yang sesuai
        $data = $response->json()['data'];
         // Ambil daftar fakultas unik
         $fakultas = collect($data)->pluck('fakultas_nama')->unique();

         return view('chart.chart_mahasiswa', compact('data', 'fakultas'));

    }

    // public function mahasiswa_angkatan_index()
    // {
    //     return view('chart.chart_angkatan'); // Sesuaikan dengan lokasi file Blade Anda
    // }

    public function mahasiswa_angkatan()
    {
        // URL API yang menyediakan data


        // Mengambil data dari API
        $response = Http::get('http://127.0.0.1:8000/api/mhs/data-angkatan-mahasiswa'); // Ganti dengan URL API yang sesuai
        // dd($response);
      //  Periksa apakah permintaan berhasil (status 200)
        if ($response->successful()) {
            $data = $response->json(); // Konversi respons menjadi array
        } else {
            $data = ['error' => 'Gagal mengambil data dari API'];
        }

        return view('chart.chart_angkatan', compact('data'));
    }



    /**
     * Mengambil daftar Fakultas, Program Studi, dan Angkatan untuk Filter.
     */
    public function getFilters()
    {
        // Ambil data dari API eksternal
        $response = Http::get('http://127.0.0.1:8000/api/mhs/data-angkatan-mahasiswa'); // Ganti dengan API yang sesuai
        $data = $response->json()['data'] ?? [];

        // Jika data kosong, kembalikan response error
        if (!$data) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        // Flatten data berdasarkan struktur API
        $flattenedData = [];
        foreach ($data as $group) {
            foreach ($group as $key => $item) {
                $flattenedData[] = [
                    'fakultas' => $item['fakultas'],
                    'program_studi' => $item['program_studi'],
                    'angkatan' => $item['angkatan'],
                ];
            }
        }

        // Ambil daftar Fakultas, Program Studi, dan Angkatan yang unik
        $fakultas = collect($flattenedData)->pluck('fakultas')->unique()->sort()->values();
        $programStudi = collect($flattenedData)->pluck('program_studi')->unique()->sort()->values();
        $angkatan = collect($flattenedData)->pluck('angkatan')->unique()->sort()->values();

        return response()->json([
            'fakultas' => $fakultas,
            'program_studi' => $programStudi,
            'angkatan' => $angkatan
        ]);
    }
}
