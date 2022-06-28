<?php
namespace App\Http\Controllers\Api;
use App\CancelReason;
use App\CarSize;
use App\CarType;
use App\Coupon;
use App\CouponUser;
use App\Place;
use App\PlaceDay;
use App\DateTime;
use App\Offer;
use App\Order;
use App\OrderImage;
use App\Question;
use App\Service;
use App\User;
use App\WorkTime;
use App\Price;
use function Couchbase\defaultDecoder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
class HelperController extends Controller
{
    /*================ All Services ======================*/
    public function services()
    {
        $services = Service::where('level', 1)->get();
        if ($services->count() < 0) {
            return response('no services ', 404);
        }//end
        $j = 0;
        foreach ($services as $service) {
            $services_suns = Service::where('level', 2)->where('parent_id', $service->id)->get();
            $i = 0;
            foreach ($services_suns as $services_sun) {
                $services_sun_suns = Service::where('level', 3)->where('parent_id', $services_sun->id)->get();
                $services_suns[$i]['level3'] = $services_sun_suns;
                $i++;
            }//end
            $services[$j]['level2'] = $services_suns;
            $j++;
        }//end foreach
        return response(['data' => $services], 200);
    }//end function
    /*================ End All Services ==================*/
    /*================  Special Service ==================*/
    public function single_service(Request $request)
    {
        $rules = [
            'service_id' => 'required',
        ];
        $validate = Validator::make(request()->all(), $rules);
        if ($validate->fails()) {
            return response(['message' => 'this is the all errors', 'errors' => $validate->messages()], 422);
        }
        $service = Service::find($request->service_id);
        if (!$service) {
            return response(['status' => false, 'message' => 'this Service not in DB'], 422);
        }
        if ($service->level == 1) {
            $services_suns = Service::where('level', 2)->where('parent_id', $service->id)->get();
            $i = 0;
            foreach ($services_suns as $services_sun) {
                $services_sun_suns = Service::where('level', 3)->where('parent_id', $services_sun->id)->get();
                $services_suns[$i]['level3'] = $services_sun_suns;
                $i++;
            }//end
            $service['level2'] = $services_suns;
            return response(['data' => $service], 200);
        }//end if level 1
        if ($service->level == 2) {
            $i = 0;
            $services_suns = Service::where('level', 3)->where('parent_id', $service->id)->get();
            foreach ($services_suns as $services_sun) {
                $services_suns[$i] = $services_sun;
                $i++;
            }//end
            $service['level3'] = $services_suns;
            return response(['data' => $service], 200);
        }
        if ($service->level == 3) {
            return response(['data' => $service], 200);
        }
    }//end function
    /*================  Special Service ==================*/
    /*================ StartCar Sizes ==================*/
    public function carSizes()
    {
        $carSizes = CarSize::get();
        if ($carSizes->count() < 0) {
            return response('no Car Sizes ', 404);
        }//end
        return response(['data' => $carSizes], 200);
    }//end
    /*================End Car Sizes ==================*/
    /*================ StartCar Types ==================*/
    public function carTypes()
    {
        $carTypes = CarType::where('level', 1)->get();
        if ($carTypes->count() < 0) {
            return response('no carTypes ', 404);
        }//end
        $j = 0;
        $i = 0;
        foreach ($carTypes as $carType) {
            $i = 0;
            $carType_suns = CarType::where('level', 2)->where('parent_id', $carType->id)->get();
            //  dd($carType_suns);
            foreach ($carType_suns as $carType_sun) {
                $car_size = CarSize::find($carType_sun->size);
                // dd($carType_sun);
                $carType_suns[$i]->size_en_title = $car_size->en_title;
                $carType_suns[$i]->size_ar_title = $car_size->ar_title;
                $carType_suns[$i]->size_price = $car_size->price;
                $carType_suns[$i]->size_image = $car_size->image;
                $i++;
            }
            $carTypes[$j]['level2'] = $carType_suns;
            $j++;
        }//end foreach
        return response(['data' => $carTypes], 200);
    }//end
    /*================End Car Types ==================*/
    /*================single Car Type ==================*/
    public function single_car_type(Request $request)
    {
        $rules = [
            'car_type_id' => 'required',
        ];
        $validate = Validator::make(request()->all(), $rules);
        if ($validate->fails()) {
            return response(['message' => 'this is the all errors', 'errors' => $validate->messages()], 422);
        }
        $car_type = CarType::find($request->car_type_id);
        if (!$car_type) {
            return response(['status' => false, 'message' => 'this car type not in DB'], 422);
        }
        if ($car_type->level == 1) {
            $i = 0;
            $carType_suns = CarType::where('level', 2)->where('parent_id', $car_type->id)->get();
            //  dd($carType_suns);
            foreach ($carType_suns as $carType_sun) {
                $car_size = CarSize::find($carType_sun->size);
                // dd($carType_sun);
                $carType_suns[$i]->size_en_title = $car_size->en_title;
                $carType_suns[$i]->size_ar_title = $car_size->ar_title;
                $carType_suns[$i]->size_price = $car_size->price;
                $carType_suns[$i]->size_image = $car_size->image;
                $i++;
            }
            $car_type['level2'] = $carType_suns;
        }//end if level 1
        if ($car_type->level == 2) {
            $car_type['level2'] = [];
        }
        return response($car_type, 200);
    }//end function
    /*================single Car Type ==================*/
    /*================ cancel Reasons  ==================*/
    public function cancelReasons()
    {
        $cancelReasons = CancelReason::get();
        if ($cancelReasons->count() < 0) {
            return response('no cancel Reasons ', 404);
        }//end
        return response(['data' => $cancelReasons], 200);
    }//end
    /*================End cancel Reasons ==================*/
    /*================ offers  ==================*/
    public function offers()
    {
        $offers = Offer::get();
        if ($offers->count() < 0) {
            return response('no offers ', 404);
        }//end
        return response(['data' => $offers], 200);
    }//end
    /*================End offers ==================*/
    /*================ Questions  ==================*/
    public function questions()
    {
        $questions = Question::get();
        if ($questions->count() < 0) {
            return response('no questions ', 404);
        }//end
        return response(['data' => $questions], 200);
    }//end
    /*================End Questions ==================*/
    /*================ workTimes  ==================*/
    public function workTimes()
    {
        $workTimes = WorkTime::where('id', '!=', 27)->get();
        if ($workTimes->count() < 0) {
            return response('no workTimes ', 404);
        }//end
        return response(['data' => $workTimes], 200);
    }//end
    /*================End workTimes ==================*/
    /*============================Get Single Client User=====================*/
    public function get_client_or_driver_user(Request $request)
    {
        if (!$request->user_id) {
            return response(['status' => false, 'message' => 'user id is required'], 422);
        }
        $user = User::find($request->user_id);
        if (!$user) {
            return response(['status' => false, 'message' => 'this user id not exists in DB '], 422);
        }
        if ($user->user_type !== 1 && $user->user_type !== 2) {
            return response(['status' => false, 'message' => 'this user id not client or driver in DB '], 422);
        }
        // all orders
        // $orders=Order::where('user_id',$request->user_id)->with('order_details')->get();
        return response($user, 200);
    }//end
    /*============================Get Single User=====================*/
    /*========================get date times========================*/
    public function get_date_times(Request $request)
    {
        $rules = [
            'date' => 'required|date_format:"Y-m-d"',
        ];
        $validate = Validator::make(request()->all(), $rules, ['digits_between' => 'the phone number must be number and no + in it']);
        if ($validate->fails()) {
            return response(['message' => 'this is the all errors', 'errors' => $validate->messages()], 422);
        }
        $date_times = DateTime::where('date', $request->date)->get();
        if ($date_times->count() == 0) {
            $workTimes = WorkTime::where("is_deleted", 0)->get();
            if ($workTimes->count() < 0) {
                return response('no workTimes ', 404);
            }//end
            $workTimes = $workTimes->toArray();
            $i = 0;
            foreach ($workTimes as $workTime) {
                $workTimes[$i]['status_en'] = 'active';
                $workTimes[$i]['status_ar'] = 'نشط';
                $i++;
            }
            return response(['data' => $workTimes], 200);
        }
        $date_times = $date_times->toArray();
        $i = 0;
        foreach ($date_times as $date_time) {
            $time = WorkTime::find($date_time['time_id']);
            if ($time) {
                $date_times[$i] = $time;
            }
            if ($date_time['status'] == 1) {
                $date_times[$i]['status_en'] = 'active';
                $date_times[$i]['status_ar'] = 'نشط';
            }
            if ($date_time['status'] == 0) {
                $date_times[$i]['status_en'] = 'not-active';
                $date_times[$i]['status_ar'] = 'غير نشط';
            }
            $i++;
        }
        return response(['data' => $date_times], 200);
    }//end
    /*========================get date times========================*/
    /*========================get Coupons========================*/
    public function coupons(Request $request)
    {
        $coupons = Coupon::get();
        if ($coupons->count() < 0) {
            return response('no Coupones ', 404);
        }//end
        return response(['data' => $coupons], 200);
    }//end
    public function check_coupon(Request $request)
    {
        if (!$request->user_id) {
            return response(['status' => false, 'message' => 'user id is required'], 422);
        }
        $user = User::find($request->user_id);
        if (!$user) {
            return response(['status' => false, 'message' => 'this user id not exists in DB '], 422);
        }
        if (!$request->coupon_serial) {
            return response(['status' => false, 'message' => 'coupon serial is required'], 422);
        }
        $coupon = Coupon::where('coupon_serial', $request->coupon_serial)->first();
        if (!$coupon) {
            return response(['status' => false, 'message' => 'this coupon not exists in DB '], 422);
        }
        if ($coupon->is_active == 0) {
            return response(['status' => false, 'message' => 'this coupon not active '], 422);
        }
        $exist = CouponUser::where('coupon_id', $coupon->id)->where('user_id', $request->user_id)->first();
        if ($exist) {
            return response(['status' => false, 'message' => 'this user already using the coupon  '], 402);
        }
        return response($coupon, 200);
    }//end
    /*========================get Coupons========================*/
    /*========================get All Images of Orders========================*/
    public function get_images_by_status(Request $request)
    {
        $rules = [
            'order_id' => 'required|integer',
            'status' => 'required|integer|in:1,2'
        ];
        $validate = Validator::make(request()->all(), $rules);
        if ($validate->fails()) {
            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);
        }//end validation
        $order = Order::find($request->order_id);
        if (!$order) {
            return response(['status' => false, 'message' => 'this order not in DB'], 422);
        }//end
        $order_images = OrderImage::where('order_id', $order->id)->where('status', $request->status)->get();
        return response(['data' => $order_images], 200);
    }//end
    /*========================get All Images of Orders========================*/
    /*=========================Get Price======================================*/
    public function getPrice(Request $request)
    {
        $rules = [
            'service_id' => 'required',
            'size_id' => 'required',
        ];
        $validate = Validator::make(request()->all(), $rules);
        if ($validate->fails()) {
            return response(['message' => 'this is the all errors', 'errors' => $validate->messages()], 422);
        }
        $service = Service::find($request->service_id);
        $size = CarSize::find($request->size_id);
        if (!$service) {
            return response(['status' => false, 'message' => 'this Service not in DB'], 422);
        }
        if (!$size) {
            return response(['status' => false, 'message' => 'this size not in DB'], 422);
        }
        if ($service->level == 3) {
            return response(['status' => false, 'message' => 'this Service not in level 1 or 2'], 422);
        }
        $price = Price::where('service_id', $request->service_id)
            ->where('size_id', $request->size_id)
            ->first();
        if ($price) {
            return response($price->price);
        }
        return response(0);
    }//end fun
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function all_coupons()
    {
        $coupons = Coupon::where(['is_active' => 1])->get();
        return response(['data' => $coupons]);
    }//end fun
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function places()
    {
        $data = Place::latest()->get();


        return response(['data'=>$data]);
    }//end fun
    public function dayByPlacesAndServices(Request $request)
    {
        $rules = [
            'service_id' => 'required|integer|exists:services,id',
            'place_id' => 'required|integer|exists:places,id',
        ];
        $validate = Validator::make(request()->all(), $rules);
        if ($validate->fails()) {
            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);
        }//end validation

        $where = $request->only('service_id','place_id');

        $find = PlaceDay::where($where)->firstOrFail();

        return response($find);

    }//end fun

}//end class
