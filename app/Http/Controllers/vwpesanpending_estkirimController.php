<?php

namespace App\Http\Controllers;

use App\model\vwpesanpending_estkirim;
use App\model\vwpesanpending;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\stmemenu;

class vwpesanpending_estkirimController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('cekmenuroles');
    }


    public function index(Request $request)
    {

        // SELECT `status`, selisihestkirim, FORMAT(total,0) as total
        // FROM vwpesanpendingrekap
        // where statuskirim = '2 minggu'
        // order by `status`, selisihestkirim


        $menu = stmemenu::where('links', $request->path())->first();
        $title = $menu->parentname.' '.$menu->name;
        $title = strtoupper($title);

        // 2 Minggu
        $data_pending = vwpesanpending_estkirim::selectraw("`status`, selisihestkirim, FORMAT(total,0) as total, statuskirim")
                                        ->where('statuskirim', '2 minggu')->where('status', 'pending')
                                        ->orderby('status')->orderby('selisihestkirim')->get();

        $data_pendingproses = vwpesanpending_estkirim::selectraw("`status`, selisihestkirim, FORMAT(total,0) as total, statuskirim")
                                        ->where('statuskirim', '2 minggu')->where('status', 'pending proses')
                                        ->orderby('status')->orderby('selisihestkirim')->get();

        $data_tot = vwpesanpending_estkirim::selectraw(" FORMAT(sum(if(`status` = 'pending', total, 0)), 0) as totpending, FORMAT(sum(if(`status` = 'pending proses', total, 0)), 0) as totpendingproses")
                                        ->where('statuskirim', '2 minggu')->first();

        // Overdue
        $data_pendingoverdue = vwpesanpending_estkirim::selectraw("`status`, -1 * selisihestkirim as selisihestkirim, FORMAT(total,0) as total, statuskirim")
                                        ->where('statuskirim', 'overdue')->where('status', 'pending')->where('total', '>', 0)
                                        ->orderby('status')->orderby('selisihestkirim')->get();

        $data_pendingprosesoverdue = vwpesanpending_estkirim::selectraw("`status`, -1 * selisihestkirim as selisihestkirim, FORMAT(total,0) as total, statuskirim")
                                        ->where('statuskirim', 'overdue')->where('status', 'pending proses')->where('total', '>', 0)
                                        ->orderby('status')->orderby('selisihestkirim')->get();

        $data_totoverdue = vwpesanpending_estkirim::selectraw(" FORMAT(sum(if(`status` = 'pending', total, 0)), 0) as totpending, FORMAT(sum(if(`status` = 'pending proses', total, 0)), 0) as totpendingproses")
                                        ->where('statuskirim', 'overdue')->first();


        return view('rptpesanpending_estkirim',compact('title', 
                                                        'data_pending', 'data_pendingproses', 'data_tot', 
                                                        'data_pendingoverdue', 'data_pendingprosesoverdue', 'data_totoverdue'));
    }



    public function store(Request $request)
    {
        $cur_user = \Auth::user();

        switch($request->mode){
            case 'showdetail':
                try {
                    $datadetail = vwpesanpending::where('statuskirim', $request->statuskirim)->where('status', $request->status)->where('selisihestkirim', $request->selisihestkirim)
                                                    ->orderby('faktur')->get();


                    $ht = '';
                    foreach ($datadetail as $d) {
                        $sisablmkirim = number_format($d->jumlahsisabelumkirim, 0);
                        $ht .= <<<EOD
                                <tr>
                                    <th>$d->faktur</th>
                                    <td>$d->tanggal</td>
                                    <td>$d->namacustomer</td>
                                    <td>$d->alamatcustomer</td>
                                    <td>$d->keterangan</td>
                                    <td>$d->memo</td>
                                    <td class="text-right">$sisablmkirim</td>
                                </tr>
                                EOD;                        
                    }

                    $ht = <<<EOD
                        <table class="table table-sm">
                        <thead>
                        <tr>
                            <th scope="col">Faktur</th>
                            <th scope="col">Tgl</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Ket</th>
                            <th scope="col">Memo</th>
                            <th scope="col" class="text-right">Sisa</th>
                        </tr>
                        </thead>
                        <tbody>
                        $ht
                        </tbody>
                        </table>
                    EOD;


                    return response()->json(['success' => 'Berhasil', 'html' => $ht]);    
                } catch (\Throwable $th) {
                    return response()->json(['error' => $th->getMessage()]);
                }
                break;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\model\vwpesanpending_estkirim  $vwpesanpending_estkirim
     * @return \Illuminate\Http\Response
     */
    public function show(vwpesanpending_estkirim $vwpesanpending_estkirim)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\model\vwpesanpending_estkirim  $vwpesanpending_estkirim
     * @return \Illuminate\Http\Response
     */
    public function edit(vwpesanpending_estkirim $vwpesanpending_estkirim)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\model\vwpesanpending_estkirim  $vwpesanpending_estkirim
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, vwpesanpending_estkirim $vwpesanpending_estkirim)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\model\vwpesanpending_estkirim  $vwpesanpending_estkirim
     * @return \Illuminate\Http\Response
     */
    public function destroy(vwpesanpending_estkirim $vwpesanpending_estkirim)
    {
        //
    }
}
