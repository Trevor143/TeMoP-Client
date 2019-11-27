<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravelista\Comments\Commenter;


class Organization extends Model
{
    use Commenter;
    protected $table = "users";
    protected $primaryKey = "id";

    public function tender(){
        return $this->hasMany('App\Models\Tender');
    }


}
