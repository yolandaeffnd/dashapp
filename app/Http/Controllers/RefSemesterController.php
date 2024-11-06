<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\RefSemester;

class RefSemesterController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = RefSemester::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm" style="height:20px">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" style="height:20px">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $title = "Data Semester";
        return view('admin.refsemester.index',compact('title'));
    }
}
