<?php

namespace App\Http\Controllers\Admin;

use App\CancelReason;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminCancelReasonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cancels=CancelReason::all();
        return view('admin.cancels.index')->with(['cancels'=>$cancels]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cancels.create');

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

        $cancel=new CancelReason();
        $cancel->en_title=$request->en_title;
        $cancel->ar_title=$request->ar_title;



        $cancel->save();
        toastr()->success(trans('main.Message_success'), trans('main.Message_title_congratulation'));

        return redirect(route('cancels.index'));
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
        $cancel=CancelReason::find($id);
        return view('admin.cancels.edit')->with(['cancel'=>$cancel]);
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

        $cancel=CancelReason::find($id);
        $cancel->en_title=$request->en_title;
        $cancel->ar_title=$request->ar_title;



        $cancel->save();
        toastr()->success(trans('main.Message_success'), trans('main.Message_title_congratulation'));

        return redirect(route('cancels.index'));
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

        $good= CancelReason::destroy($request->id);
        if ($good)
            return response(['error'=>0]);
        else
            return response(['error'=>1]);

    }
}
