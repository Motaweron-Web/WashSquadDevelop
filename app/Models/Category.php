<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable=['title_ar','title_en'];
    public function ScopeSelection($query){
        return $query->select('id','title_en','title_ar' );
    }

    public function products(){

        return $this->hasMany('App\Models\Product','category_id','id');

    }
}
