<?php

namespace App\Http\Controllers;

use App\model\trbelitmp;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;

class trbeliController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('cekmenuroles');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $cur_user = \Auth::user();
        $data = trbelitmp::where('iduser', $cur_user->id);
        // $columnsheader  = \DB::getSchemaBuilder()->getColumnListing($data);
        return Datatables::of($data)->toJson(); 

        // switch ($request->mode){
        //     case "tmpdatatable" :
        //         $data = trbelitmp::where('iduser', $cur_user->id);
        //         // $columnsheader  = \DB::getSchemaBuilder()->getColumnListing($data);

        //         return Datatables::of($data)->toJson(); 
        //                             // ->addColumn('action', function($row){
        //                             //     $btn = '<button type="button" name="detail" data-iduser="'.$row->iduser.'" data-idoutlet="'.$row->idoutlet.'" data-idbarang="'.$row->idbarang.'" class="btn btn-danger btn-sm" style="padding-bottom: 0rem; padding-top: 0rem;">delete</button>';
        //                             //     return $btn;
        //                             // })
        //                             // ->rawColumns(['action'])
        //                             // ->toJson(); 
        //         break;

        //     case "bayar":
        //         return response()->json(['success' => $suksesmsg]);
        //     break;
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\model\trbelitmp  $trbelitmp
     * @return \Illuminate\Http\Response
     */
    public function show(trbelitmp $trbelitmp)
    {
        $cur_user = \Auth::user();
        $data = trbelitmp::where('iduser', $cur_user->id);
        // $columnsheader  = \DB::getSchemaBuilder()->getColumnListing($data);

        return Datatables::of($data)->toJson(); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\model\trbelitmp  $trbelitmp
     * @return \Illuminate\Http\Response
     */
    public function edit(trbelitmp $trbelitmp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\model\trbelitmp  $trbelitmp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, trbelitmp $trbelitmp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\model\trbelitmp  $trbelitmp
     * @return \Illuminate\Http\Response
     */
    public function destroy(trbelitmp $trbelitmp)
    {
        //
    }
}
