<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Service;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function getpaymentmethod(){
       $payments=Payment::paginate(15);
        return view('admin.home.payments.index',compact('payments'));

    }
    public  function cretepayment(){
        return view('admin.home.payments.create');


    }
    public function addpayment(Request $request){


        $validator=\Validator::make($request->all(),
            [
                'type'=>'required|string',
                'extracost'=>'required|regex:/^\d+(\.\d{1,2})?$/',
                'visability'=>'required',



            ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data=['type'=>$request->type,'extracost'=>$request->extracost];

        if(count($request->visability)>1)
        {
            $data['visability']='كلاهما';
        }
        else
        {
            $data['visability']=$request->visability[0];

        }

    Payment::create($data);
        return redirect()->route('getpaymentmethod')->with('message','تمة عملية الاضافة بنجاح');


    }

    public  function deletepayment(Request $request){

        $payment=Payment::find($request->id);
        if($payment==null){
            return response()->json(['status'=>false]);
        }
        $payment->delete();
        return response()->json(['status'=>true]);

    }

public function changepaymentstatus(Request $request){

        $payment=Payment::find($request->id);
        if($payment==null)
            return response()->json(['status'=>false]);
        if($payment->display==1){
            $payment->display=0;
            $payment->save();
        }
        else
        {
            $payment->display=1;
            $payment->save();
        }
    return response()->json(['status'=>true]);

}


public function editpayment($id){

        $payment=Payment::find($id);

    return view('admin.home.payments.update',compact('payment'));


}

  public function updatepayment($id,Request $request){

      $validator=\Validator::make($request->all(),
          [
              'type'=>'required|string',
              'extracost'=>'required|regex:/^\d+(\.\d{1,2})?$/',
              'visability'=>'required',



          ]);

      if ($validator->fails()) {
          return redirect()->back()
              ->withErrors($validator)
              ->withInput();
      }

      $data=['type'=>$request->type,'extracost'=>$request->extracost];

      if(count($request->visability)>1)
      {
          $data['visability']='كلاهما';
      }
      else
      {
          $data['visability']=$request->visability[0];

      }

      Payment::find($id)->update($data);
      return redirect()->route('getpaymentmethod')->with('message','تمة عملية التعديل بنجاح');;



  }









}
