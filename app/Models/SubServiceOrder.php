<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubServiceOrder extends Model
{
    protected $guarded=[];
    protected $table='sub_service_orders';
    public function service()
    {
        return $this->belongsTo(Service::class,'sub_service_id');
    }//end fun

}//end class
