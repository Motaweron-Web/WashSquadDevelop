<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\App;
use App\Models\User;
use App\Models\UserEmploy;
use App\traits\PhotoTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class AppsController extends Controller
{

    //use App\traits;

    use PhotoTrait;
    public function index(Request $request){


        $fromDate = '';
        $toDate = '';

        if (!$request->has('month') || !$request->has('type') || !in_array($request->type, ['month', 'filter'])) {
            return redirect(route('admin.Apps') . '?month=' . date('Y-m') . '&type=month');
        }//end fun

        if ($request->type == 'filter') {
            if (!$request->has('filter') || !in_array($request->filter, ['today', 'thisWeek'
                    , 'lastWeek', 'thisMonth', 'lastMonth', 'lastYear', 'thisYear']))
                return redirect(route('admin.Apps') . '?month=' . date('Y-m') . '&type=filter&filter=today');
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
        $Apps=User::where('user_type',4)->whereBetween("created_at", $betweenMonth)->latest()->paginate(15);
        return view('admin/apps/index',compact('Apps','request'));

    }


    public function creat(){

        $Apps = User::active()->get();

        return view('admin.apps.create',compact('Apps'));
    }



    public function store(Request $request)
    {
//UserEmploy::create(['name'=>$request->name]);
// return $request;
        $validator = \Validator::make($request->all(),
            [
                 'name' =>'required',
                'IBN_number'=>'required',
                'created_at'=>'required',
                'IBN_number'=>'required',
                'logo'=>'required',
                'ratio'=>'required',
                'Payment_method'=>'required',

                'main_packages'=>'required',
            ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
//return $request;
//return 1;
        try {
//            if ($request->has('logo')) {
//                $file_name = $this->saveImage($request->logo, 'assets/admin/images/apps');
//                $photoPass = 'assets/admin/images/apps' . $file_name;
//            }



            $filePath = "";

            if ($request->has('logo')) {
                $filePath = uploadImage('apps', $request->logo);
            }

            if (!$request->has('is_active'))
                $request['is_active']=0;
            else
                $request['is_active']=1;

            $Apps= User::create([

                'name' => $request->name,
                'full_name' => $request->name,
                 'user_type'=>4,
                'IBN_number' => $request->IBN_number,
                'is_active' => $request->is_active,
                'created_at' => $request->created_at,
                'logo' => $filePath,
                'ratio' => $request->ratio,


                'Payment_method'=>json_encode($request->Payment_method),
                'main_packages'=>json_encode($request->main_packages),
            ]);

//return $Apps;
            return redirect()->route('admin.Apps')->with(['success' => 'تم الحفظ بنجاح']);

        } catch (\Exception $ex) {
       //  return $ex;
            return redirect()->route('admin.Apps')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);

        }


    }




 public function edit($id){


     $Apps = User::Selection2()->find($id);
           return view('admin.apps.edit', compact('Apps'));


    }




    public function update(Request $request,$id)
    {
 //  return $request;

        $validator = \Validator::make($request->all(),
            [
                'name' =>'required',
                'full_name' =>'required',
                'IBN_number'=>'required',
                'created_at'=>'required',
                'IBN_number'=>'required',
                'logo'=>'required',
                'ratio'=>'required',
                'Payment_method'=>'required',

                'main_packages'=>'required',
            ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        try {

            $Apps = User::Selection2()->find($id);

//            DB::beginTransaction();

//

            if ($request->has('logo') ) {
                $filePath = uploadImage('apps', $request->logo);
                User::where('id', $id)
                    ->update([
                        'logo' => $filePath,
                    ]);
            }

////////////////////////////////////////////////////////////////////////////
            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);


            //////////////////////////////////////////////////////////////////////////////////////////

//            DB::beginTransaction();
       //return 1;

            $data = $request->except('_token', 'id', 'logo');

            $Apps->update(
                $data
            );
            $Apps->update(['name'=>$request->full_name]);

            // return 1;
////////////////////////////////////////////////////////////////////////////////////////
            DB::commit();

            return redirect()->route('admin.Apps')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $exception) {
            return $exception;
            DB::rollback();
            return redirect()->route('admin.Apps')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }

    public function export()
    {
        return Excel::download(new AppsController(), 'file.xlsx');
    }

}
