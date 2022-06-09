<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $guarded=[];
    public $timestamps=true;

    public function group(){
        return $this->belongsTo('App\Models\Group','group_id');
    }
    public function payments(){
        return $this->belongsToMany('App\Models\Payment','payments_places');
    }
    public  function services(){
        return $this->belongsToMany('App\Models\Service','services_places');
    }
}//end class
