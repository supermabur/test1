<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class mstjenis extends Model
{
    public $timestamps = false;
    protected $table = 'mstjenis';

    protected $fillable = [
        'nama',
        'aktif',
        'idcompany',
        'usere',
        'useru'
    ];
}
