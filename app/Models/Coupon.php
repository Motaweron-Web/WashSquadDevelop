<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $guarded=[];

    public function payments(){
        return $this->belongsToMany('App\Models\Payment','coupoons_payments','coupon_id','payment_id');
    }//end fun
}//end class
