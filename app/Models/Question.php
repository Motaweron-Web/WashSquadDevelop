<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded=[];
    public function ScopeSelection($query){
        return $query->select('id','en_title','ar_title','ar_content','en_content' );
    }

}
