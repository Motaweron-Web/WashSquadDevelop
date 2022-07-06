<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Service;
use Illuminate\Http\Request;

class OfferController extends Controller
{

    public function getoffers()
    {

        if(!checkPermission(27))
            return view('admin.permission.index');

        $offers = Offer::with('service')->paginate(15);
        return view('admin.home.offers.index', compact('offers'));
    }

    public function createoffer()
    {
        if(!checkPermission(27))
            return view('admin.permission.index');

        $services = Service::where('level', 1)->get();

        return view('admin.home.offers.create', compact('services'));

    }

    public function addoffer(Request $request)
    {
        if(!checkPermission(27))
            return view('admin.permission.index');

        $validator = \Validator::make($request->all(),
            [
                'ar_image' => 'required',
                'en_image' => 'required',
                'service_id' => 'required',
                'expiredate' => 'required',


            ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $data = ['expiredate' => strtotime($request->expiredate), 'service_id' => (int)$request->service_id];

        if ($request->file('ar_image')) {
            $image = $request->file('ar_image');
            $imagename = 'assets/admin/images/offers/' . time() . $image->getclientOriginalName();
            $img = \Image::make($image->getRealPath());
            $img->resize(350, 350);
            $img->save(public_path($imagename));

            $data['ar_image'] = $imagename;
        }
        if ($request->file('en_image')) {
            $image = $request->file('en_image');
            $imagename = 'assets/admin/images/offers/' . time() . $image->getclientOriginalName();
            $img = \Image::make($image->getRealPath());
            $img->resize(350, 350);
            $img->save(public_path($imagename));

            $data['en_image'] = $imagename;
        }
        Offer::create($data);
        return redirect()->route('getoffers')->with('message','تم اضافة العرض بنجاح');


    }
    public  function  deleteoffer(Request $request){
        $offer=Offer::find($request->id);
         if($offer==null)
             return response()->json(['status'=>false]);
         $offer->delete();
        return response()->json(['status'=>true]);


    }
    public function editoffer($id)
    {
        if(!checkPermission(27))
            return view('admin.permission.index');

        $offer=Offer::with('service')->find($id);
        $services = Service::where('level', 1)->get();

        return view('admin.home.offers.update', compact('offer','services'));

    }
    public  function  updateoffer($id,Request $request){
        if(!checkPermission(27))
            return view('admin.permission.index');

        $validator = \Validator::make($request->all(),
            [
                'ar_image' => 'nullable',
                'en_image' => 'nullable',
                'service_id' => 'required',
                'expiredate' => 'required',


            ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $data = ['expiredate' => strtotime($request->expiredate), 'service_id' => (int)$request->service_id];

        if ($request->file('ar_image')) {
            $image = $request->file('ar_image');
            $imagename = 'assets/admin/images/offers/' . time() . $image->getclientOriginalName();
            $img = \Image::make($image->getRealPath());
            $img->resize(350, 350);
            $img->save(public_path($imagename));

            $data['ar_image'] = $imagename;
        }
        if ($request->file('en_image')) {
            $image = $request->file('en_image');
            $imagename = 'assets/admin/images/offers/' . time() . $image->getclientOriginalName();
            $img = \Image::make($image->getRealPath());
            $img->resize(350, 350);
            $img->save(public_path($imagename));

            $data['en_image'] = $imagename;
        }
        $offer=Offer::find($id);
        $offer->update($data);
        return redirect()->route('getoffers')->with('message','تم تحديث الطلب بنجاح');


    }

}
