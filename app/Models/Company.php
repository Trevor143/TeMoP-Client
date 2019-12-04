<?php

namespace App\Models;

use App\Bidder;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $guarded =[];

    public function bids(){
        return $this->hasManyThrough(Bid::class,Bidder::class);
    }

    public function tender(){
        return $this->belongsToMany('App\Models\Tender', 'company_tender');
    }

    public function user(){
        return $this->hasMany('App\Models\Bidder','company_id');
    }
}
