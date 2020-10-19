<?php

namespace App\Http\Controllers;

use App\model\mstbarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class mstbarangController extends Controller
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
        // return response()->json(['success' => $request->mnu]);

        // ----------------------------------VALIDATION
        $rules = array(            
            'nama' => ['required', \Illuminate\Validation\Rule::unique('mstbarang', 'nama')->ignore($request->hidden_id)],
            'sku' => 'required',
            'barcode' => 'required',
            'idmerk' => 'required',
            'idjenis' => 'required',
            'deskripsi' => 'required'
        );

        
        $suksesmsg = 'Penambahan data berhasil';
        if ($request->actionx == 'edit')
        {
            $suksesmsg = 'Edit data berhasil';
        }

        // $errmsg = array(
        //     'name.required' => 'Kotak Name belum diisi',
        //     'name.unique' => 'Name sudah ada didatabase, silahkan pilih Name yang lain'
        // );

        // $error = Validator::make($request->all(), $rules, $errmsg);
        $result = Validator::make($request->all(), $rules);
        
        if($result->fails())
        {
            // return response()->json(['errors' => $error->errors()->all()]);
            return response()->json(['errors' => ['keys' => $result->errors()->keys(), 'message' => $result->errors()->all() ]]);
        }
        
        // ----------------------------------CRUD
        $cur_user = \Auth::user();
        
        $form_data = [
            'nama' => $request->nama,
            'sku' => $request->sku,
            'barcode' => $request->barcode,
            'idmerk' => $request->idmerk,
            'idjenis' => $request->idjenis,
            'deskripsi' => $request->deskripsi,
            'idsatuan' => $request->idsatuan,
            'hpp' => $request->hpp,
            'harga' => $request->harga,
            'disc' => $request->disc,
            'saldomin' => $request->saldomin,
            'saldomax' => $request->saldomax,
            'aktif' => $request->active + 0,
            'idvarian1' => $request->idvarian1,
            'idvarian2' => $request->idvarian2,
            'idvarian3' => $request->idvarian3,
            'idcompany' => $cur_user->idcompany,
            'useru' => $cur_user->id
        ];

        if ($request->actionx == 'new')
        {
            $form_data['usere'] = $cur_user->id;
        }

        $tmp = mstbarang::updateOrCreate(['id' => $request->hidden_id], $form_data);   


        
        // ----------------------------------IMAGE SAVING
        // $destinationPaththumb = public_path('images/users');  
        

        // $new_name = $request->imageold;
        // $image = $request->file('pathimage');
        // if($image != '')
        // {
        //     $new_name = $tmp->id . '.jpg'; /*. $image->getClientOriginalExtension(); */
        //     $resize_image = Image::make($image->getRealPath());

        //     $resize_image->resize(200, 200, function($constraint){
        //     $constraint->aspectRatio();
        //     })->save($destinationPaththumb . '/' . $new_name);
        // }


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
     * Show the form for editing the specified resource.
     *
     * @param  \App\model\mstbarang  $mstbarang
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = mstbarang::find($id);
        return response()->json($data);
    }
}
