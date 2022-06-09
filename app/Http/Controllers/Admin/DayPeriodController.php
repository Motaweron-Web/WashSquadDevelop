<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DayGroup;
use App\Models\GroupPeriod;
use Illuminate\Http\Request;

class DayPeriodController extends Controller
{
    //
    public  function createorupdateregionperiodandday($id,Request  $request){
       if($request->days) {
           DayGroup::where('group_id',$id)->delete();
           for($i=0;$i<count($request->days);$i++){
               DayGroup::updateOrCreate([
                   'group_id'=>$id,
                   'day_id'=>$request->days[$i]
               ]);
           }
        }

        if($request->periods) {
            GroupPeriod::where('group_id',$id)->delete();
            for($i=0;$i<count($request->periods);$i++){
                GroupPeriod::updateOrCreate([
                    'group_id'=>$id,
                    'period_id'=>$request->periods[$i]
                ]);
            }
        }
       return redirect()->route('getregiondetails',$id);
    }
}
