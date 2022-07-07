<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SentServicesRequest;
use App\Models\CarType;
use App\Models\Order;

use App\Models\Place;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SentServicesController extends Controller
{

    public function index(Request $request)
    {
        if(!checkPermission(6))
            return view('admin.permission.index');

        $from = date('Y-m').'-01';
        $to = date('Y-m-t');
        if ($request->has('month')){
            $from = date('Y-m',strtotime($request->month.'-01')).'-01';
            $to = date('Y-m-t',strtotime($request->month.'-01'));
        }

        $betweenMonth = [$from,$to];

        $orders = Order::where('service_id',79)->whereBetween('date',$betweenMonth)
            ->with('user','from_user','service','type')->latest()->get();
//        return $orders;

        $orders =Order::paginate(10);

        $places = Place::get();
        $carTypes = CarType::with('sub_types')->where('level', 1)->get();
        $services = Service::where('level', 1)->get();
        $array = compact('orders','places', 'carTypes', 'services','request');
        return view('admin.sent_services.index', compact('orders','places', 'carTypes', 'services','request'));


    }






    public function store( SentServicesRequest $request)

    {
        if(!checkPermission(6))
            return view('admin.permission.index');
      //  return $request;
        if (!$request->has('status'))
            $request->request->add(['status' => 0]);
        else
            $request->request->add(['status' => 1]);

        $filePath = "";

        if ($request->has('logo')) {
            $filePath = uploadImage('logo', $request->logo);
        }






//
//
        // return 1;
        $orders = Order::create([
            'date' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'status' => $request->status,
            'address' => $request->address,
            'logo' => $filePath,
            'password' => bcrypt($request->password),
            'category_id' => $request->category_id,

        ]);
        //return 1;
        //Notification::send($vendor, new VendorCreated($vendor));



        // File upload location


        //return 1;

        return redirect()->route('admin.Vendors')->with(['success' => 'تم الحفظ بنجاح']);

        //  } catch (\Exception $ex) {
        // return $ex;
        return redirect()->route('admin.Vendors')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);

        //      }

    }







}
