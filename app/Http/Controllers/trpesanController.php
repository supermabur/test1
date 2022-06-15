<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\model\posframe_mstbarang;


class trpesanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('cekmenuroles');
    }


    public function index()
    {
        $mstbarang = posframe_mstbarang::orderby('nama')->get();
                
        return view('trpesan',compact('mstbarang'));
    }
}
