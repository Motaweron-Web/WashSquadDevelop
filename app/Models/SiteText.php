<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteText extends Model
{
    protected $table = 'site_texts';

    protected $fillable = [

        'en_title','ar_title', 'ar_content','en_content','image','index'
    ];



    public function ScopeActive($query){
        return $query->where('id',2);
    }
    public function ScopeSelection($query)
    {
        return $query->select('id', 'ar_content', 'en_content');

    }

}
