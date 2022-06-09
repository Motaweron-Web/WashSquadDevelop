<?php

namespace App\Http\Controllers\Admin;

use App\Social;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminSocialController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $socials=Social::all();
        return view('admin.socials.index')->with(['socials'=>$socials]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.socials.create');

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
            'title' => 'required|string',
            'link' =>'required|string|max:191',

        ]);

        $social=new Social();
        $social->title=$request->title;
        $social->link=$request->link;

        $social->save();
        toastr()->success(trans('main.Message_success'), trans('main.Message_title_congratulation'));

        return redirect(route('socials.index'));

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
        $social=Social::find($id);
        return view('admin.socials.edit')->with(['social'=>$social]);
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
            'title' => 'required|string',
            'link' =>'required|string|max:191',

        ]);

        $social=Social::find($id);
        $social->title=$request->title;
        $social->link=$request->link;

        $social->save();
        toastr()->success(trans('main.Message_success'), trans('main.Message_title_congratulation'));

        return redirect(route('socials.index'));
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
        $good= Social::destroy($request->id);
        if ($good)
            return response(['error'=>0]);
        else
            return response(['error'=>1]);

    }

}
