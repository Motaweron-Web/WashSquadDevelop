<?php

namespace App\Http\Controllers\Api;

use App\FirebaseToken;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TokenController extends Controller
{
    /*================= Update Token============================*/


    public function token_update(Request $request){

        $rules=[
            'phone_token'=>'required',
            'user_id'=>'required',
            'software_type'=>'required|integer',
        ];

        $validate=Validator::make(request()->all(),$rules);


        if($validate->fails()){

            return response(['message'=>'this is the all errors','errors'=>$validate->messages()],422);

        }else {

            $user = User::find($request->user_id);

            if(!$user){
                return response(['status' => false, 'message' => 'this user not in DB'], 422);

            }

            if($request->software_type!=1&&$request->software_type!=2){
                return response(['status'=>false,'message'=>'send me 1 if you used  android , and 2 for ios'],422);

            }

            $firebase = FirebaseToken::where('user_id',$request->user_id)
                ->where('phone_token', $request->phone_token)
                ->where('software_type', $request->software_type)
                ->get();

            if ($firebase->count() == 0) {
                $usertoken = new  FirebaseToken();
                $usertoken->phone_token = $request->phone_token;
                $usertoken->user_id = $request->user_id;
                $usertoken->software_type = $request->software_type;
                $usertoken->save();
                return response(['message'=>'this token not found in table and i store it'],200);

            }else{
                return response(['message'=>'this token is already Stored'],200);

            }// end firebase
        }//end validation

    }//end  fun
    /*=================End  Update Token============================*/

    /*=================Delete Token============================*/

    public function token_delete(Request $request){

        $rules=[
            'phone_token'=>'required',
            'user_id'=>'required',
        ];

        $validate=Validator::make(request()->all(),$rules);


        if($validate->fails()){

            return response(['message'=>'this is the all errors','errors'=>$validate->messages()],422);

        }else {

            $user = User::find($request->user_id);

            if(!$user){
                return response(['status' => false, 'message' => 'this user not in DB'], 422);

            }

            $firebase= FirebaseToken::where('user_id',$request->user_id)->where('phone_token', $request->phone_token)->first();


            if ($firebase) {

                FirebaseToken::destroy($firebase->id);
                return response(['message'=>'the token is deleted'],200);

            }else{
                return response(['message'=>'the firebase Token not exist'],404);

            }// end firebase
        }//end validation

    }//end  fun

    /*=================Delete Token============================*/

}//end class
