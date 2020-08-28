<?php

namespace App\Http\Controllers;

use App\model\strole;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\stmemenu;
use Illuminate\Support\Facades\DB;

class stroleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $menu = stmemenu::where('links', $request->path())->first();
        $title = $menu->parentname.' '.$menu->name;
        $title = strtoupper($title);
        

        $db = DB::connection()->getPdo();
        $rs = $db->query('SELECT * FROM strole ');
        for ($i = 0; $i < $rs->columnCount(); $i++) {
                $col = $rs->getColumnMeta($i);
                $columns[] = $col['name'];
                $columns[] = $col['native_type'];
        }
        
        return view('strole',compact('title', 'columns'));
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
     * @param  \App\model\strole  $strole
     * @return \Illuminate\Http\Response
     */
    public function show(strole $strole)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\model\strole  $strole
     * @return \Illuminate\Http\Response
     */
    public function edit(strole $strole)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\model\strole  $strole
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, strole $strole)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\model\strole  $strole
     * @return \Illuminate\Http\Response
     */
    public function destroy(strole $strole)
    {
        //
    }
}
