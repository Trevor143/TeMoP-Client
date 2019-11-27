<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravelista\Comments\Commentable;

class Task extends Model
{
    use Commentable;

    protected $appends = ["open"];
    protected $fillable = ['text', 'start_date','duration','progress', 'parent'];
    protected $dates = ['start_date'];

    public function getOpenAttribute(){
        return true;
    }

    public function tender()
    {
        return $this->belongsTo('App\Models\Tender');
    }
    public  function user(){
        return $this->belongsTo('App\Models\Organization', 'owners');
    }
}
