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
     * Create a new controller instance.
     *
     * @return void
     */
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
        
        $cur_user = \Auth::user();
        // return response()->json(['success' => $request->mnu]);

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
            'useru' => $cur_user->id,
            'idcompany' => $cur_user->idcompany
        );

        if ($request->actionx == 'new')
        {
            $form_data[] = ['usere' => $cur_user->id] ;
        }

        $tmp = strole::updateOrCreate(['id' => $request->hidden_id], $form_data);   


        
        // -------------------------------------CRUD strolemenu
        DB::delete('delete from strolemenu where id_role = ?', [$request->hidden_id]);
            // return response()->json(['success' => $request->mnu]);

        $myA = explode(',', $request->mnu);
        foreach($myA as $mnu){
            DB::insert('INSERT INTO strolemenu(`id_role`, `id_menu`, `usere`, `useru`, idcompany) VALUES (?,?,?,?,?)', [$request->hidden_id, $mnu, $cur_user->id, $cur_user->id, $cur_user->idcompany]);
        }


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

        $menumaster = vwstrolemenupra::where('menu_parentid',0)->where('id', $id)->get();

        foreach ($menumaster as $mm){
            if($mm->menu_haschild > 0 ){
                
                $menudetail = vwstrolemenupra::where('menu_parentid', $mm->menu_id)->where('id', $id)->get();
                $mmd = array();
                foreach($menudetail as $md){                    
                    $mmd[] = ['item' => ['id' => "$md->menu_id", 'label' => $md->menu_name, 'checked' => $md->checked ==1?true:false ] ];
                }

                $menu[] = [ 'item' => ['id' => "$mm->menu_id", 'label' => $mm->menu_name, 'checked' => $mm->checked ==1?true:false ], 'children' => $mmd ];
                // $menu[] = ['children' => $mmd];
            }
        }

        $data = ['data' => $data1, 'menu' => $menu ];
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
