<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\model\trpesantmpd;

use DB;
use Carbon\Carbon;

class trpesancartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('cekmenuroles');
    }


    function cartcount(){
        $cur_user = \Auth::user();
        $tmp = trpesantmpd::where('userid', $cur_user->id)->where('qty', '>' ,  0)->count();
        return $tmp;
    }


    public function index()
    {
        $cur_user = \Auth::user();
        // $mstbarang = posframe_mstbarang::orderby('nama')->get();

        $que = "select a.*, ifnull(b.qty, 0) as qty, ifnull(b.harga, 0) as harga, ifnull(b.disc, 0) as disc, ifnull(b.jumlah, 0) as jumlah, ifnull(b.keterangan, '') as keterangan,
                    REPLACE(a.kode, '.', '') as kodex
                FROM posframe_mstbarang a
                inner join trpesantmpd b on a.kode = b.kode and b.qty > 0 and b.userid = $cur_user->id 
                order by a.nama";
        $mstbarang = DB::select(DB::raw($que));
        
        $cartcount = $this->cartcount();

        return view('trpesancart',compact('mstbarang', 'cartcount'));
    }



}
