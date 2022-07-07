<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppSettingDriversRequest;
use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    ########################################==index==##############################################3
    public function index(){
        if(!checkPermission(20))
            return view('admin.permission.index');
        $AppSettingDrivers= User::where('user_type',2)->latest()->get();

        return view('admin.AppSettingDrivers.index', compact('AppSettingDrivers'));
        //return   $AppSettingDriver;
    }
##################################==creat==###############################################

    public function creat (){
        if(!checkPermission(20))
            return view('admin.permission.index');
        $AppSettingDriver=User::where('user_type',2)->active()->get();

        return view('admin.AppSettingDrivers.creat',compact('AppSettingDriver'));

    }


    ############################==store==##################################

    public function  store(AppSettingDriversRequest $request){
        if(!checkPermission(20))
            return view('admin.permission.index');
   // return $request ;
   //return $request ;
        try {

            if (!$request->has('is_confirmed'))
                $request->request->add(['is_confirmed' => 0]);
            else
                $request->request->add(['is_confirmed' => 1]);
     //return 1;



            $filePath = "";

            if ($request->has('logo')) {
                $filePath = uploadImage('driver', $request->logo);
            }
         //  return 1;



            $AppSettingDriver = User::create([
                'name' => $request->name,
                'full_name' => $request->full_name,
                'driver_name' => $request->driver_name,
                'commission' => $request->commission,
                'phone' => $request->phone,
                'is_active' => $request->is_active,
                'logo' => $filePath,
                'password' => bcrypt($request->password),
                'worker_name' => $request->worker_name,
                'user_type'=>2,
            ]);

//return 1;
            return redirect()->route('admin.AppSettingDrivers')->with(['success' => 'تم الحفظ بنجاح']);

        } catch (\Exception $ex) {
           return  $ex;
            return redirect()->route('admin.AppSettingDrivers')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);

        }

    }


