<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarType extends Model
{
    protected $guarded = [];

    public function sub_types()
    {
        return $this->hasMany(CarType::class,'parent_id');
    }//end fun
 public function parent(){
        return $this->belongsTo(CarType::class,'parent_id');
 }
}//end class
