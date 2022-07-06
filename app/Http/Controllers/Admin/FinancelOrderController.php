<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class FinancelOrderController extends Controller
{
    //
    public function getOrderReport(Request $request){

           $users = User::where('user_type',4)->with(['distributerOrders'=>function($query)use($request)
           {

           }])->get();

           $orders=Order::whereDoesntHave('distributor')->paginate(10);

           return view('admin.financialReport.index',compact('users','orders'));

    }
    public function searchByDate(Request $request){
        $toDate = date("Y-m-d ");
        $fromDate=$request->date;
        $betweenDate = [$fromDate, $toDate];
       // $orders=Or::whereBetween('date',$betweenDate)->paginate(10);
        $users = User::where('user_type',4)->with(['distributerOrders'=>function($query)use($betweenDate)
        {

            $query->whereBetween('date',$betweenDate);
        }])->get();
        $orders=Order::whereBetween('date',$betweenDate)->whereDoesntHave('distributor')->paginate(10);

        $date=$request->date;
        return view('admin.financialReport.index',compact('users','date','orders'));

    }
    public function searchByOrderStatus(Request $request){

        $users = User::where('user_type',4)->with(['distributerOrders'=>function($query)use($request)
        {

            $query->where('status',$request->orderStatus);
        }])->get();
        $orders=Order::where('status',$request->orderStatus)->whereDoesntHave('distributor')->paginate(10);

        $status=$request->orderStatus;
        return view('admin.financialReport.index',compact('users','status','orders'));

    }
}
