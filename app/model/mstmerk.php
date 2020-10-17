<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class mstmerk extends Model
{
    public $timestamps = false;
    protected $table = 'mstmerk';

    protected $fillable = [
        'nama',
        'aktif',
        'idcompany',
        'usere',
        'useru'
    ];
}
