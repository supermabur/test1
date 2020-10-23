<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class mstcarabayar extends Model
{
    public $timestamps = false;
    protected $table = 'mstcarabayar';

    protected $fillable = [
        'nama',
        'aktif',
        'inputnokartu',
        'chargeusepersen',
        'chargevalue',
        'idcoa',
        'idcompany',
        'usere',
        'useru'
    ];
}
