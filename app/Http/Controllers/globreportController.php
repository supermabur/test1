<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use DataTables;
use Validator;
use App\stmemenu;

class globreportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\model\strole  $strole
     * @return \Illuminate\Http\Response
     */
    public function show($menuid, Request $request)
    {
        $menu = stmemenu::where('id', $menuid)->first();
        $title = $menu->parentname.' '.$menu->name;
        $title = strtoupper($title);

        $que = $menu->query1;

        $fdate1 = Str::contains($que, '@date1');
        $fdate2 = Str::contains($que, '@date2');
        $fgudang = Str::contains($que, '@gudang');

        if ($request->ajax()) {
            if (!empty($request->fdate1)){
                $xx = Carbon::createFromFormat('d-m-Y', $request->fdate1)->format('Ymd');
                $que = Str::of($que)->replace('@date1', $xx);
            }

            if (!empty($request->fdate2)){
                $xx = Carbon::createFromFormat('d-m-Y', $request->fdate2)->format('Ymd');
                $que = Str::of($que)->replace('@date2', $xx);
            }

            if (!empty($request->fgudang)){
                $que = Str::of($que)->replace('@gudang', $request->fgudang);
            }


            $data = DB::Select($que);

            return Datatables::of($data)
                                ->with('xx', $que)
                                ->with('fdate1',$request->fdate1)
                                ->with('fdate2',$request->fdate2)
                                ->with('gudang',$request->fgudang)
                                // ->with('lastupdate', $lastupdate->dateu)
                                // ->with('columnheader', $columnsheader)
                                // ->with('outlet','nama gudang')
                                // ->with('outlet',$data[0]['namagudang'] . ' (' . $data[0]['kdgudang'] . ')')
                                ->toJson(); 
        }

        // $editview = $menu->editview;
        $editview = $menu->editview;


        
        $db = DB::connection()->getPdo();
        $rs = $db->query($que . ' limit 0');
        for ($i = 0; $i < $rs->columnCount(); $i++) {
                $col = $rs->getColumnMeta($i);
                $columnheader[] = $col['name'];
                // $columns[] = $col['native_type'];
                $dtcolumns[] = ['title' => $col['name'], 'data' => $col['name'], 'name' => $col['name']];
        }
        return view('globalreports.globalreport',
                    compact('title', 'menuid', 'columnheader', 'editview', 'dtcolumns', 
                            'fdate1','fdate2', 'fgudang')
                );

        // return view('strole');                
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\model\strole  $strole
     * @return \Illuminate\Http\Response
     */
    public function edit(strole $strole)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\model\strole  $strole
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, strole $strole)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\model\strole  $strole
     * @return \Illuminate\Http\Response
     */
    public function destroy(strole $strole)
    {
        //
    }
}
