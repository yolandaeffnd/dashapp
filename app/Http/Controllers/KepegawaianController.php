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
        $response = Http::get('http://127.0.0.1:8000/api/kepegawaian/data-jumlah-dosen');
        $data = $response->json()['data'];



         return view('chart.kepegawaian.chart_dosen', compact('data'));
    }


}
