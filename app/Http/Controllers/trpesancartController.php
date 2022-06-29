<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\model\trpesantmpd;
use App\model\mstongkir;
use App\model\mstgudang;
use App\model\posframe_mstleasing;

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

        $mstongkir = mstongkir::orderby('kota')->get();
        $mstgudang = mstgudang::where('kode','<>', '')->where('nama','<>', '-')->orderby('nama')->get();
        $mstleasing = posframe_mstleasing::orderby('nama')->get();
        $pesanhead = DB::table('trpesantmph')->where('userid', $cur_user->id)->first();
        // $pesanbayar = DB::table('vwtrpesantmpbayar')->where('userid', $cur_user->id)->get();
        $pesanbayar = $this->gettablebodyhtmlbayar();
        $mstbayar = DB::table('posframe_stdefaultbayar')->get();

        $cartcount = $this->cartcount();  
        $sumbayar = $this->gettotalbayar();
        $total = $this->gettotaltransaksi();

        return view('trpesancart',compact('mstbarang', 'mstgudang', 'mstongkir', 'mstleasing', 'mstbayar', 'cartcount', 'pesanhead', 'pesanbayar', 'sumbayar', 'total'));
    }

    
    public function store(Request $request)
    {        
        $cur_user = \Auth::user();

        switch ($request->mode) {
            case 'savehead':
                $ongkir = $request->ongkir ? $request->ongkir : 0;
                $dp = $request->dp ? $request->dp : 0;
                $form_data = array(
                    'kdgudang' => $request->kdgudang,
                    'csnama' => $request->csnama,
                    'csalamat' => $request->csalamat,
                    'csnohp' => $request->csnohp,
                    'cskota' => $request->cskota,
                    'ongkir' => $ongkir,
                    'dp' => $dp,
                    'kdleasing' => $request->kdleasing,
                    'ls_cicilan1' => $request->ls_cicilan1 ? $request->ls_cicilan1 : 0,
                    'ls_admin' => $request->ls_admin ? $request->ls_admin : 0,
                    'keterangan' => $request->keterangan
                );
        
                DB::table('trpesantmph')->updateOrInsert(['userid' => $cur_user->id], 
                                                    $form_data);   
                $total = $this->gettotaltransaksi();
                

                return response()->json(['success' => 'oke', 'total' => $total]);
                break;

            
            case 'tambahbayar':
                $pk = array(
                    'userid' => $cur_user->id,
                    'kode' => $request->kodebayar,
                    'nobukti' => $request->nobuktibayar
                );

                $val = array(
                    'jumlah' => $request->jumlahbayar
                );
        
                DB::table('trpesantmpbayar')->updateOrInsert($pk, $val);  
                $bodybayar = $this->gettablebodyhtmlbayar();
                $sumbayar = $this->gettotalbayar();
                $total = $this->gettotaltransaksi();
  
                return response()->json(['success' => 'oke', 'bodybayar' => $bodybayar, 'sumbayar' => $sumbayar, 'total' => $total]);
                break;

        
            case 'delbayar':                
                DB::table('trpesantmpbayar')->where('userid', $cur_user->id)->where('kode', $request->kode)->delete();
                $bodybayar = $this->gettablebodyhtmlbayar();
                $sumbayar = $this->gettotalbayar();
                $total = $this->gettotaltransaksi();
                return response()->json(['success' => 'oke', 'bodybayar' => $bodybayar, 'sumbayar' => $sumbayar, 'total' => $total]);
                break;

            
            default:
                # code...
                break;
        }        

    }


    function gettotaltransaksi(){
        $cur_user = \Auth::user();
        $totalbarang = DB::table('trpesantmpd')->where('userid', $cur_user->id)->sum('jumlah');
        $ongkir = DB::table('trpesantmph')->where('userid', $cur_user->id)->sum('ongkir');
        $total = $totalbarang + $ongkir;
        return ['totalbarang' => number_format($totalbarang), 'ongkir' => number_format($ongkir), 'total' => number_format($total)] ;
    }


    function gettotalbayar(){
        $cur_user = \Auth::user();
        $sumbayar = DB::table('vwtrpesantmpbayar')->where('userid', $cur_user->id)->sum('jumlah');
        return number_format($sumbayar);
    }


    function gettablebodyhtmlbayar(){
        $cur_user = \Auth::user();
        $pesanbayar = DB::table('vwtrpesantmpbayar')->where('userid', $cur_user->id)->get();

        $ht = '';
        foreach ($pesanbayar as $d){
            $ht .= <<<EOD
                        <tr class="small">
                            <td>$d->nama</td>
                            <td>$d->nobukti</td>
                            <td class="text-end">$d->jumlahx</td>
                            <td class="text-end">
                                <button type="button" class="btn btn-sm btn-outline-danger p-0 px-1" onclick="delbayar('$d->kode')"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                    EOD;                            
        }
        return $ht;
    }


}
