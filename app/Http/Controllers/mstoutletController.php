<?php

namespace App\Http\Controllers;

use App\model\mstoutlet;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Rules\Uppercase;

class mstoutletController extends Controller
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
        $cur_user = \Auth::user();
        
        // ----------------------------------VALIDATION
        // untuk kolom nama, unique nya pake nama dan idcompany.. makanya jadi kayak gitu rulesnya
        $rules = array(            
            'nama' => ['required', 
                        Rule::unique('mstoutlet', 'nama')
                        ->ignore($request->hidden_id)
                        ->where(function ($query) {
                            $cur_user = \Auth::user();
                            return $query->where('idcompany', $cur_user->idcompany);
                        })
                    ],
            'kode' => ['required', 'string', new Uppercase, 'min:3', 'max:3',
                        Rule::unique('mstoutlet', 'kode')
                        ->ignore($request->hidden_id)
                        ->where(function ($query) {
                            $cur_user = \Auth::user();
                            return $query->where('idcompany', $cur_user->idcompany);
                        })
                    ],
            'notelp' => 'required',
            'alamat' => 'required',
            'idkota' => 'required'
        );

        
        $suksesmsg = 'Penambahan data berhasil';
        if ($request->actionx == 'edit')
        {
            $suksesmsg = 'Edit data berhasil';
        }

        $errmsg = array(
            'nama.required' => 'Kotak Nama belum diisi',
            'nama.unique' => 'Nama sudah ada didatabase, silahkan pilih Nama yang lain',
            'kode.required' => 'Kode belum diisi',
            'kode.unique' => 'Kode sudah ada didatabase, silahkan pilih Kode yang lain'
        );

        $result = Validator::make($request->all(), $rules, $errmsg);
        
        if($result->fails())
        {
            return response()->json(['errors' => ['keys' => $result->errors()->keys(), 'message' => $result->errors()->all() ]]);
        }
        
        // ----------------------------------CRUD
        $cur_user = \Auth::user();
        
        $form_data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'notelp' => $request->notelp,
            'nohp' => $request->nohp,
            'alamat' => $request->alamat,
            'idkota' => $request->idkota,
            'kode' => $request->kode,

            'idcompany' => $cur_user->idcompany,
            'useru' => $cur_user->id
        ];

        if ($request->actionx == 'new')
        {
            $form_data['usere'] = $cur_user->id;
        }

        $tmp = mstoutlet::updateOrCreate(['id' => $request->hidden_id], $form_data);   

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
    }

    public function edit($id)
    {
        $data = mstoutlet::find($id);
        return response()->json($data);
    }
}
