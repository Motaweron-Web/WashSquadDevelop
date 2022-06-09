<?php

namespace App\Http\Controllers\Admin;
use App\Admin;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Mail\AdminResetPassword;
use Carbon\Carbon;
use DB;
use Mail;

use Auth;

class AdminLoginController extends Controller
{


    public function showLoginForm()
    {
        if (auth()->guard('admin')->check()){
            return redirect(url('admin/home'));
        }
        return view('admin.auth.login');
    }

    public function login(\Illuminate\Http\Request $request)
    {
        // Validate the form data
        $this->validate($request, [
            'email'   => 'required|email|exists:admins',
            'password' => 'required|min:6'
        ]);
        $rememberme = request('rememberme') == 1?true:false;
        if (admin()->attempt(['email' => request('email'), 'password' => request('password')], $rememberme)) {
            return response()->json(200);
        }
       // $errors = new MessageBag(['error' => ['Email and/or password invalid.']]);
        // if unsuccessful, then redirect back to the login with the form data
        return response()->json(405);
    }

    public function logout(Request $request)
    {
        auth()->guard('admin')->logout();
        toastr()->info(trans('main.Message_success'), trans('main.Message_title_congratulation'));
        return redirect()->route('admin.login');
    }

}
