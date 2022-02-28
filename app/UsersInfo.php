<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersInfo extends Model
{
    protected $table = "users_info";
    public $guarded = [];

    function user(){
        return $this->belongsTo('App\User');
    }
}
