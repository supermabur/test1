<?php

namespace App\Http\Controllers;

use App\model\vwgraphpesanbulanini;
use App\model\vwgraphpesanbulaninipergudang;
use App\model\vwgraphpesansetahunkebelakang;
use App\model\rkppesanheadx;

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
        $bulaninigudang = vwgraphpesanbulaninipergudang::selectraw("distinct kdgudang, namagudang")->wherenotnull('kdgudang')->orderby('kdgudang')->get();
        return view('dashboard', compact('bulaninigudang'));
    }
    


    public function store(Request $request)
    {
        $cur_user = \Auth::user();

        switch($request->mode){
            case 'getdasboard':
                    $bulaninix = vwgraphpesanbulanini::select('x')->wherenotnull('y')->pluck('x');
                    $bulaniniy = vwgraphpesanbulanini::selectraw('y as y')->wherenotnull('y')->get();
                    $bulanini = vwgraphpesanbulanini::wherenotnull('y')->get();

                    $hbi = '';
                    $jumlah = 0;
                    foreach ($bulanini as $d) {
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
                            


                    $setahunx = vwgraphpesansetahunkebelakang::select('x')->wherenotnull('y')->pluck('x');
                    $setahuny = vwgraphpesansetahunkebelakang::selectraw('y as y')->wherenotnull('y')->get();
                    $setahun = vwgraphpesansetahunkebelakang::wherenotnull('y')->get();

                    $hsthn = '';
                    $jumlah = 0;
                    foreach ($setahun as $d) {
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
                                        <th scope="col" class="border-0">Bulan</th>
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


                    $lastupdate = rkppesanheadx::selectraw("DATE_FORMAT(max(dateukehosting), '%d-%m-%Y %H:%i') as tanggal")->first();
                    return response()->json(['success' => 'Berhasil', 'lastupdate' => $lastupdate->tanggal,
                                            'bulaninix' => $bulaninix, 'bulaniniy' => $bulaniniy, 'bulanini' => $hbi, 
                                            'setahunx' => $setahunx, 'setahuny' => $setahuny, 'setahun' => $hsthn ]);    
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

                    return response()->json(['success' => 'Berhasil', 
                                            'x' => $spgudangx, 'y' => $spgudangy, 'data' => $hsthn, 'namagudang' => $namagudang ]);    
                    
                    break;
        }

    }
}
