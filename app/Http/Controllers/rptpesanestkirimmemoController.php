<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\model\log_akses;
use Jenssegers\Agent\Agent;

class rptpesanestkirimmemoController extends Controller
{

    public function index(Request $request)
    {
        $que = "SELECT * FROM vwpesankirim3 order by kirimjatuhtempo";
        $mendekatiestkirim = DB::select($que);

        $que = "SELECT * FROM rkppesanheadx
                where `status` in ('pending', 'pending proses') and memo is NULL 
                        and DATE_FORMAT(tanggal, '%Y') = 2021 
                        and flagvoid = 0 and kdleasing = ''
                order by tanggal DESC";
        $gaadamemo = DB::select($que);

        $que = "SELECT max(dateukehosting) as lastupdate FROM rkppesanheadx limit 1";
        $lastupdate = DB::select($que);


        // dd($user);
        $agent = new Agent();
        $browser = $agent->browser();
        $browser .= ' ' . $agent->version($browser);

        $platform = $agent->platform();
        $device = $agent->device();
        $version = $agent->version($platform);

        $aksesby = $browser . ' ' . $platform . ' ' . $version . ' ' . $device;

        DB::table('log_akses')->insert([
            ['aksesmodul' => 'rptpesanestimasikirimmemo', 'aksesby' => $aksesby]
        ]);


        return view('rptpesanestkirimmemo',compact('mendekatiestkirim', 'gaadamemo', 'lastupdate'));
    }

}
