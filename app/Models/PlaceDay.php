<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlaceDay extends Model
{
    protected $guarded=[];
    public $timestamps=true;

    protected $appends=['days'];

    public function getDaysAttribute()
    {
        return json_decode($this->days_json);
    }//end fun

}//end class
