<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodLimit extends Model
{
    use HasFactory;
    protected $guarded = [];
   protected $table='periods_limit';
}
