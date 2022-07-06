<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactMailRequest;
use App\Models\ContactMail;
use Carbon\Carbon;
use Illuminate\Http\Request;


class ContactMailController extends Controller
{
    public function index(Request $request){
        // return 1;


        if(!checkPermission(35))
            return view('admin.permission.index');
        $fromDate='';
        $toDate='';

        if (!$request->has('month') || !$request->has('type') || !in_array($request->type, ['month', 'filter'])) {
            return redirect(route('admin.ContactMail') . '?month=' . date('Y-m') . '&type=month');
        }//end fun

        if ($request->type == 'filter') {
            if (!$request->has('filter') || !in_array($request->filter, ['today', 'thisWeek'
                    , 'lastWeek', 'thisMonth', 'lastMonth', 'lastYear','thisYear']))
                return redirect(route('admin.ContactMail') . '?month=' . date('Y-m') . '&type=filter&filter=today');
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




















        $ContactMails= ContactMail::whereBetween("date", $betweenMonth)->Selection()->paginate(10);
        return view('admin.ContactMails.index', compact('ContactMails','request'));
    }


    public function  store(Request $request){

        if(!checkPermission(35))
            return view('admin.permission.index');
        $validator=\Validator::make($request->all(),
            [
                'name'=>'required',
                'email'=>'required|unique:contact_mails|email',
                'phone'=>'required|unique:contact_mails',
                'discription'=>'required',
            ]);
        if ($validator->fails()) {
            return response()->json(['status'=>'error','message'=>'wrong data error','errors'=>$validator->errors()]);
        }


        $ContactMail = ContactMail::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'date'=>Carbon::now(),
            'discription' => $request->discription,

        ]);

        return response()->json(['status'=>true]);



    }

    public function destroy($id){

        if(!checkPermission(35))
            return view('admin.permission.index');
        try {
            $ContactMail =  ContactMail::find($id);

            $ContactMail->delete();
            return redirect()->route('admin.ContactMail')->with(['success' => 'تم الحذف  ']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.ContactMail')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }





}
