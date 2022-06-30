<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarType;
use App\Models\Order;
use App\Models\OrderSubscriptionDetails;
use App\Models\PlaceDay;
use App\Models\Price;
use App\Models\Service;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;

class ParticipationController extends Controller
{
    //
    public  function getDays(Request $request){
        $place_days=PlaceDay::where('place_id',$request->id)->first();
        $days=json_decode($place_days->days_json);
        return response()->json(['status'=>true,'days'=>$days]);
    }
    public  function addParticipation(Request $request){
        $validator=\Validator::make($request->all(),
            [
                'full_name'=>'required',
                'phone'=>'required',
                'place_id'=>'required',
                'order_time'=>'required',
                'service_id'=>'required|exists:services,id',
                'payment_id'=>'required',
                'car_type1'=>'required',
                'car_type2'=>'required',
                'car_blade_number'=>'required',
                'day'=>'required'
            ]);
        if ($validator->fails()) {
            return response()->json(['status'=>'error','message'=>'you have errors','errors'=>$validator->errors()]);

        }
        $service=Service::find($request->service_id);
        $user=User::where('phone',$request->phone)->first();
        if($user==null){
            $user=User::create([
                'full_name'=>$request->full_name,
                'phone'=>$request->phone,

            ]);
        }
     $car=CarType::find($request->car_type2);
        $price=Price::where('size_id',$car->size)->where('service_id',$service->id)->first();
        $total_price=$price->price*$service->count;

        $order= Order::create([
            'total_price'=>$total_price,
            'place_id'=>$request->place_id,
            'order_time'=>$request->order_time,
            'service_id'=>77,
            'payment_method'=>$request->payment_id,
            'car_blade_number'=>$request->car_blade_number,
            'number_of_cars'=>1,
            'user_id'=>$user->id,
        ]);

            $nextDay = strtotime("next $request->day ");
            $first_date = date('Y-m-d', $nextDay);
         $orderSubscriptionDetails=   OrderSubscriptionDetails::create([
                'number_of_wash'=>1,
                'order_id'=>$order->id,
                'wash_date'=>$first_date,
                'status'=>'new',
                'time_dealy'=>0
            ]);
   $newDate=$nextDay;

for($i=2;$i<=$service->count;$i++){
    $date = strtotime("+7 day", $newDate);
    $nextDate=date('Y-m-d', $date);
    OrderSubscriptionDetails::create([
        'number_of_wash'=>$i,
        'order_id'=>$order->id,
        'wash_date'=>$nextDate,
        'status'=>'new',
        'time_dealy'=>0
    ]);
    $newDate=$date;
}

return  response()->json(['status'=>true,'order'=>$order]);









    }
}
