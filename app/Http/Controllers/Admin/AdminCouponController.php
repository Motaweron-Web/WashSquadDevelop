<?php

namespace App\Http\Controllers\Admin;

use App\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class AdminCouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons=Coupon::all();
        return view('admin.copon.index')->with(['coupons'=>$coupons]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.copon.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'en_title' => 'required|string',
            'ar_title' => 'required|string',
            'ar_des' => 'nullable|string',
            'en_des' => 'nullable|string',
            'coupon_serial' => 'required|string|unique:coupons',
            'ratio'=>'required|numeric|min:1|max:99',
            'image' => 'required|image|mimes:jpeg,jpg,png,gif',

        ]);

        $coupon=new Coupon();
        $coupon->en_title=$request->en_title;
        $coupon->ar_title=$request->ar_title;
        $coupon->en_des=$request->en_des;
        $coupon->ar_des=$request->ar_des;
        $coupon->ratio=$request->ratio;
        $coupon->coupon_serial=$request->coupon_serial;
        $coupon->is_active=1;
        if ($request->image){

            $image = $request->file('image');
            $imageName = time() . '.' .\request('image')->getClientOriginalExtension();
            $coupon->image = 'coupons/'.$imageName;
            $image->move('upload/coupons', $imageName);
        }
        $coupon->save();
        toastr()->success(trans('main.Message_success'), trans('main.Message_title_congratulation'));

        return redirect(route('coupons.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon=Coupon::find($id);
        return view('admin.copon.edit')->with(['coupon'=>$coupon]);
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
        $this->validate($request,[
            'en_title' => 'required|string',
            'ar_title' => 'required|string',
            'ar_des' => 'required|string',
            'en_des' => 'required|string',
            'ratio'=>'required|numeric|min:1|max:99',
            'coupon_serial' => 'required|string|unique:users',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif',

        ]);

        $coupon_serial=Coupon::where('coupon_serial','=',$request->coupon_serial)->where('id','!=',$id)->get();

        if ($coupon_serial->count()!=0){
            toastr()->error(trans('main.Message_title_attention'), 'رقم الكوبون هذا موجود من قبل');

            return back()->withInput();
        }

        $coupon=new Coupon();
        $coupon->en_title=$request->en_title;
        $coupon->ar_title=$request->ar_title;
        $coupon->en_des=$request->en_des;
        $coupon->ar_des=$request->ar_des;
        $coupon->ratio=$request->ratio;
        $coupon->is_active=1;
        if ($request->image){

            $image = $request->file('image');
            $imageName = time() . '.' .\request('image')->getClientOriginalExtension();
            $coupon->image = 'coupons/'.$imageName;
            $image->move('upload/coupons', $imageName);
        }
        $coupon->save();
        toastr()->success(trans('main.Message_success'), trans('main.Message_title_congratulation'));

        return redirect(route('coupons.index'));
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


    public function delete(Request $request)
    {

        $good= Coupon::destroy($request->id);
        if ($good)
            return response(['error'=>0]);
        else
            return response(['error'=>1]);

    }//end

    public function is_active($id)
    {
        $coupoun=Coupon::find($id);
        if (!$coupoun){
            toastr()->success(trans('main.Message_title_attention'), trans('main.Message_warning'));

            return redirect(route('coupons.index'));
        }
        //dd($user);

        if ($coupoun->is_active==1){
            $coupoun->is_active=0;
        }else if ($coupoun->is_active==0){
            $coupoun->is_active=1;
        }
        $coupoun->save();
        //dd($user);

        toastr()->success(trans('main.Message_success'), trans('main.Message_title_congratulation'));

        return redirect(route('coupons.index'));

    }//end

}
