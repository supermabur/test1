<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class trbelitmp extends Model
{
    public $timestamps = false;
    protected $table = 'trbelitmp';

    protected $fillable = [
        'iduser',
        'faktur',
        'idoutlet',
        'idsupcus',
        'fakturreff',
        'pkp',
        'idbarang',
        'order',
        'qty',
        'idsatuan',
        'disc',
        'harga',
        'jumlah',
        'info'
    ];
}
