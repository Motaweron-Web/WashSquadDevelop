<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class CarPerformanceController extends Controller
{

    public  function index(){
        $orders=Order::paginate(15);
        return view('admin.carPerformance.index',compact('orders'));
    }
public function search(Request $request){

    $ordersByMobile = Order::whereHas('user', function($q) use ($request){
        $q->where('phone','LIKE',"%$request->search%");
    })->paginate(15);
$search=$request->search;
    $ordersById=Order::where('id','LIKE',"%$request->search%")->paginate(15);
    return view('admin.carPerformance.index',compact('ordersById','ordersByMobile','search'));

}
public function searchByDate(Request $request){
    $toDate = date("Y-m-d ");
    $fromDate=$request->date;
    $betweenDate = [$fromDate, $toDate];
    $orders=Order::whereBetween('date',$betweenDate)->paginate(15);
    $date=$request->date;
    return view('admin.carPerformance.index',compact('orders','date'));

}
public function searchByCar(Request $request){
 $orders=Order::where('driver_id',$request->car)->paginate(15);
 $car=$request->car;
    return view('admin.carPerformance.index',compact('orders','car'));

}
public  function exportCarPerformance(){

}
}
