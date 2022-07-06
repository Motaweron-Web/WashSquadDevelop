<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admins';

    protected $fillable = [
        'name', 'email', 'password','image','lang'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function permissions(){
        return $this->belongsToMany(Permission::class,'admins_permissions','admin_id','permission_id');
    }
}
