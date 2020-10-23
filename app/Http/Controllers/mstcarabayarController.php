<?php

namespace App\Http\Controllers;

use App\model\mstcarabayar;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class mstcarabayarController extends Controller
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
            'nama' => ['required', 
                        Rule::unique('mstcarabayar', 'nama')
                        ->ignore($request->hidden_id)
                        ->where(function ($query) {
                            $cur_user = \Auth::user();
                            return $query->where('idcompany', $cur_user->idcompany);
                        })
                    ]
        );

        
        $suksesmsg = 'Penambahan data berhasil';
        if ($request->actionx == 'edit')
        {
            $suksesmsg = 'Edit data berhasil';
        }

        $errmsg = array(
            'nama.required' => 'Nama belum diisi',
            'nama.unique' => 'Nama sudah ada, silahkan pilih Nama yang lain'
        );

        $result = Validator::make($request->all(), $rules, $errmsg);
        
        if($result->fails())
        {
            return response()->json(['errors' => ['keys' => $result->errors()->keys(), 'message' => $result->errors()->all() ]]);
        }
        
        // ----------------------------------CRUD
        
        $form_data = [
            'nama' => $request->nama,
            'inputnokartu' => $request->inputnokartu+0,
            'chargeusepersen' => $request->chargeusepersen+0,
            'chargevalue' => $request->chargevalue,
            'idcoa' => 1,
            'aktif' => $request->active + 0,
            'idcompany' => $cur_user->idcompany,
            'useru' => $cur_user->id
        ];

        if ($request->actionx == 'new')
        {
            $form_data['usere'] = $cur_user->id;
        }

        $tmp = mstcarabayar::updateOrCreate(['id' => $request->hidden_id], $form_data);   
        return response()->json(['success' => $suksesmsg]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\model\mstcarabayar  $mstcarabayar
     * @return \Illuminate\Http\Response
     */
    public function show(mstcarabayar $mstcarabayar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\model\mstcarabayar  $mstcarabayar
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = mstcarabayar::find($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\model\mstcarabayar  $mstcarabayar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, mstcarabayar $mstcarabayar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\model\mstcarabayar  $mstcarabayar
     * @return \Illuminate\Http\Response
     */
    public function destroy(mstcarabayar $mstcarabayar)
    {
        //
    }
}
