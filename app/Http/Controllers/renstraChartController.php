<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
class renstraChartController extends Controller
{
    //
    public function chartikuII(Request $request){
        $response = Http::get('http://127.0.0.1:8000/api/mhs/data-iku-II');
        $data = $response->json()['data'];
    // dd($data);
    $fakultas = collect($data)->pluck('fakultas_nama')->unique();
    }
}
