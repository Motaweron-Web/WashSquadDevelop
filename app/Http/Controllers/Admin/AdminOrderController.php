<?php

namespace App\Http\Controllers\Admin;

use App\Models\CarSize;
use App\Models\CarType;
use App\Models\DailyOrderLimit;
use App\Models\DailyOrderLimitData;
use App\Models\DateTime;
use App\Models\MonthService;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderLimit;
use App\Models\Place;
use App\Models\Service;
use App\Models\Setting;
use App\Models\SubServiceOrder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AdminOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        //////////////////////////// for calender ////////////////////////////
        $month = date('m', strtotime($request->month ?? date('Y-m')));
        $year = date('Y', strtotime($request->month ?? date('Y-m')));

        $number_of_day = date('t', mktime(0, 0, 0, $month, 1, $year));

        $start_day = date('w', strtotime($year . '-' . $month . '-01')) + 1;

        $prev_year = date('Y', strtotime('-1 year', strtotime($year . '-' . $month . '-01')));
        $prev_month = date('m', strtotime('-1 month', strtotime($year . '-' . $month . '-01')));
        $next_year = date('Y', strtotime('+1 year', strtotime($year . '-' . $month . '-01')));
        $next_month = date('m', strtotime('+1 month', strtotime($year . '-' . $month . '-01')));

        ///////////////////////////////// end calender //////////////////////////

        return view('admin.orders.index', compact('start_day',
            'number_of_day', 'prev_year', 'prev_month', 'next_year', 'next_month', 'year', 'month', 'request'));
    }//end fun

    /**
     * @param Request $request
     * @return void
     */
    public function anotherMonth(Request $request)
    {
        //////////////////////////// for calender ////////////////////////////
        $month = date('m', strtotime($request->month ?? date('Y-m')));
        $year = date('Y', strtotime($request->month ?? date('Y-m')));

        $number_of_day = date('t', mktime(0, 0, 0, $month, 1, $year));

        $start_day = date('w', strtotime($year . '-' . $month . '-01')) + 1;

        $prev_year = date('Y', strtotime('-1 year', strtotime($year . '-' . $month . '-01')));
        $prev_month = date('m', strtotime('-1 month', strtotime($year . '-' . $month . '-01')));
        $next_year = date('Y', strtotime('+1 year', strtotime($year . '-' . $month . '-01')));
        $next_month = date('m', strtotime('+1 month', strtotime($year . '-' . $month . '-01')));

        ///////////////////////////////// end calender //////////////////////////

        $html = view('admin.orders.parts.anotherMonth', compact('start_day',
            'number_of_day', 'prev_year', 'prev_month', 'next_year', 'next_month', 'year', 'month', 'request'));
        return response(['html' => "$html", 'status' => 200]);
    }//end fun

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $places = Place::latest()->get();
        $carTypes = CarType::with('sub_types')->where('level', 1)->get();
        $services = Service::where('level', 1)->get();
        $array = compact('places', 'carTypes', 'services');
        return view('admin.orders.crud.create', compact('places', 'carTypes', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required|numeric|digits_between:1,20',//
            'full_name' => 'required|string|max:190',//
            'service_id' => 'required|integer|exists:services,id',//
            'sub_service_id' => 'nullable|integer|exists:services,id',//
            'type_id' => 'required|integer|exists:car_types,id',//
            'place_id' => 'required|integer|exists:places,id',//
            'sub_type_id' => 'required|integer|exists:car_types,id',//
            // 'package_id'=>'required|integer',//
            'order_date' => 'required',//
            //'addons'=>'nullable|string|max:190',//
            'order_time_id' => 'required|integer|exists:car_types,id',//
            'number_of_cars' => 'required|integer',//
            'payment_method' => 'required|integer|in:2,3',//
            'price_total' => 'required',
            'order_time' => 'required'
        ]);

        //check order time
        $is_date_time_active = DateTime::where('date', $request->order_date)->where('time_id', $request->order_time_id)->first();
        if ($is_date_time_active) {
            if ($is_date_time_active->status == 2) {
                return response(['errors' => ['active time' => ['هذا الوقت غير متاح']], 'message' => 'The given data was invalid.'], 423);
            }
        }

        $check = $this->check_if_Exceeds($request->order_date, $request->order_time, $request->service_id, $request->place_id);
        if ($check['check']) {
            return response(['errors' => ['error' => [$check['message']]], 'message' => 'that is ann errors'], 422);
        }

        //get user id
        $user_id = 0;
        // 1- check if the phone exists
        $user = User::where('phone', $request->phone)->first();
        if ($user) {
            $user_id = $user->id;
        }
        if (!$user) {
            $user = new User();
            $user->phone_code = '966';
            $user->phone = $request->phone;
            $user->full_name = $request->full_name;
            $user->user_type = 1;
            $user->is_marketer_add = 2;
            $user->save();
            $user_id = $user->id;
        }
        $order = new Order;
        //get Size
        $size = CarType::find($request->sub_type_id);
        $order->size_id = $size->size;
        $order->sub_type_id = $request->sub_type_id;
        $order->order_type = 3;
        $order->user_id = $user_id;
        $order->date = $request->order_date;
        $order->place_id = $request->place_id;
        $order->employee_id = 0;
        $order->service_id = $request->service_id;
        $order->type_id = $request->type_id;
        $order->brand_id = $request->sub_type_id;
        $order->sub_service_id = $request->sub_service_id;
        $order->neighborhood = $request->neighborhood;
        // $order->package_id=$request->package_id;
        $order->order_date = strtotime($request->order_date);
        $order->order_time = $request->order_time;
        $order->order_time_id = $request->order_time_id;
        $order->number_of_cars = $request->number_of_cars == null ? 1 : $request->number_of_cars;
        $order->payment_method = $request->payment_method;
        //  $order->addons=$request->addons;
        $order->status = -1;
        //Sun Total price order
        $save = $order->save();
        $value_total = 0;
        if ($request->sub_sun_services) {
            foreach ($request->sub_sun_services as $sub_sun_service) {
                //get
                $sub_service_level3 = Service::find($sub_sun_service);
                if ($sub_service_level3) {
                    $sub_order = new SubServiceOrder();
                    $sub_order->order_id = $order->id;
                    $sub_order->sub_service_id = $sub_sun_service;
                    $sub_order->price = $sub_service_level3->price;
                    $sub_order->save();
                    $value_total += $sub_order->price;
                }
            }
        }
        //حساب التكلفة
        $service = Service::find($request->service_id);
        $carSize = CarSize::find($size->size);
        /*$total_price=$service->price+$carSize->price+$value_total;*/
        $order->total_price = $request->price_total;
        $order->save();
        //create the sms link
        // link/sms/order/$order_id
        $textSMS = "تطبيق ووش اسكواد ادخل لتحديد موقعك ";
        $textSMS .= url("link/sms/order") . "/" . $order->id;
        $this->sendSMS($user->phone, $textSMS);

        return response(['status' => 200, 'message' => 'تم حفظ الطلب بنجاح', 'date' => $request->order_date]);

    }//end fun

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($date)
    {
        $orders = Order::where('date', $date)
            ->with('service_basic', 'user', 'sub_service', 'type', 'sub_type')->orderBy('service_id', 'DESC')
            ->get();
        $drivers = User::where('user_type', 2)->where('is_active', 1)->get();
        $html = view('admin.orders.parts.tableDate', compact('orders', 'drivers'));
        session()->put('activeDate', $date);
        return response(['html' => "$html"]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $places = Place::latest()->get();
        $carTypes = CarType::with('sub_types')->where('level', 1)->get();
        $services = Service::where('level', 1)->get();
        $array = compact('places', 'carTypes', 'services');
        $order = Order::with('user', 'type.sub_types')->findOrFail($id);
        return view('admin.orders.crud.edit', compact('places', 'order', 'carTypes', 'services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'phone' => 'required|numeric|digits_between:1,20',//
            'full_name' => 'required|string|max:190',//
            'service_id' => 'required|integer|exists:services,id',//
            'sub_service_id' => 'nullable|integer|exists:services,id',//
            'type_id' => 'required|integer|exists:car_types,id',//
            'place_id' => 'required|integer|exists:places,id',//
            'sub_type_id' => 'required|integer|exists:car_types,id',//
            // 'package_id'=>'required|integer',//
            'order_date' => 'required',//
            //'addons'=>'nullable|string|max:190',//
            'order_time_id' => 'required|integer|exists:car_types,id',//
            'number_of_cars' => 'required|integer',//
            'payment_method' => 'required|integer|in:2,3',//
            'price_total' => 'required',
            'order_time' => 'required'
        ]);

        //check order time
        $is_date_time_active = DateTime::where('date', $request->order_date)->where('time_id', $request->order_time_id)->first();
        if ($is_date_time_active) {
            if ($is_date_time_active->status == 2) {
                return response(['errors' => ['active time' => ['هذا الوقت غير متاح']], 'message' => 'The given data was invalid.'], 423);
            }
        }

        $check = $this->check_if_Exceeds($request->order_date, $request->order_time, $request->service_id, $request->place_id);
        if ($check['check']) {
            return response(['errors' => ['error' => [$check['message']]], 'message' => 'that is ann errors'], 422);
        }

        //get user id
        $user_id = 0;
        // 1- check if the phone exists
        $user = User::where('phone', $request->phone)->first();
        if ($user) {
            $user_id = $user->id;
        }
        if (!$user) {
            $user = new User();
            $user->phone_code = '966';
            $user->phone = $request->phone;
            $user->full_name = $request->full_name;
            $user->user_type = 1;
            $user->is_marketer_add = 1;
            $user->save();
            $user_id = $user->id;
        }

        $order = Order::findOrFail($id);
        //get Size
        $size = CarType::find($request->sub_type_id);
        $order->size_id = $size->size;
        $order->place_id = $size->place_id;
        $order->sub_type_id = $size->sub_type_id;
        $order->order_type = 3;
        $order->user_id = $user_id;
        $order->employee_id = 0;
        $order->service_id = $request->service_id;
        $order->type_id = $request->type_id;
        $order->neighborhood = $request->neighborhood;
        $order->brand_id = $request->sub_type_id;
        $order->sub_service_id = $request->sub_service_id;
        // $order->package_id=$request->package_id;
        $order->order_date = strtotime($request->order_date);
        $order->order_time = $request->order_time;
        $order->order_time_id = $request->order_time_id;
        $order->number_of_cars = $request->number_of_cars == null ? 1 : $request->number_of_cars;
        $order->payment_method = $request->payment_method;
        //  $order->addons=$request->addons;
        /* $order->status = -1;*/
        //Sun Total price order
        $save = $order->save();
        $value_total = 0;
        if ($request->sub_sun_services) {
            foreach ($request->sub_sun_services as $sub_sun_service) {
                //get
                $sub_service_level3 = Service::find($sub_sun_service);
                if ($sub_service_level3) {
                    $sub_order = new SubServiceOrder();
                    $sub_order->order_id = $order->id;
                    $sub_order->sub_service_id = $sub_sun_service;
                    $sub_order->price = $sub_service_level3->price;
                    $sub_order->save();
                    $value_total += $sub_order->price;
                }
            }
        }
        //حساب التكلفة
        $service = Service::find($request->service_id);
        $carSize = CarSize::find($size->size);
        /*$total_price=$service->price+$carSize->price+$value_total;*/
        $order->total_price = $request->price_total;
        $order->save();
        return response(['status' => 200, 'message' => 'تم تعديل الطلب بنجاح', 'date' => $request->order_date], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $find = Order::findOrFail($id);
        Order::destroy($id);
        return response(['status' => true, 'message' => 'تم حذف الطلب بنجاح', 'date' => $find->date], 200);
    }//end fun

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function insertDriver(Request $request)
    {
        $request->validate([
            'driver_id' => ['required', Rule::exists('users', 'id')->where('user_type', 2)],
            'order_id' => 'required|exists:orders,id',
        ]);
        $order = Order::find($request->order_id);
        if ($order->status != 0 && $order->status != 1) {
            return response(0, 200);
        }
        $driver = User::find($request->driver_id);
        //
        $order->driver_id = $driver->id;
        $order->distributor_employee_id = 0;
        $order->status = 1;
        $order->save();
        //notification
        $s = Carbon::now();
        $date = strtotime($s);
        $notification = new Notification();
        $notification->from_id = 0;
        $notification->to_id = $order['driver_id'];
        $notification->notification_type = 1;
        $notification->action_type = 0;
        $notification->status = 1;
        $notification->notification_date = $date;
        $notification->order_id = $order['id'];
        $notification->notification_name = 1;
        $notification->save();
        //sms
        $user = User::find($order->user_id);
        $order->message_key = 'new_order';
//        $this->sendFCMNotification([$driver->id,$order->user_id],'',$order);

        $pos = $user->phone_code == '966' ? true : false;
        if ($pos != false) {
            // $this->sendSMS($user->phone, "تم تعيين سائق لتنفيذ طلبك");
        }
        return response(['status' => 'success']);
    }//end fun

    /**
     * @param $date
     * @param $service_id
     * @return int
     */
    public function check_if_Exceeds($date, $time, $service_id, $place_id)
    {
        $date = strtotime($date);
        $setting = Setting::first();
        $data['message'] = '';
        $data['check'] = 0;
        //  dd($orderOfMonth);

        $orders_count_in_day = Order::where('order_date', $date)
            ->where('service_id', $service_id)
            ->where('place_id', $place_id)
            ->count();
        $serviceCount = DailyOrderLimitData::where('service_id', $service_id)
            ->where('place_id', $place_id)
            ->with('daily_order_limit')
            ->wherehas('daily_order_limit', function ($q) use ($date,$time) {
                $q->whereDate('date', date('Y-m-d', $date))
                ->where('from', '<=', $time.':00')
                ->where('to', '>=', $time.':00');
            })->first();
        if ($serviceCount) {
            if ($orders_count_in_day >= $serviceCount->count ?? 0) {
                $data['message'] = 'لقد تم تجاوز الحد الاقصى من الطلبات لهذه الخدمة';
                $data['check'] = 1;
            }
        }


        return $data;
    }//end fun

    /**
     * @param $date
     * @param $service_id
     * @return int
     */
    public function check_if_Exceeds_Old($date, $service_id)
    {
        $date = strtotime($date);
        $setting = Setting::first();
        $serviceCount[0] = $setting->service1_counts;
        $serviceCount[1] = $setting->service2_counts;
        $orderLimit = OrderLimit::where('date', $date)->first();
        $orderOfMonth = MonthService::where('date', strtotime(date('Y-m', $date)))
            ->first();
        $data['message'] = '';
        $data['check'] = 0;
        //  dd($orderOfMonth);
        if ($orderOfMonth) {
            $serviceCount[0] = $orderOfMonth->service_1;
            $serviceCount[1] = $orderOfMonth->service_2;
        }
        if ($orderLimit) {
            $serviceCount[0] = $orderLimit->service_1;
            $serviceCount[1] = $orderLimit->service_2;
        }
        if ($service_id == 1) {
            $orders_count_in_day = Order::where('order_date', $date)
                ->where('service_id', 1)
                ->count();
            if ($orders_count_in_day >= $serviceCount[0]) {
                $data['message'] = 'لقد تم تجاوز الحد الاقصى من الطلبات لهذه الخدمة';
                $data['check'] = 1;
            }
        }
        if ($service_id == 2) {
            $orders_count_in_day = Order::where('order_date', $date)
                ->where('service_id', 2)
                ->count();
            if ($orders_count_in_day >= $serviceCount[1]) {
                $data['message'] = 'لقد تم تجاوز الحد الاقصى من الطلبات لهذه الخدمة';
                $data['check'] = 1;
            }
        }

        return $data;
    }//end fun

    /**
     * @param $number
     * @param $message_text
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|int
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
    }//end fun

    /**
     * @param $number
     * @param $message_text
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|int
     */
    public function dailyOrder(Request $request)
    {
        $places = Place::all();
        $services = Service::where('level', 1)->get();
        return view('admin.orders.daily_order.create', compact('places', 'services'));
    }//end fun

    public function dailyOrderSave(Request $request)
    {
        $currentDate = date("Y-m-d");
        $request->validate([
            'date' => 'required|unique:daily_order_limit|after:yesterday',
            'from' => 'required',
            'to' => 'required',
            'place_id' => 'required|array',
        ], [
            'date.after' => "يجب إدخال تاريخ يبدأ من اليوم {$currentDate}",
            'place_id.required' => "يجب إختيار المناطق"
        ]);
        $data = $request->all();

        $create = DailyOrderLimit::create($request->only('date', 'from', 'to'));

        foreach ($request->place_id as $place_id) {
            foreach ($data['count_' . $place_id] as $key => $count) {
                $smallSave = [];
                $smallSave['place_id'] = $place_id;
                $smallSave['daily_order_limit_id'] = $create->id;
                $smallSave['service_id'] = $key;
                $smallSave['count'] = $count;
                DailyOrderLimitData::create($smallSave);
            }
        }
        return response(['status' => 200, 'message' => 'تم الحفظ بنجاح']);
    }//end fun

    public function showInformation($id)
    {
        $places = Place::latest()->get();
        $carTypes = CarType::with('sub_types')->where('level', 1)->get();
        $services = Service::where('level', 1)->get();
        $array = compact('places', 'carTypes', 'services');
        $order = Order::with('user', 'type.sub_types')->findOrFail($id);
        return view('admin.orders.crud.show', compact('places', 'order', 'carTypes', 'services'));
    }//end fun


}//end class
