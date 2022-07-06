<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SalaryAndcommission;
use App\Models\UserEmploy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class SalaryAndCommissionController extends Controller
{
    public function index(Request $request)

    {
        $fromDate = '';
        $toDate = '';

        if (!$request->has('month') || !$request->has('type') || !in_array($request->type, ['month', 'filter'])) {
            return redirect(route('admin.SalariesCommissions') . '?month=' . date('Y-m') . '&type=month');
        }//end fun

        if ($request->type == 'filter') {
            if (!$request->has('filter') || !in_array($request->filter, ['today', 'thisWeek'
                    , 'lastWeek', 'thisMonth', 'lastMonth', 'lastYear', 'thisYear']))
                return redirect(route('admin.SalariesCommissions') . '?month=' . date('Y-m') . '&type=filter&filter=today');
        }

        $fromDate = date('Y-m-d', strtotime('-1 month ' . date('Y-m-d')));
        $toDate = date('Y-m-d');

        if ($request->type == 'month') {
            $fromDate = $request->month . '-01';
            $toDate = date('Y-m-t', strtotime($fromDate));
        } elseif ('filter') {
            $fromDate = date('Y-m-d');
            $toDate = date('Y-m-d');
            if ($request->filter == 'thisWeek') {
                $day = date('w', strtotime(date('Y-m-d')));
                $day = $day + 1;
                $fromDate = date('Y-m-d', strtotime('-' . $day . ' days', strtotime(date('Y-m-d'))));
                $toDate = date('Y-m-d');
            } elseif ($request->filter == 'lastWeek') {
                $day = date('w', strtotime(date('Y-m-d')));
                $day = $day + 8;
                $fromDate = date('Y-m-d', strtotime('-' . $day . ' days', strtotime(date('Y-m-d'))));
                $toDate = date('Y-m-d', strtotime('+ 6 days', strtotime($fromDate)));
            } elseif ($request->filter == 'lastMonth') {
                $fromDate = date('Y-m', strtotime('- 1 month' . date('Y-m-d'))) . '-1';
                $toDate = date('Y-m-t', strtotime('- 1 month' . date('Y-m-d')));
            } elseif ($request->filter == 'thisMonth') {
                $fromDate = date('Y-m-d');
                $toDate = date('Y-m-t');
            } elseif ($request->filter == 'lastYear') {
                $fromDate = date('Y', strtotime('- 1 year' . date('Y-m-d'))) . '-' . date('m-d', strtotime('2022-01-01'));
                $toDate = date('Y', strtotime('- 1 year' . date('Y-m-d'))) . '-' . date('m-t', strtotime('2022-12-01'));
            } elseif ($request->filter == 'thisYear') {
                $fromDate = date('Y') . '-' . date('m-d', strtotime('2022-01-01'));
                $toDate = date('Y') . '-' . date('m-t', strtotime('2022-12-01'));
            }
        }

        $betweenMonth = [$fromDate, $toDate];
//        return $betweenMonth;


        $SalaryAndcommissions = SalaryAndcommission::whereBetween("created_at", $betweenMonth)->Selection()->paginate(10);
        return view('admin.Salaries-commissions.index', compact('SalaryAndcommissions', 'request'));

    }

    ///
    public function store(Request $request)
    {
        // return $request;
        $validator = \Validator::make($request->all(),
            [
                'title_ar'=>'required',
                'name'=>'required',
                'id_number'=>'required',
                'employ_number'=>'required',
                'commencement_date'=>'required',
                'expire_residence'=>'required',
                'phone'=>'required',
                'salary'=>'required',
                'status'=>'required',
                'job_title'=>'required',
                'vacations'=>'required',
                'absence'=>'required',
                'email'=>'required',
                'ipan'=>'required',
                'photo'=>'required',
                'commission'=>'required',
                'discoound'=>'required',
                'invoice'=>'required',
                'borrow'=>'required',

            ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        try {
            if ($request->has('invoice')) {
                $file_name = $this->saveImage($request->invoice, 'assets/admin/images/employ');
                $photoPass = 'assets/admin/images/employ' . $file_name;
            }
            if (!$request->has('is_confirmed'))
                $request->request->add(['is_confirmed' => 0]);
            else
                $request->request->add(['is_confirmed' => 1]);


            $UserEmploys = UserEmploy::create([
                'name' => $request->name,
                'commencement_date' => $request->commencement_date,
                'salary' => $request->salary,
                'commission' => $request->commission,
                'absence' => $request->absence,
                'discoound' => $request->discoound,
                'salary' => $request->salary,
                'invoice' => $request->invoice,
                'borrow' => $request->borrow,
                'commission' => $request->commission,

            ]);

//return 1;
            return redirect()->route('admin.SalariesCommissions')->with(['success' => 'تم الحفظ بنجاح']);

        } catch (\Exception $ex) {
            return $ex;
            return redirect()->route('admin.SalariesCommissions')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);

        }


    }


    public function update(Request $request)
    {


//        if ($request->has('invoice')) {
//            $file_name = $this->saveImage($request->invoice, 'assets/admin/images/employ');
//            $photoPass = 'assets/admin/images/employ' . $file_name;
//        }

////////////////////////////////////////////////////////////////////////////
        $salry = SalaryAndcommission::find($request->id);
        if ($salry == null)
            return response()->json(['status' => false]);
        $salry->is_confirmed = 1;
        $salry->save();
        return response()->json(['status' => true]);

    }

public function edit($id,Request $request){



// return $request;
    try {

        $UserEmploys = UserEmploy::Selection()->find($id);

/////////////////////////////////
///
///
///
        if ($request->has('photo')) {
            $file_name = $this->saveImage($request->photo, 'assets/admin/images/employ');
            $photoPass = 'assets/admin/images/employ' . $file_name;
            $UserEmploys->update(['photo' => $photoPass]);
        }
        if ($request->has('contract')) {
            $file_name = $this->saveImage($request->contract, 'assets/admin/images/employ');
            $fillPass = 'assets/admin/images/employ/' . $file_name;
            $UserEmploys->update(['contract' => $fillPass]);
        }
///
///
///

        DB::beginTransaction();
        //  return 1;

        $data = $request->except('_token', 'id','photo','file');

        //  return 1;
        $UserEmploys->update(
            $data
        );
        // return 1;
////////////////////////////////////////////////////////////////////////////////////////
        DB::commit();
        return redirect()->route('admin.SalariesCommissions')->with(['success' => 'تم التحديث بنجاح']);}
    catch (\Exception $exception) {
        return $exception;
        DB::rollback();
        return redirect()->route('admin.SalariesCommissions')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
    }

}
    public function search($search,Request $request){

        $fromDate = '';
        $toDate = '';

        if (!$request->has('month') || !$request->has('type') || !in_array($request->type, ['month', 'filter'])) {
            return redirect(route('admin.SalariesCommissions') . '?month=' . date('Y-m') . '&type=month');
        }//end fun

        if ($request->type == 'filter') {
            if (!$request->has('filter') || !in_array($request->filter, ['today', 'thisWeek'
                    , 'lastWeek', 'thisMonth', 'lastMonth', 'lastYear', 'thisYear']))
                return redirect(route('admin.SalariesCommissions') . '?month=' . date('Y-m') . '&type=filter&filter=today');
        }

        $fromDate = date('Y-m-d', strtotime('-1 month ' . date('Y-m-d')));
        $toDate = date('Y-m-d');

        if ($request->type == 'month') {
            $fromDate = $request->month . '-01';
            $toDate = date('Y-m-t', strtotime($fromDate));
        } elseif ('filter') {
            $fromDate = date('Y-m-d');
            $toDate = date('Y-m-d');
            if ($request->filter == 'thisWeek') {
                $day = date('w', strtotime(date('Y-m-d')));
                $day = $day + 1;
                $fromDate = date('Y-m-d', strtotime('-' . $day . ' days', strtotime(date('Y-m-d'))));
                $toDate = date('Y-m-d');
            } elseif ($request->filter == 'lastWeek') {
                $day = date('w', strtotime(date('Y-m-d')));
                $day = $day + 8;
                $fromDate = date('Y-m-d', strtotime('-' . $day . ' days', strtotime(date('Y-m-d'))));
                $toDate = date('Y-m-d', strtotime('+ 6 days', strtotime($fromDate)));
            } elseif ($request->filter == 'lastMonth') {
                $fromDate = date('Y-m', strtotime('- 1 month' . date('Y-m-d'))) . '-1';
                $toDate = date('Y-m-t', strtotime('- 1 month' . date('Y-m-d')));
            } elseif ($request->filter == 'thisMonth') {
                $fromDate = date('Y-m-d');
                $toDate = date('Y-m-t');
            } elseif ($request->filter == 'lastYear') {
                $fromDate = date('Y', strtotime('- 1 year' . date('Y-m-d'))) . '-' . date('m-d', strtotime('2022-01-01'));
                $toDate = date('Y', strtotime('- 1 year' . date('Y-m-d'))) . '-' . date('m-t', strtotime('2022-12-01'));
            } elseif ($request->filter == 'thisYear') {
                $fromDate = date('Y') . '-' . date('m-d', strtotime('2022-01-01'));
                $toDate = date('Y') . '-' . date('m-t', strtotime('2022-12-01'));
            }
        }

        $betweenMonth = [$fromDate, $toDate];
//        return $betweenMonth;


        //searcch by NAme
        $SalaryAndcommissions = SalaryAndcommission::where('name','LIKE',"%$search%")->whereBetween("created_at", $betweenMonth)->Selection()->paginate(10);
        return view('admin.Salaries-commissions.index', compact('SalaryAndcommissions', 'request'));

    }
    public function export()
    {
        return Excel::download(new SalaryAndCommissionController(), 'file.xlsx');
    }

}

