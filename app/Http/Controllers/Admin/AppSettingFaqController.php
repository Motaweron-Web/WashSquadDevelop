<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppSettingFaqRequest;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AppSettingFaqController extends Controller
{
    public function index(){
//return 1;
        $AppSettingFaqs= Question::Selection()->paginate(10);
        return view('admin/AppSettingFaq.index', compact('AppSettingFaqs'));
        //return   $AppSettingDriver;
    }
##################################==creat==###############################################

    public function creat (){

        $AppSettingFaqs=Question::get();

        return view('admin.AppSettingFaq.creat',compact('AppSettingFaqs'));

    }


    ############################==store==##################################

    public function  store(AppSettingFaqRequest $request){
        // return $request ;
        try {



            $AppSettingFaqs = Question::create([
                'en_title' => $request->en_title,
                'ar_title' => $request->ar_title,
                'ar_content' => $request->ar_content,
                'en_content' => $request->en_content,

            ]);

//return 1;
            return redirect()->route('admin.AppSettingFaq')->with(['success' => 'تم الحفظ بنجاح']);

        } catch (\Exception $ex) {
            //   return $ex;
            return redirect()->route('admin.AppSettingFaq')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);

        }

    }


############################==edit==##################################

    public function edit($id)
    {
        //return 1;
        try {

            $AppSettingFaqs=Question::Selection()->find($id);
            if (!$AppSettingFaqs)
                return redirect()->route('admin.AppSettingFaq')->with(['error' => 'هذا السؤال غير موجود او ربما يكون محذوفا ']);


            //  return  1;
            return view('admin.AppSettingFaq.edit', compact('AppSettingFaqs'));

        } catch (\Exception $exception) {
            return redirect()->route('admin.AppSettingFaq')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }



    public function update($id ,AppSettingFaqRequest $request){
        //  return 1;

        try {

            $AppSettingFaqs=Question::Selection()->find($id);
            if (!$AppSettingFaqs)
                return redirect()->route('admin.AppSettingFaq')->with(['error' => 'هذا السؤال غير موجود او ربما يكون محذوفا ']);


            DB::beginTransaction();

            //////////////////////////////////////////////////////////////////////////////////////////
//return 1;
            $data = $request->except('_token', 'id');
            //  return 1;
            Question::where('id', $id)
                ->update(
                    $data
                );
            // return 1;
////////////////////////////////////////////////////////////////////////////////////////
            DB::commit();
            return redirect()->route('admin.AppSettingFaq')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $exception) {
            return $exception;
            DB::rollback();
            return redirect()->route('admin.AppSettingFaq')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }





    ###################################==destroy==############################################
    public function destroy($id){

        try {


            $AppSettingDriver=Question::find($id);
            if (!$AppSettingDriver)
                return redirect()->route('admin.AppSettingFaq')->with(['error' => 'هذا السؤال غير موجود ']);

            /////////////////// delete photo from folder///////
            //   return 1;

            $path = parse_url(  $AppSettingDriver->logo);

            File::delete(public_path($path['path']));


//return 1;


            $AppSettingDriver->delete();
            return redirect()->route('admin.AppSettingFaq')->with(['success' => 'تم حذف السؤال بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.AppSettingFaq')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
}
