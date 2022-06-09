<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderSubscriptionDetails extends Model
{
    protected $guarded=[];
    protected $table='order_subscription_details';

    protected $appends=['day'];

    public function getDayAttribute()
    {
        if ($this->will_wash_date != null)
        return date('l',strtotime($this->will_wash_date));

        return date('l',strtotime($this->wash_date));
    }//end fun

}//end class
