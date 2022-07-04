<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $guarded=[];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id')->withDefault();
    }
    public function driver()
    {
        return $this->belongsTo(User::class,'driver_id')->withDefault();
    }

    public function marketer()
    {
        return $this->belongsTo(User::class,'marketer_id','id');
    }

    public function service_basic()
    {
        return $this->belongsTo(Service::class,'service_id');
    }
    public function sub_service()
    {
        return $this->belongsTo(Service::class,'sub_service_id');
    }
     public function type()
    {
        return $this->belongsTo(CarType::class,'type_id');
    }
    public function sub_type()
    {
        return $this->belongsTo(CarType::class,'brand_id');
    }


    public function service()
    {
        return $this->belongsTo(Service::class,'service_id')->withDefault();
    }

    public function still_wash_sub()
    {
        return $this->hasMany(OrderSubscriptionDetails::class,'order_id')
            ->where('status','!=','done');
    }//end fun

    public function wash_sub()
    {
        return $this->hasMany(OrderSubscriptionDetails::class,'order_id');
    }//end fun

    public function place()
    {
        return $this->belongsTo(Place::class,'place_id');
    }//end fun

    public function from_user()
    {
        return $this->belongsTo(User::class,'from_user_id');

    }//end fun

   public  function userdeails()
   {
       return $this->belongsTo('App\Models\Admin\User','user_id');
   }
   public function payment(){
        return $this->belongsTo('App\Models\Payment','payment_method');
   }
   public  function  distributor(){
        return $this->belongsTo(User::class,'distributor_employee_id');
   }
   public function  sub_sub_services(){
        return $this->belongsToMany(Service::class,'sub_service_orders','order_id','sub_service_id');
   }
////////////////// financial order reports//////////
    public function ScopeSelection($query){
        return $query->select('id','order_date','order_type','number_of_cars','service_id','sub_service_id','sub_type_id','place_id','user_id','total_price','driver_id','status');
    }


}//end class
