<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class strole extends Model
{
    protected $table = 'strole';
    const CREATED_AT = 'datee';
    const UPDATED_AT = 'dateu';

    protected $fillable = [
        'name', 'idcompany','active', 'usere','useru'
    ];
}
