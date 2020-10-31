<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class mstsupcus extends Model
{
    public $timestamps = false;
    protected $table = 'mstsupcus';

    protected $fillable = [
        'nama',
        'email',
        'jenis',
        'notelp',
        'nohp',
        'alamat',
        'idkota',
        'ispkp',
        'npwp',
        'terminbeli',
        'terminjual',
        'maxhutang',
        'maxpiutang',
        'aktif',
        'idcompany',
        'usere',
        'useru'
    ];
}
