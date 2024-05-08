<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class tempuh extends Model
{
    public $timestamps = false;
    protected $table = 'tempuh';

    protected $fillable = [
        'nama',
        'notelp',
        'jarak',
        'potongan',
        'harga',
        'pajak'
    ];
}
