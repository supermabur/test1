<?php

namespace App\Http\Controllers;

use App\model\vwgraphpesanbulanini;
use App\model\vwgraphpesanbulanlalu;

use App\model\vwgraphpesanbulaninipergudang;
use App\model\vwgraphpesanbulanlalupergudang;

use App\model\vwgraphpesanbulaninipersalesman;
use App\model\vwgraphpesanbulanlalupersalesman;

use App\model\vwgraphpesansetahunkebelakang;

use App\model\rkppesanheadx;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dashboardjualController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('cekmenuroles');  
    }


    public function index()
    {
        $thnbln = DB::table('rkpjualhead')->selectraw("DISTINCT DATE_FORMAT(tanggal, '%Y%m') as thnbln, DATE_FORMAT(tanggal, '%M %Y') as thnbln2")->orderbyraw('1 desc')->get();
        return view('dashboardjual', compact('thnbln'));
    }
    


    public function store(Request $request)
    {
        $cur_user = \Auth::user();

        switch($request->mode){
            case 'getdasboardjual':
                $lastupdate = DB::table('rkpjualhead')->selectraw("DATE_FORMAT(max(dateukehosting), '%d-%m-%Y %H:%i') as tanggal")->first();

                $thnbln = $request->thnbln;
                $g = $request->kdgudang;
                $s = $request->kdsalesman;
                $que = '';

                if ($g == 'na' && $s == 'na') {
                    $que = "CALL spgraphjualh('$thnbln')";
                    $data = DB::select(DB::raw($que));
                    $htm = $this->createtable($data);
                    $graphx = array_column($data, 'x');
                    $graphy = array_column($data, 'y'); 

                    $gudang = DB::table('vwjualh_bulanan_gudang')->where('thnbln', $thnbln)->selectraw("kdgudang as kode, total")->orderby('total', 'desc')->get();
                    $htmlgudang = $this->createheaderbutton($gudang, 'gudang');

                    $salesman = DB::table('vwjualh_bulanan_salesman')->where('thnbln', $thnbln)->selectraw("namasalesman as kode, total")->orderby('total', 'desc')->get();
                    $htmlsalesman = $this->createheaderbutton($salesman, 'salesman');

                    return response()->json(['success' => 'Berhasil', 'mode' => 1, 'lastupdate' => $lastupdate->tanggal, 'data' => $data,
                                            'graphx' => $graphx, 'graphy' => $graphy, 'html' => $htm, 
                                            'gudang' => $gudang, 'htmlgudang' => $htmlgudang, 
                                            'salesman' => $salesman, 'htmlsalesman' => $htmlsalesman ]);    

                }
                else{
                    if ($g != 'na' && $s = 'na') {
                        $que = "CALL spgraphjualh_pergudang('$thnbln', '$g')";
                        $mode = 2;
                    }
                    else{
                        $que = "CALL spgraphjualh_persalesman('$thnbln', '$s')";
                        $mode = 3;
                    }

                    $data = DB::select(DB::raw($que));
                    $htm = $this->createtable($data);
                    $graphx = array_column($data, 'x');
                    $graphy = array_column($data, 'y'); 

                    return response()->json(['success' => 'Berhasil', 'mode' => $mode, 'data' => $data,
                                            'graphx' => $graphx, 'graphy' => $graphy, 'html' => $htm ]);  
                }                


                // vwjualh_bulanan_gudang                
                

                


                        
                
                break;



            case 'showbulaninigudang':
                $spgudangx = vwgraphpesanbulaninipergudang::select('x')->where('kdgudang', $request->kdgudang)->pluck('x');
                $spgudangy = vwgraphpesanbulaninipergudang::selectraw('y as y')->where('kdgudang', $request->kdgudang)->get();
                $spgudang = vwgraphpesanbulaninipergudang::where('kdgudang', $request->kdgudang)->get();

                $hsthn = '';
                $jumlah = 0;
                $namagudang = '';
                foreach ($spgudang as $d) {
                    $namagudang = $d->namagudang;
                    $yy = number_format($d->y, 0);
                    $jumlah += $d->y;
                    $hsthn .= <<<EOD
                                <tr>
                                    <td class="py-0">$d->x</th>
                                    <td class="py-0 text-right">$yy</td>
                                </tr>
                            EOD;
                }

                $jumlah = number_format($jumlah,0);
                $hsthn = <<<EOD
                            <table class="table table-sm small">
                                <thead>
                                <tr>
                                    <th scope="col" class="border-0">Tanggal</th>
                                    <th scope="col" class="text-right border-0">Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                    $hsthn
                                    <tr>
                                        <th class="py-0">TOTAL</th>
                                        <th class="py-0 text-right">$jumlah</td>
                                    </tr>                                        
                                </tbody>
                            </table>
                        EOD;      
                        
                        
                $spgudanglalux = vwgraphpesanbulanlalupergudang::select('x')->where('kdgudang', $request->kdgudang)->pluck('x');
                $spgudanglaluy = vwgraphpesanbulanlalupergudang::selectraw('y as y')->where('kdgudang', $request->kdgudang)->get();
                $spgudanglalu = vwgraphpesanbulanlalupergudang::where('kdgudang', $request->kdgudang)->get();

                $hsthnlalu = '';
                $jumlah = 0;
                foreach ($spgudanglalu as $d) {
                    $yy = number_format($d->y, 0);
                    $jumlah += $d->y;
                    $hsthnlalu .= <<<EOD
                                <tr>
                                    <td class="py-0">$d->x</th>
                                    <td class="py-0 text-right">$yy</td>
                                </tr>
                            EOD;
                }

                $jumlah = number_format($jumlah,0);
                $hsthnlalu = <<<EOD
                            <table class="table table-sm small">
                                <thead>
                                <tr>
                                    <th scope="col" class="border-0">Tanggal</th>
                                    <th scope="col" class="text-right border-0">Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                    $hsthnlalu
                                    <tr>
                                        <th class="py-0">TOTAL</th>
                                        <th class="py-0 text-right">$jumlah</td>
                                    </tr>                                        
                                </tbody>
                            </table>
                        EOD;  

                return response()->json(['success' => 'Berhasil', 
                                        'x' => $spgudangx, 'y' => $spgudangy, 'data' => $hsthn, 
                                        'lalux' => $spgudanglalux, 'laluy' => $spgudanglaluy, 'datalalu' => $hsthnlalu, 
                                        'namagudang' => $namagudang ]);    
                break;



            case 'showbulaninisalesman':
                $spsalesmanx = vwgraphpesanbulaninipersalesman::select('x')->where('kdsalesman', $request->kdsalesman)->pluck('x');
                $spsalesmany = vwgraphpesanbulaninipersalesman::selectraw('y as y')->where('kdsalesman', $request->kdsalesman)->get();
                $spsalesman = vwgraphpesanbulaninipersalesman::where('kdsalesman', $request->kdsalesman)->get();

                $hsthn = '';
                $jumlah = 0;
                $namasalesman = '';
                foreach ($spsalesman as $d) {
                    $namasalesman = $d->namasalesman;
                    $yy = number_format($d->y, 0);
                    $jumlah += $d->y;
                    $hsthn .= <<<EOD
                                <tr>
                                    <td class="py-0">$d->x</th>
                                    <td class="py-0 text-right">$yy</td>
                                </tr>
                            EOD;
                }

                $jumlah = number_format($jumlah,0);
                $hsthn = <<<EOD
                            <table class="table table-sm small">
                                <thead>
                                <tr>
                                    <th scope="col" class="border-0">Tanggal</th>
                                    <th scope="col" class="text-right border-0">Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                    $hsthn
                                    <tr>
                                        <th class="py-0">TOTAL</th>
                                        <th class="py-0 text-right">$jumlah</td>
                                    </tr>                                        
                                </tbody>
                            </table>
                        EOD;      
                        
                        
                $spsalesmanlalux = vwgraphpesanbulanlalupersalesman::select('x')->where('kdsalesman', $request->kdsalesman)->pluck('x');
                $spsalesmanlaluy = vwgraphpesanbulanlalupersalesman::selectraw('y as y')->where('kdsalesman', $request->kdsalesman)->get();
                $spsalesmanlalu = vwgraphpesanbulanlalupersalesman::where('kdsalesman', $request->kdsalesman)->get();

                $hsthnlalu = '';
                $jumlah = 0;
                foreach ($spsalesmanlalu as $d) {
                    $yy = number_format($d->y, 0);
                    $jumlah += $d->y;
                    $hsthnlalu .= <<<EOD
                                <tr>
                                    <td class="py-0">$d->x</th>
                                    <td class="py-0 text-right">$yy</td>
                                </tr>
                            EOD;
                }

                $jumlah = number_format($jumlah,0);
                $hsthnlalu = <<<EOD
                            <table class="table table-sm small">
                                <thead>
                                <tr>
                                    <th scope="col" class="border-0">Tanggal</th>
                                    <th scope="col" class="text-right border-0">Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                    $hsthnlalu
                                    <tr>
                                        <th class="py-0">TOTAL</th>
                                        <th class="py-0 text-right">$jumlah</td>
                                    </tr>                                        
                                </tbody>
                            </table>
                        EOD;   

                return response()->json(['success' => 'Berhasil', 
                                        'x' => $spsalesmanx, 'y' => $spsalesmany, 'data' => $hsthn, 
                                        'lalux' => $spsalesmanlalux, 'laluy' => $spsalesmanlaluy, 'datalalu' => $hsthnlalu, 
                                        'namasalesman' => $namasalesman ]);    
                break;
        }

    }


    function createheaderbutton($data, $idx){
        $htm = '';

        foreach ($data as $d) {
            $jml = number_format($d->total);
            $htm .= <<<EOD
                    <li class="nav-item">
                        <button class="nav-link btn btn-sm btn-light p-0 px-1 m-1 tombol$idx" data-kode='$d->kode')">
                            <p class="m-0 font-weight-bold">$d->kode</p> 
                            <small class="">$jml</small>
                        </button>
                    </li>
                    EOD;
        }
        return $htm;
    }


    function createtable($data){
        $hbi = '';
        $jumlah = 0;
        foreach ($data as $d) {
            $yy = number_format($d->y, 0);
            $jumlah += $d->y;
            $hbi .= <<<EOD
                        <tr>
                            <td class="py-0">$d->x</th>
                            <td class="py-0 text-right">$yy</td>
                        </tr>
                    EOD;
        }

        $jumlah = number_format($jumlah,0);
        $hbi = <<<EOD
                    <table class="table table-sm small">
                        <thead>
                        <tr>
                            <th scope="col" class="border-0">Tanggal</th>
                            <th scope="col" class="text-right border-0">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                            $hbi
                            <tr>
                                <th class="py-0">TOTAL</th>
                                <th class="py-0 text-right">$jumlah</td>
                            </tr>   
                        </tbody>
                    </table>
                EOD;
        return $hbi;
    }
}
