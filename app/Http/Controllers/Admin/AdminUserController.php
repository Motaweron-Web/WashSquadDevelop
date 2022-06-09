<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::where('user_type',1)->get();
        return view('admin.users.index')->with(['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');

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
            'full_name'=>'required|string|max:190',
            'password' =>'required|string|max:190|min:2',
            'phone' => 'required|numeric|digits_between:1,20|unique:users',
            'phone_code'=>'required|numeric|digits_between:2,6',
            'logo' => 'required|image|mimes:jpeg,jpg,png,gif',

        ]);

        $user=new User();
        $user->full_name=$request->full_name;
        $user->password= bcrypt($request->password);
        $user->phone_code=$request->phone_code;
        $user->phone=$request->phone;
        $user->user_type=1;
        $user->software_type=3;
        $user->is_active=1;

        if ($request->logo){


            $image = $request->file('logo');
            $imageName = time() . '.' .\request('logo')->getClientOriginalExtension();
            $user->logo = 'users/'.$imageName;
            $image->move('upload/users', $imageName);
        }



        $user->save();
        toastr()->success(trans('main.Message_success'), trans('main.Message_title_congratulation'));

        return redirect(route('users.index'));
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
        $user=User::find($id);
        return view('admin.users.edit')->with(['user'=>$user]);
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
        $user=User::find($id);

        $this->validate($request,[
            'full_name'=>'nullable|string|max:190',
            'password' =>'nullable|string|max:190|min:2',
            'phone' => 'required|numeric|digits_between:1,20',
            'phone_code'=>'required|numeric|digits_between:2,6',
            'logo' => 'nullable|image|mimes:jpeg,jpg,png,gif',
        ]);

        $user_phone=User::where('phone','=',$request->phone)->where('id','!=',$id)->get();

        if ($user_phone->count()!=0){
            toastr()->error(trans('main.Message_title_attention'), trans('main.Phone_duplicate'));

            return back()->withInput();
        }



        $user->full_name = $request->full_name!=null? $request->full_name:$user->full_name;
        $user->password = $request->password != null ? bcrypt($request->password):$user->password;
        $user->phone_code = $request->phone_code!= null ?$request->phone_code:$user->phone_code;
        $user->phone = $request->phone!= null ?$request->phone:$user->phone;

        if($request->logo!=null){
            if($user->logo!=null) {
                $image = public_path("upload/{$user->logo}"); // get previous image from folder
                if (File::exists($image)) { // unlink or remove previous image from folder
                    unlink($image);
                }
            }
            $image_request=$request->logo;
            $imageName= time().'.'. request()->logo->getClientOriginalExtension();
            $user->logo = 'users/'.$imageName;
            $image_request->move('upload/users', 'users/'.$imageName);
        }


        $user->save();
        toastr()->success(trans('main.Message_success'), trans('main.Message_title_congratulation'));

        return redirect(route('users.index'));
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
        $good= User::destroy($request->id);
        if ($good)
            return response(['error'=>0]);
        else
            return response(['error'=>1]);

    }//end


    public function is_active($id)
    {
       $user=User::find($id);
        if (!$user){
            toastr()->success(trans('main.Message_title_attention'), trans('main.Message_warning'));

            return redirect(route('users.index'));
        }
        //dd($user);

        if ($user->is_active==1){
            $user->is_active=0;
        }else if ($user->is_active==0){
            $user->is_active=1;
        }
        $user->save();
        //dd($user);

        toastr()->success(trans('main.Message_success'), trans('main.Message_title_congratulation'));

        return redirect(route('users.index'));

    }//end



}
