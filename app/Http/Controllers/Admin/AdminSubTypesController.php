<?php

namespace App\Http\Controllers\Admin;

use App\CarType;
use function Couchbase\defaultDecoder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CarSize;

class AdminSubTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carTypes=CarType::where('level',2)->get();
        return view('admin.car-types-level2.index')->with(['carTypes'=>$carTypes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $carTypes=CarType::where('level',1)->get();
        $sizes=CarSize::all();
        return view('admin.car-types-level2.create')->with(['carTypes'=>$carTypes,'sizes'=>$sizes]);

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
            'parent_id'=>'required',
            'size_id'=>'required'

        ]);

        $carType=new CarType();
        $carType->en_title=$request->en_title;
        $carType->ar_title=$request->ar_title;
        $carType->parent_id=$request->parent_id;
        $carType->level=2;
        $carType->size=$request->size_id;



        $carType->save();
        toastr()->success(trans('main.Message_success'), trans('main.Message_title_congratulation'));

        return redirect(route('subCarTypes.index'));
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

        $carType=CarType::find($id);
        $carType_parent=CarType::find($carType->parent_id);
        $carTypeLevel1=CarType::where('level',1)->where('id','!=',$carType->parent_id)->get();

        $my_size=CarSize::find($carType->size);

        $sizes=CarSize::where('id','!=',$carType->size)->get();
        return view('admin.car-types-level2.edit')->with(['carType'=>$carType,'carTypeLevel1'=>$carTypeLevel1,'carType_parent'=>$carType_parent,'my_size'=>$my_size,'sizes'=>$sizes]);
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
            'parent_id' => 'required',
            'size_id' => 'required',


        ]);

        $carType=CarType::find($id);
        $carType->en_title=$request->en_title;
        $carType->ar_title=$request->ar_title;
        $carType->parent_id=$request->parent_id;
        $carType->size=$request->size_id;

        $carType->save();
        toastr()->success(trans('main.Message_success'), trans('main.Message_title_congratulation'));

        return redirect(route('subCarTypes.index'));
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

        $good= CarType::destroy($request->id);
        if ($good)
            return response(['error'=>0]);
        else
            return response(['error'=>1]);

    }
}
