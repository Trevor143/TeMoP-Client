<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    protected $table = 'timelines';
    protected $casts=['user_id'=>'array'];

    public function tender(){
        return $this->belongsTo('App\Models\Tender');
    }

    public function user(){
        return $this->belongsToMany('App\Models\BackpackUser');
    }

}
