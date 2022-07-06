<?php

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

function uploadImage($folder, $image)
{
    $image->store('/', $folder);
    $filename = $image->hashName();
    $path = 'assets/images/' . $folder . '/' . $filename;
    return $path;



}

function checkPermission($permission_id){
    $ides=[];
    $id=  Auth::guard('admin')->user()->id;
    $admin=Admin::find($id);
    $permissions= $admin->permissions;
    for($i=0;$i<count($permissions);$i++)
    {

        array_push($ides,$permissions[$i]->id);


    }

    if (!in_array($permission_id, $ides))
        return false;
    return true;
}

function checkSuperAdmin(){
    $id=  Auth::guard('admin')->user()->id;
    if($id==1)
        return true;
    return false;


}
