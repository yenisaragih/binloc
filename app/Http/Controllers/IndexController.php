<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\Models\Binloc;


class IndexController extends Controller
{
    // Get all binloc data 
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = Binloc::select('*');
            
            return DataTables::of($data)->make(true);
        }

        return view('/theme/index');
    }


    // Fetch data binloc
    public function fetchData(Request $request)
    {
        if($request->ajax()){
            $data = DB::table('binlocs')->get();

            return view('binloc-table', compact('data'))->render();
        }
    }
}
