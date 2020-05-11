<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class rptpersediaan extends Model
{
    protected $table = 'rptpersediaan';
    // protected $fillable = [
    //     'name', 'detail', 'jenis_id', 'kategori_id', 'harga', 'disc1', 'disc2', 'disc3', 'disc4', 'disc5', 'aktif'
    // ];
    
    // Fetch departments
    public static function get_vwmstbarang($id)
    {
        $value=DB::table('vwmstbarang')->where('id', $id)->orderBy('id', 'asc')->first(); 
        return $value;
    }
    
    // Fetch departments
    public static function get_vwmstbarangperjenis($jenis_id)
    {
        $value=DB::table('vwmstbarang')->where('jenis_id', $jenis_id)->orderBy('id', 'desc')->get(); 
        return $value;
    }
    
    // Fetch departments
    public static function get_rptpersediaan_all()
    {
        $value=DB::table('rptpersediaan')->orderBy('kdgudang', 'asc')->get(); 
        return $value;
    }
}
