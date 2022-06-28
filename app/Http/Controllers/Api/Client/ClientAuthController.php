<?php

namespace App\Http\Controllers\Api\Client;

use App\User;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ClientAuthController extends Controller
{
    /*=============Fun===============*/


    /*======================= Register ============================*/

    public function register(Request $request, User $user)// Start Register
    {
        $rules = [
            'full_name' => 'required|string|max:190',
            'password' => 'required|string|max:190|min:2',
            'phone' => 'required|numeric|digits_between:1,20',
            'phone_code' => 'required|numeric|digits_between:2,6',
            'software_type' => 'required|integer',
        ];
        $validate = Validator::make(request()->all(), $rules, ['digits_between' => 'the phone number must be number and no + in it']);
        if ($validate->fails()) {
            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);
        }
        // Check the software register
        if ($request->software_type != 1 && $request->software_type != 2) {
            return response(['status' => false, 'message' => 'send me 1 if the user register from android , and 2 for ios'], 422);
        }
        // Check Email Or username Validation
        //-----------------------------------------------
        $user_phone = User::where(['phone'=>$request->phone])->first();
        if ($user_phone) {
            if($user_phone->is_confirmed == 1){
                return response(["message"=>"user is registered"], 406);
            }
            else{
                //send verification code
                $code = sprintf('%04u', rand(0,1000));
                DB::table('users')
                    ->where('id',$user_phone->id)
                    ->update(['confirmation_code'=> $code ]);
                $pos=$request->phone_code=='966'?true:false;
                if($pos != false){
                   $this->sendSMS($request->phone,"Act Code-".$code."كود التفعيل -");
                }
                return response($user_phone, 200);
            }
        }
        else{
            $user = new User();
            $user->full_name = $request->full_name;
            $user->password = bcrypt($request->password);
            $user->phone_code = $request->phone_code;
            $user->phone = $request->phone;
            $user->user_type = 1;//client
            $user->is_active = 1;//client
            $goodInsert = $user->save();
            if ($goodInsert) {
                $user_data = User::where('id', $user->id)->first();
                //send verification code
                $code = sprintf('%04u', rand(0,1000));
                DB::table('users')
                    ->where('id',$user->id)
                    ->update(['confirmation_code'=> $code ]);
               // $pos = strpos($request->phone_code , "966");
                $pos=$request->phone_code=='966'?true:false;
                if($pos != false){

                    $val=$this->sendSMS($request->phone,"Act Code-".$code."كود التفعيل -");

                 //   dd($val);
                }
                return response($user_data, 200);
            }
            else {
                return response([
                    'status' => false,
                    'message' => 'Insert fail',
                ], 500);
            }//insert
        }
        //-----------------------------------------------

    }// End Register
    /*=========================End Register============================*/


    /*======================= Login ============================*/


    public function login(Request $request){ // Start Login

        $rules=[
            'phone' => 'required|numeric|digits_between:1,20',
            'phone_code'=>'required|numeric|digits_between:2,6',
            'password'=>'required',

        ];

        $validate=Validator::make(request()->all(),$rules,['digits_between'=>'the phone number must be number and no + in it']);


        if($validate->fails()){

            return response(['message'=>'this is the all errors','errors'=>$validate->messages()],422);

        }else{



            if(Auth::attempt(['phone_code'=>request('phone_code'),'phone'=>request('phone'),'password'=>request('password')])) {

                $user = Auth::user();
                $user=User::find($user->id);
                if ($user->user_type!=1){
                    return response('not a client', 404);
                }
                //--------------------------------------
                if ($user->is_confirmed == 0) {
                    return response($user, 405);
                } else {
                    if ($user->is_active == 0) {
                        return response($user, 406);
                    }
                    else{
                        return response($user, 200);
                    }
                }
                //--------------------------------------
                $user->is_login = 1;
                $user->save();
                if($user->user_type==1) {
                    $user=User::find($user->id);
                    return response($user, 200);
                }
            }
            return response([
                'messages'=>'Invalid phone or password',

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
        $user->is_login=0;
        $save=$user->save();
        if($save) {
            $user=User::find($user->id);
            return response($user, 200);
        }
        return response([
            'messages'=>'error',

        ],500);


    }//end function

    /*======================= Logout ============================*/

    /*======================= Confirm Code ============================*/

    public function confirm_code(Request $request){

        $rules=[
            'user_id'=>'required|integer',
            'code'=>'required|numeric|digits_between:2,10',

        ];

        $validate=Validator::make(request()->all(),$rules,['digits_between'=>'the phone number must be number and no + in it']);


        if($validate->fails()){

            return response(['message'=>'this is the all errors','errors'=>$validate->messages()],422);

        }


        if ($request->user_id) {
            $user = User::find($request->user_id);

            if (!$user) {
                return response(['status' => false, 'message' => 'this user not in DB'], 422);
            }

            if ($user->user_type!=1) {
                return response(['status' => false, 'message' => 'this user not a client in DB'], 422);
            }

        }

        if ($user->confirmation_code!=$request->code){
            return response($user,401);
        }
        $user->is_confirmed=1;
        $user->is_login=1;
        $user->save();
        return response($user,200);


    }//end


    /*======================= Confirm Code ============================*/
    /*======================= Resend Code ============================*/
    public function resend(Request $request){

        $rules=[
            'user_id'=>'required|integer',
        ];

        $validate=Validator::make(request()->all(),$rules,['digits_between'=>'the phone number must be number and no + in it']);


        if($validate->fails()){

            return response(['message'=>'this is the all errors','errors'=>$validate->messages()],422);

        }


        if ($request->user_id) {
            $user = User::find($request->user_id);

            if (!$user) {
                return response(['status' => false, 'message' => 'this user not in DB'], 422);
            }

            if ($user->user_type!=1) {
                return response(['status' => false, 'message' => 'this user not a client in DB'], 422);
            }
            if ($user->is_confirmed==1) {
                return response(['status' => false, 'message' => 'this user is aleady confirmed in DB'], 422);
            }

        }

        // code
        //send mobile sms
        //send verification code
        $code = sprintf('%04u', rand(0,1000));
        DB::table('users')
            ->where('id',$user->id)
            ->update(['confirmation_code'=> $code ]);
       // $pos = strpos($user->phone_code , "966");
        $pos=$user->phone_code=='966'?true:false;
        if($pos != false){
            $this->sendSMS($user->phone,"Act Code-".$code."كود التفعيل -");
        }
        $user->confirmation_code=$code;
        $user->save();
        return response($user,200);


    }//end

    /*===========================forget_pass=========================*/
    public function forget_pass(Request $request){

        $rules=[
            'phone' => 'required|numeric|digits_between:1,20',
            'phone_code'=>'required|numeric|digits_between:2,6',
        ];

        $validate=Validator::make(request()->all(),$rules,['digits_between'=>'the phone number must be number and no + in it']);


        if($validate->fails()){

            return response(['message'=>'this is the all errors','errors'=>$validate->messages()],422);

        }
        //---------------------------------------------------------------------------------
        $user = User::where(['phone'=>$request->phone])->first();

        if (!$user){
            return response(['message'=>'this phone is not exist the all errors'],422);
        }

        $code = sprintf('%04u', rand(0,1000));
        $pos=$user->phone_code=='966'?true:false;
        if($pos != false){
            $this->sendSMS($user->phone,"".$code."كود تأكيد تغيير كلمة المرور -");
        }
        $user->password_token=$code;
        $user->save();
        $user = User::where(['phone_code'=>$request->phone_code])->where(['phone'=>$request->phone])->first();

        return response($user,200);

    }//end

    /*=============================confirm password Code=========================*/
    public function confirm_passwordCode(Request $request){
        $rules=[
            'user_id'=>'required|integer',
            'code'=>'required|numeric|digits_between:2,10',

        ];

        $validate=Validator::make(request()->all(),$rules,['digits_between'=>'the phone number must be number and no + in it']);


        if($validate->fails()){

            return response(['message'=>'this is the all errors','errors'=>$validate->messages()],422);

        }
        //---------------------------------------------------------------------------------
        $user = User::find($request->user_id);

        if (!$user) {
            return response(['status' => false, 'message' => 'this user not in DB'], 422);
        }
        if ($user->password_token!=$request->code){
            return response($user,401);
        }

        return response($user ,200);

    }

    /*===========================================password reset=============================*/

    public function reset_pass(Request $request){

        $rules=[
            'user_id'=>'required|integer',
            'password' => 'required|string|max:190|min:2',

        ];

        $validate=Validator::make(request()->all(),$rules,['digits_between'=>'the phone number must be number and no + in it']);


        if($validate->fails()){

            return response(['message'=>'this is the all errors','errors'=>$validate->messages()],422);

        }
        //---------------------------------------------------------------------------------
        $user = User::find($request->user_id);

        if (!$user) {
            return response(['status' => false, 'message' => 'this user not in DB'], 422);
        }
        //---------------------------------------------------------------------------------
        $user->pasword_is_reset=1;
        $user->password=bcrypt($request->password);
        $user->save();
        return response($user,200);

    }//end

    /*===========================================password Change=============================*/
    public function change_pass(Request $request){
        $rules=[
            'user_id'=>'required|integer',
            'new_pass' => 'required|string|max:190|min:2',

        ];

        $validate=Validator::make(request()->all(),$rules,['digits_between'=>'the phone number must be number and no + in it']);


        if($validate->fails()){

            return response(['message'=>'this is the all errors','errors'=>$validate->messages()],422);

        }
        //---------------------------------------------------------------------------------
        $user = User::find($request->user_id);

        if (!$user) {
            return response(['status' => false, 'message' => 'this user not in DB'], 422);
        }
        if ($user->user_type!=1){
            return response(['status' => false, 'message' => ' user not client in DB'], 422);

        }

        $user->password=bcrypt($request->new_pass);
        $user->save();
        return response($user,200);
    }
    /**
     *  ============================================================
     *
     *  ------------------------------------------------------------
     *
     *  ============================================================
     */
    private function sendSMS($number ,$message_text ){
        $user_name    = env("SMS_USERNAME");// "creativeshare"; //  creativeshare
        $pass         = env('SMS_PASSWORD');  //  Hyaadodo@1010
        $sender       = env('SMS_SENDER');  //  MIZ-WORLD

//        //$number       = "0539044145";
//        //$message_text =  "";
        $date         = date("Y-m-d",time());
        $time         = date("h:i",time());
//
        $api_url  = 'http://www.oursms.net/api/sendsms.php?'  ;
        $api_url .= 'username='.$user_name  ;
        $api_url .= '&password='.$pass  ;
        $api_url .= '&numbers='.$number  ;
        $api_url .= '&sender='.$sender  ;
        $api_url .= '&unicode=E'  ;
        $api_url .= '&return=full'  ;
        $api_url .= '&message='.urlencode($message_text)."&"  ;
        $crl = curl_init();
        curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($crl, CURLOPT_URL, $api_url);
        curl_setopt($crl, CURLOPT_TIMEOUT, 10);
        $reply = curl_exec($crl);
        if ($reply === false) {
            return 0;
        }
        //	curl_close($crl);
        return response($reply,200);
        //return  $reply;
    }







}//end class
