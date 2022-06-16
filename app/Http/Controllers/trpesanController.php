<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\model\posframe_mstbarang;
use App\model\trpesantmpd;

use DB;
use Carbon\Carbon;

class trpesanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('cekmenuroles');
    }


    public function index()
    {
        $cur_user = \Auth::user();
        // $mstbarang = posframe_mstbarang::orderby('nama')->get();

        $que = "select a.*, ifnull(b.qty, 0) as qty, ifnull(b.harga, 0) as harga, ifnull(b.disc, 0) as disc, ifnull(b.jumlah, 0) as jumlah, ifnull(b.keterangan, '') as keterangan
                FROM posframe_mstbarang a
                left join trpesantmpd b on a.kode = b.kode and b.userid = $cur_user->id 
                order by a.nama";
        $mstbarang = DB::select(DB::raw($que));
                
        return view('trpesan',compact('mstbarang'));
    }

    
    public function store(Request $request)
    {
        
        $cur_user = \Auth::user();
        // return response()->json(['success' => $myA]);

        switch ($request->mode) {
            case 'saveqty':
                $jml = $request->qty * $request->harga;

                $form_data = array(
                    'qty' => $request->qty,
                    'harga' => $request->harga,
                    'disc' => 0,
                    'jumlah' => $jml ,  
                    'keterangan' => $request->keterangan
                );
        
                DB::table('trpesantmpd')->updateOrInsert(['userid' => $cur_user->id, 'kode' => $request->kode], 
                                                    $form_data);   
                
                return response()->json(['success' => 'oke', 'kode' => $request->kode, 'qty' => 'Qty : ' . number_format($request->qty), 'jumlah' => 'Jml : ' . number_format($jml), 'keterangan' => $request->keterangan]);
                break;
            
            default:
                # code...
                break;
        }        

    }
}
