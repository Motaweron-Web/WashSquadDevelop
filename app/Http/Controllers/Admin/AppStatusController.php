<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AppStatusController extends Controller
{
    //
    public  function index(){

        $orders=Order::with('sub_sub_services')->paginate(15);
        return view('admin.appStatus.index',compact('orders'));

    }
    public  function  filterByDate($date)
    {
        $toDate = date("Y-m-d ");
        $fromDate = $date;
        $betweenDate = [$fromDate, $toDate];
        $orders = Order::whereBetween('date', $betweenDate)->with('sub_sub_services')->paginate(15);
        $date = $date;
        return view('admin.appStatus.index', compact('orders', 'date'));
    }
    public function filterBySearch($search){
        $orders = Order::with('sub_sub_services')->whereHas('user', function($q) use ($search){
            $q->where('phone','LIKE',"%$search%");
        })->paginate(15);
        return view('admin.appStatus.index', compact('orders', 'search'));

    }
}
