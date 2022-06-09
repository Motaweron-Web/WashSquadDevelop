<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponPaymente extends Model
{
    use HasFactory;
    protected $guarded = [];
protected $table='coupoons_payments';
}
