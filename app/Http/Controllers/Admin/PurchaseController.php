<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{

    public  function index(Request $request){
        if(!checkPermission(12))
            return view('admin.permission.index');
        $fromDate='';
        $toDate='';

        if (!$request->has('month') || !$request->has('type') || !in_array($request->type, ['month', 'filter'])) {
            return redirect(route('admin.purchase.index') . '?month=' . date('Y-m') . '&type=month');
        }//end fun

        if ($request->type == 'filter') {
            if (!$request->has('filter') || !in_array($request->filter, ['today', 'thisWeek'
                    , 'lastWeek', 'thisMonth', 'lastMonth', 'lastYear','thisYear']))
                return redirect(route('admin.purchase.admin') . '?month=' . date('Y-m') . '&type=filter&filter=today');
        }

        $fromDate = date('Y-m-d', strtotime('-1 month ' . date('Y-m-d')));
        $toDate = date('Y-m-d');

        if ($request->type == 'month') {
            $fromDate = $request->month . '-01';
            $toDate = date('Y-m-t', strtotime($fromDate));
        }elseif('filter'){
            $fromDate = date('Y-m-d');
            $toDate = date('Y-m-d');
            if ($request->filter == 'thisWeek')
            {
                $day = date('w',strtotime(date('Y-m-d')));
                $day = $day+1;
                $fromDate = date('Y-m-d', strtotime('-'.$day.' days',strtotime(date('Y-m-d'))));
                $toDate = date('Y-m-d');
            }elseif($request->filter =='lastWeek')
            {
                $day = date('w',strtotime(date('Y-m-d')));
                $day = $day+8;
                $fromDate = date('Y-m-d', strtotime('-'.$day.' days',strtotime(date('Y-m-d'))));
                $toDate = date('Y-m-d', strtotime('+ 6 days',strtotime($fromDate)));
            }
            elseif($request->filter =='lastMonth')
            {
                $fromDate = date('Y-m',strtotime('- 1 month'.date('Y-m-d'))).'-1';
                $toDate = date('Y-m-t',strtotime('- 1 month'.date('Y-m-d')));
            }elseif($request->filter =='thisMonth'){
                $fromDate = date('Y-m-d');
                $toDate = date('Y-m-t');
            }elseif($request->filter =='lastYear')
            {
                $fromDate = date('Y',strtotime('- 1 year'.date('Y-m-d'))).'-'.date('m-d',strtotime('2022-01-01'));
                $toDate = date('Y',strtotime('- 1 year'.date('Y-m-d'))).'-'.date('m-t',strtotime('2022-12-01'));
            }elseif($request->filter =='thisYear')
            {
                $fromDate = date('Y').'-'.date('m-d',strtotime('2022-01-01'));
                $toDate = date('Y').'-'.date('m-t',strtotime('2022-12-01'));
            }
        }

        $betweenMonth = [$fromDate, $toDate];



        $purchases=Purchase::whereBetween("date", $betweenMonth)->paginate(15);
        return view('admin.purchase.index',compact('purchases','request'));

    }
    public function delete(Request $request){
        $purchase=Purchase::find($request->id);
        if($purchase==null)
            return response()->json(['status'=>false]);
        $purchase->delete();
        return response()->json(['status'=>true]);

    }
    public function create(Request $request){
        if(!checkPermission(12))
            return view('admin.permission.index');
        return view('admin.purchase.create');
    }
    public  function add(Request $request){
        if(!checkPermission(12))
            return view('admin.permission.index');
        $validator=\Validator::make($request->all(),
            [
                'date'=>'required',
                'name'=>'required',
                'category'=>'required',
                'value'=>'required|regex:/^\d+(\.\d{1,2})?$/',
                'count'=>'required|regex:/^\d+(\.\d{1,2})?$/',
                'payment_method'=>'required'

            ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Purchase::create([
                'date'=>$request->date,
                'name'=>$request->name,
                'category'=>$request->category,
                'value'=>$request->value,
                'count'=>$request->count,
                'payment_method'=>$request->payment_method,
        ]
        );
       return redirect()->route('admin.purchase.index')->with('message','تمت الاضافة بنجاح');
    }
    public function edit($id){
        if(!checkPermission(12))
            return view('admin.permission.index');
        $purchase=Purchase::findOrFail($id);
        return view('admin.purchase.update',compact('purchase'));


    }
    public function update($id,Request $request){
        if(!checkPermission(12))
            return view('admin.permission.index');
        $validator=\Validator::make($request->all(),
            [
                'date'=>'required',
                'name'=>'required',
                'category'=>'required',
                'value'=>'required|regex:/^\d+(\.\d{1,2})?$/',
                'count'=>'required|regex:/^\d+(\.\d{1,2})?$/',
                'payment_method'=>'required'

            ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $purchase=Purchase::findOrFail($id);


     $purchase->update([
                'date'=>$request->date,
                'name'=>$request->name,
                'category'=>$request->category,
                'value'=>$request->value,
                'count'=>$request->count,
                'payment_method'=>$request->payment_method,
            ]
        );
        return redirect()->route('admin.purchase.index')->with('message','تمت التعديل بنجاح');
}
}
