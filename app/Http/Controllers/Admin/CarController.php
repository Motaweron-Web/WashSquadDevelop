<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarSize;
use App\Models\CarType;
use Illuminate\Http\Request;

class CarController extends Controller
{
    //
    public  function getcartype(){
        if(!checkPermission(23))
            return view('admin.permission.index');
         $cartypes=CarType::where('level',1)->paginate(15);
        return view('admin.home.car.main',compact('cartypes'));
    }
    public function createmaincar()
    {
        if(!checkPermission(23))
            return view('admin.permission.index');
        return view('admin.home.car.create');

    }
    public function addmaincar(Request $request){
        if(!checkPermission(23))
            return view('admin.permission.index');
        $validator=\Validator::make($request->all(),
            [
                'ar_title'=>'required|string',
                'en_title'=>'required|string',

            ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        CarType::create([
            'ar_title'=>$request->ar_title,
            'en_title'=>$request->en_title,
            'level'=>1,
            'parent_id'=>0,
            'size'=>0
        ]);
        return redirect()->route('getcartype')->with('message','تمة الاضافة بنجاح');
    }
    public function editmaincar($id){
        $car=CarType::find($id);

        return view('admin.home.car.update',compact('car'));

    }
    public function updatemaincar($id,Request $request){
        if(!checkPermission(23))
            return view('admin.permission.index');
        $validator=\Validator::make($request->all(),
            [
                'ar_title'=>'required|string',
                'en_title'=>'required|string',

            ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $car=CarType::find($id);
        $car->update([
            'ar_title'=>$request->ar_title,
            'en_title'=>$request->en_title,
        ]);
        return redirect()->route('getcartype')->with('message','تم التعديل بنجاح');

    }
    public function deletemaincar(Request $request){
        $car=CarType::find($request->id);
        if($car==null)
            return response()->json(['status'=>false]);
        $car->delete();
        return response()->json(['status'=>true]);

    }



    public function getsubcartype(){
        if(!checkPermission(24))
            return view('admin.permission.index');
        $cartypes=CarType::with('parent')->where('level',2)->paginate(15);
        return view('admin.home.car.sub.index',compact('cartypes'));
    }


    public function createsubtypecar(){
        if(!checkPermission(24))
            return view('admin.permission.index');
        $maincars=CarType::where('level',1)->get();
      $sizes=CarSize::get();
        return view('admin.home.car.sub.create',compact('maincars','sizes'));

    }

    public function addsubtypecar(Request $request){
        if(!checkPermission(24))
            return view('admin.permission.index');
        $validator=\Validator::make($request->all(),
            [
                'ar_title'=>'required|string',
                'en_title'=>'required|string',
                'parent_id'=>'required',
                'size'=>'required',
            ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        CarType::create([
            'ar_title'=>$request->ar_title,
            'en_title'=>$request->en_title,
            'level'=>2,
            'parent_id'=>$request->parent_id,
            'size'=>$request->size
        ]);
        return redirect()->route('getsubcartype')->with('message','تمة الاضافة بنجاح');

    }
  public function  editsubcar($id){
      if(!checkPermission(24))
          return view('admin.permission.index');
        $car=CarType::find($id);
      $maincars=CarType::where('level',1)->get();
      $sizes=CarSize::get();
      return view('admin.home.car.sub.update',compact('maincars','sizes','car'));

  }
  public function updatesubcar($id,Request $request){
      if(!checkPermission(24))
          return view('admin.permission.index');
      $validator=\Validator::make($request->all(),
          [
              'ar_title'=>'required|string',
              'en_title'=>'required|string',
              'parent_id'=>'required',
              'size'=>'required',
          ]);
      if ($validator->fails()) {
          return redirect()->back()
              ->withErrors($validator)
              ->withInput();
      }
      $car=CarType::find($id);
      $car->update([
          'ar_title'=>$request->ar_title,
          'en_title'=>$request->en_title,
          'level'=>2,
          'parent_id'=>$request->parent_id,
          'size'=>$request->size
      ]);
      return redirect()->route('getsubcartype')->with('message','نم التعديل بنجاح');
  }
}
