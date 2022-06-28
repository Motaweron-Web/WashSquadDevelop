<?php

namespace App\Http\Controllers\Api\Driver;

use App\CancelReason;
use App\CarSize;
use App\CarType;
use App\MarketerPayment;
use App\Notification;
use App\Order;
use App\OrderImage;
use App\Service;
use App\SubServiceOrder;
use App\User;
use App\WorkTime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\NotificationFirebaseTrait;
use Illuminate\Validation\Rule;

class DriverActionController extends Controller
{
    use NotificationFirebaseTrait;
    function get_single_order($id){

        $order=Order::where('id',$id)->first()->toArray();

        $user = User::find($order['user_id']);
        $service = Service::find($order['service_id']);
        $carSize = CarSize::find($order['size_id']);
        $carType = CarType::find($order['type_id']);
        $orderTimes = WorkTime::find($order['order_time_id']);
        $cancel = CancelReason::find($order['cancel_reason']);

        //get user
        if ($user){
            $order['user_full_name']=$user->full_name;
            $order['user_image']=$user->logo;

        }

        if ($service){
            $order['service_en_title']=$service->en_title;
            $order['service_ar_title']=$service->ar_title;
            $order['service_image']=$service->image;

        }

        if ($carSize){
            $order['carSize_en_title']=$carSize->en_title;
            $order['carSize_ar_title']=$carSize->ar_title;
            $order['carSize_image']=$carSize->image;

        }

        if ($cancel){
            $order['cancel_en_title']=$cancel->en_title;
            $order['cancel_ar_title']=$cancel->ar_title;

        }


        if ($carType){
            $order['carType_en_title']=$carType->en_title;
            $order['carType__ar_title']=$carType->ar_title;
            $order['carType__image']=$carType->image;


        }
        if ($orderTimes){
            $order['work_time_choosen']=$orderTimes->time_text;

            if ($orderTimes->type==1){
                $order['work_time_en_title']='Am';
                $order['work_time_ar_title']='صباحا';

            }
            if ($orderTimes->type==2){
                $order['work_time_en_title']='Bm';
                $order['work_time_ar_title']='مساءا';

            }


        }





        $order_sub_services=SubServiceOrder::where('order_id',$order['id'])->get();

        if ($order_sub_services->count()>0){

            $i=0;
            $order_sub_array=array();
            $order_Sub_services=$order_sub_services->toArray();
            //  dd($order_Sub_services);
            foreach ($order_Sub_services as $order_Sub_service){

                $sub_service=Service::where('id',$order_Sub_service['sub_service_id'])->first();

                $order_Sub_service['sub_service_en_title']=$sub_service->en_title;
                $order_Sub_service['sub_service_ar_title']=$sub_service->ar_title;
                $order_Sub_service['sub_service_image']=$sub_service->image;
                $order_Sub_service['sub_service_price']=$order_Sub_service['price'];
                $order_Sub_service['sub_service_parent_id']=$sub_service->parent_id;
                $order_Sub_service['sub_service_level']=$sub_service->level;

                $order_sub_array[$i]=$order_Sub_service;

                $i++;

            }


            $order['order_sub_services']=$order_sub_array;
        }


        $order_images=OrderImage::where('order_id',$order['id'])->get();

        if ($order_images->count()>0){

            $i=0;
            $order_images_array=array();
            $order_Images=$order_images->toArray();
            //  dd($order_Sub_services);
            foreach ($order_Images as $order_Image){


                $order_Image['order_image_type']=$order_Image['type'];
                $order_Image['order_image']=$order_Image['image'];


                $order_images_array[$i]=$order_Image;

                $i++;

            }


            $order['order_images']=$order_images_array;
        }




        return $order;

    }//end


    /*======================= Start Order ============================*/

    public function driver_start_order(Request $request){

        $rules=[
            'order_id' => 'required|integer',
            'start_time_work' => 'required|integer',

        ];

        $validate=Validator::make(request()->all(),$rules,['digits_between'=>'the phone number must be number and no + in it']);


        if($validate->fails()){

            return response(['message'=>'this is the all errors','errors'=>$validate->messages()],422);

        }

        $order = Order::find($request->order_id);

        if(!$order){
            return response(['status' => false, 'message' => 'this order not in DB'], 422);

        }

        if ($order->status!= 12){
            return response(['status' => false, 'message' => 'this order not in this stage'], 422);
        }

        $order->start_time_work=$request->start_time_work;
       $order->status=2;
        $order->save();
        // dd($request->order_images_in);

        $order->message_key= 'driver_start_work';
        $this->sendFCMNotification([$order->user_id],'',$order);

        $order=$this->get_single_order($request->order_id);


        return response($order,200);

    }//end


