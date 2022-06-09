<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use App\OrderSubscriptionDetails;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MonthlySubscriptionController extends Controller
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

        return view('admin.monthly_subscription.index', compact('start_day',
            'number_of_day', 'prev_year', 'prev_month', 'next_year', 'next_month', 'year', 'month', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $date
     * @return \Illuminate\Http\Response
     */
    public function show($date)
    {
        $orders = Order::where('date', $date)
            ->where('service_id',77)
            ->with('service_basic', 'user', 'sub_service', 'type', 'sub_type')->orderBy('service_id', 'DESC')
            ->get();
        $drivers = User::where('user_type', 2)->where('is_active', 1)->get();
        $html = view('admin.monthly_subscription.parts.tableDate', compact('orders', 'drivers'));
        session()->put('activeDate', $date);
        return response(['html' => "$html"]);
    }//end fun
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
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

        $html = view('admin.monthly_subscription.parts.anotherMonth', compact('start_day',
            'number_of_day', 'prev_year', 'prev_month', 'next_year', 'next_month', 'year', 'month', 'request'));
        return response(['html' => "$html", 'status' => 200]);
    }//end fun
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::with('wash_sub')->findOrFail($id);
        $leftWashes = OrderSubscriptionDetails::where([['order_id',$order->id],['status','!=','done']])->count();
        $days = ["Sat" => "السبت", "Sun" => "الأحد", "Mon" => "الإثنين", "Tue" => "الثلاثاء", "Wed" => "الأربعاء", "Thu" => "الخميس", "Fri" => "الجمعة"];
        $nextDayTime = strtotime("next {$order->day}");
        $day = $days[date('D', $nextDayTime)];
        return view('admin.monthly_subscription.crud.show', compact('id','order','day','leftWashes','days'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
