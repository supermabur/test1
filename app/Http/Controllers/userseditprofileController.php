<?php

namespace App\Http\Controllers;

use App\model\users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use Image;
use File;


class userseditprofileController extends Controller
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
        if ($request->ajax()) {
            $cur_user = \Auth::user();
            $data = users::find($cur_user->id);
            return response()->json($data);    
        }
        $title = 'EDIT USER PROFILE';
        return view('userseditprofile',compact('title'));
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
        $cur_user = \Auth::user();
        
        $form_data = array(
            'name' => $request->name,
            'active' => $request->active + 0,
            'username' => $request->username,
            'role_id' => $request->role,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'hp' => $request->hp,
            'useru' => $cur_user->id,
            'idcompany' => $cur_user->idcompany
        );

        if ($request->actionx == 'new')
        {
            $form_data[] = ['usere' => $cur_user->id] ;
        }

        $tmp = users::updateOrCreate(['id' => $request->hidden_id], $form_data);   


        
        // ----------------------------------IMAGE SAVING
        $new_name = $tmp->id . '.jpg'; 
        $imagePath = public_path('images/users'. '/' . $new_name);  
        $noimagePath = public_path('images/users/noimage.jpg');  

        $image = $request->file('pathimage');

        if($image != '')
        {
            $resize_image = Image::make($image->getRealPath());

            $resize_image->resize(300, 300, function($constraint){
            $constraint->aspectRatio();
            })->save($imagePath);
        }
        else{
            if(!(File::exists($imagePath))){
                $success = \File::copy($noimagePath,$imagePath);
            }
        }

        $tmp->imagepath = $new_name;
        $tmp->save();


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
     * @param  \App\model\users  $users
     * @return \Illuminate\Http\Response
     */
    public function show(users $users)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\model\users  $users
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\model\users  $users
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, users $users)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\model\users  $users
     * @return \Illuminate\Http\Response
     */
    public function destroy(users $users)
    {
        //
    }
}
