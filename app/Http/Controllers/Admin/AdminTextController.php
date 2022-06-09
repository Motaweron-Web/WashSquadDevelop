<?php

namespace App\Http\Controllers\Admin;

use App\SiteText;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminTextController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siteTexts=SiteText::all();
        return view('admin.siteText.index')->with(['siteTexts'=>$siteTexts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.siteText.create');

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
            'ar_title' =>'required|string|max:191',
            'en_content' => 'required|string|max:191',
            'ar_content' =>'required|string|max:191',

        ]);

        $siteText=new SiteText();
        $siteText->link='web';
        $siteText->en_title=$request->en_title;
        $siteText->ar_title=$request->ar_title;
        $siteText->en_content=$request->en_content;
        $siteText->ar_content=$request->ar_content;
        $siteText->save();
        toastr()->success(trans('main.Message_success'), trans('main.Message_title_congratulation'));

        return redirect(route('siteTexts.index'));

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
        $siteText=SiteText::find($id);
        return view('admin.siteText.edit')->with(['siteText'=>$siteText]);
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
            'ar_title' =>'required|string|max:191',
            'en_content' => 'required|string|max:191',
            'ar_content' =>'required|string|max:191',

        ]);

        $siteText=SiteText::find($id);
        $siteText->en_title=$request->en_title;
        $siteText->ar_title=$request->ar_title;
        $siteText->en_content=$request->en_content;
        $siteText->ar_content=$request->ar_content;
        $siteText->save();
        toastr()->success(trans('main.Message_success'), trans('main.Message_title_congratulation'));

        return redirect(route('siteTexts.index'));
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
       $good= SiteText::destroy($request->id);
        if ($good)
        return response(['error'=>0]);
        else
            return response(['error'=>1]);

    }

}
