<?php

namespace App\Http\Controllers;

use App\model\mstcompany;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Image;
use File;
use Illuminate\Support\Facades\Validator;

class mstcompanyController extends Controller
{
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
            $kota = DB::select(DB::raw("SELECT id, name2 FROM vwmstkota order by `name`"));
            $id = auth()->user()->id;
            $data = mstcompany::find($id);
            return view('master\mstcompany', compact('data', 'kota'));
      }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = auth()->user()->id;
        // return response()->json(['success' => 'Data Added successfully. ' . $request->image]);

        // ----------------------------------VALIDATION
        $rules = array(
            'name'      => ['required', \Illuminate\Validation\Rule::unique('mstcompany')->ignore($id)],
            'alamat'    => 'required', 
            'idkota'    => 'required',
            'notelp'    => 'required', 
            'email'     => 'required|email', 
            'deskripsi' => 'required'
        );

        $errmsg = array(
            'name.unique' => 'Name sudah ada didatabase, silahkan pilih Name yang lain'
        );

        $error = Validator::make($request->all(), $rules, $errmsg);
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $suksesmsg = 'Edit data berhasil';
        
        // ----------------------------------IMAGE SAVING
        $destinationPathbig = public_path('images/company');
        $destinationPaththumb = public_path('images/company');  
        

        $new_name = $request->imageold;
        $image = $request->file('pathlogo');
        if($image != '')
        {
            // $new_name = time() . '_' . rand() . '.' . $image->getClientOriginalExtension();
            $new_name = $id . '.' . $image->getClientOriginalExtension();
            // upload image thumbnail size
            $resize_image = Image::make($image->getRealPath());

            $resize_image->resize(150, 150, function($constraint){
            $constraint->aspectRatio();
            })->save($destinationPaththumb . '/' . $new_name);

            // upload image original size
            // $image->move($destinationPathbig , $new_name);
            
            //Hapus file yang lama
            // if ($request->actionx == 'edit')
            // {
            //     File::delete($destinationPaththumb . '/' . $request->imageold);
            //     File::delete($destinationPathbig . '/' . $request->imageold);
            // }
        }


        // ----------------------------------CRUD
        $aktifx = 0;
        if ($request->input('aktif') == true ){$aktifx=1;}

        $form_data = array(
            'name' => $request->name,            
            'idkota'    => $request->idkota,
            'alamat'    => $request->alamat, 
            'notelp'    => $request->notelp, 
            'email'     => $request->email, 
            'deskripsi' => $request->deskripsi, 
            'pathlogo'  => $new_name,
            'active'    => $request->active + 0,
            'useru'     => $id,
        );

        if ($request->actionx == 'new')
        {$form_data[] = ['usere' => $id] ;}
        
        $tmp = mstcompany::updateOrCreate(['id' => $id], $form_data);   


        // // Catat Log trans
        // $crud = $request->actionx == 'edit'?'u':'i';
        // $user = auth()->user();
        // DB::table('log_trans')->insert([
        //     'table_name'=>'Mstevent',
        //     'faktur'=>$tmp->id,
        //     'crud'=>$crud,
        //     'info'=>'',
        //     'ip_user'=>$request->ip(),
        //     'user_id'=>$user->id,
        // ]);
        
        return response()->json(['success' => $suksesmsg]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\model\mstcompany  $mstcompany
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = mstcompany::find($id);
        return response()->json($data);
    }

}
