<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class OnlineStoreCategoriesController extends Controller
{
    public function index()
    {

        $OnlineStoreCategories = Category::Selection()->paginate(10);
        return view('admin.online_store_categories.index', compact('OnlineStoreCategories'));

    }

    public function creat()
    {
        //return 1;

        $OnlineStoreCategories = Category::get();
        return view('admin.online_store_categories.creat', compact('OnlineStoreCategories'));
    }



    public function  store(Request $request){
        // return $request ;
        $validator=\Validator::make($request->all(),
            [
                'title_ar'=>'required',
                'title_en'=>'required',

            ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        try {

            $OnlineStoreCategories =Category::create([
                'title_ar' => $request->title_ar,
                'title_en' => $request-> title_en,
            ]);

//return 1;
            return redirect()->route('admin.OnlineStoreCategories')->with(['success' => 'تم الحفظ بنجاح']);

        } catch (\Exception $ex) {
            //   return $ex;
            return redirect()->route('admin.OnlineStoreCategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);

        }

    }

    ############################==edit==##################################

    public function edit($id)
    {
        //return 1;
        try {

            $OnlineStoreCategories=Category::Selection()->find($id);
            if (!$OnlineStoreCategories)
                return redirect()->route('admin.OnlineStoreCategories')->with(['error' => 'هذا السؤال غير موجود او ربما يكون محذوفا ']);


            //  return  1;
            return view('admin.online_store_categories.edit', compact('OnlineStoreCategories'));

        } catch (\Exception $exception) {
            return $exception;
            return redirect()->route('admin.OnlineStoreCategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }



    public function update($id ,Request $request){
        //  return 1;

        try {

            $OnlineStoreCategories=Category::Selection()->find($id);
            if (!$OnlineStoreCategories)
                return redirect()->route('admin.OnlineStoreCategories')->with(['error' => 'هذا السؤال غير موجود او ربما يكون محذوفا ']);


            DB::beginTransaction();

            //////////////////////////////////////////////////////////////////////////////////////////
//return 1;
            $data = $request->except('_token',);
            //  return 1;
            Category::where('id', $id)
                ->update(
                    $data
                );
            // return 1;
////////////////////////////////////////////////////////////////////////////////////////
            DB::commit();
            return redirect()->route('admin.OnlineStoreCategories')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $exception) {
            //   return $exception;
            DB::rollback();
            return redirect()->route('admin.OnlineStoreCategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }





    ###################################==destroy==############################################
    public function destroy($id){

        try {


            $OnlineStoreCategories=Category::find($id);
            if (!$OnlineStoreCategories)
                return redirect()->route('admin.OnlineStoreCategories')->with(['error' => 'هذا السؤال غير موجود ']);

            /////////////////// delete photo from folder///////


//return 1;


            $OnlineStoreCategories->delete();
            return redirect()->route('admin.OnlineStoreCategories')->with(['success' => 'تم حذف التصنيف بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.OnlineStoreCategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }




}
