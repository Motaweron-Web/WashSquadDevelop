<?php

namespace App\Http\Controllers\Api\Client;

use App\CarSize;
use App\CarType;
use App\Coupon;
use App\CouponUser;
use App\Order;
use App\Service;
use App\Wallet;
use App\SubServiceOrder;
use App\User;
use App\WorkTime;
use App\OrderSubscriptionDetails;
use App\Setting;
use App\OrderLimit;
use App\MonthService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Traits\PaymentTapTrait;

class ClientOrderController extends Controller
{
    use PaymentTapTrait;

    /*======================= Add Order ============================*/

    public function add_order(Request $request)
    {

        $rules = [
            'user_id' => 'required|integer',
            'service_id' => 'required|integer',
            'place_id' => 'required|integer|exists:places,id',
            'sub_serv_id' => 'nullable|integer',
            'carSize_id' => 'required|integer',

            'day' => 'nullable',

            'brand_id' => 'required|integer',
            'carType_id' => 'required|integer',
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
            'total_tax' => 'required|numeric',
            'address' => 'nullable|string|min:1|max:191',
            'order_date' => 'required|date_format:Y-m-d',
            'order_time_id' => 'required|integer',
            'number_of_cars' => 'nullable|integer',
            'payment_method' => 'required|integer|in:1,2',
            'total_price' => 'required|numeric',
            'coupon_serial' => 'nullable',
        ];
        $validate = Validator::make($request->all(), $rules);

        $check = $this->check_if_Exceeds($request->order_date, $request->service_id);
        if ($check == 1) {
            return response(['status' => false, 'message' => 'The maximum number of requests for the selected service has been exceeded'], 402);

        }
        if ($validate->fails()) {

            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);

        }
        //check user id
        $user = User::find($request->user_id);

        if (!$user) {
            return response(['status' => false, 'message' => 'this user not in DB'], 422);

        }

        //check service id

        $service = Service::find($request->service_id);

        if (!$service) {
            return response(['status' => false, 'message' => 'this service not in DB'], 422);
        }

        if ($service->level != 1) {
            return response(['status' => false, 'message' => 'this service not head service'], 422);

        }


        $service_sub = Service::find($request->sub_serv_id);


        //check carSize id

        $carSize = CarSize::find($request->carSize_id);

        if (!$carSize) {
            return response(['status' => false, 'message' => 'this car size not in DB'], 422);

        }

        //check carType id

        $carType = CarType::find($request->carType_id);

        if (!$carType) {
            return response(['status' => false, 'message' => 'this car Type not in DB'], 422);

        }
        $carBrand = CarType::where('id', $request->brand_id)->where('level', 2)->first();
        if (!$carBrand) {
            return response(['status' => false, 'message' => 'this Brand id not in DB'], 422);

        }

        if ($request->coupon_serial != null) {
            $coupon = Coupon::where('coupon_serial', $request->coupon_serial)
                ->where('is_active', 1)
                ->first();
            if (!$coupon) {

                return response(['status' => false, 'message' => 'this coupon not exists in DB '], 422);

            }
            $exist = CouponUser::where('coupon_id', $coupon->id)->where('user_id', $request->user_id)->first();

            if ($exist) {
                return response(['status' => false, 'message' => 'this user already using the coupon  '], 422);
            }
            $userCoupon = new CouponUser;
            $userCoupon->coupon_id = $coupon->id;
            $userCoupon->user_id = $request->user_id;
            $userCoupon->save();

        }
        //check order_time_id id


        if ($request->order_time_id != '')
        {
            $orderTimes = WorkTime::find($request->order_time_id);

            if (!$orderTimes) {
                return response(['status' => false, 'message' => 'this work Times not in DB'], 422);
            }
        }


        $order = new Order;

        $order->order_type = 1;
        $order->user_id = $request->user_id;
        $order->service_id = $request->service_id;
        $order->sub_service_id = $request->sub_serv_id;
        $order->size_id = $request->carSize_id;
        $order->type_id = $request->carType_id;
        $order->place_id = $request->place_id;
        //order_date

