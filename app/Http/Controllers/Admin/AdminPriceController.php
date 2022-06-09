<?php

namespace App\Http\Controllers\Admin;

use App\CarType;
use function Couchbase\defaultDecoder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CarSize;
use App\Service;
use App\Price;

class AdminPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //----------------------------------------------------------------
        $i=0;
        $prices=Price::get();
        //---------------------------------------------------------------
        foreach ($prices as $price){
            $size=CarSize::find($price->size_id);
            $service=Service::find($price->service_id);
            //----------------------------------
            if ($size){
                $prices[$i]->car_size_en_title=$size->en_title;
                $prices[$i]->car_size_ar_title=$size->ar_title;
            }else{
                $prices[$i]->car_size_en_title='تم الحذف';
                $prices[$i]->car_size_ar_title='تم الحذف';
            }//endif

            if ($service){
                $prices[$i]->service_en_title=$service->en_title;
                $prices[$i]->service_ar_title=$service->ar_title;
            }else{
                $prices[$i]->service_en_title='تم الحذف';
                $prices[$i]->service_ar_title='تم الحذف';
            }//endif
            $i++;
        }//end foreach
        return view('admin.prices.index')->with(['prices'=>$prices]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services=Service::whereIn('level',array(1,2))->get();
        $sizes=CarSize::all();
        return view('admin.prices.create')->with(['services'=>$services,'sizes'=>$sizes]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'size_id' => 'required',
            'service_id' => 'required',
            'price'=>'required|min:1',
        ]);

        $sizes=CarSize::all();

        if ($request->size_id==-1){

            foreach ($sizes as $size){
                $price_check=Price::where('size_id',$size->id)
                    ->where('service_id',$request->service_id)
                    ->first();

                if (!$price_check){
                    $price=new Price();
                    $price->size_id=$size->id;
                    $price->service_id=$request->service_id;
                    $price->price=$request->price;
                    $price->save();
                }else{
                    toastr()->error('تحذير','تم اختيار هذين النوعين من قبل');
                    return redirect()->back();
                }


            }//end foreach
        }else{
            $price_check=Price::where('size_id',$request->size_id)
                ->where('service_id',$request->service_id)
                ->first();
            if (!$price_check){
                $price=new Price();
                $price->size_id=$request->size_id;
                $price->service_id=$request->service_id;
                $price->price=$request->price;
                $price->save();
            }//end id
            else{
                toastr()->error('تحذير','تم اختيار هذين النوعين من قبل');
                return redirect()->back();
            }
        }///end else
        toastr()->success(trans('main.Message_success'), trans('main.Message_title_congratulation'));
        return redirect(route('prices.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $services=Service::whereIn('level',array(2,3))->get();
        $sizes=CarSize::all();
        $price=Price::find($id);
        return view('admin.prices.edit')->with(['services'=>$services,'sizes'=>$sizes,'price'=>$price]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'size_id' => 'required',
            'service_id' => 'required',
            'price'=>'required|min:1',

        ]);

        $price=Price::find($id);
        $price_check=Price::where('size_id',$request->size_id)
            ->where('service_id',$request->service_id)
            ->where('id','!=',$id)
            ->first();
        if (!$price_check){
            $price->size_id=$request->size_id;
            $price->service_id=$request->service_id;
            $price->price=$request->price;
            $price->save();
        }else{
            toastr()->error('تحذير','تم اختيار هذين النوعين من قبل');
            return redirect()->back();
        }

        toastr()->success(trans('main.Message_success'), trans('main.Message_title_congratulation'));
        return redirect(route('prices.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function delete(Request $request)
    {
        $good= Price::destroy($request->id);
        if ($good)
            return response(['error'=>0]);
        else
            return response(['error'=>1]);
    }//end delete

}//end class
