<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlinStoreCategory extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function ScopeSelection($query){
        return $query->select('id','EN_title','AR_title' );
    }
}
