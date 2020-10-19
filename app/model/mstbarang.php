<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class mstbarang extends Model
{
    public $timestamps = false;
    protected $table = 'mstbarang';

    protected $fillable = [
        'sku',
        'barcode',
        'nama',
        'idmerk',
        'idjenis',
        'deskripsi',
        'idsatuan',
        'hpp',
        'harga',
        'disc',
        'saldomin',
        'saldomax',
        'aktif',
        // 'idvarian1',
        // 'idvarian2',
        // 'idvarian3',
        
        'idcompany',
        'usere',
        'useru'
    ];
}
