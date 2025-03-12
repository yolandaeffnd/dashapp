<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
class renstraChartController extends Controller
{

    public function chartikuII(Request $request)
    {
        // $response = Http::get('http://127.0.0.1:8000/api/mhs/data-iku-II');
        // $data = $response->json()['data'];
        $path = database_path('json/data-iku2.json');

        // Cek apakah file JSON ada
        if (!File::exists($path)) {
            return response()->json(['message' => 'File tidak ditemukan'], 404);
        }

        // Ambil isi file JSON
        $json = File::get($path);

        // Ubah ke array PHP
        $data_temp = json_decode($json, true);
        $data = $data_temp['data'];

        // dd($data);
        if ($data === null || !isset($data)) {
            return response()->json(['message' => 'Format JSON tidak valid'], 400);
        }

        // Ambil tahun yang tersedia
        $years = array_keys($data);

        // Ambil fakultas pertama untuk mengambil sub kategori (asumsi sub kategori pada setiap fakultas seragam)
        $firstFaculty = array_values($data[$years[0]]['IKU']['IKU 2'])[0]; // Fakultas pertama
        $subCategories = array_keys($firstFaculty); // Subkategori berdasarkan fakultas pertama

        // Ambil tahun & sub kategori yang dipilih
        $tahunDipilih = $request->query('tahun', $years[0]);
        $subKategoriDipilih = $request->query('sub_kategori', 'all'); // Default: Semua subkategori

        // Siapkan data untuk chart
        $chartData = [];
        $labels = []; // Label untuk sumbu X (fakultas)
        $dataset = []; // Dataset untuk nilai setiap subkategori

        // Ambil data berdasarkan tahun yang dipilih
        if (isset($data[$tahunDipilih]['IKU']['IKU 2'])) {
            // Loop untuk setiap fakultas
            foreach ($data[$tahunDipilih]['IKU']['IKU 2'] as $fakultas => $subKategoriData) {
                // Tambahkan fakultas ke label
                $labels[] = $fakultas;

                // Loop untuk setiap subkategori dan ambil data dari fakultas
                foreach ($subCategories as $subKategori) {
                    if (isset($subKategoriData[$subKategori])) {
                        // Pastikan kita mendapatkan nilai untuk setiap subkategori
                        $dataset[$subKategori][] = (int) $subKategoriData[$subKategori]['nilai'];
                    } else {
                        $dataset[$subKategori][] = 0; // Jika data tidak ada, set ke 0
                    }
                }
            }
        }

        // Filter berdasarkan subkategori jika ada yang dipilih
        if ($subKategoriDipilih !== 'all') {
            $dataset = array_filter($dataset, function($key) use ($subKategoriDipilih) {
                return $key === $subKategoriDipilih;
            }, ARRAY_FILTER_USE_KEY);
        }

        // Return view dengan data yang sudah diproses
        return view('chart.renstra.chart_iku_II', compact('chartData', 'years', 'subCategories', 'tahunDipilih', 'subKategoriDipilih', 'labels', 'dataset'));
    }


}
