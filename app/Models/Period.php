<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory;
    protected $guarded = [];

    public  function  services(){
        return $this->belongsToMany('App\Models\Service','periods_limit','service_id','id');
    }


}
