<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('admin.email-send.send_email');
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
        //
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
        //
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

    public function send_Email(Request $request)
    {
        $facebook=\App\Social::find(1);
        $facebook=$facebook->link;
        $twitter=\App\Social::find(2);
        $twitter=$twitter->link;

        $instagram=\App\Social::find(5);
        $instagram=$instagram->link;

        $youtube=\App\Social::find(6);
        $youtube=$youtube->link;


        $email=$request->email;
        $emailtext=$request->text;
        $contact_company='flower.com';
        $subject='email to subscriber';
        Mail::send(['html' => 'admin.setting.email-tem'], ['text' => $emailtext,'email'=>$email,'youtube'=>$youtube,'instagram'=>$instagram,'twitter'=>$twitter,'facebook'=>$facebook],
            function($message) use ($email, $subject, $contact_company)
            {
                $message->to($email,$contact_company)->subject($subject);
            }
        );
        toastr()->success(trans('main.Message_success'), trans('main.Message_title_congratulation'));

        return redirect()->route('admin.dashboard');
    }//end fun

}