    /*=======================End Start Order ============================*/

    /*======================= Cancel Order ============================*/
    public function driver_cancel_order(Request $request)
    {

        $rules = [
            'order_id' => 'required|integer',
            'cancel_reason_id' => 'required|integer',

        ];

        $validate = Validator::make(request()->all(), $rules, ['digits_between' => 'the phone number must be number and no + in it']);


        if ($validate->fails()) {

            return response(['message' => 'this is the all errors', 'errors' => $validate->messages()], 422);

        }

        $order = Order::find($request->order_id);

        if (!$order) {
            return response(['status' => false, 'message' => 'this order not in DB'], 422);


        }//end

        $cancel = CancelReason::find($request->cancel_reason_id);

        if (!$cancel) {
            return response(['status' => false, 'message' => 'this cancel Reason not in DB'], 422);


        }//end

        $order->cancel_reason=$request->cancel_reason_id;
        $order->status=5;
        $order->save();

        $order->message_key= 'driver_cancel_work';
        $this->sendFCMNotification([$order->user_id],'',$order);

        $order=$this->get_single_order($request->order_id);


        return response($order,200);


    }

    /*=======================End Cancel Order ============================*/


    /*======================= reject Order ============================*/
    public function driver_reject_order(Request $request)
    {

        $rules = [
            'order_id' => 'required|integer',
            'cancel_reason_id' => 'nullable|integer',

        ];

        $validate = Validator::make(request()->all(), $rules, ['digits_between' => 'the phone number must be number and no + in it']);


        if ($validate->fails()) {

            return response(['message' => 'this is the all errors', 'errors' => $validate->messages()], 422);

        }

        $order = Order::find($request->order_id);

        if (!$order) {
            return response(['status' => false, 'message' => 'this order not in DB'], 422);


        }//end

        if ($request->cancel_reason_id != ''){
            $cancel = CancelReason::find($request->cancel_reason_id);
            if (!$cancel) {
                return response(['status' => false, 'message' => 'this cancel Reason not in DB'], 422);
            }//end
            $order->cancel_reason=$request->cancel_reason_id;
        }
        $order->status=10;
        $order->save();

        $order->message_key= 'driver_reject_work';
        $this->sendFCMNotification([$order->user_id],'',$order);

        $order=$this->get_single_order($request->order_id);


        return response($order,200);


    }

    /*=======================End reject Order ============================*/



    /*======================= End Order ============================*/

