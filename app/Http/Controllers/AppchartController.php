<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appchart;
use App\Models\Kategori;

class AppchartController extends Controller
{
    public function Appchart(){
        $chart = Appchart::all();
        $kategori = Kategori::all();
        return view('configurations.chart',compact('chart','kategori'));
    }

    public function crudAppchart(Request $request){
        if($request->action == "DELETE"){
            $roles = Appchart::findOrFail($request->id);
            $roles->delete();
            return redirect()->back()->withSuccess('Chart Deleted successfully!');
        }
        $validasi = $request->validate([
            'idKategori'=>'required',
            'namaChart'=>'required|max:100',
            'urlChart'=>'max:100',
            'idFakultas'=>'required',
            'posisiChart'=>'required',
            'action'=>'required|max:6',
        ]);
        if($request->action == "SAVE"){
            Appchart::create([
                'idKategori' => $request->idKategori,
                'namaChart'=> $request->namaChart,
                'urlChart'=> $request->urlChart,
                'idFakultas'=> $request->idFakultas,
                'posisiChart'=> $request->posisiChart,
                'created_at'=>now(),
                'updated_at'=>now(),
            ]);
            return redirect()->back()->withSuccess('Chart Created successfully!');
        }elseif($request->action == "UPDATE"){
            $roles = Appchart::findOrFail($request->id);
            $roles->update([
                'idKategori' => $request->idKategori,
                'namaChart'=> $request->namaChart,
                'urlChart'=> $request->urlChart,
                'idFakultas'=> $request->idFakultas,
                'posisiChart'=> $request->posisiChart,
                'updated_at' => now(),
            ]);
            return redirect()->back()->withSuccess('Chart Updated successfully!');
        }
        return redirect()->back()->withErrors(['error' => 'Action failed. Please try again.']);
    }
    public function getAppchart(){
        $chart = Appchart::all();
        return response()->json($chart);
    }
}
