<?php

namespace App\Http\Controllers;

use App\model\tempuh;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class tempuhController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('cekmenuroles');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // ----------------------------------VALIDATION
        // untuk kolom nama, unique nya pake nama dan idcompany.. makanya jadi kayak gitu rulesnya
        $rules = array(            
            'nama' => 'required',
            'notelp' => 'required',
            'jarak' => 'required',
            'potongan' => 'required',
            'harga' => 'required'
        );

        
        $suksesmsg = 'Penambahan data berhasil';
        if ($request->actionx == 'edit')
        {
            $suksesmsg = 'Edit data berhasil';
        }

        $errmsg = array(
            'nama.required' => 'Kotak Nama belum diisi'
        );

        $result = Validator::make($request->all(), $rules, $errmsg);
        
        if($result->fails())
        {
            return response()->json(['errors' => ['keys' => $result->errors()->keys(), 'message' => $result->errors()->all() ]]);
        }
        
        // ----------------------------------CRUD
        
        $form_data = [
            'nama' => $request->nama,
            'notelp' => $request->notelp,
            'jarak' => $request->jarak,
            'potongan' => $request->potongan,
            'harga' => $request->harga
        ];

        $tmp = tempuh::updateOrCreate(['id' => $request->id], $form_data);   

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
        
        return response()->json(['success' => $suksesmsg, 'data' =>$tmp]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\model\mstsupcus  $mstsupcus
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = tempuh::find($id);
        return response()->json($data);
    }


}
