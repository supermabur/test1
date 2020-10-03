<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    public $timestamps = false;
    protected $table = 'users';

    protected $fillable = [
        'name', 'role_id', 'email', 'username', 'password', 
        'hp', 
        'active', 'usere','useru'
    ];
}
