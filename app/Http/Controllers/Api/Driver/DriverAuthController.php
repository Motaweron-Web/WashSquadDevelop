<?php

namespace App\Http\Controllers\Api\Driver;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DriverAuthController extends Controller
{
    /*======================= Login ============================*/


    public function login(Request $request){ // Start Login

        $rules=[
            'username' => 'required|string',
            'password'=>'required',

        ];

        $validate=Validator::make(request()->all(),$rules,['digits_between'=>'the phone number must be number and no + in it']);


        if($validate->fails()){

            return response(['message'=>'this is the all errors','errors'=>$validate->messages()],422);

        }else{



            if(Auth::attempt(['name'=>request('username'),'password'=>request('password')])) {

                $user = Auth::user();

                if ($user->user_type!=2){
                    return response('not a driver', 402);
                }


                if ($user->is_active==0){
                    return response('not active user', 403);
                }


                $user->is_login = 1;
                $user->save();

                $user=User::find($user->id);
                return response($user, 200);
            }
            return response([
                'messages'=>'Invalid username or password',

            ],404);
        }//no login

    }// validation

//login end

    /*=======================End Login ============================*/

    /*======================= Logout ============================*/

    public function logout(Request $request){

        $rules=[
            'user_id' => 'required',


        ];

        $validate=Validator::make(request()->all(),$rules,['digits_between'=>'the phone number must be number and no + in it']);


        if($validate->fails()){

            return response(['message'=>'this is the all errors','errors'=>$validate->messages()],422);

        }

        $user = User::find($request->user_id);

        if(!$user){
            return response(['status' => false, 'message' => 'this user not in DB'], 422);

        }

        if ($user->user_type!=2){
            return response('not a driver', 402);
        }


        $user->is_login=0;
        $save=$user->save();
        if($save) {
            $user=User::find($user->id);
            return response($user, 200);
        }
        return response([
            'messages'=>'error',

        ],404);


    }//end function

    /*======================= Logout ============================*/

}
