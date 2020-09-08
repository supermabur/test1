<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'name', 'role_id', 'email', 'username', 'password',
        'active', 'usere','useru'
    ];
}
