<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $table = 'bidder_details';

    public function user(){
        return $this->belongsTo('App\User');
    }
}
