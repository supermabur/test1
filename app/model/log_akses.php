<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class log_akses extends Model
{
    public $timestamps = false;
    protected $table = 'log_akses';

    protected $fillable = [
        'aksesmodul',
        'aksesby'
    ];
}
