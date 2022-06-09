<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Setting;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rules\In;
use Raulr\GooglePlayScraper\Scraper;
use function GuzzleHttp\Psr7\str;


class AdminController extends Controller
{

    /**
     * AdminController constructor.
     * Create a new controller instance.
     */
    /**
     * show dashboard.
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fromDate='';
        $toDate='';

        if (!$request->has('month') || !$request->has('type') || !in_array($request->type, ['month', 'filter'])) {
            return redirect(route('admin.dashboard') . '?month=' . date('Y-m') . '&type=month');
        }//end fun

        if ($request->type == 'filter') {
            if (!$request->has('filter') || !in_array($request->filter, ['today', 'thisWeek'
                    , 'lastWeek', 'thisMonth', 'lastMonth', 'lastYear','thisYear']))
                return redirect(route('admin.dashboard') . '?month=' . date('Y-m') . '&type=filter&filter=today');
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
//        return $betweenMonth;



        $setting = Setting::first();


         $totalorders = Order::whereBetween("date", $betweenMonth)->select(DB::raw('sum(total_price) as `price`'),DB::raw('count(*) as total'),DB::raw('sum(number_of_cars) as `carsnumber`'))->get();
         $vesa=Order::whereBetween("date", $betweenMonth)->where('payment_method',1)->count();
        $cash=Order::whereBetween("date", $betweenMonth)->where('payment_method',2)->count();
        $shabka=Order::whereBetween("date", $betweenMonth)->where('payment_method',3)->count();
        $mahfeza=Order::whereBetween("date", $betweenMonth)->where('payment_method',4)->count();
        $users=User::where('user_type','1')->count();
           $orders = Order::whereBetween("date", $betweenMonth)->where('service_id','!=',79)->select('service_id', DB::raw('count(*) as total'),DB::raw('sum(total_price) as `price`'),)
            ->groupBy('service_id')->with('service_basic')
            ->get();


     $places = Order::whereBetween("date", $betweenMonth)->where('service_id','!=',79)->select('place_id', DB::raw('count(*) as total'),)
            ->groupBy('place_id')->with('place')
            ->get();
   $allorders=Order::count();

   $ios=Order::whereBetween("date", $betweenMonth)->where('device_type','ios')->count();
   $web=Order::whereBetween("date", $betweenMonth)->where('device_type','web')->count();
   $android=Order::whereBetween("date", $betweenMonth)->where('device_type','android')->count();
   $ordercountfordevicecount=Order::whereBetween("date", $betweenMonth)->count();
   if($ordercountfordevicecount==0)
   {
       $finalios=0;
       $finalweb=0;
       $finalandroid=0;

   }
   else {
       $finalios = $ios / $ordercountfordevicecount * 1200;
        $finalweb = $web / $ordercountfordevicecount * 1200;
       $finalandroid = $android / $ordercountfordevicecount * 1200;
   }
               $users=User::whereHas('orders')->count();
               $mans=User::where('gender',1)->whereHas('orders')->count();
               $womens=User::where('gender',2)->whereHas('orders')->count();
               $totalman=$mans /$users * 100;
               $totalwomen=$womens /$users * 100;

        return view('admin.home.dashboard',compact('request','places','allorders','finalandroid','finalios','finalweb','totalman','totalwomen'))->with([

            "setting" => $setting,
            'orders'=>$orders ,
            'totalorders'=>$totalorders,
            'vesa'=>$vesa,
            'cash'=>$cash,
            'shabka'=>$shabka,
            'mahfeza'=>$mahfeza,
            'users'=>$users,


        ]);
    }

    public function sales_and_operation(Request $request)
    {
        if (!$request->has('month') || !$request->has('type') || !in_array($request->type, ['month', 'filter'])) {
            return redirect(route('admin.sales_and_operation') . '?month=' . date('Y-m') . '&type=month');
        }//end fun

        if ($request->type == 'filter') {
            if (!$request->has('filter') || !in_array($request->filter, ['today', 'thisWeek'
                    , 'lastWeek', 'thisMonth', 'lastMonth', 'lastYear','thisYear']))
                return redirect(route('admin.sales_and_operation') . '?month=' . date('Y-m') . '&type=filter&filter=today');
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



        ///////////////////////// orders Details ////////////////////////
        $orderData['orders_received'] = Order::whereBetween("date", $betweenMonth)
            ->count();


        $orderData['orders_inProgress'] = Order::where('status', 2)
            ->whereBetween("date", $betweenMonth)
            ->count();


        $orderData['orders_ended'] = Order::wherein('status',[3,4])
            ->whereBetween("date", $betweenMonth)
            ->count();

        $orderData['orders_inProgress'] = Order::wherein('status',[2,1])
            ->whereBetween("date", $betweenMonth)
            ->count();

        $orderData['orders_new'] = Order::wherein('status', [-1,0])
            ->whereBetween("date", $betweenMonth)
            ->count();

        $orderData['orders_cancel'] = Order::wherein('status', [5, 15])
            ->whereBetween("date", $betweenMonth)
            ->count();

        ///////////////////////// end orders Details ////////////////////////

        ///////////////////////// money Details ////////////////////////

        $orderMoney['cash'] = Order::where('status', 3)
            ->whereBetween("date", $betweenMonth)
            ->where('payment_method',2)
            ->sum('total_price');

        $orderMoney['online'] = Order::where('status', 3)
            ->whereBetween("date", $betweenMonth)
            ->where('payment_method',1)
            ->sum('total_price');


        $orderMoney['pos'] = Order::where('status', 3)
            ->whereBetween("date", $betweenMonth)
            ->where('payment_method',3)
            ->sum('total_price');

        $orderMoney['not_paid'] = Order::where('status', 3)
            ->whereBetween("date", $betweenMonth)
            ->where('payment_status','no')
            ->sum('total_price');

        ///////////////////////// end money Details ////////////////////////

        $orders = Order::whereBetween("date", $betweenMonth)->where('service_id','!=',79)->select('service_id', DB::raw('count(*) as total'),DB::raw('sum(total_price) as `price`'),)
            ->groupBy('service_id')->with('service_basic')
            ->get();

        $setting = Setting::first();
        return view('admin.home.sales_and_operation',compact('setting','orders',
            'request','orderData','orderMoney','betweenMonth'));
    }

    public function update_target_setting(Request $request)
    {
        $data = $request->validate([
            'target' => "nullable",
            'target_month' => "nullable",
            'target_year' => "nullable",
        ]);
        Setting::where('id', request()->id)->update($data);
        return response()->json(['success' => 'Ajax request submitted successfully']);
    }

    public function test_android()
    {
        // dd($app['downloads']);
        //dd($app) ;
    }

    public function test_ios()
    {
        // dd($response);
    }
}//end
