<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CouponPaymente;
use App\Models\CouponService;
use App\Models\Coupon;
use App\Models\CouponUser;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Service;
use App\Models\ServicePayment;
use App\Models\ServiceSubService;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    public function getcoupons()
    {
        if(!checkPermission(25))
            return view('admin.permission.index');
        $coupons=Coupon::with('payments')->paginate(15);

        return view('admin.home.coupons.index',compact('coupons'));

    }
    public function createcoupon(){
        if(!checkPermission(25))
            return view('admin.permission.index');
        $payments=Payment::get();
        $services=Service::where('level',1)->get();
        return view('admin.home.coupons.create',compact('payments','services'));
    }
    public function changecouponstatus(Request $request){
        $coupon=Coupon::find($request->id);
        if($coupon==null)
            return response()->json(['status'=>false]);
        if($coupon->status==1){
            $coupon->status=0;
            $coupon->save();
        }
        else{
            $coupon->status=1;
            $coupon->save();
        }
        return response()->json(['status'=>true]);

    }

    public function addcoupon(Request $request){
        if(!checkPermission(25))
            return view('admin.permission.index');

        $validator= Validator::make($request->all(),
            [
                'discount_coupon_code'=>'required|string',
                'date_created'=>'required',
                'expiry_date'=>'required',
                'discount_type'=>'required',
                'services'=>'required',
                'payments'=>'required',
                'minimum_order'=>'required',
                'market_percentage_code_sales'=>'required',
                 'number_customer_used'=>'required|numeric',
                'number_all_used'=>'required|numeric',
                'ratio'=>'required',
                'clients_excluded'=>'required'


            ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data=[
          'discount_coupon_code'=>$request->discount_coupon_code,
          'date_created'=> $request->date_created ,
          'expiry_date'=>$request->expiry_date,
          'discount_type'=>$request->discount_type,
          'minimum_order'=>$request->minimum_order,
          'market_percentage_code_sales'=>$request->market_percentage_code_sales,
          'number_customer_used'=>$request->number_customer_used,
          'number_all_used'=>$request->number_all_used,
            'ratio'=>$request->ratio,
            'clients_excluded'=>json_encode($request->clients_excluded),
        ];
    $coupon=Coupon::create($data);





        if($request->services) {
            CouponService::where('coupon_id', $coupon->id)->delete();
            for ($i = 0; $i < count($request->services); $i++) {
                CouponService::create([
                    'service_id' => $request->services[$i],
                    'coupon_id' => $coupon->id,
                ]);
            }
        }
        else
        {
            CouponService::where('coupon_id', $coupon->id)->delete();

        }
        if($request->payments) {
            CouponPaymente::where('coupon_id',$coupon->id)->delete();
            for ($i = 0; $i < count($request->payments); $i++) {
                CouponPaymente::create([
                    'payment_id' => $request->payments[$i],
                    'coupon_id' => $coupon->id,
                ]);
            }
        }
        else{
            CouponPaymente::where('coupon_id',$coupon->id)->delete();

        }
     return redirect()->route('getcoupons')->with('message','???? ?????????????? ??????????');
    }
    public function couponDetails(Request $request){
        $coupon=Coupon::find($request->id);
        if($coupon==null)
            return response()->json(['status'=>false]);
             $salaries=Order::where('coupon_serial',$request->id)->sum('total_price');
             $numberOfUses=CouponUser::where('coupon_id',$request->id)->count();
             $numberOfUsers= CouponUser::where('coupon_id',$request->id)->distinct()
                 ->count('user_id');
        return response()->json(['status'=>true,'salaries'=>$salaries,'coupon'=>$coupon,'numberOfUses'=>$numberOfUses,'numberOfUsers'=>$numberOfUsers]);

    }
    public function couponDetailsByDate(Request $request){
        $toDate = date("Y-m-d ");
        $fromDate=$request->date;
        $betweenDate = [$fromDate, $toDate];
        // $orders=Or::whereBetween('date',$betweenDate)->paginate(10);
        $coupon=Coupon::find($request->id);
        if($coupon==null)
            return response()->json(['status'=>false]);
        $salaries=Order::whereBetween('date',$betweenDate)->where('coupon_serial',$request->id)->sum('total_price');
        $numberOfUses=CouponUser::whereBetween('created_at',$betweenDate)->where('coupon_id',$request->id)->count();
        $numberOfUsers= CouponUser::whereBetween('created_at',$betweenDate)->where('coupon_id',$request->id)->distinct()
            ->count('user_id');
        return response()->json(['status'=>true,'salaries'=>$salaries,'numberOfUses'=>$numberOfUses,'numberOfUsers'=>$numberOfUsers]);

    }
}
