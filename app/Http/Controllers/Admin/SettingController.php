<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AdminPermission;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    //
    public function index(){
        $admins=Admin::paginate(15);
        return view('admin.setting.index',compact('admins'));
    }
    public  function  changeAdminStatus(Request $request){
        $admin=Admin::find($request->id);
        if($admin==null)
            return response()->json(['status'=>false]);
        if($admin->status==1)
        {
            $admin->status=0;
            $admin->save();
            return response()->json(['status'=>true,'active'=>$admin->status]);

        }
        $admin->status=1;
        $admin->save();
        return response()->json(['status'=>true,'active'=>$admin->status]);

    }

    public function deleteAdmin(Request $request){
        $admin=Admin::find($request->id);
        if($admin==null)
            return response()->json(['status'=>false]);
        $admin->delete();
        return response()->json(['status'=>true]);

    }

   public  function createAdmin(){
        $permissions=Permission::get();
       return view('admin.setting.admin.create',compact('permissions'));
   }
   public function addAdmin(Request $request){
       $data = $request->all();
       $validator = \Validator::make($request->all(),
           [
               'name' => 'required|string',
               'password' => 'required',
               'image' => 'required',
               'permissions' => 'required',

           ]);
       if ($validator->fails()) {
           return redirect()->back()
               ->withErrors($validator)
               ->withInput();
       }

       if ($request->file('image')) {
           $image = $request->file('image');
           $imagename = 'assets/admin/images/admins/' . time() . $image->getclientOriginalName();
           $img = \Image::make($image->getRealPath());
           $img->resize(350, 350);
           $img->save(public_path($imagename));

           $data['image'] = $imagename;
       }
      $admin= Admin::create([
           'name'=>$data['name'],
          'email'=>$data['email'],
          'image'=>$data['image'],
           'password'=>\Hash::make($data['password']),
       ]);
       if ($request->has('permissions')) {

           for ($i=0;$i<count($request->permissions);$i++){
          AdminPermission::create([
              'permission_id'=>$request->permissions[$i],
              'admin_id'=>$admin->id,
          ]);
      }}
      return redirect()->route('admin.setting');
   }


   public function editAdmin($id){
        $admin=Admin::findOrFail($id);
        $permissions=Permission::get();
       return view('admin.setting.admin.update',compact('permissions','admin'));
   }


   public function updateAdmin ($id,Request $request){
        $admin=Admin::find($id);
       $validator = \Validator::make($request->all(),
           [
               'name' => 'required|string',
               'password' => 'nullable',
               'image' => 'nullable',
               'permissions' => 'nullable',

           ]);
       if ($validator->fails()) {
           return redirect()->back()
               ->withErrors($validator)
               ->withInput();
       }

       if ($request->file('image')) {
           $image = $request->file('image');
           $imagename = 'assets/admin/images/admins/' . time() . $image->getclientOriginalName();
           $img = \Image::make($image->getRealPath());
           $img->resize(350, 350);
           $img->save(public_path($imagename));

           $data['image'] = $imagename;
       }
       $data['name']=$request->name;
       $data['email']=$request->email;
       if ($request->has('password')) {
           $data['password']=\Hash::make($request->password);
       }
     $admin->update($data);
       if ($request->has('permissions')) {
           AdminPermission::where('admin_id',$admin->id)->delete();
           for ($i=0;$i<count($request->permissions);$i++){
               AdminPermission::create([
                   'permission_id'=>$request->permissions[$i],
                   'admin_id'=>$admin->id,
               ]);
           }
       }
        else {
            AdminPermission::where('admin_id',$admin->id)->delete();

        }
       return redirect()->route('admin.setting');

   }





}
