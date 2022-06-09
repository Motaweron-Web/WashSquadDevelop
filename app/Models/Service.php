<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table='services';
    protected $guarded = [];
 public function subsubservices(){
     return $this->belongsToMany('App\Models\Service','services_subs_services','sub_service_id','sub_sub_service_id');
 }

    public function subservices(){
        return $this->belongsToMany('App\Models\Service','services_subs_services','sub_sub_service_id','sub_service_id');
    }
}//end class
