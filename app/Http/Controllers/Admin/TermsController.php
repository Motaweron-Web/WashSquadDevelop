<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteText;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class TermsController extends Controller
{
    public function index(){

        $AppSettingTermss= SiteText::active()->first();

        return view('admin.terms.index', compact('AppSettingTermss'));
    }



########################################################################################3
    public function update($id ,Request $request){
        //  return 1;
// return $request;
        try {

            $AppSettingTerms = SiteText::Selection()->find($id);



            DB::beginTransaction();
       //  return 1;

            $data = $request->except('_token', 'id',);

            //  return 1;
            $AppSettingTerms->update(
                    $data
                );
            // return 1;
////////////////////////////////////////////////////////////////////////////////////////
            DB::commit();
            return redirect()->route('admin.AppSettingTerms')->with(['success' => 'تم التحديث بنجاح']);}
        catch (\Exception $exception) {
            return $exception;
            DB::rollback();
            return redirect()->route('admin.AppSettingTerms')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }








}
