<?php

namespace App\Http\Controllers\Admin;

use App\DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminDateTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dateTimes=DateTime::get();
        return view('admin.dateTime.index')->with(['dateTimes'=>$dateTimes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $work_times=\App\WorkTime::where('is_deleted',0)
            ->where('id','!=',27)
            ->get();
        return view('admin.dateTime.create',compact('work_times'));
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
            'time_id' => 'required',
            'status' => 'required',

        ]);

        $error_check=DateTime::where('date',$request->date)
            ->where('time_id',$request->time_id)
            ->get();
        if ($error_check->count()!=0){
            toastr()->error(trans('main.Message_fail'), trans('main.Date_duplicate'));

            return redirect(route('dateTimes.index'));

        }


        $dateWork=new DateTime();
        $dateWork->time_id=$request->time_id;
        $dateWork->date=$request->date;
        $dateWork->status=$request->status;

        $dateWork->save();
        toastr()->success(trans('main.Message_success'), trans('main.Message_title_congratulation'));

        return redirect(route('dateTimes.index'));




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
    public function delete(Request $request)
    {

        $good= DateTime::destroy($request->id);
        if ($good)
            return response(['error'=>0]);
        else
            return response(['error'=>1]);

    }

    public function is_active($id)
    {
        $dateWork=DateTime::find($id);
        if (!$dateWork){
            toastr()->success(trans('main.Message_title_attention'), trans('main.Message_warning'));

            return redirect(route('dateTimes.index'));
        }
        //dd($user);

        if ($dateWork->status==1){
            $dateWork->status=0;
        }else if ($dateWork->status==0){
            $dateWork->status=1;
        }
        $dateWork->save();
        //dd($user);

        toastr()->success(trans('main.Message_success'), trans('main.Message_title_congratulation'));

        return redirect(route('dateTimes.index'));

    }//end
}