        //$order_date_=date("Y-m-d", $request->order_date);
        $order_date_ = strtotime($request->order_date);

        $order->order_date = $order_date_;
        $order->order_time_id = $request->order_time_id;
        $order->brand_id = $request->brand_id;
        $order->number_of_cars = $request->number_of_cars == null ? 1 : $request->number_of_cars;
        $order->payment_method = $request->payment_method;
        $order->status = 0;
        $order->total_price = $request->total_price;
        $order->total_tax = $request->total_tax;

        $order->longitude = $request->longitude;
        $order->latitude = $request->latitude;
        $order->address = $request->address == null ? null : $request->address;

        $save = $order->save();

        $firstDate = $request->day;
//Mohamed gamal









        if ($save) {
            if ($request->service_id == 77) {
                for ($x = 1; $x <= $service_sub->count; $x++) {
                    $plus = $x - 1;
                    if ($x == 1) {
                        $washDate = date('Y-m-d', strtotime("next saturday","{$order_date_}"));
                        $firstDate = $washDate;

                    } else {
                        $washDate = date('Y-m-d', strtotime("+ {$plus} weeks $firstDate"));
                    }

                    $order_subscription_details = [];
                    $order_subscription_details['number_of_wash'] = $x;
                    $order_subscription_details['order_id'] = $order->id;
                    $order_subscription_details['wash_date'] = $washDate;
                    $order_subscription_details['status'] = 'new';
                    OrderSubscriptionDetails::create($order_subscription_details);
                }
            }
        }


        if ($request->sub_services) {

            $rows = $request->sub_services;

            foreach ($rows as $order_sub) {
                $service_check = Service::find($order_sub['sub_service_id']);

                if (!$service_check) {
                    return response(['status' => false, 'message' => 'this Sub service  not in DB'], 422);

                }

                $order_sub_service_object = new SubServiceOrder();

                $order_sub_service_object->sub_service_id = $order_sub['sub_service_id'];
                $order_sub_service_object->order_id = $order->id;
                $order_sub_service_object->price = $order_sub['price'];

                $order_sub_service_object->save();

            }//end foreach

        }//

        $order = Order::where('id', $order->id)->first()->toArray();

        $user = User::find($order['user_id']);
        $service = Service::find($order['service_id']);
        $carSize = CarSize::find($order['size_id']);
        $carType = CarType::find($order['type_id']);
        $orderTimes = WorkTime::find($order['order_time_id']);

