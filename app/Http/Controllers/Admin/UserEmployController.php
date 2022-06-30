<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SalaryAndcommission;
use App\Models\UserEmploy;
use App\traits\PhotoTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class UserEmployController extends Controller
{
    use PhotoTrait;
    public function index()
    {
        $UserEmploys = UserEmploy::Selection()->paginate(10);
        return view('admin.UserEmploy.index', compact('UserEmploys'));

    }


    /////////////
    ///
    ///
    public function store(Request $request){
   // return $request;
        $validator=\Validator::make($request->all(),
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
                'contract'=>'required',

            ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


       try {
            if ($request->has('photo')) {
                $file_name = $this->saveImage($request->photo, 'assets/admin/images/employ');
                $photoPass = 'assets/admin/images/employ' . $file_name;
            }
            if ($request->has('contract')) {
                $file_name = $this->saveImage($request->contract, 'assets/admin/images/employ');
                $fillPass = 'assets/admin/images/employ/' . $file_name;
            }

            $UserEmploys =UserEmploy::create([
                'name' => $request->name,
                'id_number' => $request-> id_number,
                'employ_number' => $request-> employ_number,
                'commencement_date' => $request-> commencement_date,
                'expire_residence' => $request-> expire_residence,
                'phone' => $request-> phone,
                'salary' => $request-> salary,
                'status' => $request-> status,
                'job_title' => $request-> job_title,
                'vacations' => $request-> vacations,
                'absence' => $request-> absence,
                'email' => $request-> email,
                'photo' =>$photoPass ,
                 'contract' => $fillPass,
                'ipan' => $request-> ipan,
            ]);

//return 1;
            return redirect()->route('admin.UserEmploy')->with(['success' => 'تم الحفظ بنجاح']);

        } catch (\Exception $ex) {
               return $ex;
            return redirect()->route('admin.UserEmploy')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);

        }


    }
public function update($id,Request $request){

// return $request;
  try {

        $salarys = SalaryAndcommission::Selection()->find($id);

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
      $salarys->update(
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



    public function pdf()
    {
        $data = UserEmploy::get()->all();
        $pdf = PDF::loadView('UserEmploy.index', ['data'=>$data]);
        return $pdf->stream('form.pdf');
    }



    /////////////////////////
}
