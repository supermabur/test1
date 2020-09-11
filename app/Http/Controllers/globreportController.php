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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    
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

        $crud_i = Str::contains($menu->crud, 'i');
        $crud_u = Str::contains($menu->crud, 'u');
        $crud_d = Str::contains($menu->crud, 'd');

        $editview = $menu->editview;

        $db = DB::connection()->getPdo();
        $rs = $db->query($que . ' limit 0');
        for ($i = 0; $i < $rs->columnCount(); $i++) {
                $col = $rs->getColumnMeta($i);
                $columnheader[] = $col['name'];
                $columnnative[] = $col['native_type'];

                switch ($col['native_type']){
                    case 'BIT':
                        $dtcolumns[] = ['title' => $col['name'], 'data' => $col['name'], 'name' => $col['name'], 'className' => 'text-center'];
                        $colbit[] = $col['name'];
                        break;
                    case 'TIMESTAMP':
                        $dtcolumns[] = ['title' => $col['name'], 'data' => $col['name'], 'name' => $col['name'], 'className' => 'text-center'];
                        break;
                    case 'LONGLONG':
                        $dtcolumns[] = ['title' => $col['name'], 'data' => $col['name'], 'name' => $col['name'], 'className' => 'text-right'];
                        break;
                    default:
                        $dtcolumns[] = ['title' => $col['name'], 'data' => $col['name'], 'name' => $col['name']];
                }
        }

        if ($crud_u == 1 ){
            $dtcolumns[] = ['title' => 'Upd', 'data' => 'upd', 'name' => 'upd', 'orderable' => 'false', 'searchable' => 'false', 'className' => 'text-right'];
        }

        if ($crud_d == 1 ){
            $dtcolumns[] = ['title' => 'Del', 'data' => 'del', 'name' => 'del', 'orderable' => 'false', 'searchable' => 'false', 'className' => 'text-right'];
        }



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

            $dt = Datatables::of($data)
                                ->with('xx', $que)
                                ->with('fdate1',$request->fdate1)
                                ->with('fdate2',$request->fdate2)
                                ->with('gudang',$request->fgudang);

            if ($crud_d == 1) {
                $dt = $dt->addColumn('del', function($row){
                    $btn = '<button type="button" name="btndelete" data-id="'.$row->id.'" data-toggle="modal" class="btndelete detail btn btn-primary btn-sm" style="padding-bottom: 0rem; padding-top: 0rem;">Delete</button>';
                    return $btn;
                });
                $rawcol[] = 'del';    
            }
            
            if ($crud_u == 1) {
                $dt = $dt->addColumn('upd', function($row){
                    $btn = '<button type="button" name="btnedit" data-id="'.$row->id.'" data-target="#editview" class="btnedit detail btn btn-primary btn-sm" style="padding-bottom: 0rem; padding-top: 0rem;">
                                Edit
                            </button>';
                    return $btn;
                });
                $rawcol[] = 'upd'; 
            }

            if (!empty($colbit)) {
                // bit kolom active
                if(in_array('active', $colbit))
                {
                    $dt = $dt->addColumn('active', function($row){
                        $button = '<input onclick="return false;" type="checkbox" data-id="'.$row->id.'" name="active" class="me_switch active" '. ($row->active == 1 ? 'checked':'')  . '> ';
                        return $button;
                    });
                    $rawcol[] = 'active';              
                }

            }

            return $dt->rawColumns($rawcol)->toJson();
        }


        return view('globalreports.globalreport',
                    compact('title', 'menuid', 'columnheader', 'editview', 'dtcolumns', 'columnnative',
                            'fdate1','fdate2', 'fgudang', 
                            'crud_i')
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
