<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $table = "details";
    protected $casts = [
        'range_dates'=> 'object',
        'minutes'=>'array'
    ];

    public function tender(){

        return $this->belongsTo('App\Models\Tender');
    }
}
