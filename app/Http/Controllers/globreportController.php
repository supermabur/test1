<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        // $menu = stmemenu::where('id', $request->menuid)->first();
        
        if ($request->ajax()) {
            // $lastupdate = rptpersediaan::select('dateu', 'kdgudang', 'namagudang')->where('kdgudang', $request->filter_gudang)->orderBy('dateu', 'desc')->first();

            // $data = Mstbarang::latest()->get();
            // $data = rptpersediaan::get_rptpersediaan_all();
            // if($request->show0 =='YA')
            // {
            //     $data = rptpersediaan::where('kdgudang', $request->filter_gudang)->where('saldo','>=','0');
            // }
            // else
            // {
            //     $data = rptpersediaan::where('kdgudang', $request->filter_gudang)->where('saldo','>','0');
            // }
            $data = DB::Select('SELECT * FROM strole ');

            return Datatables::of($data)
                                // ->with('lastupdate', $lastupdate->dateu)
                                // ->with('columnheader', $columnsheader)
                                // ->with('outlet','nama gudang')
                                // ->with('outlet',$data[0]['namagudang'] . ' (' . $data[0]['kdgudang'] . ')')
                                ->toJson(); 
        }
      
        // return view('rptpersediaan',compact('title', 'gudang'));
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

        $asd = $request->asd;

        // $editview = $menu->editview;
        $editview = $menu->editview;

        

        $db = DB::connection()->getPdo();
        $rs = $db->query('SELECT * FROM strole ');
        for ($i = 0; $i < $rs->columnCount(); $i++) {
                $col = $rs->getColumnMeta($i);
                $columnheader[] = $col['name'];
                // $columns[] = $col['native_type'];
                $dtcolumns[] = ['title' => $col['name'], 'data' => $col['name'], 'name' => $col['name']];
        }
        
        return view('globalreports.globalreport',compact('title', 'menuid', 'columnheader', 'editview', 'dtcolumns'));
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
