<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Price;
use App\Models\ServicePayment;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\CarSize;
use App\Models\Payment;
use App\Models\ServiceSubService;


class ServiceController extends Controller
{
    //
    public function getservices()
    {
        $services = Service::where('level', 1)->get();
        return view('admin.home.services', compact('services'));
    }

    public function editservice($id)
    {
        $service = Service::find($id);
        return view('admin.home.service.update', compact('service'));
    }

    public function updateservice($id, Request $request)
    {
        $data = $request->all();
        $validator = \Validator::make($request->all(),
            [
                'ar_title' => 'required|string',
                'en_title' => 'required|string',
                'ar_image' => 'nullable',
                'en_image' => 'nullable',

            ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        if ($request->file('ar_image')) {
            $image = $request->file('ar_image');
            $imagename = 'assets/admin/images/services/' . time() . $image->getclientOriginalName();
            $img = \Image::make($image->getRealPath());
            $img->resize(350, 350);
            $img->save(public_path($imagename));

            $data['ar_image'] = $imagename;
        }
        if ($request->file('en_image')) {
            $image = $request->file('en_image');
            $imagename = 'assets/admin/images/services/' . time() . $image->getclientOriginalName();
            $img = \Image::make($image->getRealPath());
            $img->resize(350, 350);
            $img->save(public_path($imagename));

            $data['en_image'] = $imagename;
        }

        $service = Service::find($id);

        $service->update($data);
        return redirect()->route('getallservices')->with('message','تمت العملية بنجاح');

    }

    public function changeservicevisibility(Request $request)
    {

        $service = Service::find($request->id);
        if ($service == null)
            return Response()->json(['status' => false]);
        if ($service->visability == 0) {
            $service->visability = 1;
            $service->save();
        } else {
            $service->visability = 0;
            $service->save();
        }
        return Response()->json(['status' => true]);

    }

    public function getsubserviceformainservice($id)
    {

        $subservices = Service::with('subsubservices')->where('parent_id', $id)->where('level', 2)->paginate(15);
        $service = Service::find($id);
        return view('admin.home.service.sub', compact('subservices', 'service'));
    }

    public function deletesubservice(Request $request)
    {
        $service = Service::find($request->id);
        if ($service == null)
            return response()->json(['status' => false]);
        $service->delete();
        return response()->json(['status' => true]);

    }

    public function editsubservice($id)
    {
        $servicesubservice = ServiceSubService::where('sub_service_id', $id)->get();

        $service = Service::find($id);
        $carsizes = CarSize::get();
        $prices = Price::where('service_id', $id)->get();
        $payments = Payment::get();
        $subfromsubservices = Service::where('level', 3)->get();
        $pays = ServicePayment::where('service_id', $id)->get();

        return view('admin.home.service.updatesub', compact('prices', 'service', 'carsizes', 'subfromsubservices', 'servicesubservice', 'payments', 'pays'));

    }

    public function createsubservice($id)
    {
        $carsizes = CarSize::get();
        $service = Service::find($id);
        $subfromsubservices = Service::where('level', 3)->get();
        $payments = Payment::get();
        return view('admin.home.service.createsub', compact('carsizes', 'service', 'subfromsubservices', 'payments'));

    }

    public function getminsubservice()
    {

        $minsubservices = Service::with('subservices')->where('level', 3)->paginate(15);
        return view('admin.home.service.minsubservices.index', compact('minsubservices'));

    }

    public function createminsubservice()
    {
        $carsizes = CarSize::get();
        $subservices = Service::where('level', 2)->get();
        $payments = Payment::get();
        return view('admin.home.service.minsubservices.create', compact('carsizes', 'subservices', 'payments'));

    }

    public function editminsubservice($id)
    {
        $servicesubservice = ServiceSubService::where('sub_sub_service_id', $id)->get();
        $service = Service::find($id);
        $carsizes = CarSize::get();
        $prices = Price::where('service_id', $id)->get();
        $subservices = Service::where('level', 2)->get();
        $payments = Payment::get();
        $pays = ServicePayment::where('service_id', $id)->get();
        return view('admin.home.service.minsubservices.update', compact('service', 'carsizes', 'prices', 'subservices', 'servicesubservice', 'payments', 'pays'));

    }

    public function updatesubservice($id, Request $request)
    {

        $validator = \Validator::make($request->all(),
            [
                'ar_title' => 'required|string',
                'en_title' => 'required|string',
                'ar_image' => 'nullable',
                'en_image' => 'nullable',
                'ar_des' => 'required',
                'en_des' => 'required',
                'timer' => 'required',


            ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $data = ['ar_title' => $request->ar_title, 'en_title' => $request->en_title, 'ar_des' => $request->ar_des, 'en_des' => $request->en_des, 'timer' => strtotime($request->timer)];
        if ($request->file('ar_image')) {
            $image = $request->file('ar_image');
            $imagename = 'assets/admin/images/services/' . time() . $image->getclientOriginalName();
            $img = \Image::make($image->getRealPath());
            $img->resize(350, 350);
            $img->save(public_path($imagename));

            $data['ar_image'] = $imagename;
        }
        if ($request->file('en_image')) {
            $image = $request->file('en_image');
            $imagename = 'assets/admin/images/services/' . time() . $image->getclientOriginalName();
            $img = \Image::make($image->getRealPath());
            $img->resize(350, 350);
            $img->save(public_path($imagename));

            $data['en_image'] = $imagename;
        }

        $service = Service::find($id);

        $service->update($data);
        if ($request->subsubservices) {
            ServiceSubService::where('sub_service_id', $id)->delete();
            for ($i = 0; $i < count($request->subsubservices); $i++) {
                ServiceSubService::create([
                    'service_id' => $service->parent_id,
                    'sub_service_id' => $id,
                    'sub_sub_service_id' => $request->subsubservices[$i],
                ]);
            }
        }
        if ($request->payment) {
            ServicePayment::where('service_id', $service->id)->delete();
            for ($i = 0; $i < count($request->payment); $i++) {
                ServicePayment::create([
                    'payment_id' => $request->payment[$i],
                    'service_id' => $id
                ]);
            }
        } else {
            ServicePayment::where('service_id', $service->id)->delete();

        }
        if ($request->prices) {
            $prices = Price::where('service_id', $id)->delete();
            $carsizes = CarSize::get();
            for ($i = 0; $i < count($carsizes); $i++) {
                if ($request->prices[$i] <= 0)
                    continue;
                Price::create(
                    [
                        'service_id' => $id,
                        'size_id' => $carsizes[$i]->id,
                        'price' => $request->prices[$i],

                    ]
                );
            }
        }
        return redirect()->route('getsubserviceformainservice', $service->parent_id)->with('message','تمت العملية بنجاح');
    }


    public function addsubservice($parentid, Request $request)
    {
        $validator = \Validator::make($request->all(),
            [
                'ar_title' => 'required|string',
                'en_title' => 'required|string',
                'ar_image' => 'required',
                'en_image' => 'required',
                'ar_des' => 'required',
                'en_des' => 'required',
                'timer' => 'required',


            ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $data = ['ar_title' => $request->ar_title, 'en_title' => $request->en_title, 'ar_des' => $request->ar_des, 'en_des' => $request->en_des, 'timer' => strtotime($request->timer)];
        if ($request->file('ar_image')) {
            $image = $request->file('ar_image');
            $imagename = 'assets/admin/images/services/' . time() . $image->getclientOriginalName();
            $img = \Image::make($image->getRealPath());
            $img->resize(350, 350);
            $img->save(public_path($imagename));

            $data['ar_image'] = $imagename;
        }
        if ($request->file('en_image')) {
            $image = $request->file('en_image');
            $imagename = 'assets/admin/images/services/' . time() . $image->getclientOriginalName();
            $img = \Image::make($image->getRealPath());
            $img->resize(350, 350);
            $img->save(public_path($imagename));

            $data['en_image'] = $imagename;
        }
        $data['parent_id'] = $parentid;
        $data['level'] = 2;
        $service = Service::create($data);


        if ($request->subsubservices) {
            ServiceSubService::where('sub_service_id', $service->id)->delete();
            for ($i = 0; $i < count($request->subsubservices); $i++) {
                ServiceSubService::create([
                    'service_id' => $service->parent_id,
                    'sub_service_id' => $service->id,
                    'sub_sub_service_id' => $request->subsubservices[$i],
                ]);
            }
        } else {
            ServiceSubService::where('sub_service_id', $service->id)->delete();

        }
        if ($request->payment) {
            ServicePayment::where('service_id', $service->id)->delete();

            for ($i = 0; $i < count($request->payment); $i++) {
                ServicePayment::create([
                    'payment_id' => $request->payment[$i],
                    'service_id' => $service->id,
                ]);
            }
        } else {
            ServicePayment::where('service_id', $service->id)->delete();

        }
        if ($request->prices) {
            $prices = Price::where('service_id', $service->id)->delete();
            $carsizes = CarSize::get();
            for ($i = 0; $i < count($carsizes); $i++) {
                if ($request->prices[$i] <= 0)
                    continue;
                Price::create(
                    [
                        'service_id' => $service->id,
                        'size_id' => $carsizes[$i]->id,
                        'price' => $request->prices[$i],

                    ]
                );
            }
        }
        return redirect()->route('getsubserviceformainservice', $service->parent_id)->with('message','تمت العملية بنجاح');


    }

    public function updateminsubservice($id, Request $request)
    {


        $validator = \Validator::make($request->all(),
            [
                'ar_title' => 'required|string',
                'en_title' => 'required|string',
                'ar_image' => 'nullable',
                'en_image' => 'nullable',
                'ar_des' => 'required',
                'en_des' => 'required',
                'timer' => 'required',


            ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $data = ['ar_title' => $request->ar_title, 'en_title' => $request->en_title, 'ar_des' => $request->ar_des, 'en_des' => $request->en_des, 'timer' => strtotime($request->timer)];
        if ($request->file('ar_image')) {
            $image = $request->file('ar_image');
            $imagename = 'assets/admin/images/services/' . time() . $image->getclientOriginalName();
            $img = \Image::make($image->getRealPath());
            $img->resize(350, 350);
            $img->save(public_path($imagename));

            $data['ar_image'] = $imagename;
        }
        if ($request->file('en_image')) {
            $image = $request->file('en_image');
            $imagename = 'assets/admin/images/services/' . time() . $image->getclientOriginalName();
            $img = \Image::make($image->getRealPath());
            $img->resize(350, 350);
            $img->save(public_path($imagename));

            $data['en_image'] = $imagename;
        }

        $service = Service::find($id);

        $service->update($data);


        if ($request->prices) {
            $prices = Price::where('service_id', $service->id)->delete();
            $carsizes = CarSize::get();
            for ($i = 0; $i < count($carsizes); $i++) {
                if ($request->prices[$i] <= 0)
                    continue;
                Price::create(
                    [
                        'service_id' => $service->id,
                        'size_id' => $carsizes[$i]->id,
                        'price' => $request->prices[$i],

                    ]
                );
            }
        }
        if ($request->subservices) {
            ServiceSubService::where('sub_sub_service_id', $service->id)->delete();
            for ($i = 0; $i < count($request->subservices); $i++) {
                $level2 = Service::find($request->subservices[$i]);
                ServiceSubService::create([
                    'service_id' => $level2->parent_id,
                    'sub_sub_service_id' => $service->id,
                    'sub_service_id' => $request->subservices[$i],
                ]);
            }
        } else {
            ServiceSubService::where('sub_sub_service_id', $service->id)->delete();

        }
        if ($request->payment) {
            ServicePayment::where('service_id', $service->id)->delete();
            for ($i = 0; $i < count($request->payment); $i++) {
                ServicePayment::create([
                    'payment_id' => $request->payment[$i],
                    'service_id' => $service->id,
                ]);
            }
        } else {
            ServicePayment::where('service_id', $service->id)->delete();

        }
        return redirect()->route('getminsubservice')->with('message','تمت العملية بنجاح');


    }

    public function addminsubservice(Request $request)
    {

        $validator = \Validator::make($request->all(),
            [
                'ar_title' => 'required|string',
                'en_title' => 'required|string',
                'ar_image' => 'required',
                'en_image' => 'required',
                'ar_des' => 'required',
                'en_des' => 'required',
                'timer' => 'required',


            ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $data = ['ar_title' => $request->ar_title, 'en_title' => $request->en_title, 'ar_des' => $request->ar_des, 'en_des' => $request->en_des, 'timer' => strtotime($request->timer)];
        if ($request->file('ar_image')) {
            $image = $request->file('ar_image');
            $imagename = 'assets/admin/images/services/' . time() . $image->getclientOriginalName();
            $img = \Image::make($image->getRealPath());
            $img->resize(350, 350);
            $img->save(public_path($imagename));

            $data['ar_image'] = $imagename;
        }
        if ($request->file('en_image')) {
            $image = $request->file('en_image');
            $imagename = 'assets/admin/images/services/' . time() . $image->getclientOriginalName();
            $img = \Image::make($image->getRealPath());
            $img->resize(350, 350);
            $img->save(public_path($imagename));

            $data['en_image'] = $imagename;
        }
        $data['parent_id'] = 1;
        $data['level'] = 3;
        $service = Service::create($data);


        if ($request->prices) {
            $prices = Price::where('service_id', $service->id)->delete();
            $carsizes = CarSize::get();
            for ($i = 0; $i < count($carsizes); $i++) {
                if ($request->prices[$i] <= 0)
                    continue;
                Price::create(
                    [
                        'service_id' => $service->id,
                        'size_id' => $carsizes[$i]->id,
                        'price' => $request->prices[$i],

                    ]
                );
            }
        }
        if ($request->subservices) {
            ServiceSubService::where('sub_sub_service_id', $service->id)->delete();
            for ($i = 0; $i < count($request->subservices); $i++) {
                $level2 = Service::find($request->subservices[$i]);
                ServiceSubService::create([
                    'service_id' => $level2->parent_id,
                    'sub_sub_service_id' => $service->id,
                    'sub_service_id' => $request->subservices[$i],
                ]);
            }
        }
        if ($request->payment) {
            ServicePayment::where('service_id', $service->id)->delete();
            for ($i = 0; $i < count($request->payment); $i++) {
                ServicePayment::create([
                    'payment_id' => $request->payment[$i],
                    'service_id' => $service->id,
                ]);
            }
        } else {
            ServicePayment::where('service_id', $service->id)->delete();

        }
        return redirect()->route('getminsubservice')->with('message','تمت العملية بنجاح');
    }


}
