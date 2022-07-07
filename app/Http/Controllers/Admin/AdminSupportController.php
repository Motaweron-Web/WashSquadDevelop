<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Support;
use Illuminate\Http\Request;

class AdminSupportController extends Controller
{

    public function index(){
        if(!checkPermission(32))
            return view('admin.permission.index');
        $AppSettingSupports= Support::all();

        return view('admin.support.support', compact('AppSettingSupports'));
    }



########################################################################################3
    public function update($id ,Request $request){
        if(!checkPermission(32))
            return view('admin.permission.index');
        //  return 1;
        try {

            $AppSettingSupports = Support::find($id);
            $AppSettingSupports->update([
                'link' => $request->link,

            ]);
            toastr()->success('تم تحديث الرابط بنجاح', 'تم بنجاح');
            return redirect()->route('admin.AppSettingSupport');
        }

        catch (\Exception $exception) {
            return redirect()->route('admin.AppSettingSupport')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }



}
