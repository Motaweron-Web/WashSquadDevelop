<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class AdminMarketerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::where('user_type',4)->get();
        return view('admin.marketers.index')->with(['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.marketers.create');

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
            'name'=>'required|string|max:190|unique:users',
            'email'=>'required|string|email|max:190|unique:users',
            'password' =>'required|string|max:190|min:2',
            'logo' => 'required|image|mimes:jpeg,jpg,png,gif',
            'phone' => 'required|numeric|digits_between:1,20|unique:users',
            'phone_code'=>'required|numeric|digits_between:2,6',
            'gender'=>'required',
            'bank_account'=>'required|string|max:190',
            'IBN_number'=>'required|string|max:190',
            'ratio'=>'required|numeric|min:1|max:99',

        ]);

        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->phone=$request->phone;
        $user->phone_code=$request->phone_code;
        $user->gender=$request->gender;
        $user->bank_account=$request->bank_account;
        $user->IBN_number=$request->IBN_number;
        $user->ratio=$request->ratio;

        $user->password= bcrypt($request->password);
        $user->user_type=4;
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

        return redirect(route('marketers.index'));
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
        return view('admin.marketers.edit')->with(['user'=>$user]);
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
            'name'=>'nullable|string|max:190',
            'email'=>'required|string|email|max:190',
            'password' =>'nullable|string|max:190|min:2',
            'logo' => 'nullable|image|mimes:jpeg,jpg,png,gif',
            'phone' => 'required|numeric|digits_between:1,20',
            'phone_code'=>'required|numeric|digits_between:2,6',
            'gender'=>'required',
            'bank_account'=>'required|string|max:190',
            'IBN_number'=>'required|string|max:190',
            'ratio'=>'required|numeric|min:1|max:99',
        ]);

        $user_name=User::where('name','=',$request->name)->where('id','!=',$id)->get();

        if ($user_name->count()!=0){
            toastr()->error(trans('main.Message_title_attention'), trans('main.Name_duplicate'));

            return back()->withInput();
        }

        $phone=User::where('phone','=',$request->phone)->where('id','!=',$id)->get();

        if ($phone->count()!=0){
            toastr()->error(trans('main.Message_title_attention'), trans('main.Phone_duplicate'));

            return back()->withInput();
        }

        $email=User::where('email','=',$request->email)->where('id','!=',$id)->get();

        if ($email->count()!=0){
            toastr()->error(trans('main.Message_title_attention'), trans('main.Email_duplicate'));

            return back()->withInput();
        }



        $user->name = $request->name!=null? $request->name:$user->name;
        $user->password = $request->password != null ? bcrypt($request->password):$user->password;
        $user->phone=$request->phone;
        $user->email=$request->email;
        $user->phone_code=$request->phone_code;
        $user->gender=$request->gender;
        $user->bank_account=$request->bank_account;
        $user->IBN_number=$request->IBN_number;
        $user->ratio=$request->ratio;
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

        return redirect(route('marketers.index'));
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

            return redirect(route('marketers.index'));
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

        return redirect(route('marketers.index'));

    }//end
}
