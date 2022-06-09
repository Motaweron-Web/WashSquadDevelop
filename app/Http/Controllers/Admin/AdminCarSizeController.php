<?php

namespace App\Http\Controllers\Admin;

use App\CarSize;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class AdminCarSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carSizes=CarSize::all();
        return view('admin.car-sizes.index')->with(['carSizes'=>$carSizes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.car-sizes.create');

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
            /*'price' => 'required|min:1',*/
            'image' => 'required|image|mimes:jpeg,jpg,png,gif',

        ]);

        $carSize=new CarSize();
        $carSize->en_title=$request->en_title;
        $carSize->ar_title=$request->ar_title;
        $carSize->price=0;
       /* $carSize->price=$request->price;*/

        if ($request->image){

            $image = $request->file('image');
            $imageName = time() . '.' .\request('image')->getClientOriginalExtension();
            $carSize->image = 'services/'.$imageName;
            $image->move('upload/services', $imageName);
        }

        $carSize->save();
        toastr()->success(trans('main.Message_success'), trans('main.Message_title_congratulation'));

        return redirect(route('carSizes.index'));
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
        $carSize=CarSize::find($id);
        return view('admin.car-sizes.edit')->with(['carSize'=>$carSize]);
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
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif',
            /*'price' => 'required|min:1',*/


        ]);

        $carSize=CarSize::find($id);
        $carSize->en_title=$request->en_title;
        $carSize->ar_title=$request->ar_title;
        $carSize->price=0;
        /* $carSize->price=$request->price;*/

        if ($request->image){

            $imageName = url("upload/{$carSize->image}"); // get previous image from folder
            if (File::exists($imageName)) { // unlink or remove previous image from folder
                unlink($imageName);
            }
            $image = $request->file('image');
            $imageName = time() . '.' .\request('image')->getClientOriginalExtension();
            $carSize->image = 'services/'.$imageName;
            $image->move('upload/services', $imageName);
        }




        $carSize->save();
        toastr()->success(trans('main.Message_success'), trans('main.Message_title_congratulation'));

        return redirect(route('carSizes.index'));
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
        $carSize=CarSize::find($request->id);
        if ($carSize){
            $imageName = url("upload/{$carSize->image}"); // get previous image from folder
            if (File::exists($imageName)) { // unlink or remove previous image from folder
                unlink($imageName);
            }

        }

        $good= CarSize::destroy($request->id);
        if ($good)
            return response(['error'=>0]);
        else
            return response(['error'=>1]);

    }
}
