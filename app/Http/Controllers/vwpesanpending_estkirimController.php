<?php

namespace App\Http\Controllers;

use App\model\vwpesanpending_estkirim;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\stmemenu;

class vwpesanpending_estkirimController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('cekmenuroles');
    }


    public function index(Request $request)
    {

        // SELECT `status`, selisihestkirim, FORMAT(total,0)
        // FROM vwpesanpendingrekap
        // where statuskirim = '2 minggu'
        // order by `status`, selisihestkirim


        $menu = stmemenu::where('links', $request->path())->first();
        $title = $menu->parentname.' '.$menu->name;
        $title = strtoupper($title);
        return view('rptpesanpending_estkirim',compact('title'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\model\vwpesanpending_estkirim  $vwpesanpending_estkirim
     * @return \Illuminate\Http\Response
     */
    public function show(vwpesanpending_estkirim $vwpesanpending_estkirim)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\model\vwpesanpending_estkirim  $vwpesanpending_estkirim
     * @return \Illuminate\Http\Response
     */
    public function edit(vwpesanpending_estkirim $vwpesanpending_estkirim)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\model\vwpesanpending_estkirim  $vwpesanpending_estkirim
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, vwpesanpending_estkirim $vwpesanpending_estkirim)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\model\vwpesanpending_estkirim  $vwpesanpending_estkirim
     * @return \Illuminate\Http\Response
     */
    public function destroy(vwpesanpending_estkirim $vwpesanpending_estkirim)
    {
        //
    }
}
