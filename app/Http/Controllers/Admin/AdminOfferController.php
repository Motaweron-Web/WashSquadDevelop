<?php

namespace App\Http\Controllers\Admin;

use App\Offer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class AdminOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers=Offer::all();
        return view('admin.offers.index')->with(['offers'=>$offers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.offers.create');
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
            'en_title' => 'required|string',
            'ar_title' => 'required|string',
            'ar_description' => 'required|string',
            'en_description' => 'required|string',
            'price' => 'required|min:0',

            'image' => 'required|image|mimes:jpeg,jpg,png,gif',

        ]);

        $offer=new Offer();
        $offer->en_title=$request->en_title;
        $offer->ar_title=$request->ar_title;
        $offer->en_description=$request->en_description;
        $offer->ar_description=$request->ar_description;
        $offer->price=$request->price;

        if ($request->image){


            $image = $request->file('image');
            $imageName = time() . '.' .\request('image')->getClientOriginalExtension();
            $offer->image = 'offers/'.$imageName;
            $image->move('upload/offers', $imageName);
        }

        $offer->save();
        toastr()->success(trans('main.Message_success'), trans('main.Message_title_congratulation'));

        return redirect(route('offers.index'));

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
        $offer=Offer::find($id);
        return view('admin.offers.edit')->with(['offer'=>$offer]);
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
            'en_title' => 'required|string',
            'ar_title' => 'required|string',
            'ar_description' => 'required|string',
            'en_description' => 'required|string',
            'price' => 'required|min:0',

            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif',

        ]);

        $offer=Offer::find($id);
        $offer->en_title=$request->en_title;
        $offer->ar_title=$request->ar_title;
        $offer->en_description=$request->en_description;
        $offer->ar_description=$request->ar_description;
        $offer->price=$request->price;

        if ($request->image){
            if ($offer->image) {
                $imageName = url("upload/{$offer->image}"); // get previous image from folder
                if (File::exists($imageName)) { // unlink or remove previous image from folder
                    unlink($imageName);
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' .\request('image')->getClientOriginalExtension();
            $offer->image = 'offers/'.$imageName;
            $image->move('upload/offers', $imageName);
        }

        $offer->save();
        toastr()->success(trans('main.Message_success'), trans('main.Message_title_congratulation'));

        return redirect(route('offers.index'));
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
        $offer=Offer::find($request->id);
        if ($offer){
            $imageName = url("upload/{$offer->image}"); // get previous image from folder
            if (File::exists($imageName)) { // unlink or remove previous image from folder
                unlink($imageName);
            }

        }

        $good= Offer::destroy($request->id);
        if ($good)
            return response(['error'=>0]);
        else
            return response(['error'=>1]);

    }
}
