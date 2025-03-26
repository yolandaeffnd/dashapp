<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
class TracerStudyController extends Controller
{

    public function chartTracer(Request $request)
    {
        // $response = Http::get('http://127.0.0.1:8000/api/tracer/data-tracer-study');
        // $data = $response->json()['data'];

        $path = database_path('json/data-tracer.json');

        // Cek apakah file JSON ada
        if (!File::exists($path)) {
            return response()->json(['message' => 'File tidak ditemukan'], 404);
        }

        // Ambil isi file JSON
        $json = File::get($path);

        // Ubah ke array PHP
        $data_temp = json_decode($json, true);


        $data = $data_temp['data'];


         return view('chart.tracer.chart_tracer', compact('data'));
    }






}
