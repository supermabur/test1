<?php

namespace App\Http\Controllers;

use App\model\mstmerk;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class mstmerkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('cekmenuroles');
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
        // ----------------------------------VALIDATION
        $rules = array(            
            'nama' => 'required|unique:mstmerk,nama,null,id,idcompany,'.$cur_user->idcompany 
        );

        
        $suksesmsg = 'Penambahan data berhasil';
        if ($request->actionx == 'edit')
        {
            $suksesmsg = 'Edit data berhasil';
        }

        $result = Validator::make($request->all(), $rules);
        
        if($result->fails())
        {
            return response()->json(['errors' => $result->errors()->all() ]);
        }
        
        // ----------------------------------CRUD
        
        $form_data = [
            'nama' => $request->nama,
            'aktif' => $request->active + 0,
            'idcompany' => $cur_user->idcompany,
            'useru' => $cur_user->id
        ];

        if ($request->actionx == 'new')
        {
            $form_data['usere'] = $cur_user->id;
        }

        $tmp = mstmerk::updateOrCreate(['id' => $request->hidden_id], $form_data);   
        $hasil = ['id'=>$tmp->id, 'nama'=>$tmp->nama];
        return response()->json(['success' => $hasil]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\model\mstmerk  $mstmerk
     * @return \Illuminate\Http\Response
     */
    public function show(mstmerk $mstmerk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\model\mstmerk  $mstmerk
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = mstbarang::find($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\model\mstmerk  $mstmerk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, mstmerk $mstmerk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\model\mstmerk  $mstmerk
     * @return \Illuminate\Http\Response
     */
    public function destroy(mstmerk $mstmerk)
    {
        //
    }
}
