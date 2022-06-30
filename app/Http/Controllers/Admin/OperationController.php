<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarType;
use App\Models\Order;
use App\Models\Place;
use App\Models\Service;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OperationController extends Controller
{
    //

    public function getoperation(Request $request)
    {

        if (!$request->has('month') || !$request->has('type') || !in_array($request->type, ['month', 'filter'])) {
            return redirect(route('getoperation') . '?month=' . date('Y-m') . '&type=month');
        }//end fun

        if ($request->type == 'filter') {
            if (!$request->has('filter') || !in_array($request->filter, ['today', 'thisWeek'
                    , 'lastWeek', 'thisMonth', 'lastMonth', 'lastYear','thisYear']))
                return redirect(route('getoperation') . '?month=' . date('Y-m') . '&type=filter&filter=today');
        }

        $type = $request->type;


        $month = date('m', strtotime($request->month . '-01'));
        $year = date('Y', strtotime($request->month . '-01'));

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






        $neworders = Order::whereBetween("date", $betweenMonth)->where('status', 1)->with('service', 'driver')->paginate(10);
        $roadorders = Order::whereBetween("date", $betweenMonth)->where('status', 11)->with('service', 'driver')->paginate(10);
        $workorders=Order::whereBetween("date", $betweenMonth)->where('status',2)->with('service','driver')->paginate(10);
        $cancelorders=Order::whereBetween("date", $betweenMonth)->where('status',5)->with('service','driver')->paginate(10);
        $doneorders=Order::whereBetween("date", $betweenMonth)->where('status',3)->with('service','driver')->paginate(10);
        $finishorders=Order::whereBetween("date", $betweenMonth)->where('status',13)->with('service','driver')->paginate(10);
         $drivers=User::where('user_type',2)->get();
         $places=Place::get();
        $carTypes=CarType::where('level',1)->get();
        $services=Service::where('level',1)->get();




        $units = \UnitGps::all();
        $units = json_decode($units);

        $bigArray = [];
        foreach($units as $unit) {
            $stringJs = json_encode($unit);
            $smallArray = [];
            $smallArray['name'] = Str::between($stringJs,'"nm":"','","mu"');
            $smallArray['lat'] = Str::between($stringJs,'"lat":',',"lon":');
            $smallArray['lng'] = Str::between($stringJs,'"lon":','}');
            $bigArray[] = $smallArray;
        }
        return view('admin.home.operation.index',compact('neworders','roadorders','workorders','cancelorders','doneorders','finishorders','drivers','places','carTypes','services','request','bigArray'));

    }//end fun
    public function carTrack()
    {
        $units = \UnitGps::all();
        $units = json_decode($units);

        $bigArray = [];
        foreach($units as $unit) {
            $stringJs = json_encode($unit);
            $smallArray = [];
            $smallArray['name'] = Str::between($stringJs,'"nm":"','","mu"');
            $smallArray['lat'] = Str::between($stringJs,'"lat":',',"lon":');
            $smallArray['lng'] = Str::between($stringJs,'"lon":','}');
            $bigArray[] = $smallArray;
        }
        return response($bigArray);
    }
    public function searcbymobile(Request $request){











        $search=$request->search;
        $searchorders=Order::where('id','like',"%$search%")->paginate(50);
        $drivers=User::where('user_type',2)->get();
        $places=Place::get();
        $carTypes=CarType::where('level',1)->get();
        $services=Service::where('level',1)->get();

        $searchordersbymobile = Order::with('user')->whereHas('user', function ( $query) use ($search) {
            $query->where('phone', 'like', "%$search%");
        })->paginate(10);


        return view('admin.home.operation.index',compact('search','drivers','places','carTypes','services','searchorders','searchordersbymobile','request'));

    }
    public function deleteorder(Request $request){

        $order=Order::find($request->id);
        if($order==null)
            return response()->json(['status'=>false]);
        $order->delete();
        return response()->json(['status'=>true]);


    }
    public  function  showorder(Request $request){

        $order=Order::with('user','service','place','sub_type','type')->find($request->id);
        if($order==null)
            return response()->json(['status'=>false]);

        $mark=CarType::where('id',$order->brand_id)->first();
        $marks=CarType::where('parent_id',$order->type_id)->get();



        return response()->json(['status'=>true,'order'=>$order,'mark'=>$mark,'marks'=>$marks]);




    }
    public function getsubcarbymaincar(Request $request)
    {
        $cars=CarType::where('parent_id',$request->id)->get();
        return response()->json(['status'=>true,'cars'=>$cars]);
    }

      public function updateorderbyadmin(Request $request)
      {

          $validator=\Validator::make($request->all(),
              [
                  'order_time_id'=>'required',
                  'full_name'=>'required',
                  'phone'=>'required',
                  'place_id'=>'required',
                  'order_date'=>'required',
                  'type_id'=>'required',
                  'sub_type_id'=>'required',
                  'service_id'=>'required',
                  'number_of_cars'=>'required',
                  'id'=>'required|exists:orders,id',
              ]);
          if ($validator->fails()) {
              return response()->json(['status'=>'error','errors'=>$validator->errors()]);
          }

          $order=Order::find($request->id);
          $order->update(
              [
                  'order_time_id'=>$request->order_time_id,
                  'place_id'=>$request->place_id,
                  'date'=>$request->order_date,
                  'type_id'=>$request->type_id,
                   'sub_type_id'=>$request->sub_type_id,
                  'service_id'=>$request->service_id,
                  'number_of_cars'=>$request->number_of_cars,

              ]

          );
          return response()->json(['status'=>true]);



      }

public  function  changedriver(Request $request)
{
    $order=Order::find($request->id);
    if($order->status==1)
    {
        $order->driver_id=$request->driver_id;
        $order->save();
        return response()->json(['status'=>true]);

    }
    return response()->json(['status'=>false]);


}


}
