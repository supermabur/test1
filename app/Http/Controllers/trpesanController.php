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

        $que = "select a.*, ifnull(b.qty, 0) as qty, ifnull(b.harga, 0) as harga, ifnull(b.disc, 0) as disc, ifnull(b.jumlah, 0) as jumlah, ifnull(b.keterangan, '') as keterangan,
                    REPLACE(a.kode, '.', '') as kodex
                FROM posframe_mstbarang a
                left join trpesantmpd b on a.kode = b.kode and b.userid = $cur_user->id 
                order by a.nama";
        $mstbarang = DB::select(DB::raw($que));
        
        $cartcount = $this->cartcount();

        return view('trpesan',compact('mstbarang', 'cartcount'));
    }


    function cartcount(){
        $cur_user = \Auth::user();
        $tmp = trpesantmpd::where('userid', $cur_user->id)->where('qty', '>' ,  0)->count();
        return $tmp;
    }


    function gettotaltransaksi(){
        $cur_user = \Auth::user();
        $totalbarang = DB::table('trpesantmpd')->where('userid', $cur_user->id)->sum('jumlah');
        $ongkir = DB::table('trpesantmph')->where('userid', $cur_user->id)->sum('ongkir');
        $totaldp = DB::table('trpesantmpbayar')->where('userid', $cur_user->id)->sum('jumlah');
        $total = $totalbarang + $ongkir;
        $kurangbayar = $total - $totaldp;
        return ['totalbarang' => number_format($totalbarang), 'ongkir' => number_format($ongkir), 'total' => number_format($total), 
                'totaldp' => number_format($totaldp), 'kurangbayar' => number_format($kurangbayar)] ;
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
                
                $cartcount = $this->cartcount();
                $total = $this->gettotaltransaksi();

                return response()->json(['success' => 'oke', 
                                        'cartcount' => $cartcount, 
                                        'kode' => $request->kode, 
                                        'kodex' => str_replace('.', '', $request->kode), 
                                        'qty' => $request->qty, 
                                        'harga' => $request->harga, 
                                        'jumlah' => $jml, 
                                        'keterangan' => $request->keterangan, 
                                        'total' => $total]);
                break;

                
            case 'hapusitem':
                trpesantmpd::where('userid', $cur_user->id)->where('kode', $request->kode)->delete();
                
                $cartcount = $this->cartcount();
                $total = $this->gettotaltransaksi();

                return response()->json(['success' => 'oke', 
                                        'cartcount' => $cartcount, 
                                        'kodex' => str_replace('.', '', $request->kode), 
                                        'total' => $total]);
                break;
            
            default:
                # code...
                break;
        }        

    }
}
