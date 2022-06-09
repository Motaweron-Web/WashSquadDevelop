<?php

namespace App\Http\Controllers\Admin;

use App\MarketerPayment;
use Faker\Provider\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $payments=MarketerPayment::orderBy('created_at','desc')->get();
       return view('admin.payments.index')->with(['payments'=>$payments]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function is_finish($id)
    {
        $payment=MarketerPayment::find($id);
        if (!$payment){
            toastr()->success(trans('main.Message_title_attention'), trans('main.Message_warning'));

            return redirect(route('payments.index'));
        }
        //dd($user);

        if ($payment->status==1){
            $payment->status=0;
        }else if ($payment->status==0){
            $payment->status=1;
        }
        $payment->admin_id=admin()->user()->id;
        $payment->save();
        //dd($user);

        toastr()->success(trans('main.Message_success'), trans('main.Message_title_congratulation'));

        return redirect(route('payments.index'));

    }//end
}
