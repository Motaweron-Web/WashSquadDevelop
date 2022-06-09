<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'packages';

    protected $fillable = [

        'serial_number','price', 'ar_title','en_title','ar_des','en_des','image','watches'
    ];
}
