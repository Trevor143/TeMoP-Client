<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $guarded =[];

    public function bids(){
        return $this->hasManyThrough(Bid::class,User::class);
    }

    public function tender(){
        return $this->belongsToMany('App\Models\Tender', 'company_tender');
    }
}
