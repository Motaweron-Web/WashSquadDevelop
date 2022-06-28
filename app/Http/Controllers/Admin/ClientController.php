<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Place;
use App\Models\Setting;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;

class ClientController extends Controller
{
     public  function  getClients(){
         $clients=User::paginate(15);
         $places=Place::get();
         return view('admin.client.index',compact('clients','places'));
     }
     public function profile($id){
         $client=User::find($id);
         $orders=$client->orders;
         $total_price=0;
         foreach ($client->orders as $order)
         {
             $total_price +=$order->total_price;
         }
         return view('admin.client.profile',compact('client','total_price','orders'));

     }
     public function filterProfileByDate( Request $request,$id){
         $client=User::find($id);
         $total_price=0;
         foreach ($client->orders as $order)
         {
             $total_price +=$order->total_price;
         }
         $toDate = date("Y-m-d ");
         $fromDate=$request->date;
         $betweenDate = [$fromDate, $toDate];
         $orders=Order::where('user_id',$id)->whereBetween('date',$betweenDate)->paginate(15);
         $date=$request->date;
         return view('admin.client.profile',compact('client','total_price','orders','date'));

     }
     public function changeVip(Request $request){
         $client=User::find($request->id);
         if($client==null){
             return response()->json(['status'=>false]);
         }
         if($client->is_vip==0){
             $client->is_vip=1;
             $client->save();
             return response()->json(['status'=>true]);

         }
         $client->is_vip=0;
         $client->save();
         return response()->json(['status'=>true]);
     }
     public function changeActive(Request $request){
         $client=User::find($request->id);
         if($client==null){
             return response()->json(['status'=>false]);
         }
         if($client->is_active==0){
             $client->is_active=1;
             $client->save();
             return response()->json(['status'=>true,'data'=>1]);

         }
         $client->is_active=0;
         $client->save();
         return response()->json(['status'=>true,'data'=>0]);


     }
     public function changeVipDiscount(Request $request)
     {

         $validator=\Validator::make($request->all(),
             [
                 'discount'=>'required|regex:/^\d+(\.\d{1,2})?$/',

             ]);
         if ($validator->fails()) {
             return response()->json(['status'=>'error', 'message'=>'you have errors','errors'=>$validator->errors()]);

         }
         $setting=Setting::first();
         if($setting==null)
             return response()->json(['status'=>false]);
            $setting->vip_discount=$request->discount;
            $setting->save();
            return response()->json(['status'=>true]);


     }
     public function getClientsByFilter($key){
         $places=Place::get();

         if($key=='vip'){
             $clients=User::where('is_vip',1)->paginate(15);

         }
         elseif ($key=='cancel')
         {
             $clients = User::whereHas('orders', function($q){
                 $q->where('status',5);
             })->paginate(15);
         }
         elseif ($key=='new')
         {
             $clients = User::doesntHave('orders')->paginate(15);
         }
         elseif ($key=='done')
         {
             $clients = User::whereHas('orders', function($q){
                 $q->where('status',13);
             })->paginate(15);
         }
         elseif ($key=='notServe')
         {
             $clients = User::whereHas('orders', function($q){
                 $q->where('status',1);
             })->paginate(15);
         }
         return view('admin.client.index',compact('clients','places'));

     }
     public function searchByMobile(Request $request){
         $places=Place::get();
         $clients=User::where('phone','like',"%$request->search%")->paginate(15);
         $search=$request->search;
         return view('admin.client.index',compact('clients','search','places'));

     }
     public function searchByPlace(Request $request){

         $places=Place::get();
         $clients=User::where('place_id',$request->region)->paginate(15);
         $region=$request->region;
         return view('admin.client.index',compact('clients','region','places'));


     }
     public function searchByDate(Request $request){
         $toDate = date("Y-m-d h:i:s");
         $fromDate=$request->date;
         $betweenDate = [$fromDate, $toDate];
         //whereBetween
         $places=Place::get();
         $clients=User::whereBetween('created_at',$betweenDate)->paginate(15);
         $date=$request->date;
         return view('admin.client.index',compact('clients','date','places'));
     }
     public function searchByCountOrder( Request $request){

            $ides=[];
         $places=Place::get();
         $clients=User::get();
         foreach ($clients as $client)
         {
             $sum=$client->orders->count() ?? 0;
          if($sum==$request->countOrder)
          {
              array_push($ides,$client->id);

          }
         }
         $clients=User::whereIn('id',$ides)->get();

         $countOrder=$request->countOrder;
         return view('admin.client.index',compact('clients','countOrder','places'));

     }
     public function searchByService(Request $request){
         $places=Place::get();
         $clients = User::whereHas('orders', function($q) use ($request){
             $q->where('service_id',$request->service);
         })->paginate(15);
         $ser=$request->service;
         return view('admin.client.index',compact('clients','ser','places'));

     }
     public function clientSearchByPayment(Request $request){
         $places=Place::get();
         $clients = User::whereHas('orders', function($q) use ($request){
             $q->where('payment_method',$request->payment);
         })->paginate(15);
         $pay=$request->payment;
         return view('admin.client.index',compact('clients','pay','places'));

     }
     public function addBalanceToClient(Request $request){

         $validator=\Validator::make($request->all(),
             [
                 'balance'=>'required|regex:/^\d+(\.\d{1,2})?$/',

             ]);
         if ($validator->fails()) {
             return response()->json(['status'=>'error', 'message'=>'you have errors','errors'=>$validator->errors()]);

         }
         $client=User::find($request->id);
         if($client==null){
             return response()->json(['status'=>false]);

         }
         $client->balance +=$request->balance;
         $client->save();
         return  response()->json(['status'=>true,'balance'=>$client->balance]);


     }
     public function changePercentage(Request $request){
         $validator=\Validator::make($request->all(),
             [
                 'percentage'=>'required|regex:/^\d+(\.\d{1,2})?$/',

             ]);
         if ($validator->fails()) {
             return response()->json(['status'=>'error', 'message'=>'you have errors','errors'=>$validator->errors()]);

         }
         $client=User::find($request->id);
         if($client==null){
             return response()->json(['status'=>false]);

         }
         $client->one_time_discount_rate +=$request->percentage;
         $client->save();
         return  response()->json(['status'=>true]);
     }
}
