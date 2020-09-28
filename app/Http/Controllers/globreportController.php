<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
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
        $menuid = $request->id;
        $menu = stmemenu::where('id', $menuid)->first();
        $title = $menu->parentname.' '.$menu->name;
        $title = strtoupper($title);

        $useglobalreport = $menu->useglobreport;
        $editview = $menu->editview;

        if ($useglobalreport==1) {
            $que = $menu->query1;
            $fdate1 = Str::contains($que, '@date1');
            $fdate2 = Str::contains($que, '@date2');
            $fgudang = Str::contains($que, '@gudang');
    
            $crud = 0;
            $crud_i = Str::contains($menu->crud, 'i');
    
            $db = DB::connection()->getPdo();
            $rs = $db->query($que . ' limit 0');
            for ($i = 0; $i < $rs->columnCount(); $i++) {
                $col = $rs->getColumnMeta($i);
                if($col['name'] <> 'crud')
                {
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
                else
                {
                    $crud = 1;
                }
            }
    
            if ($crud == 1 ){
                $dtcolumns[] = ['title' => 'action', 'data' => 'action', 'name' => 'action', 'orderable' => 'false', 'searchable' => 'false', 'className' => 'text-right'];
            }

            
            $view = View::make('globalreports.globalreport2')->with(['menuid' => $menuid, 
                                                                    'editview' => $editview, 
                                                                    'fdate1' => $fdate1, 
                                                                    'fdate2' => $fdate2, 
                                                                    'fgudang' => $fgudang, 
                                                                    'crud_i' => $crud_i]);
            $viewr = $view->render();
            return response()->json(['success' => 'use global report ' . $request->id, 
                                    'usegr' => '1',
                                    'view' => $viewr, 
                                    'title' => $title,
                                    'dtcolumns' => $dtcolumns, 
                                    'columnnative' => $columnnative, 
                                    'columnheader' => $columnheader,
                                    'menuid' => $menuid,
                                    'urlshowwithid' => route('gr.show', $menuid)
                                    ]);
        }
        else{

            $view = View::make($editview);
            $viewr = $view->render();
            return response()->json(['success' => 'not globrep ' . $request->id, 
                                    'usegr' => '0',
                                    'view' => $viewr, 
                                    'title' => $title ]);
        }


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

        $crud = 0;
        $crud_i = Str::contains($menu->crud, 'i');

        $editview = $menu->editview;

        $db = DB::connection()->getPdo();
        $rs = $db->query($que . ' limit 0');
        for ($i = 0; $i < $rs->columnCount(); $i++) {
            $col = $rs->getColumnMeta($i);
            if($col['name'] <> 'crud')
            {
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
            else
            {
                $crud = 1;
            }
        }

        if ($crud == 1 ){
            $dtcolumns[] = ['title' => 'action', 'data' => 'action', 'name' => 'action', 'orderable' => 'false', 'searchable' => 'false', 'className' => 'text-right'];
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
                if($request->fgudang == 'ALL'){
                    $que = Str::of($que)->replace('@gudang', "kdgudang");
                }
                else{
                    $que = Str::of($que)->replace('@gudang', "'$request->fgudang'");
                }
            }


            $data = DB::select(DB::raw($que));


            $dt = Datatables::of($data)
                                ->with('xx', $que)
                                ->with('fdate1',$request->fdate1)
                                ->with('fdate2',$request->fdate2)
                                ->with('gudang',"'$request->fgudang'");
            
            if ($crud == 1) {
                $dt = $dt->addColumn('action', function($row){
                    $btn = '';
                    if(Str::contains($row->crud,'u'))
                    {
                        $btn .= '<button type="button" name="btnedit" data-id="'.$row->id.'" data-target="#editview" class="btnedit detail btn btn-warning btn-xs" 
                                    style="padding-bottom: 0rem; padding-top: 0rem;margin-left: 2px;margin-right: 2px;">
                                    Edit
                                </button>';
                    }
                    if (Str::contains($row->crud,'d'))
                    {
                        $btn .= '<button type="button" name="btndelete" data-id="'.$row->id.'" data-target="#editview" class="btndelete detail btn btn-danger btn-xs" 
                                    style="padding-bottom: 0rem; padding-top: 0rem;margin-left: 2px;margin-right: 2px;">
                                    Delete
                                </button>';
                    }

                    return $btn;
                });
                $rawcol[] = 'action'; 
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
            
            if(!empty($rawcol)){
                return $dt->rawColumns($rawcol)->toJson();
            }

            return $dt->toJson();
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
