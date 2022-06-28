<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    //
    public function getdriverorder(Request  $request){
        $fromDate='';
        $toDate='';

        if (!$request->has('month') || !$request->has('type') || !in_array($request->type, ['month', 'filter'])) {
            return redirect(route('getdriverorder') . '?month=' . date('Y-m') . '&type=month');
        }//end fun

        if ($request->type == 'filter') {
            if (!$request->has('filter') || !in_array($request->filter, ['today', 'thisWeek'
                    , 'lastWeek', 'thisMonth', 'lastMonth', 'lastYear','thisYear']))
                return redirect(route('getdriverorder') . '?month=' . date('Y-m') . '&type=filter&filter=today');
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
        $orders=Order::whereBetween("date", $betweenMonth)->with('service','driver')->paginate(10);
        return view('admin.home.orders.index',compact('orders','request'));

    }




}
