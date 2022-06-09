<?php

namespace App\Http\Controllers\Admin;

use App\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class AdminPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages=Package::all();
        return view('admin.packages.index')->with(['packages'=>$packages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.packages.create');

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
            'price' => 'required|min:1',
            'image' => 'required|image|mimes:jpeg,jpg,png,gif',

        ]);

        $package=new Package();
        $package->en_title=$request->en_title;
        $package->ar_title=$request->ar_title;
        $package->en_des=$request->en_des;
        $package->ar_des=$request->ar_des;
        $package->price=$request->price;

        if ($request->image){

            $image = $request->file('image');
            $imageName = time() . '.' .\request('image')->getClientOriginalExtension();
            $package->image = 'services/'.$imageName;
            $image->move('upload/services', $imageName);
        }

        $package->save();
        toastr()->success(trans('main.Message_success'), trans('main.Message_title_congratulation'));

        return redirect(route('packages.index'));
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
        $package=Package::find($id);
        return view('admin.packages.edit')->with(['package'=>$package]);
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
            'price' => 'required|min:1',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif',

        ]);

        $package=Package::find($id);
        $package->en_title=$request->en_title;
        $package->ar_title=$request->ar_title;
        $package->en_des=$request->en_des;
        $package->ar_des=$request->ar_des;
        $package->price=$request->price;
/*        $package->serial_numbe=$request->serial_numbe;*/



        if ($request->image){

            $imageName = url("upload/{$package->image}"); // get previous image from folder
            if (File::exists($imageName)) { // unlink or remove previous image from folder
                unlink($imageName);
            }
            $image = $request->file('image');
            $imageName = time() . '.' .\request('image')->getClientOriginalExtension();
            $package->image = 'services/'.$imageName;
            $image->move('upload/services', $imageName);
        }




        $package->save();
        toastr()->success(trans('main.Message_success'), trans('main.Message_title_congratulation'));

        return redirect(route('packages.index'));
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
        $package=Package::find($request->id);
        if ($package){
            $imageName = url("upload/{$package->image}"); // get previous image from folder
            if (File::exists($imageName)) { // unlink or remove previous image from folder
                unlink($imageName);
            }

        }

        $good= Package::destroy($request->id);
        if ($good)
            return response(['error'=>0]);
        else
            return response(['error'=>1]);

    }
}