    public function driver_end_order(Request $request){
        $rules=[
            'order_id' => 'required|integer',
            'payment_method_check' => 'required|in:1,2,3',
            'end_time_work' => 'required|integer',
            'feed_back'=>'nullable|max:1000'

        ];

        $validate=Validator::make(request()->all(),$rules,['digits_between'=>'the phone number must be number and no + in it']);


        if($validate->fails()){

            return response(['message'=>'this is the all errors','errors'=>$validate->messages()],422);

        }

        $order = Order::find($request->order_id);

        if(!$order){
            return response(['status' => false, 'message' => 'this order not in DB'], 422);

        }

        if ($order->status!=2){
            return response(['status' => false, 'message' => 'this order not in this stage'], 422);
        }

        $order->end_time_work=$request->end_time_work;
        $order->payment_method_check=$request->payment_method_check;
        $order->feedback=$request->feed_back??'';

        $order->status=3;
        $order->save();


        //notification
        $s=Carbon::now();
        $date=strtotime($s);
        $notification=new Notification();
        $notification->from_id=$order['driver_id'];
        $notification->to_id= $order['user_id'];
        $notification->notification_type=2;

        $notification->action_type=1;
        $notification->status=1;
        $notification->notification_date=$date;
        $notification->order_id=$order['id'];
        $notification->notification_name=2;
        $notification->save();

        //payment table
        $day=date('j');
        $year=date('Y');
        $month=date('n');
        $date=time();
        if ($order['order_type']==2){


            $marketer_payment=MarketerPayment::where('month',$month)->where('year',$year)->where('user_id',$order['marketer_id'])->first();
            if ($marketer_payment){
                //get the marketer value
                $marketer_row=User::where('id',$order['marketer_id'])->first();
                $value=($marketer_row->ratio/100)*$order['total_price'];
                //
                $marketer_payment->value+=$order['total_price'];
                $marketer_payment->order_count+=1;
                $marketer_payment->marketer_value+=$value;
                $marketer_payment->status=0;
                $marketer_payment->save();

            }
            else{
                $marketer_row=User::where('id',$order['marketer_id'])->first();
                $value=($marketer_row->ratio/100)*$order['total_price'];

                $marketer_payment=new MarketerPayment;
                $marketer_payment->user_id=$order['marketer_id'];
                $marketer_payment->month=$month;
                $marketer_payment->year=$year;
                $marketer_payment->day=$day;
                $marketer_payment->date=$date;
                $marketer_payment->value=$order['total_price'];
                $marketer_payment->marketer_value=$value;
                $marketer_payment->status=0;
                $marketer_payment->order_count=1;
                $marketer_payment->save();

             //   return $marketer_payment;

            }//end if


        }//end

        //set the sms fun
        $user= User::where('id',$order['user_id'])->first();
        $pos=$user->phone_code=='966'?true:false;
        if($pos != false){
            $textSMS  = "تطبيق ووش اسكواد ، لينك عرض صور الطلب قبل التنفيذ و بعد التنفيذ";
            $textSMS .= url('order/images/view'.'/'.$order['id']);
         //   $this->sendSMS($user->phone,$textSMS);
          //  $this->sendSMS($user->phone,"تم انهاء طلبك بنجاح");
        }



        $order->message_key= 'driver_end_work';
        $this->sendFCMNotification([$order->user_id],'',$order);
        $order=$this->get_single_order($request->order_id);

        return response($order,200);
    }//end

    /*=======================End end Order ============================*/

    /*=======================Upload images ============================*/
    public function driver_upload_images(Request $request){

        $rules=[
            'order_id' => 'required|integer',
            'status' => 'required|integer|in:1,2',
            'type1'=>'required|integer|in:1,2,3,4,5,6,7,8',
            'type2'=>'required|integer|in:1,2,3,4,5,6,7,8',
            'step'=>'required|integer|in:1,2,3,4,5,6,7,8'

        ];

        $validate=Validator::make(request()->all(),$rules,['digits_between'=>'the phone number must be number and no + in it']);


        if($validate->fails()){

            return response(['message'=>'this is the all errors','errors'=>$validate->messages()],422);

        }

        $order = Order::find($request->order_id);

        if(!$order){
            return response(['status' => false, 'message' => 'this order not in DB'], 422);

        }



            if($request->images1){
                //  dd($request->order_images);

                $i=0;
                foreach ($request->images1 as $order_image){

                    $start_order_images=new OrderImage();
                    $start_order_images->order_id=$request->order_id;
                    $start_order_images->status=$request->status;
                    $start_order_images->type=$request->type1;


                    //upload image

                    if ($order_image){
                        $image_request=$order_image;
                        $imageName= time().$i.'.'.$order_image->getClientOriginalName();
                        $start_order_images->image = 'orders/'.$imageName;
                        $image_request->move('upload/orders', 'orders/'.$imageName);

                    }//end
                    $start_order_images->save();
                   // dd($start_order_images);
                    $i++;

                }//end


            }//

            if($request->images2){
                //  dd($request->order_images);

                $i=0;
                foreach ($request->images2 as $order_image){

                    $start_order_images=new OrderImage();
                    $start_order_images->order_id=$request->order_id;
                    $start_order_images->status=$request->status;
                    $start_order_images->type=$request->type2;




                    //upload image

                    if ($order_image){
                        $image_request=$order_image;
                        $imageName= time().$i.'.'.$order_image->getClientOriginalName();
                        $start_order_images->image = 'orders/'.$imageName;
                        $image_request->move('upload/orders', 'orders/'.$imageName);

                    }//end
                    $start_order_images->save();

                    $i++;
                }//end


            }//



        $order->step=$request->step;
        $order->save();


        $order=$this->get_single_order($request->order_id);
        return response($order);


    }//end fun

