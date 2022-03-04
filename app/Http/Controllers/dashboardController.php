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

class dashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('cekmenuroles');
    }


    public function index()
    {
        $bulaninigudang = vwgraphpesanbulaninipergudang::selectraw("kdgudang, namagudang, sum(y) as jumlah")
                            ->wherenotnull('kdgudang')->groupby('kdgudang')->groupby('namagudang')->orderby('jumlah', 'desc')->get();
        $bulaninisalesman = vwgraphpesanbulaninipersalesman::selectraw("kdsalesman, namasalesman, sum(y) as jumlah")
                            ->wherenotnull('kdsalesman')->groupby('kdsalesman')->groupby('namasalesman')->orderby('jumlah', 'desc')->get();
        return view('dashboard', compact('bulaninigudang', 'bulaninisalesman'));
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
                            

                    $bulanlalux = vwgraphpesanbulanlalu::select('x')->wherenotnull('y')->pluck('x');
                    $bulanlaluy = vwgraphpesanbulanlalu::selectraw('y as y')->wherenotnull('y')->get();
                    $bulanlalu = vwgraphpesanbulanlalu::wherenotnull('y')->get();

                    $hbl = '';
                    $jumlah = 0;
                    foreach ($bulanlalu as $d) {
                        $yy = number_format($d->y, 0);
                        $jumlah += $d->y;
                        $hbl .= <<<EOD
                                    <tr>
                                        <td class="py-0">$d->x</th>
                                        <td class="py-0 text-right">$yy</td>
                                    </tr>
                                EOD;
                    }

                    $jumlah = number_format($jumlah,0);
                    $hbl = <<<EOD
                                <table class="table table-sm small">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="border-0">Tanggal</th>
                                        <th scope="col" class="text-right border-0">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        $hbl
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
                                            'bulanlalux' => $bulanlalux, 'bulanlaluy' => $bulanlaluy, 'bulanlalu' => $hbl, 
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
}
