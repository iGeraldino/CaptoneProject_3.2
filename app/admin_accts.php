<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class admin_accts extends Authenticatable
{

    protected $table = 'admin_accts';
    protected $primaryKey = 'Admin_ID';

    protected $fillable = [
        'email', 'password','type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
