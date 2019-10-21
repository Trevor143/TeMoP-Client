<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table='files';
//    protected $fillable = [
//        'fileable_id', 'filename', 'fileable_type', 'fileurl'
//    ];

protected $guarded = [];
    protected $casts = ['url' => 'array'];

    public function fileable(){
        return $this->morphTo();
    }
}
