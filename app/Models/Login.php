<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'fullname',
        'email', 
        'password', 
        'password_confirm',
        'phone',
        'gender',
        'address',
        'role',
    ];

    protected $primaryKey = 'users_id';
    protected $table = 'users';
}
