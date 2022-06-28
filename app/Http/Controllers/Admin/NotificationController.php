<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppNotification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    //
    public  function  getnotification(){

        $notifications=AppNotification::paginate(15);
        return view('admin.home.notification.index',compact('notifications'));

    }

    public function deletenotification(Request $request){
        $notification=AppNotification::find($request->id);
        if($notification==null)
            return response()->json(['status'=>false]);
        $notification->delete();
        return response()->json(['status'=>true]);

    }
    public function createnotification(){
        return view('admin.home.notification.create');

    }


    public function adminsendnotification(Request $request){


        $validator=\Validator::make($request->all(),
            [
                'sending_date'=>'required',
                'target'=>'required',
                'target_date_start'=>'required',
                'target_date_end'=>'required',
                'ar_title'=>'required',
                'ar_text'=>'required',
                'en_title'=>'required',
                'en_text'=>'required',

            ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
      $data=[
          'sending_date'=>$request->sending_date,
          'target'=>json_encode($request->target),
        'target_date_start'=>$request->target_date_start,
        'target_date_end'=>$request->target_date_end,
        'ar_title'=>$request->ar_title,
        'ar_text'=>$request->ar_text,
          'en_title'=>$request->en_title,
          'en_text'=>$request->en_text,
      ];

        AppNotification::create($data);

        return redirect()->route('getnotification');



    }




}
