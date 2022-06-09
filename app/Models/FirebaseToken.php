<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FirebaseToken extends Model
{
    protected $table = 'firebase_tokens';

    protected $fillable = [
        'phone_token', 'user_id','software_type'
    ];

}
