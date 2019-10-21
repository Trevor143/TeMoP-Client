<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $table = "users";

    public function tender(){
        return $this->hasMany('App\Models\Tender');
    }


}
