<?php

namespace App\Http\Controllers\Admin;

use App\OrderLimit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class AdminDailyOrderCountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderCounts=OrderLimit::orderBy('created_at','desc')->get();
        return view('admin.order-counts.index')->with(['orderCounts'=>$orderCounts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.order-counts.create');
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
            'date' => 'required',
            'service_1' => 'required|min:1',
            'service_2' => 'required|min:1',

        ]);
        $date=OrderLimit::where('date',strtotime($request->date))
            ->first();
        if ($date){
            toastr()->error(trans('main.Message_fail'),'هذا التاريخ تم تسجيله من قبل');
            return back();
        }

        $orderLimit=new OrderLimit();
        $orderLimit->date=strtotime($request->date);
        $orderLimit->service_1=$request->service_1;
        $orderLimit->service_2=$request->service_2;
        $orderLimit->save();
        toastr()->success(trans('main.Message_success'), trans('main.Message_title_congratulation'));

        return redirect(route('order-counts.index'));

    }//end

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
        $orderCount=OrderLimit::find($id);
        return view('admin.order-counts.edit')->with(['order_count'=>$orderCount]);
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
            'service_1' => 'required|min:1',
            'service_2' => 'required|min:1',

        ]);

        $orderLimit=OrderLimit::find($id);
        $orderLimit->service_1=$request->service_1;
        $orderLimit->service_2=$request->service_2;

        $orderLimit->save();
        toastr()->success(trans('main.Message_success'), trans('main.Message_title_congratulation'));

        return redirect(route('order-counts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {


    }

}//end class
