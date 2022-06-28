<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Social;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminSocialMediaController extends Controller
{
    public function index(){
        $AppSettingSocials= Social::all();

        return view('admin.socialMedia.index', compact('AppSettingSocials'));
    }



########################################################################################3
    public function update($id ,Request $request){
        /// return 1;
        //  return 1;
        try {

            $AppSettingSocials= Social::find($id);
            $AppSettingSocials->update([
                'link' => $request->link
            ]);
            toastr()->success('تم تحديث الرابط بنجاح', 'تم بنجاح');
            return redirect()->route('admin.AppSettingSocial');
        }

        catch (\Exception $exception) {
            return redirect()->route('admin.AppSettingSocial')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
}}
