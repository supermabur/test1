<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class databrowserController extends Controller
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
            return response()->json(['success' => $request->datamenu]);
            if ($request->ajax()) {
                if($request->show0 =='YA')
                {
                    $data = rptpersediaan::where('kdgudang', $request->filter_gudang)->where('saldo','>=','0');
                }
                else
                {
                    $data = rptpersediaan::where('kdgudang', $request->filter_gudang)->where('saldo','>','0');
                }
    
                return Datatables::of($data)
                                    ->with('lastupdate', $lastupdate->dateu)
                                    ->with('columnheader', $columnsheader)
                                    // ->with('outlet','nama gudang')
                                    // ->with('outlet',$data[0]['namagudang'] . ' (' . $data[0]['kdgudang'] . ')')
                                    ->toJson(); 
            }
      }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->datamenu == 1){
            return response()->json(['success' => 'uyeeee']);
        }
        else{
            return response()->json(['success' => $request->datamenu]);
        }


        // return response()->json(['success' => $request->mnu]);

        // ----------------------------------VALIDATION
        $rules = array(
            'name'      => ['required', \Illuminate\Validation\Rule::unique('users')->ignore($request->hidden_id)],
            'username' => 'required|string|max:255|unique:users,username,'.$request->hidden_id,
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$request->hidden_id],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        );

        
        $suksesmsg = 'Penambahan data berhasil';
        
        if ($request->actionx == 'edit')
        {
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
            'username' => $request->username,
            'role_id' => $request->role,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'useru' => 1
        );

        if ($request->actionx == 'new')
        {
            $form_data[] = ['usere' => 1] ;
        }

        $tmp = users::updateOrCreate(['id' => $request->hidden_id], $form_data);   


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
    public function show($menuid, Request $request)
    {
        return response()->json(['success' => $menuid]);

    }



}
