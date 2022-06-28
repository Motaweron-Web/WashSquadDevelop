<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarSize;
use App\Models\GroupPeriod;
use App\Models\Period;
use App\Models\PeriodLimit;
use App\Models\Service;
use Illuminate\Http\Request;

class TimeController extends Controller
{
    //
    public  function index()
    {
        $periods=Period::paginate(15);
        $periodlimits=PeriodLimit::get();
        $sizes=CarSize::get();

        return view('admin.home.times.index',compact('periods','periodlimits','sizes'));

    }
    public  function  createtime(){
        $sizes=CarSize::get();
        $services=Service::where('level',1)->whereIn('id',[1,2,78])->get();
        return view('admin.home.times.create',compact('services','sizes'));

    }
    public  function addtime(Request $request){

        $ar_period_type='';
        $en_period_type='';
        if($request->timetype==1)
        {
           $ar_period_type='صباحا';
           $en_period_type='AM';
        }
        else
        {
            $ar_period_type='مساءً';
            $en_period_type='PM';
        }
        $period=Period::updateOrCreate([
            'period_title'=>$request->starttime.'-'.$request->endtime,
            'ar_period_type'=> $ar_period_type ,
            'en_period_type'=>$en_period_type,
        ]);

        PeriodLimit::where('period_id',$period->id)->delete();
        $services=Service::where('level',1)->whereIn('id',[1,78])->get();
        for($i=0;$i<count($request->servicecount);$i++)
        {
           $periodlimit= PeriodLimit::updateOrCreate(
                [
                    'service_id'=>$services[$i]->id,
                    'period_id'=>$period->id,
                    'count'=>$request->servicecount[$i],
                    'type'=>'main'
                ]
            );
        }
        for($i=0;$i<count($request->waitservicecount);$i++)
        {
            $periodlimit= PeriodLimit::updateOrCreate(
                [
                    'service_id'=>$services[$i]->id,
                    'period_id'=>$period->id,
                    'count'=>$request->waitservicecount[$i],
                    'type'=>'wait'
                ]
            );
        }


        $sizes=CarSize::get();


            for ($i = 0; $i < count($request->talmeecount); $i++) {

                $periodlimit = PeriodLimit::updateOrCreate(
                    [
                        'service_id' => 2,
                        'period_id' => $period->id,
                        'count' => $request->talmeecount[$i],
                        'type' => 'main',
                        'size_id'=>$sizes[$i]->id,
                    ]
                );
            }



            for ($i = 0; $i < count($request->waittalmeecount); $i++) {
                $periodlimit = PeriodLimit::updateOrCreate(
                    [
                        'service_id' => 2,
                        'period_id' => $period->id,
                        'count' => $request->waittalmeecount[$i],
                        'type' => 'wait',
                        'size_id'=>$sizes[$i]->id,
                    ]
                );
            }


        return redirect()->route('showperiods')->with('message','تمت اضافة الفترة بنجاح');

    }
    public  function  deletetime(Request $request){
        $period=Period::find($request->id);
        if($period==null)
        {
            return response()->json(['status'=>false]);
        }
        GroupPeriod::where('period_id',$period->id)->delete();
        PeriodLimit::where('period_id',$period->id)->delete();
        $period->delete();
        return response()->json(['status'=>true]);
    }
    public  function edittime($id)
    {
        $period=Period::with('services')->find($id);
         $periodlimits=PeriodLimit::where('period_id',$id)->get();
        $sizes=CarSize::get();
        $services=Service::where('level',1)->whereIn('id',[1,2,78])->get();
        return view('admin.home.times.update',compact('period','periodlimits','sizes','services'));

    }


    public function updatetime($id,Request $request)
    {
        PeriodLimit::where('period_id',$id)->delete();

        $ar_period_type='';
        $en_period_type='';
        if($request->timetype==1)
        {
            $ar_period_type='صباحا';
            $en_period_type='AM';
        }
        else
        {
            $ar_period_type='مساءً';
            $en_period_type='PM';
        }
        $period=Period::updateOrCreate([
            'period_title'=>$request->starttime.'-'.$request->endtime,
            'ar_period_type'=> $ar_period_type ,
            'en_period_type'=>$en_period_type,
        ]);

        PeriodLimit::where('period_id',$period->id)->delete();
        $services=Service::where('level',1)->whereIn('id',[1,78])->get();
        for($i=0;$i<count($request->servicecount);$i++)
        {
            $periodlimit= PeriodLimit::updateOrCreate(
                [
                    'service_id'=>$services[$i]->id,
                    'period_id'=>$period->id,
                    'count'=>$request->servicecount[$i],
                    'type'=>'main'
                ]
            );
        }
        for($i=0;$i<count($request->waitservicecount);$i++)
        {
            $periodlimit= PeriodLimit::updateOrCreate(
                [
                    'service_id'=>$services[$i]->id,
                    'period_id'=>$period->id,
                    'count'=>$request->waitservicecount[$i],
                    'type'=>'wait'
                ]
            );
        }


        $sizes=CarSize::get();


        for ($i = 0; $i < count($request->talmeecount); $i++) {

            $periodlimit = PeriodLimit::updateOrCreate(
                [
                    'service_id' => 2,
                    'period_id' => $period->id,
                    'count' => $request->talmeecount[$i],
                    'type' => 'main',
                    'size_id'=>$sizes[$i]->id,
                ]
            );
        }



        for ($i = 0; $i < count($request->waittalmeecount); $i++) {
            $periodlimit = PeriodLimit::updateOrCreate(
                [
                    'service_id' => 2,
                    'period_id' => $period->id,
                    'count' => $request->waittalmeecount[$i],
                    'type' => 'wait',
                    'size_id'=>$sizes[$i]->id,
                ]
            );
        }


        return redirect()->route('showperiods')->with('message','تمت تعديل الفترة بنجاح');
    }





}