        //get user
        if ($user) {
            $order['user_full_name'] = $user->full_name;
            $order['user_image'] = $user->logo;

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


        if ($carType) {
            $order['carType_en_title'] = $carType->en_title;
            $order['carType__ar_title'] = $carType->ar_title;
            $order['carType__image'] = $carType->image;


        }
        if ($orderTimes) {
            $order['work_time_choosen'] = $orderTimes->work_times;

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

        //send sms
        $pos = $user->phone_code == '966' ? true : false;
        if ($pos != false) {
            // $this->sendSMS($user->phone,"تم ارسال طلبك بنجاح");
        }


        $paymentData = [];
        $paymentData['name'] =  $user->full_name;
        $paymentData['phone'] =  $user->phone;
        $paymentData['phone_code'] =  $user->phone_code;
        $paymentData['amount'] =  $request->total_price;
        $paymentData['order_id'] =  $order['id'];
        $paymentData['type'] =  'order';


        $url = $this->index($paymentData);

        return response(['data'=>$order,'url'=>$url], 200);


    }//end

    /*======================= edit Order ============================*/
    public function edit_order(Request $request)
    {

        $rules = [
            'order_id' => 'required|integer',
            'user_id' => 'required|integer',
            'service_id' => 'required|integer',
            'place_id' => 'required|integer|exists:places,id',
            'sub_serv_id' => 'nullable|integer',
            'carSize_id' => 'required|integer',

            'day' => 'nullable',

            'brand_id' => 'required|integer',
            'carType_id' => 'required|integer',
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
            'total_tax' => 'required|numeric',
            'address' => 'nullable|string|min:1|max:191',
            'order_date' => 'required|date_format:Y-m-d',
            'order_time_id' => 'required|integer',
            'number_of_cars' => 'nullable|integer',
            'payment_method' => 'required|integer|in:1,2',
            'total_price' => 'required|numeric',
            'coupon_serial' => 'nullable',
        ];
        $validate = Validator::make($request->all(), $rules);

        $check = $this->check_if_Exceeds($request->order_date, $request->service_id);
        if ($check == 1) {
            return response(['status' => false, 'message' => 'The maximum number of requests for the selected service has been exceeded'], 402);

        }
        if ($validate->fails()) {

            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);
        }

        $order = Order::find($request->order_id);
        if (!$order) {
            return response(['status' => false, 'message' => 'this order not in DB'], 422);
        }
        $oldTotalPrice = Order::find($request->order_id)->total_price;

        if ($order->status != 0)
        {
            return response(['status' => false, 'message' => 'this order on stage'], 408);
        }
        //check user id
        $user = User::find($request->user_id);

        if (!$user) {
            return response(['status' => false, 'message' => 'this user not in DB'], 422);

        }

        //check service id

        $service = Service::find($request->service_id);

        if (!$service) {
            return response(['status' => false, 'message' => 'this service not in DB'], 422);
        }

        if ($service->level != 1) {
            return response(['status' => false, 'message' => 'this service not head service'], 422);

        }


        $service_sub = Service::find($request->sub_serv_id);


        //check carSize id

        $carSize = CarSize::find($request->carSize_id);

        if (!$carSize) {
            return response(['status' => false, 'message' => 'this car size not in DB'], 422);

        }

        //check carType id

        $carType = CarType::find($request->carType_id);

        if (!$carType) {
            return response(['status' => false, 'message' => 'this car Type not in DB'], 422);

        }
        $carBrand = CarType::where('id', $request->brand_id)->where('level', 2)->first();
        if (!$carBrand) {
            return response(['status' => false, 'message' => 'this Brand id not in DB'], 422);

        }

        if ($request->coupon_serial != null) {
            $coupon = Coupon::where('coupon_serial', $request->coupon_serial)
                ->where('is_active', 1)
                ->first();
            if (!$coupon) {

                return response(['status' => false, 'message' => 'this coupon not exists in DB '], 422);

            }
            $exist = CouponUser::where('coupon_id', $coupon->id)->where('user_id', $request->user_id)->first();

            if ($exist) {
                return response(['status' => false, 'message' => 'this user already using the coupon  '], 422);
            }
            $userCoupon = new CouponUser;
            $userCoupon->coupon_id = $coupon->id;
            $userCoupon->user_id = $request->user_id;
            $userCoupon->save();

        }
        //check order_time_id id


        if ($request->order_time_id != '')
        {
            $orderTimes = WorkTime::find($request->order_time_id);

            if (!$orderTimes) {
                return response(['status' => false, 'message' => 'this work Times not in DB'], 422);
            }
        }


        $order->delete();

        OrderSubscriptionDetails::where('order_id',$order->id)->delete();
        SubServiceOrder::where('order_id',$order->id)->delete();


        $order = new Order;

        $order->order_type = 1;
        $order->user_id = $request->user_id;
        $order->service_id = $request->service_id;
        $order->sub_service_id = $request->sub_serv_id;
        $order->size_id = $request->carSize_id;
        $order->type_id = $request->carType_id;
        $order->place_id = $request->place_id;
        //order_date

        //$order_date_=date("Y-m-d", $request->order_date);
        $order_date_ = strtotime($request->order_date);

        $order->order_date = $order_date_;
        $order->order_time_id = $request->order_time_id;
        $order->brand_id = $request->brand_id;
        $order->number_of_cars = $request->number_of_cars == null ? 1 : $request->number_of_cars;
        $order->payment_method = $request->payment_method;
        $order->status = 0;
        $order->total_price = $request->total_price;
        $order->total_tax = $request->total_tax;

        $order->longitude = $request->longitude;
        $order->latitude = $request->latitude;
        $order->address = $request->address == null ? null : $request->address;

        $save = $order->save();

        $firstDate = $request->day;

        if ($save) {
            if ($request->service_id == 77) {
                for ($x = 1; $x <= $service_sub->count; $x++) {
                    $plus = $x - 1;
                    if ($x == 1) {
                        $washDate = date('Y-m-d', strtotime("next saturday","{$order_date_}"));
                        $firstDate = $washDate;

                    } else {
                        $washDate = date('Y-m-d', strtotime("+ {$plus} weeks $firstDate"));
                    }

                    $order_subscription_details = [];
                    $order_subscription_details['number_of_wash'] = $x;
                    $order_subscription_details['order_id'] = $order->id;
                    $order_subscription_details['wash_date'] = $washDate;
                    $order_subscription_details['status'] = 'new';
                    OrderSubscriptionDetails::create($order_subscription_details);
                }
            }
        }


        if ($request->sub_services) {

            $rows = $request->sub_services;

            foreach ($rows as $order_sub) {
                $service_check = Service::find($order_sub['sub_service_id']);

                if (!$service_check) {
                    return response(['status' => false, 'message' => 'this Sub service  not in DB'], 422);

                }



                $order_sub_service_object = new SubServiceOrder();

                $order_sub_service_object->sub_service_id = $order_sub['sub_service_id'];
                $order_sub_service_object->order_id = $order->id;
                $order_sub_service_object->price = $order_sub['price'];

                $order_sub_service_object->save();

            }//end foreach

        }//

        $order = Order::where('id', $order->id)->first()->toArray();

        $user = User::find($order['user_id']);
        $service = Service::find($order['service_id']);
        $carSize = CarSize::find($order['size_id']);
        $carType = CarType::find($order['type_id']);
        $orderTimes = WorkTime::find($order['order_time_id']);

        //get user
        if ($user) {
            $order['user_full_name'] = $user->full_name;
            $order['user_image'] = $user->logo;

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


        if ($carType) {
            $order['carType_en_title'] = $carType->en_title;
            $order['carType__ar_title'] = $carType->ar_title;
            $order['carType__image'] = $carType->image;


        }
        if ($orderTimes) {
            $order['work_time_choosen'] = $orderTimes->work_times;

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

        //send sms
        $pos = $user->phone_code == '966' ? true : false;
        if ($pos != false) {
            // $this->sendSMS($user->phone,"تم ارسال طلبك بنجاح");
        }
        $row = Order::findOrFail($order['id']);

        $newTotalPrice = $order['total_price'];
        $url = '';
        if ($newTotalPrice > $oldTotalPrice)
        {
            $difference = $newTotalPrice - $oldTotalPrice;
            $paymentData = [];
            $paymentData['name'] =  $user->full_name;
            $paymentData['phone'] =  $user->phone;
            $paymentData['phone_code'] =  $user->phone_code;
            $paymentData['amount'] =  $difference;
            $paymentData['order_id'] =  $order['id'];
            $paymentData['type'] =  'order';
            $url = $this->index($paymentData);
        }else{
            $row->payment_status = 'yes';
            $row->save();
            $difference = $oldTotalPrice - $newTotalPrice;
            $where['user_id'] = $user->id;

            $wallet = Wallet::where($where);
            if ($wallet->count())
            {
                $wallet = $wallet->first();
                $wallet->value += $difference;
            }else{
                $wallet = new Wallet();
                $wallet->value = $difference;
                $wallet->user_id = $user->id;
            }
            $wallet->save();
        }




        return response(['data'=>$order,'url'=>$url], 200);


    }//end

    public function check_if_Exceeds($date, $service_id)
    {
        $check = 0;
        $date = strtotime($date);
        $setting = Setting::first();
        $serviceCount[0] = $setting->service1_counts;
        $serviceCount[1] = $setting->service2_counts;
        $orderOfMonth = MonthService::where('date', strtotime(date('Y-m', $date)))
            ->first();
        if ($orderOfMonth) {
            $serviceCount[0] = $orderOfMonth->service_1;
            $serviceCount[1] = $orderOfMonth->service_2;
        }
        $orderLimit = OrderLimit::where('date', $date)->first();
        if ($orderLimit) {
            $serviceCount[0] = $orderLimit->service_1;
            $serviceCount[1] = $orderLimit->service_2;
        }
        if ($service_id == 1) {
            $orders_count_in_day = Order::where('order_date', $date)
                ->where('service_id', 1)
                ->count();
            if ($orders_count_in_day >= $serviceCount[0]) {

                $check = 1;
            }

        }
        if ($service_id == 2) {
            $orders_count_in_day = Order::where('order_date', $date)
                ->where('service_id', 2)
                ->count();
            if ($orders_count_in_day >= $serviceCount[1]) {
                $check = 1;
            }

        }
        return $check;
    }


    /*======================= Add Order ============================*/


    /*======================= Rate Order ============================*/
    /**
     *  ============================================================
     *
     *  ------------------------------------------------------------
     *
     *  ============================================================
     */
    private function sendSMS($number, $message_text)
    {
        $user_name = env("SMS_USERNAME");// "creativeshare"; //  creativeshare
        $pass = env('SMS_PASSWORD');  //  Hyaadodo@1010
        $sender = env('SMS_SENDER');  //  MIZ-WORLD

        //$number       = "0539044145";
        //$message_text =  "";
        $date = date("Y-m-d", time());
        $time = date("h:i", time());

        $api_url = 'http://www.oursms.net/api/sendsms.php?';
        $api_url .= 'username=' . $user_name;
        $api_url .= '&password=' . $pass;
        $api_url .= '&numbers=' . $number;
        $api_url .= '&sender=' . $sender;
        $api_url .= '&unicode=E';
        $api_url .= '&return=full';
        $api_url .= '&message=' . urlencode($message_text) . "&";
        $crl = curl_init();
        curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($crl, CURLOPT_URL, $api_url);
        curl_setopt($crl, CURLOPT_TIMEOUT, 10);
        $reply = curl_exec($crl);
        if ($reply === false) {
            return 0;
        }
        //	curl_close($crl);
        return response($reply, 200);
        //return  $reply;
    }

    public function send_gift(Request $request)
    {
        $rules = [
            'user_id' => 'required|integer',
            'service_id' => 'required|integer',
            'place_id' => 'required|integer|exists:places,id',
            'sub_serv_id' => 'nullable|integer',
            'carSize_id' => 'required|integer',

            'sender_name' => 'required',
            'sender_phone' => 'required',

            'receiver_name' => 'required',
            'receiver_phone' => 'required',

            'brand_id' => 'required|integer',
            'carType_id' => 'required|integer',
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
            'address' => 'nullable|string|min:1|max:191',
            'order_date' => 'required|date_format:Y-m-d',
            'order_time_id' => 'required|integer',
            'number_of_cars' => 'nullable|integer',
            'payment_method' => 'required|integer|in:1,2',
            'total_price' => 'required|numeric',
            'total_tax' => 'required|numeric',
            'coupon_serial' => 'nullable',
        ];
        $validate = Validator::make($request->all(), $rules);

        $check = $this->check_if_Exceeds($request->order_date, $request->service_id);
        if ($check == 1) {
            return response(['status' => false, 'message' => 'The maximum number of requests for the selected service has been exceeded'], 402);

        }
        if ($validate->fails()) {

            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);

        }
        //check user id
        $user = User::where('phone', $request->receiver_phone)->first();

        $service = Service::findOrfail($request->service_id)->ar_title;
        $senderNumber = $request->sender_phone;
        $senderName = $request->sender_name;
        $receiverPhone = $request->receiver_phone;
        $link = "https://washsquadsa.com/";
        if (!$user) {
            $password = (int)(strtotime(date('Y-m-d H:i:s')) / 2);
            $user = new User();
            $user->phone = $request->receiver_phone;
            $user->full_name = $request->receiver_name;
            $user->user_type = 1;
            $user->is_active = 1;
            $user->is_login = 0;
            $user->phone_code = 966;
            $user->password = Hash::make($password);
            $user->full_name = $request->receiver_name;
            $user->save();

            $message = "تهانينا! لقد تلقيت هدية ({$service}) من {$senderName} رقم جوالة {$senderNumber} على رقمك الخاص بك {$receiverPhone} وكلمة المرور هى {$password} - للحصول على الهدية إضغط هنا {$link} .";
//            $message = "تهانينا! لقد تلقيت هدية $service من $senderName رقم جوالة $senderNumber على رقمك الخاص بك $receiverPhone وكلمة المرور هى $password - للحصول على الهدية إضغط هنا $link .";

        } else {
            $message = "تهانينا! لقد تلقيت هدية ({$service}) من {$senderName} رقم جوالة {$senderNumber} على رقمك الخاص بك {$receiverPhone} - للحصول على الهدية إضغط هنا {$link} .";
        }

        //check service id

        $service = Service::find($request->service_id);

        if (!$service) {
            return response(['status' => false, 'message' => 'this service not in DB'], 422);

        }

        if ($service->level != 1) {
            return response(['status' => false, 'message' => 'this service not head service'], 422);

        }


        $service_sub = Service::find($request->sub_serv_id);


        //check carSize id

        $carSize = CarSize::find($request->carSize_id);

        if (!$carSize) {
            return response(['status' => false, 'message' => 'this car size not in DB'], 422);

        }

        //check carType id

        $carType = CarType::find($request->carType_id);

        if (!$carType) {
            return response(['status' => false, 'message' => 'this car Type not in DB'], 422);

        }
        $carBrand = CarType::where('id', $request->brand_id)->where('level', 2)->first();
        if (!$carBrand) {
            return response(['status' => false, 'message' => 'this Brand id not in DB'], 422);

        }

        if ($request->coupon_serial != null) {
            $coupon = Coupon::where('coupon_serial', $request->coupon_serial)
                ->where('is_active', 1)
                ->first();
            if (!$coupon) {

                return response(['status' => false, 'message' => 'this coupon not exists in DB '], 422);

            }
            $exist = CouponUser::where('coupon_id', $coupon->id)->where('user_id', $request->user_id)->first();

            if ($exist) {
                return response(['status' => false, 'message' => 'this user already using the coupon  '], 422);
            }
            $userCoupon = new CouponUser;
            $userCoupon->coupon_id = $coupon->id;
            $userCoupon->user_id = $request->user_id;
            $userCoupon->save();

        }
        //check order_time_id id


        $orderTimes = WorkTime::find($request->order_time_id);

        if (!$orderTimes) {
            return response(['status' => false, 'message' => 'this work Times not in DB'], 422);

        }


        $order = new Order;

        $order->order_type = 1;
        $order->user_id = $user->id;
        $order->service_id = $request->service_id;
        $order->sub_service_id = $request->sub_serv_id;
        $order->size_id = $request->carSize_id;
        $order->type_id = $request->carType_id;
        $order->place_id = $request->place_id;

        //order_date

        //$order_date_=date("Y-m-d", $request->order_date);
        $order_date_ = strtotime($request->order_date);

        $order->order_date = $order_date_;
        $order->order_time_id = $request->order_time_id;
        $order->brand_id = $request->brand_id;
        $order->number_of_cars = $request->number_of_cars == null ? 1 : $request->number_of_cars;
        $order->payment_method = $request->payment_method;
        $order->status = 0;
        $order->total_price = $request->total_price;
        $order->total_tax = $request->total_tax;

        $order->longitude = $request->longitude;
        $order->latitude = $request->latitude;
        $order->address = $request->address == null ? null : $request->address;

        $save = $order->save();


        if ($request->sub_services) {

            $rows = $request->sub_services;

            foreach ($rows as $order_sub) {
                $service_check = Service::find($order_sub['sub_service_id']);

                if (!$service_check) {
                    return response(['status' => false, 'message' => 'this Sub service  not in DB'], 422);

                }

                $order_sub_service_object = new SubServiceOrder();

                $order_sub_service_object->sub_service_id = $order_sub['sub_service_id'];
                $order_sub_service_object->order_id = $order->id;
                $order_sub_service_object->price = $order_sub['price'];

                $order_sub_service_object->save();

            }//end foreach

        }//

        $order = Order::where('id', $order->id)->first()->toArray();

        $user = User::find($order['user_id']);
        $service = Service::find($order['service_id']);
        $carSize = CarSize::find($order['size_id']);
        $carType = CarType::find($order['type_id']);
        $orderTimes = WorkTime::find($order['order_time_id']);

        //get user
        if ($user) {
            $order['user_full_name'] = $user->full_name;
            $order['user_image'] = $user->logo;

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


        if ($carType) {
            $order['carType_en_title'] = $carType->en_title;
            $order['carType__ar_title'] = $carType->ar_title;
            $order['carType__image'] = $carType->image;


        }
        if ($orderTimes) {
            $order['work_time_choosen'] = $orderTimes->work_times;

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

        //send sms
//        $pos = $user->phone_code == '966' ? true : false;
//        if ($pos != false) {
        $this->sendSMS($receiverPhone, $message);
//        }
        $paymentData = [];
        $paymentData['name'] =  $user->full_name;
        $paymentData['phone'] =  $user->phone;
        $paymentData['phone_code'] =  $user->phone_code;
        $paymentData['amount'] =  $request->total_price;
        $paymentData['order_id'] =  $order['id'];
        $paymentData['type'] =  'gift';

        $url = $this->index($paymentData);

        return response(['data'=>$order,'url'=>$url], 200);

    }//end fun
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update_subscription(Request $request){
        $rules = [
            'subscription_id' => 'required|exists:order_subscription_details,id',
            'status' => ['required','string',Rule::in( 'done', 'wait')],
        ];


        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);
        }


        $data['status'] = $request->status;
        $find = OrderSubscriptionDetails::findOrFail($request->subscription_id);
        if (in_array($find->status,['done'])){
            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => ['status'=>['you can`t wait again']]], 422);
        }

