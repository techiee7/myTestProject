<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $fillable = [
        'name', 'email','phone','password','gender','image','created_at','username','usertype'
    ];
    public $timestamps = false;
}
