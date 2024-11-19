<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
}
