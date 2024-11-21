<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function kategori(){
        $kategori = Kategori::all();
        return view('configurations.kategori',compact('kategori'));
    }
    public function crudKategori(Request $request){
        if($request->action == "DELETE"){
            $roles = Kategori::findOrFail($request->id);
            $roles->delete();
            return redirect()->back()->withSuccess('Kategori Deleted successfully!');
        }
        $validasi = $request->validate([
            'name'=>'required|max:30',
            'jenis'=>'max:100',
            'action'=>'required|max:6',
        ]);
        if($request->action == "SAVE"){
            Kategori::create([
                'name' => $request->name,
                'jenis'=> $request->jenis,
                'created_at'=>now(),
                'updated_at'=>now(),
            ]);
            return redirect()->back()->withSuccess('Kategori Created successfully!');
        }elseif($request->action == "UPDATE"){
            $roles = Kategori::findOrFail($request->id);
            $roles->update([
                'name' => $request->name,
                'jenis' => $request->jenis,
                'updated_at' => now(),
            ]);
            return redirect()->back()->withSuccess('Kategori Updated successfully!');
        }
        return redirect()->back()->withErrors(['error' => 'Action failed. Please try again.']);
    }
    public function getKategori(){
        $kategori = Kategori::all();
        return response()->json($kategori);
    }
}
