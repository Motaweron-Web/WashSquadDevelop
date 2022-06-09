<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CouponPaymente;
use App\Models\CouponService;
use App\Models\Coupon;
use App\Models\Payment;
use App\Models\Service;
use App\Models\ServicePayment;
use App\Models\ServiceSubService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    public function getcoupons()
    {
        $coupons=Coupon::with('payments')->get();


        return view('admin.home.coupons.index',compact('coupons'));

    }
    public function createcoupon(){
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
     return redirect()->route('getcoupons');
    }
}
