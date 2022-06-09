<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $guarded = [];

    public  function service(){
        return $this->belongsTo('App\Models\Service','service_id');
    }
}
