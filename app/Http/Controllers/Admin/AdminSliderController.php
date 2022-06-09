<?php

namespace App\Http\Controllers\Admin;

use App\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class AdminSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders=Slider::all();
        return view('admin.slider.index')->with(['sliders'=>$sliders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
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
            'en_title' => 'nullable|string',
            'ar_title' => 'nullable|string',
            'ar_description' => 'nullable|string',
            'en_description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,jpg,png,gif',

        ]);

        $slider=new Slider();
        $slider->en_title=$request->en_title;
        $slider->ar_title=$request->ar_title;
        $slider->en_description=$request->en_description;
        $slider->ar_description=$request->ar_description;

        if ($request->image){


            $image = $request->file('image');
            $imageName = time() . '.' .\request('image')->getClientOriginalExtension();
            $slider->image = 'slider/'.$imageName;
            $image->move('upload/slider', $imageName);
        }

        $slider->save();
        toastr()->success(trans('main.Message_success'), trans('main.Message_title_congratulation'));

        return redirect(route('sliders.index'));

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
        //
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
        //
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
        $slider=Slider::find($request->id);
        if ($slider){
            $imageName = url("upload/{$slider->image}"); // get previous image from folder
            if (File::exists($imageName)) { // unlink or remove previous image from folder
                unlink($imageName);
            }

        }

        $good= Slider::destroy($request->id);
        if ($good)
            return response(['error'=>0]);
        else
            return response(['error'=>1]);

    }
}
