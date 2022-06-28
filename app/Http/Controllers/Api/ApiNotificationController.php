<?php

namespace App\Http\Controllers\Api;

use App\Notification;
use App\NotificationText;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiNotificationController extends Controller
{
    /*======================= Get All Notifications ============================*/


    public function my_notifications(Request $request){
        if (!$request->user_id) {
            return response(['status' => false, 'message' => 'User id is required'], 422);
        }
        $user_id = User::where('id', $request->user_id)->first();
        if (!$user_id) {
            return response(['status' => false, 'message' => 'this user id not exists in DB  '], 422);
        }
        if ($user_id->user_type!=1&&$user_id->user_type!=2) {
            return response(['status' => false, 'message' => 'this user id not client or driver  in DB  '], 422);
        }

        $notifications = Notification::where('to_id', $request->user_id)->get();

        if ($notifications->count()==0){
            return response('no notifications', 404);
        }

        foreach ($notifications as $notification) {
            $notification->is_read = 1;
            $notification->save();
        }
        //$notifications = Notification::where('to_id', $request->user_id)->get()->toArray();
        $notifications = Notification::where('to_id', $request->user_id)->paginate(15);
        if ($notifications != null) {
            $i = 0;
            foreach ($notifications as $notification) {

                //$order = Order::where('id', $notification['order_id'])->first();
                $text = NotificationText::where('id', $notification->notification_name)->first();
                if ($text) {
                    $notifications[$i]->ar_notification_title = $text->ar_title;
                    $notifications[$i]->ar_notification_body = $text->ar_content;
                    $notifications[$i]->en_notification_title = $text->en_title;
                    $notifications[$i]->en_notification_body = $text->en_content;
                }
                $i++;
            }
        }
        return response($notifications, 200);
    }//end


    /*======================= Get All Notifications ============================*/

}
