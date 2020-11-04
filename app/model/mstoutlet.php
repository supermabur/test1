<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class mstoutlet extends Model
{
    public $timestamps = false;
    protected $table = 'mstoutlet';

    protected $fillable = [
        'nama',
        'email',
        'kode',
        'notelp',
        'nohp',
        'alamat',
        'idkota',
        'aktif',
        'idcompany',
        'usere',
        'useru'
    ];
}
