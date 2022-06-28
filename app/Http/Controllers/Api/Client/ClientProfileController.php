<?php

namespace App\Http\Controllers\Api\Client;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ClientProfileController extends Controller
{
    public function user_profile_edit(Request $request)
    {


        $rules = [
            'user_id' => 'required',
            'full_name' => 'required|string|min:1',
            'password'  => 'nullable|string|min:2',
            'logo'=> 'nullable|image|mimes:jpeg,jpg,png,gif|max:2240',
        ];




        $validate = Validator::make(request()->all(), $rules);

        if ($validate->fails()) {

            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);

        } else {

            $user = User::find($request->user_id);

            if(!$user){
                return response(['status' => false, 'message' => 'this user not in DB'], 422);

            }



            $user->full_name = $request->full_name!=null? $request->full_name:$user->full_name;
            $user->password = $request->password != null ? bcrypt($request->password):$user->password;

            if($request->logo!=null){
                if($user->logo!=null) {
                    $image = public_path("upload/{$user->logo}"); // get previous image from folder
                    if (File::exists($image)) { // unlink or remove previous image from folder
                        unlink($image);
                    }
                }
                $image_request=$request->logo;
                $imageName= time().'.'. request()->logo->getClientOriginalExtension();
                $user->logo = 'users/'.$imageName;
                $image_request->move('upload/users', 'users/'.$imageName);
            }


            //save
            $goodInsert = $user->save();
            if ($goodInsert) {

                return response($user, 200);

            } else {
                return response([
                    'status' => false,
                    'message' => 'update fail',
                ], 500);

            }//update

        }//validation

    }//normal data update


    /*========================End User profile=========================*/


}
