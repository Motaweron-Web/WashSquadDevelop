<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarType;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Price;
use App\Models\Service;
use App\Models\SubServiceOrder;
use App\Models\User;
use Illuminate\Http\Request;

class RevenueController extends Controller
{
    //
    public function index(Request  $request){
        if(!checkPermission(14))
            return view('admin.permission.index');
        $fromDate='';
        $toDate='';

        if (!$request->has('month') || !$request->has('type') || !in_array($request->type, ['month', 'filter'])) {
            return redirect(route('admin.cars.revenue') . '?month=' . date('Y-m') . '&type=month');
        }//end fun

        if ($request->type == 'filter') {
            if (!$request->has('filter') || !in_array($request->filter, ['today', 'thisWeek'
                    , 'lastWeek', 'thisMonth', 'lastMonth', 'lastYear','thisYear']))
                return redirect(route('admin.cars.revenue') . '?month=' . date('Y-m') . '&type=filter&filter=today');
        }

        $fromDate = date('Y-m-d', strtotime('-1 month ' . date('Y-m-d')));
        $toDate = date('Y-m-d');

        if ($request->type == 'month') {
            $fromDate = $request->month . '-01';
            $toDate = date('Y-m-t', strtotime($fromDate));
        }elseif('filter'){
            $fromDate = date('Y-m-d');
            $toDate = date('Y-m-d');
            if ($request->filter == 'thisWeek')
            {
                $day = date('w',strtotime(date('Y-m-d')));
                $day = $day+1;
                $fromDate = date('Y-m-d', strtotime('-'.$day.' days',strtotime(date('Y-m-d'))));
                $toDate = date('Y-m-d');
            }elseif($request->filter =='lastWeek')
            {
                $day = date('w',strtotime(date('Y-m-d')));
                $day = $day+8;
                $fromDate = date('Y-m-d', strtotime('-'.$day.' days',strtotime(date('Y-m-d'))));
                $toDate = date('Y-m-d', strtotime('+ 6 days',strtotime($fromDate)));
            }
            elseif($request->filter =='lastMonth')
            {
                $fromDate = date('Y-m',strtotime('- 1 month'.date('Y-m-d'))).'-1';
                $toDate = date('Y-m-t',strtotime('- 1 month'.date('Y-m-d')));
            }elseif($request->filter =='thisMonth'){
                $fromDate = date('Y-m-d');
                $toDate = date('Y-m-t');
            }elseif($request->filter =='lastYear')
            {
                $fromDate = date('Y',strtotime('- 1 year'.date('Y-m-d'))).'-'.date('m-d',strtotime('2022-01-01'));
                $toDate = date('Y',strtotime('- 1 year'.date('Y-m-d'))).'-'.date('m-t',strtotime('2022-12-01'));
            }elseif($request->filter =='thisYear')
            {
                $fromDate = date('Y').'-'.date('m-d',strtotime('2022-01-01'));
                $toDate = date('Y').'-'.date('m-t',strtotime('2022-12-01'));
            }
        }

        $betweenMonth = [$fromDate, $toDate];









        $orders=Order::whereBetween("date", $betweenMonth)->with('sub_sub_services')->paginate(15);
        return view('admin.car_revenue.index',compact('orders','request'));
    }
    public  function searchByCar($car,Request $request){
        if(!checkPermission(14))
            return view('admin.permission.index');
        $fromDate='';
        $toDate='';

        if (!$request->has('month') || !$request->has('type') || !in_array($request->type, ['month', 'filter'])) {
            return redirect(route('admin.cars.revenue') . '?month=' . date('Y-m') . '&type=month');
        }//end fun

        if ($request->type == 'filter') {
            if (!$request->has('filter') || !in_array($request->filter, ['today', 'thisWeek'
                    , 'lastWeek', 'thisMonth', 'lastMonth', 'lastYear','thisYear']))
                return redirect(route('admin.cars.revenue') . '?month=' . date('Y-m') . '&type=filter&filter=today');
        }

        $fromDate = date('Y-m-d', strtotime('-1 month ' . date('Y-m-d')));
        $toDate = date('Y-m-d');

        if ($request->type == 'month') {
            $fromDate = $request->month . '-01';
            $toDate = date('Y-m-t', strtotime($fromDate));
        }elseif('filter'){
            $fromDate = date('Y-m-d');
            $toDate = date('Y-m-d');
            if ($request->filter == 'thisWeek')
            {
                $day = date('w',strtotime(date('Y-m-d')));
                $day = $day+1;
                $fromDate = date('Y-m-d', strtotime('-'.$day.' days',strtotime(date('Y-m-d'))));
                $toDate = date('Y-m-d');
            }elseif($request->filter =='lastWeek')
            {
                $day = date('w',strtotime(date('Y-m-d')));
                $day = $day+8;
                $fromDate = date('Y-m-d', strtotime('-'.$day.' days',strtotime(date('Y-m-d'))));
                $toDate = date('Y-m-d', strtotime('+ 6 days',strtotime($fromDate)));
            }
            elseif($request->filter =='lastMonth')
            {
                $fromDate = date('Y-m',strtotime('- 1 month'.date('Y-m-d'))).'-1';
                $toDate = date('Y-m-t',strtotime('- 1 month'.date('Y-m-d')));
            }elseif($request->filter =='thisMonth'){
                $fromDate = date('Y-m-d');
                $toDate = date('Y-m-t');
            }elseif($request->filter =='lastYear')
            {
                $fromDate = date('Y',strtotime('- 1 year'.date('Y-m-d'))).'-'.date('m-d',strtotime('2022-01-01'));
                $toDate = date('Y',strtotime('- 1 year'.date('Y-m-d'))).'-'.date('m-t',strtotime('2022-12-01'));
            }elseif($request->filter =='thisYear')
            {
                $fromDate = date('Y').'-'.date('m-d',strtotime('2022-01-01'));
                $toDate = date('Y').'-'.date('m-t',strtotime('2022-12-01'));
            }
        }

        $betweenMonth = [$fromDate, $toDate];






        $orders=Order::whereBetween("date", $betweenMonth)->with('sub_sub_services')->where('driver_id',$car)->paginate(15);
        return view('admin.car_revenue.index',compact('orders','car','request'));


    }
    public function addinvoice(Request $request){
        $validator=\Validator::make($request->all(),
            [
                'full_name'=>'required',
                'phone'=>'required',
                'driver_id'=>'required|exists:users,id',
                'date'=>'required',
                'service_id'=>'required|exists:services,id',
                'number_of_cars'=>'required',
                'type_id'=>'exists:car_types,id',
                'sub_type_id'=>'exists:car_types,id',
                'sub_sub_services'=>'exists:services,id',
                'payment_method'=>'exists:payments,id',
                'instant_reward'=>'required',
                'place_id'=>'required|exists:places,id',
                'order_time'=>'required',
                'car_blade_number'=>'required'

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
        $car=CarType::find($request->sub_type_id);
        $price=Price::where('size_id',$car->size)->where('service_id',$service->id)->first();
        $total_price=$price->price??0*$service->count??0;
        $final_price=$total_price*$request->number_of_cars;
        $order= Order::create([
            'total_price'=>$final_price,
            'place_id'=>$request->place_id,
            'order_time'=>$request->order_time,
            'service_id'=>$request->service_id,
            'payment_method'=>$request->payment_method,
            'car_blade_number'=>$request->car_blade_number,
            'number_of_cars'=>$request->number_of_cars,
            'user_id'=>$user->id,
          //  'sub_service_id'=>$request->service_id,
            'date'=>$request->date,
            'type_id'=>$request->type_id,
            'brand_id'=>$request->sub_type_id,
            'order_date'=>strtotime($request->date),
            'driver_id'=>$request->driver_id,
        ]);


        SubServiceOrder::where('order_id',$order->id)->delete();

for($i=0;$i<count($request->sub_sub_services);$i++){
$service=Service::find($request->sub_sub_services[$i]);
    SubServiceOrder::create(
     [
         'order_id'=>$order->id,
         'sub_service_id'=>$request->sub_sub_services[$i],
         'price'=>$service->price,
    ]
    );
}

        return response()->json(['status'=>true]);
      }

      public function getOrderById(Request $request){
        $order=Order::find($request->id);
        if($order==null)
            return respose()->json(['status'=>false]);
        $payments=Payment::get();
        $user=User::find($order->user_id);
        return response()->json(['status'=>true,'order'=>$order,'user'=>$user,'payments'=>$payments]);
      }
      public function addInstantReward(Request $request){
        $user=User::find($request->id);
        if($user==null)
            return response()->json(['status'=>false]);
        $user->instant_reward=$request->instant_reward;
        $user->save();
          return response()->json(['status'=>true,'instant_reward'=>$user->instant_reward]);

      }
      public function editOrderCarRevenue(Request $request){
          $validator=\Validator::make($request->all(),
              [
                  'user_id'=>'required|exists:users,id',
                  'order_id'=>'required|exists:orders,id',
                  'instant_reward'=>'required|regex:/^\d+(\.\d{1,2})?$/',
                  'balance'=>'required|regex:/^\d+(\.\d{1,2})?$/',
                  'number_of_cars'=>'required',
                  'notes'=>'required',
                  'payment_id'=>'required|exists:payments,id',

              ]);
          if ($validator->fails()) {
              return response()->json(['status'=>'error','message'=>'you have errors','errors'=>$validator->errors()]);

          }
          $order=Order::find($request->order_id);
          if($order==null)
              return response()->json(['status'=>false]);
          $total_price=$order->total_price;
          $price_for_one=$total_price/$order->number_of_cars??0;
          $final_price=$price_for_one*$request->number_of_cars??0;
          $order->update([
              'number_of_cars'=>$request->number_of_cars,
              'notes'=>$request->notes,
              'payment_method'=>$request->payment_id,
              'total_price'=>$final_price,
          ]);
          $user=User::find($request->user_id);
          if($user==null)
              return response()->json(['status'=>false]);
          $user->instant_reward=$request->instant_reward;
          $user->balance=$request->balance;
          $user->save();
          return response()->json(['status'=>true,'user'=>$user,'order'=>$order,'payment'=>$order->payment->type??'']);
      }
      public function editRevenueBalance(Request $request){
        $user=User::find($request->id);
        if($user==null)
            return response()->json(['status'=>false]);
        $user->balance=$request->balance;
        $user->save();
          return response()->json(['status'=>true,'balance'=>$user->balance]);

      }
}
