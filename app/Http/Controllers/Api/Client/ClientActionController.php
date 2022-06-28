<?php

namespace App\Http\Controllers\Api\Client;

use App\CancelReason;
use App\CarSize;
use App\CarType;
use App\Notification;
use App\Commissions;
use App\Setting;
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

class ClientActionController extends Controller
{

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
            $order['work_time_choosen']=$orderTimes->work_times;

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


    /*======================= Rate Order ============================*/

    public function client_rate_order(Request $request){
        $rules=[
            'order_id' => 'required|integer',
            'rating'=>'required|numeric|between:0,5.0',
            'opinion_des'=>'required|max:1000'

        ];

        $validate=Validator::make(request()->all(),$rules,['digits_between'=>'the phone number must be number and no + in it']);


        if($validate->fails()){

            return response(['message'=>'this is the all errors','errors'=>$validate->messages()],422);

        }

        $order = Order::find($request->order_id);

        if(!$order){
            return response(['status' => false, 'message' => 'this order not in DB'], 422);

        }

        if ($order->status!=3){
            return response(['status' => false, 'message' => 'this order not in this stage'], 422);
        }

        $commissionMainValue = 0;
        $commissionValue = 0;

        $setting = Setting::firstOrFail();
        $commissionOperation = $setting->commission_value_type;

        if ($setting->commission_type == 1){
            $commissionMainValue = $setting->commission_value;
        }elseif(2){
            $commissionMainValue = Commissions::where('rating',$request->rating)
                    ->where('is_active',true)->first()->value ??0;
        }

        if ($commissionMainValue){
            if ($commissionOperation == 'val'){
                $commissionValue = $commissionMainValue;
            }elseif('per'){
                $calPer = ($commissionMainValue / 100) * $order->total_price;
                $commissionValue = $commissionMainValue + $calPer;
            }
        }

        $order->commission_value=$commissionValue;
        $order->rating=$request->rating;
        $order->opinion_des=$request->opinion_des;

        $order->status=4;
        $order->save();



        $order=$this->get_single_order($request->order_id);

        return response($order,200);
    }//end

    /*======================= Rate Order ============================*/


}
