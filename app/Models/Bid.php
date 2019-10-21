<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $fillable = ['tender_id', 'user_id', 'req_files'];

    protected $casts = ['req_files'=>'object'];
    protected $dates = ['created_at'];


    public function tender(){
        return $this->belongsTo('App\Models\Tender');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function files(){
        return $this->morphMany('App\Models\File', 'fileable');
    }
}
