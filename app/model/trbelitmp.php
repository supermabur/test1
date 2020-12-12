<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CompositeKey;

class trbelitmp extends Model
{
    use CompositeKey;
    
    public $timestamps = false;
    protected $primaryKey = ['iduser','faktur','idoutlet','idbarang'];
    public $incrementing = false;
    protected $table = 'trbelitmp';

    protected $fillable = [
        'iduser',
        'faktur',
        'idoutlet',
        'idsupcus',
        'fakturreff',
        'pkp',
        'idbarang',
        'nama',
        'order',
        'qty',
        'idsatuan',
        'disc',
        'harga',
        'jumlah',
        'info'
    ];
}
