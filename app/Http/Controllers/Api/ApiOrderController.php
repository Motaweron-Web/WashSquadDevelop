<?php
namespace App\Http\Controllers\Api;
use App\CancelReason;
use App\CarSize;
use App\CarType;
use App\Order;
use App\OrderImage;
use App\Service;
use App\SubServiceOrder;
use App\User;
use App\WorkTime;
use App\Http\Traits\NotificationFirebaseTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
class ApiOrderController extends Controller
{
    use NotificationFirebaseTrait;

    /**
     *  ============================================================
     *
     *  ------------------------------------------------------------
     *
     *  ============================================================
     */
    function orders($orders)
    {
        if ($orders->count() > 0) {
            $j = 0;
            foreach ($orders as $order) {
                $order = $order->toArray();
                $user = User::find($order['user_id']);
                $service = Service::find($order['service_id']);
                $sub_service = Service::find($order['sub_service_id']);
                $carSize = CarSize::find($order['size_id']);
                $carType = CarType::find($order['type_id']);
                $brand = CarType::find($order['brand_id']);
                $orderTimes = WorkTime::find($order['order_time_id']);
                $cancel = CancelReason::find($order['cancel_reason']);
                $driver = User::find($order['driver_id']);
                //get $driver
                if ($driver) {
                    $orders[$j]['driver_full_name'] = $driver->full_name;
                    $orders[$j]['driver_image'] = $driver->logo;
                } else {
                    $orders[$j]['driver_full_name'] = null;
                    $orders[$j]['driver_image'] = null;
                }
                //get user
                if ($user) {
                    $orders[$j]['user_full_name'] = $user->full_name;
                    $orders[$j]['user_image'] = $user->logo;
                    $orders[$j]['user_phone_code'] = $user->phone_code;
                    $orders[$j]['user_phone'] = $user->phone;
                }
                if ($service) {
                    $orders[$j]['service_en_title'] = $service->en_title;
                    $orders[$j]['service_ar_title'] = $service->ar_title;
                    $orders[$j]['service_image'] = $service->image;
                }
                if ($sub_service) {
                    $orders[$j]['service_level2_en_title'] = $sub_service->en_title;
                    $orders[$j]['service_level2_ar_title'] = $sub_service->ar_title;
                    $orders[$j]['service_level2_image'] = $sub_service->image;
                } else {
                    $orders[$j]['service_level2_en_title'] = '';
                    $orders[$j]['service_level2_ar_title'] = '';
                    $orders[$j]['service_level2_image'] = '';
                }
                if ($carSize) {
                    $orders[$j]['carSize_en_title'] = $carSize->en_title;
                    $orders[$j]['carSize_ar_title'] = $carSize->ar_title;
                    $orders[$j]['carSize_image'] = $carSize->image;
                }
                if ($cancel) {
                    $orders[$j]['cancel_en_title'] = $cancel->en_title;
                    $orders[$j]['cancel_ar_title'] = $cancel->ar_title;
                }
                if ($carType) {
                    $orders[$j]['carType_en_title'] = $carType->en_title;
                    $orders[$j]['carType__ar_title'] = $carType->ar_title;
                    $orders[$j]['carType__image'] = $carType->image;
                }
                if ($brand) {
                    $orders[$j]['brand_en_title'] = $brand->en_title;
                    $orders[$j]['brand__ar_title'] = $brand->ar_title;
                    $orders[$j]['brand__image'] = $brand->image;
                } else {
                    $orders[$j]['brand_en_title'] = '';
                    $orders[$j]['brand__ar_title'] = '';
                    $orders[$j]['brand__image'] = '';
                }
                if ($orderTimes) {
                    $orders[$j]['work_time_choosen'] = $orderTimes->time_text;
                    if ($orderTimes->type == 1) {
                        $orders[$j]['work_time_en_title'] = 'Am';
                        $orders[$j]['work_time_ar_title'] = 'صباحا';
                    }
                    if ($orderTimes->type == 2) {
                        $orders[$j]['work_time_en_title'] = 'Bm';
                        $orders[$j]['work_time_ar_title'] = 'مساءا';
                    }
                }
                $order_sub_services = SubServiceOrder::where('order_id', $order['id'])->get();
                if ($order_sub_services->count() > 0) {
                    $i = 0;
                    $order_sub_array = array();
                    $order_Sub_services = $order_sub_services->toArray();
                    //  dd($order_Sub_services);
                    foreach ($order_Sub_services as $order_Sub_service) {
                        $sub_service = Service::where('id', $order_Sub_service['sub_service_id'])->first();
                        $order_Sub_service['sub_service_en_title'] = $sub_service->en_title;
                        $order_Sub_service['sub_service_ar_title'] = $sub_service->ar_title;
                        $order_Sub_service['sub_service_image'] = $sub_service->image;
                        $order_Sub_service['sub_service_price'] = $order_Sub_service['price'];
                        $order_Sub_service['sub_service_parent_id'] = $sub_service->parent_id;
                        $order_Sub_service['sub_service_level'] = $sub_service->level;
                        $order_sub_array[$i] = $order_Sub_service;
                        $i++;
                    }
                    $orders[$j]['order_sub_services'] = $order_sub_array;
                }
                $order_images = OrderImage::where('order_id', $order['id'])->get();
                if ($order_images->count() > 0) {
                    $i = 0;
                    $order_images_array = array();
                    $order_Images = $order_images->toArray();
                    //  dd($order_Sub_services);
                    foreach ($order_Images as $order_Image) {
                        $order_Image['order_image_type'] = $order_Image['type'];
                        $order_Image['order_image'] = $order_Image['image'];
                        $order_images_array[$i] = $order_Image;
                        $i++;
                    }
                    $orders[$j]['order_images'] = $order_images_array;
                }
                $image_url = url('order/images/view' . '/' . $order['id']);
                //if there are an img to order
                if ($order_images->count() != 0) {
                    $orders[$j]['see_images'] = $image_url;
                    $orders[$j]['see_image_check'] = 1;
                } else {
                    $orders[$j]['see_images'] = $image_url;
                    $orders[$j]['see_image_check'] = 0;
                }
                $j++;
            }//end
        }
        return $orders;
    }//end
    /**
     *  ============================================================
     *
     *  ------------------------------------------------------------
     *
     *  ============================================================
     */
    function Single_orders($order)
    {
        if ($order) {
            $j = 0;
            $user = User::find($order['user_id']);
            $service = Service::find($order['service_id']);
            $carSize = CarSize::find($order['size_id']);
            $carType = CarType::find($order['type_id']);
            $brand = CarType::find($order['brand_id']);
            $sub_service = Service::find($order['sub_service_id']);
            $orderTimes = WorkTime::find($order['order_time_id']);
            $cancel = CancelReason::find($order['cancel_reason']);
            $driver = User::find($order['driver_id']);
            if ($brand) {
                $orders[$j]['brand_en_title'] = $brand->en_title;
                $orders[$j]['brand__ar_title'] = $brand->ar_title;
                $orders[$j]['brand__image'] = $brand->image;
            } else {
                $orders[$j]['brand_en_title'] = '';
                $orders[$j]['brand__ar_title'] = '';
                $orders[$j]['brand__image'] = '';
            }
            //get $driver
            if ($driver) {
                $order['driver_full_name'] = $driver->full_name;
                $order['driver_image'] = $driver->logo;
            } else {
                $order['driver_full_name'] = null;
                $order['driver_image'] = null;
            }
            //get user
            if ($user) {
                $order['user_full_name'] = $user->full_name;
                $order['user_image'] = $user->logo;
                $order['user_phone_code'] = $user->phone_code;
                $order['user_phone'] = $user->phone;
            }
            if ($service) {
                $order['service_en_title'] = $service->en_title;
                $order['service_ar_title'] = $service->ar_title;
                $order['service_image'] = $service->image;
            }
            if ($carSize) {
                $order['carSize_en_title'] = $carSize->en_title;
                $order['carSize_ar_title'] = $carSize->ar_title;
                $order['carSize_image'] = $carSize->image;
            }
            if ($sub_service) {
                $orders[$j]['service_level2_en_title'] = $sub_service->en_title;
                $orders[$j]['service_level2_ar_title'] = $sub_service->ar_title;
                $orders[$j]['service_level2_image'] = $sub_service->image;
            } else {
                $orders[$j]['service_level2_en_title'] = '';
                $orders[$j]['service_level2_ar_title'] = '';
                $orders[$j]['service_level2_image'] = '';
            }
            if ($cancel) {
                $order['cancel_en_title'] = $cancel->en_title;
                $order['cancel_ar_title'] = $cancel->ar_title;
            }
            if ($carType) {
                $order['carType_en_title'] = $carType->en_title;
                $order['carType__ar_title'] = $carType->ar_title;
                $order['carType__image'] = $carType->image;
            }
            if ($orderTimes) {
                $order['work_time_choosen'] = $orderTimes->time_text;
                if ($orderTimes->type == 1) {
                    $order['work_time_en_title'] = 'Am';
                    $order['work_time_ar_title'] = 'صباحا';
                }
                if ($orderTimes->type == 2) {
                    $order['work_time_en_title'] = 'Bm';
                    $order['work_time_ar_title'] = 'مساءا';
                }
            }
            $order_sub_services = SubServiceOrder::where('order_id', $order['id'])->get();
            if ($order_sub_services->count() > 0) {
                $i = 0;
                $order_sub_array = array();
                $order_Sub_services = $order_sub_services->toArray();
                //  dd($order_Sub_services);
                foreach ($order_Sub_services as $order_Sub_service) {
                    $sub_service = Service::where('id', $order_Sub_service['sub_service_id'])->first();
                    $order_Sub_service['sub_service_en_title'] = $sub_service->en_title;
                    $order_Sub_service['sub_service_ar_title'] = $sub_service->ar_title;
                    $order_Sub_service['sub_service_image'] = $sub_service->image;
                    $order_Sub_service['sub_service_price'] = $order_Sub_service['price'];
                    $order_Sub_service['sub_service_parent_id'] = $sub_service->parent_id;
                    $order_Sub_service['sub_service_level'] = $sub_service->level;
                    $order_sub_array[$i] = $order_Sub_service;
                    $i++;
                }
                $order['order_sub_services'] = $order_sub_array;
            }
            $order_images = OrderImage::where('order_id', $order['id'])->get();
            if ($order_images->count() > 0) {
                $i = 0;
                $order_images_array = array();
                $order_Images = $order_images->toArray();
                //  dd($order_Sub_services);
                foreach ($order_Images as $order_Image) {
                    $order_Image['order_image_type'] = $order_Image['type'];
                    $order_Image['order_image'] = $order_Image['image'];
                    $order_images_array[$i] = $order_Image;
                    $i++;
                }
                $order['order_images'] = $order_images_array;
            }
            $image_url = url('order/images/view' . '/' . $order['id']);
            //if there are an img to order
            if ($order_images->count() != 0) {
                $order['see_images'] = $image_url;
                $order['see_image_check'] = 0;
            } else {
                $order['see_images'] = $image_url;
                $order['see_image_check'] = 0;
            }
            $j++;
        }//end
        $subServices = Service::where('parent_id',$order['service_id'])->get();
        $service = Service::where('id',$order['service_id'])->get();

        $subServicesOrders = SubServiceOrder::where('order_id',$order['id'])->get();

        foreach($subServices as $subService){
            $subService->taked = false;
            foreach($subServicesOrders as $subServiceOrder){
                if ($subServiceOrder->sub_service_id == $subService->id){
                    $subService->taked = true;
                }
            }
        }

        $order['sub_service'] = $subServices;
        $order['service'] = $service;
        return $order;
    }//end
    /**
     *  ============================================================
     *
     *  ------------------------------------------------------------
     *
     *  ============================================================
     */
    public function all_orders(Request $request)
    {
        $rules = [
            'user_id' => 'required|integer',
            'status' => 'nullable|integer'
        ];
        $validate = Validator::make(request()->all(), $rules);
        if ($validate->fails()) {
            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);
        }//end validation
        $user = User::find($request->user_id);
        if (!$user) {
            return response(['status' => false, 'message' => 'this user not in DB'], 422);
        }
        if ($user->user_type != 1 && $user->user_type != 2) {
            return response(['status' => false, 'message' => 'this user not driver or client'], 422);
        }
        //driver
        if ($user->user_type == 2) {
            $rules = [
                'status' => 'required|integer'
            ];
            $validate = Validator::make(request()->all(), $rules);
            if ($validate->fails()) {
                return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);
            }//end validation
            if ($request->status != 1 && $request->status != 2 && $request->status != 3 && $request->status != 5) {
                return response('status must be 1 ,2,3,5', 422);
            }
        }
        //query
        $orders = Order::where('driver_id', $request->user_id)
            ->where('status', $request->status)->take(1)->paginate(1);
        //Query in client
        if ($user->user_type == 1) {
            $orders = Order::where('user_id', $request->user_id)->paginate(20);
        }
        if ($orders->count() == 0) {
            return response('no orders exist', 404);
        }
        $orders = $this->orders($orders);
        return response($orders, 200);
    }//end
    /**
     *  ============================================================
     *
     *  ------------------------------------------------------------
     *
     *  ============================================================
     */
    public function single_order(Request $request)
    {
        $rules = [
            'order_id' => 'required|integer',
        ];
        $validate = Validator::make(request()->all(), $rules);
        if ($validate->fails()) {
            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);
        }//end validation
        $order = Order::find($request->order_id);
        if (!$order) {
            return response(['status' => false, 'message' => 'this order not in DB'], 422);
        }
        $order = Order::where('id', $request->order_id)->first()->toArray();
        $order = $this->Single_orders($order);
        return response($order, 200);
    }//end
    /**
     *  ============================================================
     *
     *  ------------------------------------------------------------
     *
     *  ============================================================
     */
    public function all_current_orders(Request $request)
    {
        $rules = [
            'driver_id' => 'required|integer',
        ];
        $validate = Validator::make(request()->all(), $rules);
        if ($validate->fails()) {
            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);
        }//end validation
        $user = User::find($request->driver_id);
        if (!$user) {
            return response(['status' => false, 'message' => 'this user not in DB'], 422);
        }
        if ($user->user_type != 1 && $user->user_type != 2) {
            return response(['status' => false, 'message' => 'this user not driver or client'], 422);
        }
        //driver
        //query
        $orders = Order::where('driver_id', $request->driver_id)
            ->whereIn('status', array(1, 2,11,12))->paginate(20);
        //Query in client
        if ($user->user_type == 1) {
            $orders = Order::where('user_id', $request->driver_id)->paginate(20);
        }

        if ($orders->count() == 0) {
            return response('no orders exist', 404);
        }
        $orders = $this->orders($orders);
        return response($orders, 200);
    }//end
    /**
     *  ============================================================
     *
     *  ------------------------------------------------------------
     *
     *  ============================================================
     */
    public function user_current_orders(Request $request)
    {
        $rules = [
            'user_id' => 'required|integer',
        ];
        $validate = Validator::make(request()->all(), $rules);
        if ($validate->fails()) {
            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);
        }//end validation
        $user = User::find($request->user_id);
        if (!$user) {
            return response(['status' => false, 'message' => 'this user not in DB'], 422);
        }
        if ($user->user_type != 1 && $user->user_type != 2) {
            return response(['status' => false, 'message' => 'this user not driver or client'], 422);
        }
        //driver
        //query
        $orders = Order::where('user_id', $request->user_id)
            ->whereIn('status', array(0, 1, 2))->orderBy("id","DESC")->paginate(20);
        if ($orders->count() > 0) {
            $orders = $this->orders($orders);
            return response($orders, 200);
        }
        return response($orders, 200);
    }//end
    /**
     *  ============================================================
     *
     *  ------------------------------------------------------------
     *
     *  ============================================================
     */
    public function user_per_orders(Request $request)
    {
        $rules = [
            'user_id' => 'required|integer',
        ];
        $validate = Validator::make(request()->all(), $rules);
        if ($validate->fails()) {
            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);
        }//end validation
        $user = User::find($request->user_id);
        if (!$user) {
            return response(['status' => false, 'message' => 'this user not in DB'], 422);
        }
        if ($user->user_type != 1 && $user->user_type != 2) {
            return response(['status' => false, 'message' => 'this user not driver or client'], 422);
        }
        //driver
        //query
        $orders = Order::where('user_id', $request->user_id)
            ->whereIn('status', array(3, 4))->orderBy("id","DESC")->paginate(20);
        if ($orders->count() > 0) {
            $orders = $this->orders($orders);
            return response($orders, 200);
        }
        return response($orders, 200);
    }//end
    /*======================= go-arrive Order ============================*/
    public function updateOrderStatus(Request $request)
    {

        $rules = [
            'order_id' => 'required|integer',
            'status' => 'required|integer|in:11,12,15',
        ];

        $validate = Validator::make(request()->all(), $rules, ['digits_between' => 'the phone number must be number and no + in it']);


        if ($validate->fails()) {

            return response(['message' => 'this is the all errors', 'errors' => $validate->messages()], 422);

        }

        $order = Order::find($request->order_id);

        if (!$order) {
            return response(['status' => false, 'message' => 'this order not in DB'], 422);

        }//end
        //
        //
        if ($order->status == 15) {
            return response(['status' => false, 'message' => 'this order not on stage'], 415);

        }//end



        if ($order->status == 11 && $request->status == 11){
            return response(['status' => false, 'message' => 'you already gone'], 422);
        }


        if ($order->status == 12 && $request->status == 12){
            return response(['status' => false, 'message' => 'you already arrived'], 423);
        }

        if ($order->status == 12 && $request->status == 11){
            return response(['status' => false, 'message' => 'error in sent data'], 424);
        }



        $order->status=$request->status;
        $order->save();



        if ($order->status == 11)
            $order->message_key= 'driver_gone_to_work';
        elseif($order->status == 12){
            $order->message_key= 'driver_arrived_to_work';
        }elseif($order->status == 15){
            $order->message_key= 'order_canceled_by_user';
        }

        $this->sendFCMNotification([$order->user_id],'',$order);

        $order=$this->get_single_order($request->order_id);


        return response($order,200);


    }

    /*=======================End go-arrive Order ============================*/
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

}//end class
