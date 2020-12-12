<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CompositeKey;

class trbelibayartmp extends Model
{
    use CompositeKey;
    
    public $timestamps = false;
    protected $primaryKey = ['iduser','faktur','idoutlet','idcarabayar'];
    public $incrementing = false;
    protected $table = 'trbelibayartmp';

    protected $fillable = [
        'iduser',
        'idoutlet',
        'faktur',
        'idcarabayar',
        'nama',
        'nokartu',
        'jumlah',
        'chargepers',
        'chargenominal',
        'total'
    ];
}
