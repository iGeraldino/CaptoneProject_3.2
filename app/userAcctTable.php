<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userAcctTable extends Model
{
    //
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $hidden = [
        'password', 'remember_token',
    ];
}