############################==edit==##################################

    public function edit($id)
    {
        if(!checkPermission(20))
            return view('admin.permission.index');
        //return 1;
        try {


            $AppSettingDriver = User::Selection()->find($id);
            if (!$AppSettingDriver)
                return redirect()->route('admin.AppSettingDrivers')->with(['error' => 'هذا السائق غير موجود او ربما يكون محذوفا ']);


            //  return  1;
            return view('admin.AppSettingDrivers.edit', compact('AppSettingDriver'));

        } catch (\Exception $exception) {
            return $exception;
            return redirect()->route('admin.AppSettingDrivers')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }



    public function update($id ,AppSettingDriversRequest $request){
     //   return 1;
        if(!checkPermission(20))
            return view('admin.permission.index');
        try {

          $AppSettingDriver = User::Selection()->find($id);
            //if (!$AppSettingDriver)
                //return redirect()->route('admin.AppSettingDrivers')->with(['error' => 'هذا السائق غير موجود او ربما يكون محذوفا ']);


            DB::beginTransaction();
         //   return 1;
            //photo
            if ($request->has('logo') ) {
                $filePath = uploadImage('driver', $request->logo);
            //    return 1;
                User::where('id', $id)
                    ->update([
                        'logo' => $filePath,
                    ]);
            }
            //return 1;

////////////////////////////////////////////////////////////////////////////
            if (!$request->has('is_confirmed'))
                $request->request->add(['is_confirmed' => 0]);
            else
                $request->request->add(['is_confirmed' => 1]);
            //////////////////////////////////////////////////////////////////////////////////////////
//return 1;
            $data = $request->except('_token', 'id','user_type');
          //  return 1;
            if ($request->has('password') && !is_null($request-> password)) {

                $data['password'] = $request->password;
            }
          //  return 1;
            User::where('id', $id)
                ->update(
                    $data
                );
           // return 1;
////////////////////////////////////////////////////////////////////////////////////////
            DB::commit();
            return redirect()->route('admin.AppSettingDrivers')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $exception) {
            return $exception;
            DB::rollback();
            return redirect()->route('admin.AppSettingDrivers')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }





    ###################################==destroy==############################################
    public function destroy($id){
        if(!checkPermission(20))
            return view('admin.permission.index');
        try {


            $AppSettingDriver=User::find($id);
            if (!$AppSettingDriver)
                return redirect()->route('admin.AppSettingDrivers')->with(['error' => 'هذا السائق غير موجود ']);

            /////////////////// delete photo from folder///////
         //   return 1;

            $path = parse_url(  $AppSettingDriver->logo);

            File::delete(public_path($path['path']));


//return 1;


            $AppSettingDriver->delete();
            return redirect()->route('admin.AppSettingDrivers')->with(['success' => 'تم حذف السائق بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.AppSettingDrivers')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
    ###################################== order_amount==#####################################
    /////////////////////////////////////////////////////////////////////////////////////////
    public function order_amount(Request $request){
        if(!checkPermission(20))
            return view('admin.permission.index');
        $rules=[
            'driver_id' => ['required','integer',Rule::exists('users','id')->where('user_type',2)],
            'month' => 'required',

        ];

        $validate=Validator::make(request()->all(),$rules,['digits_between'=>'the phone number must be number and no + in it']);

        if($validate->fails()){

            return response(['message'=>'this is the all errors','errors'=>$validate->messages()],422);

        }
        $fromDate = date('Y-m-d',strtotime($request->from));


        $toDate = date('Y-m-d',strtotime($request->to));

        $willBackData = [];



        $orders = Order::where('driver_id',$request->driver_id)
            ->whereNotIn('service_id',[79])
            ->whereDate('created_at', '>=' ,$fromDate)
            ->whereDate('created_at', '<=' ,$toDate)
            ->selectRaw('service_id, count(*) as count_of_orders')
            ->groupBy('service_id')->with('service');

        $willBackData['polishing'] = 0;
        $willBackData['wash'] = 0;
        $willBackData['sterilization'] = 0;
        $willBackData['subscription'] = 0;
        $willBackData['total_orders'] = $orders->count();
        $willBackData['commissions'] = $orders->sum('commission_value');


        foreach($orders->get() as $order){
            if ($order->service_id == 1){
                $willBackData['wash'] = $order->count_of_orders;
            }
            if ($order->service_id == 2){
                $willBackData['polishing'] = $order->count_of_orders;
            }
            if ($order->service_id == 77){
                $willBackData['subscription'] = $order->count_of_orders;
            }
            if ($order->service_id == 78){
                $willBackData['sterilization'] = $order->count_of_orders;
            }
        }



        return  response(['data'=>$willBackData]);


//        $data = Order::where('driver_id',$request->driver_id)
    }//end fun


    ###################################== order_review==#####################################
    /////////////////////////////////////////////////////////////////////////////////////////
    public function order_review(Request $request){
        if(!checkPermission(20))
            return view('admin.permission.index');
        $rules=[
            'driver_id' => ['required','integer',Rule::exists('users','id')->where('user_type',2)],
            'month' => 'required',

        ];

        $validate=Validator::make(request()->all(),$rules,['digits_between'=>'the phone number must be number and no + in it']);

        if($validate->fails()){

            return response(['message'=>'this is the all errors','errors'=>$validate->messages()],422);

        }
        $fromDate = date('Y-m-d',strtotime($request->from));


        $toDate = date('Y-m-t',strtotime($request->to));




        $averages = Order::where('driver_id',$request->driver_id)
            ->where('rating','!=','')
            ->whereDate('created_at', '>=' ,$fromDate)
            ->whereDate('created_at', '<=' ,$toDate)
            ->selectRaw('rating, count(*) as count_of_orders')
            ->selectRaw('commission_value, sum(commission_value) as sum_of_commission')
            ->groupBy('rating')->get();


        return  response()->json(['data'=>$averages]);


//        $data = Order::where('driver_id',$request->driver_id)
    }//end fun






//    public function edit($id)
//    {
//        if(!checkPermission(20))
//            return view('admin.permission.index');
//        //return 1;
//        try {
//
//            $AppSettingDriver = User::Selection()->find($id);
//            if (!$AppSettingDriver)
//                return redirect()->route('admin.AppSettingDrivers')->with(['error' => 'هذا السائق غير موجود او ربما يكون محذوفا ']);
//
//
//            //  return  1;
//            return view('admin.AppSettingDrivers.edit', compact('AppSettingDriver'));
//
//        } catch (\Exception $exception) {
//            return redirect()->route('admin.AppSettingDrivers')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
//        }
//    }

//
//
//    public function update($id ,AppSettingDriversRequest $request){
//     //   return 1;
//        if(!checkPermission(20))
//            return view('admin.permission.index');
//
//        try {
//
//          $AppSettingDriver = User::Selection()->find($id);
//            //if (!$AppSettingDriver)
//                //return redirect()->route('admin.AppSettingDrivers')->with(['error' => 'هذا السائق غير موجود او ربما يكون محذوفا ']);
//
//
//            DB::beginTransaction();
//         //   return 1;
//            //photo
//            if ($request->has('logo') ) {
//                $filePath = uploadImage('driver', $request->logo);
//            //    return 1;
//                User::where('id', $id)
//                    ->update([
//                        'logo' => $filePath,
//                    ]);
//            }
//            //return 1;
//
//////////////////////////////////////////////////////////////////////////////
//            if (!$request->has('is_confirmed'))
//                $request->request->add(['is_confirmed' => 0]);
//            else
//                $request->request->add(['is_confirmed' => 1]);
//            //////////////////////////////////////////////////////////////////////////////////////////
////return 1;
//            $data = $request->except('_token', 'id','user_type');
//          //  return 1;
//            if ($request->has('password') && !is_null($request-> password)) {
//
//                $data['password'] = $request->password;
//            }
//          //  return 1;
//            User::where('id', $id)
//                ->update(
//                    $data
//                );
//           // return 1;
//////////////////////////////////////////////////////////////////////////////////////////
//            DB::commit();
//            return redirect()->route('admin.AppSettingDrivers')->with(['success' => 'تم التحديث بنجاح']);
//        } catch (\Exception $exception) {
//            return $exception;
//            DB::rollback();
//            return redirect()->route('admin.AppSettingDrivers')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
//        }
//
//    }
//
//
//
//
//
//    ###################################==destroy==############################################
//    public function destroy($id){
//        if(!checkPermission(20))
//            return view('admin.permission.index');
//        try {
//
//
//            $AppSettingDriver=User::find($id);
//            if (!$AppSettingDriver)
//                return redirect()->route('admin.AppSettingDrivers')->with(['error' => 'هذا السائق غير موجود ']);
//
//            /////////////////// delete photo from folder///////
//         //   return 1;
//
//            $path = parse_url(  $AppSettingDriver->logo);
//
//            File::delete(public_path($path['path']));
//
//
////return 1;
//
//
//            $AppSettingDriver->delete();
//            return redirect()->route('admin.AppSettingDrivers')->with(['success' => 'تم حذف السائق بنجاح']);
//
//        } catch (\Exception $ex) {
//            return redirect()->route('admin.AppSettingDrivers')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
//        }
//    }



            public function driverDetails(Request $request){
                $driver=User::find($request->id);
                if($driver==null)
                    return response()->json(['status'=>false]);
                $normal=Order::where('service_id',1)->where('driver_id',$request->id)->count();
                $polishing=Order::where('service_id',2)->where('driver_id',$request->id)->count();
                $subscription=Order::where('service_id',77)->where('driver_id',$request->id)->count();
                $disinfect=Order::where('service_id',78)->where('driver_id',$request->id)->count();
                $sendService=Order::where('service_id',1)->where('driver_id',$request->id)->count();
                $totalOrder=Order::where('driver_id',$request->id)->count();
                $commission=Order::where('driver_id',$request->id)->sum('commission_value');
                 $order_4x=Order::where('driver_id',$request->id)->where('rating',4)->count();
                $commission_4x=Order::where('driver_id',$request->id)->where('rating',4)->sum('commission_value');
                $order_5x=Order::where('driver_id',$request->id)->where('rating',5)->count();
                $commission_5x=Order::where('driver_id',$request->id)->where('rating',5)->sum('commission_value');

                $x1=Order::where('driver_id',$request->id)->where('rating',1)->count();
                $x2=Order::where('driver_id',$request->id)->where('rating',2)->count();
                $x3=Order::where('driver_id',$request->id)->where('rating',3)->count();
                $x4=Order::where('driver_id',$request->id)->where('rating',4)->count();
                $x5=Order::where('driver_id',$request->id)->where('rating',5)->count();

                $px1=$x1/$totalOrder??0;
                $px2=$x2/$totalOrder??0;
                $px3=$x3/$totalOrder??0;
                $px4=$x4/$totalOrder??0;
                $px5=$x5/$totalOrder??0;


                return response()->json(['status'=>true,'normal'=>$normal,'polishing'=>$polishing,
                    'subscription'=>$subscription,'disinfect'=>$disinfect,'sendService'=>$sendService,
                    'totalOrder'=>$totalOrder,'commission'=>$commission,'order_4x'=>$order_4x,
                    'commission_4x'=>$commission_4x,'order_5x'=>$order_5x,'commission_5x'=>$commission_5x,
                    'x1'=>$x1,'x2'=>$x2,'x3'=>$x3,'x4'=>$x4,'x5'=>$x5,
                    'px1'=>$px1,'px2'=>$px2,'px3'=>$px3,'px4'=>$px4,'px5'=>$px5,'driver'=>$driver
                ]);






            }


            public function driverDetailsByDate(Request $request){
                $toDate = date("Y-m-d ");
                $fromDate=$request->date;
                $betweenDate = [$fromDate, $toDate];
                // $orders=Or::whereBetween('date',$betweenDate)->paginate(10);
                $driver=User::find($request->id);
                if($driver==null)
                    return response()->json(['status'=>false]);
                $normal=Order::whereBetween('date',$betweenDate)->where('service_id',1)->where('driver_id',$request->id)->count();
                $polishing=Order::whereBetween('date',$betweenDate)->where('service_id',2)->where('driver_id',$request->id)->count();
                $subscription=Order::whereBetween('date',$betweenDate)->where('service_id',77)->where('driver_id',$request->id)->count();
                $disinfect=Order::whereBetween('date',$betweenDate)->where('service_id',78)->where('driver_id',$request->id)->count();
                $sendService=Order::whereBetween('date',$betweenDate)->where('service_id',1)->where('driver_id',$request->id)->count();
                $totalOrder=Order::whereBetween('date',$betweenDate)->where('driver_id',$request->id)->count();
                $commission=Order::whereBetween('date',$betweenDate)->where('driver_id',$request->id)->sum('commission_value');
                $order_4x=Order::whereBetween('date',$betweenDate)->where('driver_id',$request->id)->where('rating',4)->count();
                $commission_4x=Order::whereBetween('date',$betweenDate)->where('driver_id',$request->id)->where('rating',4)->sum('commission_value');
                $order_5x=Order::whereBetween('date',$betweenDate)->where('driver_id',$request->id)->where('rating',5)->count();
                $commission_5x=Order::whereBetween('date',$betweenDate)->where('driver_id',$request->id)->where('rating',5)->sum('commission_value');

                $x1=Order::whereBetween('date',$betweenDate)->where('driver_id',$request->id)->where('rating',1)->count();
                $x2=Order::whereBetween('date',$betweenDate)->where('driver_id',$request->id)->where('rating',2)->count();
                $x3=Order::whereBetween('date',$betweenDate)->where('driver_id',$request->id)->where('rating',3)->count();
                $x4=Order::whereBetween('date',$betweenDate)->where('driver_id',$request->id)->where('rating',4)->count();
                $x5=Order::whereBetween('date',$betweenDate)->where('driver_id',$request->id)->where('rating',5)->count();
                $px1=0;$px2=0;$px3=0;$px4=0;$px5=0;

                if($totalOrder==0)
                {
                    $px1=0;$px2=0;$px3=0;$px4=0;$px5=0;
                }
                else
                {
                $px1=$x1/$totalOrder??1;
                $px2=$x2/$totalOrder??1;
                $px3=$x3/$totalOrder??1;
                $px4=$x4/$totalOrder??1;
                $px5=$x5/$totalOrder??1;
                }

                return response()->json(['status'=>true,'normal'=>$normal,'polishing'=>$polishing,
                    'subscription'=>$subscription,'disinfect'=>$disinfect,'sendService'=>$sendService,
                    'totalOrder'=>$totalOrder,'commission'=>$commission,'order_4x'=>$order_4x,
                    'commission_4x'=>$commission_4x,'order_5x'=>$order_5x,'commission_5x'=>$commission_5x,
                    'x1'=>$x1,'x2'=>$x2,'x3'=>$x3,'x4'=>$x4,'x5'=>$x5,
                    'px1'=>$px1,'px2'=>$px2,'px3'=>$px3,'px4'=>$px4,'px5'=>$px5,'driver'=>$driver
                ]);




            }

}

