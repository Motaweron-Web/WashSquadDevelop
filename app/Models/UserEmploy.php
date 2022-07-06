<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEmploy extends Model
{
    use HasFactory;
    protected $guarded=[];



public function users(){

    return $this->belongsTo(User::class,'userEmploy_id');
}


    public function ScopeSelection($query){
        return $query->select('id','employ_number','name','commencement_date','status','vacations','salary','commission' ,'id_number','expire_residence',

'phone','absence','job_title','email','contract','ipan','photo','discoound','invoice','borrow','commission');
    }
}
