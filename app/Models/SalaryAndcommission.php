<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Filterable;

class SalaryAndcommission extends Model
{
    use HasFactory;
    protected $table='user_employs';


    protected $filters = [
        NameFilter::class,
    ];
    protected $guarded=[];

    public function ScopeSelection($query){
        return $query->select('id','name','commencement_date','salary','commission' ,

           'absence','discoound','invoice','borrow','commission','is_confirmed','employ_number','name','commencement_date','status','vacations','salary','commission' ,'id_number','expire_residence',

'phone','absence','job_title','email','contract','ipan','photo','invoice','borrow','commission');
    }
}
