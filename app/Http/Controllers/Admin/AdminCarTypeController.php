<?php

namespace App\Http\Controllers\Admin;

use App\CarType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminCarTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carTypes=CarType::where('level',1)->get();
        return view('admin.car-types.index')->with(['carTypes'=>$carTypes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.car-types.create');

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

        ]);

        $carType=new CarType();
        $carType->en_title=$request->en_title;
        $carType->ar_title=$request->ar_title;



        $carType->save();
        toastr()->success(trans('main.Message_success'), trans('main.Message_title_congratulation'));

        return redirect(route('carTypes.index'));
    }//end fun

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
        $carType=CarType::find($id);
        return view('admin.car-types.edit')->with(['carType'=>$carType]);
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

        ]);

        $carType=CarType::find($id);
        $carType->en_title=$request->en_title;
        $carType->ar_title=$request->ar_title;



        $carType->save();
        toastr()->success(trans('main.Message_success'), trans('main.Message_title_congratulation'));

        return redirect(route('carTypes.index'));
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

        $subs= CarType::where('parent_id',$request->id)->get();
        if ($subs->count()!=0)
        {
            foreach ($subs as $sub){

                CarType::destroy($sub->id);

            }
        }

        $good= CarType::destroy($request->id);
        if ($good)
            return response(['error'=>0]);
        else
            return response(['error'=>1]);

    }
}
