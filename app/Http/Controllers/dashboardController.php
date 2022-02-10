<?php

namespace App\Http\Controllers;

use App\model\vwgraphpesanbulanini;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('cekmenuroles');
    }


    public function index()
    {
        return view('dashboard');
    }
    


    public function store(Request $request)
    {
        $cur_user = \Auth::user();

        switch($request->mode){
            case 'getbulanini':
                    $bulaninixx = vwgraphpesanbulanini::select('x')->pluck('x');
                    $bulaniniy = vwgraphpesanbulanini::selectraw('y as y')->get();


                    return response()->json(['success' => 'Berhasil', 'bulaninix' => $bulaninixx, 'bulaniniy' => $bulaniniy]);    
                break;
        }

    }
}
