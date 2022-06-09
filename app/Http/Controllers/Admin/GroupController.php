<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Day;
use App\Models\Period;
use App\Models\Place;
use Illuminate\Http\Request;
use App\Models\Group;
class GroupController extends Controller
{
    //
    public  function index(){
       $groups=Group::get();
       $places=Place::with('group','payments')->get();
        return view('admin.home.group.index',compact('groups','places'));


    }
    public  function  createregion()
    {
        return view('admin.home.group.create');

    }
    public function addregion(Request $request){

        $validator=\Validator::make($request->all(),
            [
                'name'=>'required|string',


            ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Group::create(['name'=>$request->name]);
        return redirect()->route('groups.index');

    }

    public function  editregion($id)
    {
        $group=Group::find($id);
        return view('admin.home.group.update',compact('group'));

    }
    public function updateregion($id,Request $request){

        $validator=\Validator::make($request->all(),
            [
                'name'=>'required|string',


            ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

      $group=Group::find($id);
        $group->update(['name'=>$request->name]);
        return redirect()->route('groups.index');


    }
     public function getregiondetails($id){
        $group=Group::find($id);
         $places=Place::with('group','payments')->where('group_id',$id)->get();
         $days=Day::get();
         $periods=Period::get();
         return view('admin.home.group.details',compact('group','places','days','periods'));


     }
}