    /**
     *  ============================================================
     *
     *  ------------------------------------------------------------
     *
     *  ============================================================
     */
    private function sendSMS($number ,$message_text ){
//        $user_name    = env("SMS_USERNAME");// "creativeshare"; //  creativeshare
//        $pass         = env('SMS_PASSWORD');  //  Hyaadodo@1010
//        $sender       = env('SMS_SENDER');  //  MIZ-WORLD
//
//        //$number       = "0539044145";
//        //$message_text =  "";
//        $date         = date("Y-m-d",time());
//        $time         = date("h:i",time());
//
//        $api_url  = 'http://www.oursms.net/api/sendsms.php?'  ;
//        $api_url .= 'username='.$user_name  ;
//        $api_url .= '&password='.$pass  ;
//        $api_url .= '&numbers='.$number  ;
//        $api_url .= '&sender='.$sender  ;
//        $api_url .= '&unicode=E'  ;
//        $api_url .= '&return=full'  ;
//        $api_url .= '&message='.urlencode($message_text)."&"  ;
//        $crl = curl_init();
//        curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($crl, CURLOPT_URL, $api_url);
//        curl_setopt($crl, CURLOPT_TIMEOUT, 10);
//        $reply = curl_exec($crl);
//        if ($reply === false) {
//            return 0;
//        }
//        //	curl_close($crl);
//        return response($reply,200);
//        //return  $reply;
    }//end fun

    public function order_amount(Request $request){
        $rules=[
            'driver_id' => ['required','integer',Rule::exists('users','id')->where('user_type',2)],
            'month' => 'required',

        ];

        $validate=Validator::make(request()->all(),$rules,['digits_between'=>'the phone number must be number and no + in it']);

        if($validate->fails()){

            return response(['message'=>'this is the all errors','errors'=>$validate->messages()],422);

        }
        $fromDate = date('Y-m-d',strtotime($request->month.'-01'));


        $toDate = date('Y-m-t',strtotime($request->month.'-01'));

        $willBackData = [];



        $orders = Order::where('driver_id',$request->driver_id)
            ->whereNotIn('service_id',[79])
            ->whereDate('created_at', '>=' ,$fromDate)
            ->whereDate('created_at', '<=' ,$toDate)
            ->selectRaw('service_id, count(*) as count_of_orders')
            ->groupBy('service_id')->with('service');

        $willBackData['polishing'] = 0;
        $willBackData['wash'] = 0;
        $willBackData['sterilization'] = 0;
        $willBackData['subscription'] = 0;
        $willBackData['total_orders'] = $orders->count();
        $willBackData['commissions'] = $orders->sum('commission_value');


        foreach($orders->get() as $order){
            if ($order->service_id == 1){
                $willBackData['wash'] = $order->count_of_orders;
            }
            if ($order->service_id == 2){
                $willBackData['polishing'] = $order->count_of_orders;
            }
            if ($order->service_id == 77){
                $willBackData['subscription'] = $order->count_of_orders;
            }
            if ($order->service_id == 78){
                $willBackData['sterilization'] = $order->count_of_orders;
            }
        }



        return  response(['data'=>$willBackData]);


//        $data = Order::where('driver_id',$request->driver_id)
    }//end fun
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function order_review(Request $request){
        $rules=[
            'driver_id' => ['required','integer',Rule::exists('users','id')->where('user_type',2)],
            'month' => 'required',

        ];

        $validate=Validator::make(request()->all(),$rules,['digits_between'=>'the phone number must be number and no + in it']);

        if($validate->fails()){

            return response(['message'=>'this is the all errors','errors'=>$validate->messages()],422);

        }
        $fromDate = date('Y-m-d',strtotime($request->month.'-01'));


        $toDate = date('Y-m-t',strtotime($request->month.'-01'));




        $averages = Order::where('driver_id',$request->driver_id)
            ->where('rating','!=','')
            ->whereDate('created_at', '>=' ,$fromDate)
            ->whereDate('created_at', '<=' ,$toDate)
            ->selectRaw('rating, count(*) as count_of_orders')
            ->selectRaw('commission_value, sum(commission_value) as sum_of_commission')
            ->groupBy('rating')->get();


        return  response()->json(['data'=>$averages]);


//        $data = Order::where('driver_id',$request->driver_id)
    }//end fun





}//end class