        if ($find->time_dealy >= Setting::first()->delay_order_sub_limit ??1){
            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => ['status'=>['you can`t wait again']]], 423);
        }

//        if (in_array($find->status,['wait','done']) && $request->status == 'wait'){
//            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => ['status'=>['you can`t wait again']]], 422);
//        }
        $washDate = $find->will_wash_date != null?$find->will_wash_date:$find->wash_date;

        if ($request->status == 'wait'){
            $data['will_wash_date'] = date('Y-m-d', strtotime("+7 days $washDate"));
        }

        $data['time_dealy'] = $find->time_dealy + 1;

        $find->update($data);
//        return $find;

        $getAnotherSub = OrderSubscriptionDetails::where('order_id',$find->order_id)
            ->where('status','!=','done')
            ->where('id','>',$find->id)->get();
        foreach ($getAnotherSub as $oneSub)
        {
            $newUpdateSub = [];
            $washDate = $oneSub->will_wash_date != null?$oneSub->will_wash_date:$oneSub->wash_date;
            $newUpdateSub['wash_date'] = date('Y-m-d',strtotime('+7 days'.$washDate));
            $oneSub->update($newUpdateSub);
        }

        return response($find, 200);
    }//end fun
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|void
     */
    public function getSubscription(Request $request){
        $rules = [
            'user_id' => 'required|exists:users,id',
        ];
        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);
        }

        $order = Order::wherehas('still_wash_sub')
            ->where('status','!=',3)
            ->where('user_id',$request->user_id)->with('wash_sub')->first();

        if ($order)
        return response($order, 200);

        return response($order, 201);
    }//end fun
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function backFromPay(Request $request)
    {
        return redirect($this->get_details_of_payment($request->tap_id));
    }//end fun


}//end
