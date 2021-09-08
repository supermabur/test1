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
        $ip = $request->ip();

        $aksesby = $browser . ' ' . $platform . ' ' . $version . ' ' . $device . ' ' . $ip;

        DB::table('log_akses')->insert([
            ['aksesmodul' => 'rptpesanestimasikirimmemo', 'aksesby' => $aksesby]
        ]);


        return view('rptpesanestkirimmemo',compact('mendekatiestkirim', 'gaadamemo', 'lastupdate'));
    }


    public function getClientIPaddress(Request $request) {

        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
            $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];
    
        if(filter_var($client, FILTER_VALIDATE_IP)){
            $clientIp = $client;
        }
        elseif(filter_var($forward, FILTER_VALIDATE_IP)){
            $clientIp = $forward;
        }
        else{
            $clientIp = $remote;
        }
    
        return $clientIp;
     }

}
