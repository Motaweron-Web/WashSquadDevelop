<?php

namespace App\Http\Controllers\Api;

use App\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{  /*======================= Start Contact Us ============================*/

    public function contact_us(Request $request){

        $rules=[
            'name'=>'required|string|min:4',
            'email' => 'required|string|email|max:255',
            'subject' => 'required|string|max:190',
            'message' => 'required|string|max:2000',
        ];
        $validate=Validator::make(request()->all(),$rules);

        if($validate->fails()){

            return response(['status'=>false,'message'=>'this is the all errors','errors'=>$validate->messages()],422);

        }else{

            $contact=new Contact();
            $contact->name=$request->name;
            $contact->email=$request->email;
            $contact->subject=$request->subject;
            $contact->message=$request->message;


            $save=$contact->save();

            if($save){

                // Send To admin


                return response($contact,200);

            }else{
                return response([
                    'status'=>false,
                    'message'=>'Insert fail',
                ],500);

            }//insert



        }//validate


    }//end fun


    /*======================= End  Contact Us ============================*/
}
