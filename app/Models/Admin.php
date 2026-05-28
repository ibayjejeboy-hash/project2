<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'updated_at',
        'created_at'
    ];

    protected $hidden = [
        'password'
    ];
}