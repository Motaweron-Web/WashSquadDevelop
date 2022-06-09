<?php

namespace App\Http\Controllers\Admin;

use App\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class AdminServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services=Service::where('level',1)->get();
        return view('admin.services.index')->with(['services'=>$services]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.services.create');

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
           /* 'price' => 'required|min:1',*/
            'image' => 'required|image|mimes:jpeg,jpg,png,gif',

        ]);

        $service=new Service();
        $service->en_title=$request->en_title;
        $service->ar_title=$request->ar_title;

        $service->en_des=$request->en_des;
        $service->ar_des=$request->ar_des;
       /* $service->price=$request->price;*/
        $service->price=0;
        $service->parent_id=0;
        $service->level=1;

        if ($request->image){

            $image = $request->file('image');
            $imageName = time() . '.' .\request('image')->getClientOriginalExtension();
            $service->image = 'services/'.$imageName;
            $image->move('upload/services', $imageName);
        }


        $service->save();
        toastr()->success(trans('main.Message_success'), trans('main.Message_title_congratulation'));

        return redirect(route('services.index'));
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
        return view('admin.services.edit')->with(['service'=>$service]);
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
        ]);

        $service=Service::find($id);
        $service->en_title=$request->en_title;
        $service->ar_title=$request->ar_title;
        $service->en_des=$request->en_des;
        $service->ar_des=$request->ar_des;
       /* $service->price=$request->price;*/
        $service->price=0;

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

        return redirect(route('services.index'));
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

        $services_suns=Service::where('parent_id',$request->id)->get();
        foreach ($services_suns as $services_sun){
            $services_sun_suns=Service::where('parent_id',$services_sun->id)->get();

            if ($services_sun_suns->count()>0){
                foreach ($services_sun_suns as $services_sun_sun) {
                    Service::destroy($services_sun_sun->id);
                    }
            }
            Service::destroy($services_sun->id);

        }

        $good= Service::destroy($request->id);
        if ($good)
            return response(['error'=>0]);
        else
            return response(['error'=>1]);

    }//end fun
}//end class
