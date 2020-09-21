<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class mstcompany extends Model
{
    protected $table = 'mstcompany';
    const CREATED_AT = 'datee';
    const UPDATED_AT = 'dateu';

    protected $fillable = [
        'name', 'alamat', 'idkota', 'notelp', 'email', 'deskripsi', 'pathlogo', 'active', 'usere','useru'
    ];
}
