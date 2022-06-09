<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class AdminProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $admin=Admin::find($id);
        return view('admin.admin_profile.edit')->with(['admin'=>$admin]);
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
        $admin=Admin::find(\admin()->auth()->id);

        $this->validate($request,[
            'name' => 'required|string',
            'email' =>'required|string|email|max:255',
            'password' => 'nullable|string|max:191',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif',

        ]);

        $admin_email=Admin::where('email','=',$request->email)->where('id','!=',$id)->get();

        if ($admin_email->count()!=0){
            toastr()->error(trans('main.Message_title_attention'), trans('main.Email_duplicate'));

            return back()->withInput();
        }


        $admin->name=$request->name;
        $admin->email=$request->email;
        $admin->password=$request->password!=null?bcrypt($request->password):$admin->password;

        if ($request->image){

            $imageName = url("upload/{$admin->image}"); // get previous image from folder
            if (File::exists($imageName)) { // unlink or remove previous image from folder
                unlink($imageName);
            }

            $image = $request->file('image');
            $imageName = time() . '.' .\request('image')->getClientOriginalExtension();
            $admin->image = 'admins/'.$imageName;
            $image->move('upload/admins', $imageName);
        }

        $admin->save();
        toastr()->success(trans('main.Message_success'), trans('main.Message_title_congratulation'));

        return redirect(route('admin.dashboard'));
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

    public function update_pass_view($id)
    {
        $admin=Admin::find($id);
        return view('admin.admin_profile.change_pass')->with(['admin'=>$admin]);
    }

    public function update_pass(Request $request)
    {
        $admin=Admin::find($request->id);

        $this->validate($request,[
            'password' => 'nullable|string|max:191|confirmed',
        ]);

        $admin->password=$request->password!=null?bcrypt($request->password):$admin->password;

        $admin->save();
        toastr()->success(trans('main.Message_success'), trans('main.Message_title_congratulation'));

        return redirect(route('admin.dashboard'));
    }//end fun

}//end class
