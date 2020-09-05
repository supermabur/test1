<?php

namespace App\Http\Controllers;

use App\model\strole;
use App\model\vwstrolemenupra;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\stmemenu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class stroleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $menu = stmemenu::where('links', $request->path())->first();
        $title = $menu->parentname.' '.$menu->name;
        $title = strtoupper($title);
        

        $db = DB::connection()->getPdo();
        $rs = $db->query('SELECT * FROM strole ');
        for ($i = 0; $i < $rs->columnCount(); $i++) {
                $col = $rs->getColumnMeta($i);
                $columns[] = $col['name'];
                $columns[] = $col['native_type'];
        }
        
        return view('strole',compact('title', 'columns'));
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
        // return response()->json(['success' => 'Data Added successfully. ' . $request->image]);

        // ----------------------------------VALIDATION
        $rules = array(
            'name'      => ['required', \Illuminate\Validation\Rule::unique('strole')->ignore($request->hidden_id)]
        );

        
        $suksesmsg = 'Penambahan data berhasil';
        
        if ($request->actionx == 'edit')
        {
            $rules = array(
                'name'      => ['required', \Illuminate\Validation\Rule::unique('strole')->ignore($request->hidden_id)]
            );
            $suksesmsg = 'Edit data berhasil';
        }

        $errmsg = array(
            'name.required' => 'Kotak Name belum diisi',
            'name.unique' => 'Name sudah ada didatabase, silahkan pilih Name yang lain'
        );

        $error = Validator::make($request->all(), $rules, $errmsg);
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        

        

        // ----------------------------------CRUD
        // return response()->json(['success' => $request->active]);
        
        $form_data = array(
            'name' => $request->name,
            'active' => $request->active + 0,
            // 'active' => 0,
            'useru' => 1
        );

        if ($request->actionx == 'new')
        {
            $form_data[] = ['usere' => 1] ;
        }

        $tmp = strole::updateOrCreate(['id' => $request->hidden_id], $form_data);   


        // // Catat Log trans
        // $crud = $request->actionx == 'edit'?'u':'i';
        // $user = auth()->user();
        // DB::table('log_trans')->insert([
        //     'table_name'=>'Mstjenis',
        //     'faktur'=>$tmp->id,
        //     'crud'=>$crud,
        //     'info'=>'',
        //     'ip_user'=>$request->ip(),
        //     'user_id'=>$user->id,
        // ]);
        
        return response()->json(['success' => $suksesmsg]);
        $user = auth()->user();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\model\strole  $strole
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\model\strole  $strole
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $dtcolumns[] = ['title' => $col['name'], 'data' => $col['name'], 'name' => $col['name'], 'className' => 'text-center'];
        $data1 = strole::find($id);

        $menumaster = vwstrolemenupra::find($id)->where('menu_parentid',0)->get();
        $menudetail = vwstrolemenupra::find($id)->where('menu_parentid', '>', 0)->get();



        $data = ['data' => $data1, 'menu' => $menumaster ];
        return response()->json($data);
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