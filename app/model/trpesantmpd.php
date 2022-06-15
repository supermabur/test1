<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CompositeKey;

class trpesantmpd extends Model
{
    public $timestamps = false;
    protected $table = 'trpesantmpd';
    protected $primaryKey = ['userid','kode'];
    public $incrementing = false;

    protected $fillable = [
        'userid',
        'kode',
        'qty',
        'harga',
        'disc',
        'jumlah',
        'keterangan'
    ];
}
