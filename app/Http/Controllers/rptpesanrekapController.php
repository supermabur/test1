<?php
         
namespace App\Http\Controllers;
          

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Validator;


class rptpesanrekapController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'Laporan Rekap Surat Pesan';
        $lastupdate = db::table('rkppesanheadx')->select('dateukehosting')->orderBy('dateukehosting', 'desc')->first();
        $tahunbulan = db::table('vwtahunbulan')->get();

        if ($request->ajax()) {
            // $lastupdate = rptpersediaan::select('dateu', 'kdgudang', 'namagudang')->where('kdgudang', $request->filter_gudang)->orderBy('dateu', 'desc')->first();

            // $data = Mstbarang::latest()->get();
            // $data = rptpersediaan::get_rptpersediaan_all();
            
            $data = db::select("call spgetrptpesanrekap('$request->filter_tahunbulan', 0)");
            // $columnsheader  = \DB::getSchemaBuilder()->getColumnListing($data);
            
            $columnsheader  = 'asd';

            return Datatables::of($data)
                                ->with('lastupdate', $lastupdate->dateukehosting)
                                ->with('columnheader', $columnsheader)
                                ->addColumn('action', function($row){
                                    if ($row->id=='x')
                                    {
                                        $btn = '';
                                    }
                                    else
                                    {
                                        // $btn = '<button type="button" name="detail" id="'.$row->id.'" class="detail btn btn-primary btn-sm" style="padding-bottom: 0rem; padding-top: 0rem;">Detail</button>';
                                        $btn = '<button type="button" name="detail" id="'.$row->id.'" data-toggle="modal" data-target="#modaldetail" class="detail btn btn-primary btn-sm" style="padding-bottom: 0rem; padding-top: 0rem;">Detail</button>';
                                    }
                                    return $btn;
                                })
                                ->rawColumns(['action'])
                                // ->with('outlet','nama gudang')
                                // ->with('outlet',$data[0]['namagudang'] . ' (' . $data[0]['kdgudang'] . ')')
                                ->toJson(); 
        }
      
        return view('rptpesanrekap',compact('title', 'tahunbulan'));
    }

    
    public function getdetailpesan(Request $request)
    {
        $par = explode('|', $request->id);

        $ls = $par[0]=='LEASING'?'namaleasing is not null':'namaleasing is null';

        $thnbln = str_replace('-','',$par[1]);

        $que = "select `status`, a.tanggal, a.faktur, namacustomer, total, estkirim, keterangan, memo, namaleasing, ls_acc as isacc, ls_fakturpo, namagudang ";
        $que .= "FROM rkppesanheadx a ";
        $que .= "WHERE `a`.`status` IN ( 'Pending', 'Pending Proses' ) and DATE_FORMAT(tanggal,'%Y%m') = '$thnbln' and $ls ";
        $que .= "order by `status`, tanggal, faktur";

        // return $que;

        $det = DB::select($que);
    
        return Datatables::of($det)
                ->toJson();
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
        $rules = array(
            'name'      => ['required', \Illuminate\Validation\Rule::unique('mstbarang')->ignore($request->hidden_id)],
            'detail'    => 'required'
        );

        $errmsg = array(
            'name.required' => 'Kotak Name belum diisi',
            'name.unique' => 'Name sudah ada didatabase, silahkan pilih Name yang lain',
            'detail.required' => 'Kotak Deskripsi belum diisi'
        );

        $error = Validator::make($request->all(), $rules, $errmsg);
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }


        // ----------------------------------CRUD
        $aktifx = 0;
        if ($request->input('aktif') == true ){$aktifx=1;}


        $form_data = array(
            'name' => $request->name,
            'detail' => $request->detail,
            'jenis_id' => $request->jenis_id,
            'kategori_id' => $request->kategori_id,
            'harga' => $request->harga, 
            'disc1' => $request->disc1,
            'disc2' => $request->disc2,
            'disc3' => $request->disc3,
            'disc4' => $request->disc4,
            'disc5' => $request->disc5,
            'aktif' => $aktifx
        );
        
        $tmp = Mstbarang::updateOrCreate(['id' => $request->hidden_id], $form_data);   


        // Catat Log trans
        $crud = $request->actionx == 'edit'?'u':'i';
        $user = auth()->user();
        DB::table('log_trans')->insert([
            'table_name'=>'Mstbarang',
            'faktur'=>$tmp->id,
            'crud'=>$crud,
            'info'=>'',
            'ip_user'=>$request->ip(),
            'user_id'=>$user->id,
        ]);

        return response()->json(['success' => $tmp->id]);
        $user = auth()->user();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Mstbarang::find($id);
        $image = Mstbarang_image::getImages($id);
        return response()->json(['data' =>$data, 'img'=>$image]);
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $data = Mstslide::findOrFail($id);
        // $data->delete();
        // return response()->json(['success'=>'Data deleted successfully.']);

        Mstbarang::find($id)->delete();     
        return response()->json(['success'=>'Data deleted successfully.']);
    }
    
    public function getdetail($id)
    {
        $title = 'Detail Barang';
        $data = Mstbarang::get_vwmstbarang($id);
        $image = Mstbarang_image::getImages($id);
        return view('mstbarang_detail',compact('title', 'data', 'image'));
    }
    
    public function getlistperjenis($jenis_id)
    {
        $tmp = Mstjenis::where('id', $jenis_id)->first();
        $title = $tmp->name;
        $data = VwMstbarang::where('jenis_id', $jenis_id)->where('aktif',1)->paginate(10);
        return view('mstbarang_perjenis',compact('title', 'data'));
    }



    public function changeaktif(Request $request)
    {
        $user = Mstbarang::find($request->user_id);
        $user->status = $request->aktif;
        $user->save();
  
        return response()->json(['success'=>'Status change successfully.']);
    }
}