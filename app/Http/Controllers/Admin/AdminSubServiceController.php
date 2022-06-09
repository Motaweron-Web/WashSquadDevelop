<?php

namespace App\Http\Controllers\Admin;

use App\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class AdminSubServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services=Service::where('level',3)->get();
        return view('admin.subsubservices.index')->with(['services'=>$services]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $service_all=Service::where('level',1)->get();

        return view('admin.subsubservices.create')->with(['parents'=>$service_all]);

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
            'en_des' => 'required|string',
            'ar_des' => 'required|string',
            /*'price' => 'required|min:1',*/
            'image' => 'required|image|mimes:jpeg,jpg,png,gif',
            'parent_id' => 'required',

        ]);

        $service=new Service();
        $service->en_title=$request->en_title;
        $service->ar_title=$request->ar_title;

        $service->en_des=$request->en_des;
        $service->ar_des=$request->ar_des;
        /* $service->price=$request->price;*/
        $service->price=0;
        $service->parent_id=$request->parent_id;
        $service->level=3;

        if ($request->image){

            $image = $request->file('image');
            $imageName = time() . '.' .\request('image')->getClientOriginalExtension();
            $service->image = 'services/'.$imageName;
            $image->move('upload/services', $imageName);
        }


        $service->save();
        toastr()->success(trans('main.Message_success'), trans('main.Message_title_congratulation'));

        return redirect(route('subServices.index'));
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
        $service=Service::find($id);
        $service_all=Service::where('level',2)->where('id','!=',$service->parent_id)->get();
        $service_spacial=Service::where('id',$service->parent_id)->first();

        return view('admin.subsubservices.edit')->with(['service'=>$service,'parent_service'=>$service_spacial,'parents'=>$service_all]);
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
            'en_des' => 'required|string',
            'ar_des' => 'required|string',
            /*'price' => 'required|min:1',*/
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif',
            'parent_id' => 'required',

        ]);

        $service=Service::find($id);
        $service->en_title=$request->en_title;
        $service->ar_title=$request->ar_title;
        $service->en_des=$request->en_des;
        $service->ar_des=$request->ar_des;
        /* $service->price=$request->price;*/
        $service->price=0;
        $service->parent_id=$request->parent_id;


        if ($request->image){

            $imageName = url("upload/{$service->image}"); // get previous image from folder
            if (File::exists($imageName)) { // unlink or remove previous image from folder
                unlink($imageName);
            }
            $image = $request->file('image');
            $imageName = time() . '.' .\request('image')->getClientOriginalExtension();
            $service->image = 'services/'.$imageName;
            $image->move('upload/services', $imageName);
        }


        $service->save();
        toastr()->success(trans('main.Message_success'), trans('main.Message_title_congratulation'));

        return redirect(route('subsubservices.index'));
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

        $good= Service::destroy($request->id);
        if ($good)
            return response(['error'=>0]);
        else
            return response(['error'=>1]);

    }
}
