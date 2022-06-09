<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MonthService;


class AdminMonthlyServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderCounts=MonthService::orderBy('created_at','desc')->get();
        return view('admin.monthlyServices.index')->with(['orderCounts'=>$orderCounts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.monthlyServices.create');
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
        $date=MonthService::where('date',strtotime($request->date))
            ->first();
        if ($date){
            toastr()->error(trans('main.Message_fail'),'هذا التاريخ تم تسجيله من قبل');
            return back();
        }

        $orderLimit=new MonthService();
        $orderLimit->date=strtotime($request->date);
        $orderLimit->service_1=$request->service_1;
        $orderLimit->service_2=$request->service_2;
        $orderLimit->save();
        toastr()->success(trans('main.Message_success'), trans('main.Message_title_congratulation'));

        return redirect(route('order-monthly.index'));

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
        $orderCount=MonthService::find($id);
        return view('admin.monthlyServices.edit')->with(['order_count'=>$orderCount]);
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

        $orderLimit=MonthService::findOrFail($id);
        $orderLimit->service_1=$request->service_1;
        $orderLimit->service_2=$request->service_2;

        $orderLimit->save();
        toastr()->success(trans('main.Message_success'), trans('main.Message_title_congratulation'));

        return redirect(route('order-monthly.index'));
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
}
