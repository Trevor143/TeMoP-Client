<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tender extends Model
{
    protected $table = "tenders";
    protected $casts = [ 'requiredDocs'=>'array', 'filename'=> 'array'];
    protected $dates = ['deadline'];

    public function detail(){
        return $this->hasOne('App\Models\Detail');
    }

    public function timeline()
    {
        return $this->hasMany('App\Models\Timeline', 'tender_id');
    }

    public function user(){
        return $this->belongsToMany('App\Models\Organization','tender_user', 'tender_id','user_id');
    }

    public function organization(){
        return $this->belongsTo('App\Models\Organization', 'user_id');
    }
    public function bid(){
        return $this->hasMany('App\Models\Bid');
    }

    public function company()
    {
        return $this->belongsToMany('App\Models\Company', 'company_tender');
    }
    public function tasks(){
        return $this->hasMany('App\Task');
    }
}
