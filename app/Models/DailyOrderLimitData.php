<?php

namespace App\Models;
use \Illuminate\Database\Eloquent\Model;
class DailyOrderLimitData extends Model
{
    protected $table = 'daily_order_limit_data';
    protected $guarded=[];

    public function daily_order_limit()
    {
        return $this->belongsTo(DailyOrderLimit::class,'daily_order_limit_id');
    }
}//end fun
