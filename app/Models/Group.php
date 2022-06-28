<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $guarded = [];
   protected $table='placesgroups';
   public  function  days(){
       return $this->belongsToMany(Day::class,'days_groups');
   }
    public  function  periods(){
        return $this->belongsToMany(Period::class,'groups_periods');
    }
    public function  users(){
       return $this->hasManyThrough(User::class,Place::class);
    }
}
