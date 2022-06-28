<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Payment;
use App\Models\PaymentPlace;
use App\Models\Place;
use App\Models\Service;
use App\Models\ServicePlace;
use http\Env\Response;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    //
    public  function  deleteplace(Request $request){

        $place=Place::find($request->id);
        if($place==null)
            return response()->json(['status'=>false]);
        $place->delete();
        return response()->json(['status'=>true]);
    }
    public function placechangestatus(Request $request){
        $place=Place::find($request->id);
        if($place==null)
            return response()->json(['status'=>false]);
        if($place->status==0)
        {
            $place->status=1;
            $place->save();
        }
        else{
            $place->status=0;
            $place->save();
        }
        return response()->json(['status'=>true,'st'=>$place->status]);

    }
    public function editplace($id){
        $place=Place::with('group','payments','services')->find($id);
        $payments=Payment::get();
        $services=Service::where('level',2)->get();
        return view('admin.home.group.place.update',compact('place','payments','services'));


    }
    public  function updateplace($id,Request $request){
        $validator=\Validator::make($request->all(),
            [
                'ar_name'=>'required|string',
                'en_name'=>'required|string',
                'minimum_order'=>'required|regex:/^\d+(\.\d{1,2})?$/',
                'maximum_order'=>'required|regex:/^\d+(\.\d{1,2})?$/',


            ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $place=Place::find($id);
        $data=['ar_name'=>$request->ar_name,'en_name'=>$request->en_name,'minimum_order'=>$request->minimum_order,'maximum_order'=>$request->maximum_order];
        if($request->status)
        {
            $data['status']=1;
        }
        else{
            $data['status']=0;

        }

        $place->update($data);
        if($request->payments)
        {
            PaymentPlace::where('place_id',$id)->delete();
            for($i=0;$i<count($request->payments);$i++)
            {
                PaymentPlace::create([
                    'place_id'=>$id,
                    'payment_id'=>$request->payments[$i],
                ]);
            }
        }
        else{
            PaymentPlace::where('place_id',$id)->delete();
        }

        if($request->services)
        {
            ServicePlace::where('place_id',$id)->delete();
            for($i=0;$i<count($request->services);$i++)
            {
                ServicePlace::create([
                    'place_id'=>$id,
                    'service_id'=>$request->services[$i],
                ]);
            }

        }
        else{
          ServicePlace::where('place_id',$id)->delete();
        }

   return redirect()->route('getregiondetails',$place->group_id)->with('message','تم تعديل الحي بنجاح');
    }


    public function createplcetoregion($id){

        $group=Group::find($id);
        $payments=Payment::get();
        $services=Service::where('level',2)->get();
        return view('admin.home.group.place.create',compact('group','payments','services'));


    }


  public function addplacetoregion ($groupid,Request $request){


      $validator=\Validator::make($request->all(),
          [
              'ar_name'=>'required|string',
              'en_name'=>'required|string',
              'minimum_order'=>'required|regex:/^\d+(\.\d{1,2})?$/',
              'maximum_order'=>'required|regex:/^\d+(\.\d{1,2})?$/',


          ]);
      if ($validator->fails()) {
          return redirect()->back()
              ->withErrors($validator)
              ->withInput();
      }
      $data=['ar_name'=>$request->ar_name,'en_name'=>$request->en_name,'minimum_order'=>$request->minimum_order,'maximum_order'=>$request->maximum_order,'group_id'=>$groupid];
      if($request->status)
      {
          $data['status']=1;
      }
      else{
          $data['status']=0;

      }

    $place=Place::create($data);
      if($request->payments)
      {
          PaymentPlace::where('place_id',$place->id)->delete();
          for($i=0;$i<count($request->payments);$i++)
          {
              PaymentPlace::create([
                  'place_id'=>$place->id,
                  'payment_id'=>$request->payments[$i],
              ]);
          }
      }
      else{
          PaymentPlace::where('place_id',$place->id)->delete();
      }

      if($request->services)
      {
          ServicePlace::where('place_id',$place->id)->delete();
          for($i=0;$i<count($request->services);$i++)
          {
              ServicePlace::create([
                  'place_id'=>$place->id,
                  'service_id'=>$request->services[$i],
              ]);
          }

      }
      else{
          ServicePlace::where('place_id',$place->id)->delete();
      }

      return redirect()->route('getregiondetails',$place->group_id)->with('message','تم اضاقة الحي بنجاح');

  }









}
