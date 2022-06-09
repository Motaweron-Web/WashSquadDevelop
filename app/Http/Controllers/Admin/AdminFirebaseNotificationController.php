<?php

namespace App\Http\Controllers\Admin;

use App\FirebaseToken;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminFirebaseNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('admin.firebase.index');
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

        $rules = [
            'title' => 'required|string',
            'body' => 'required|string',
        ];

        $customMessages = [
            'title.required' => 'العنوان مطلوب.',
            'body.required' => 'نص الرسالة مطلوب.',
            'title.string' => 'العنوان يمكن ان يكون حروف و ارقام فقط.',
            'body.string' => 'نص الرسالة يمكن ان يكون حروف و ارقام فقط.',
        ];

        $this->validate($request, $rules, $customMessages);

        $firebases = FirebaseToken::get();
        $tokens = [];
        foreach ($firebases as $firebase) {

            foreach ($firebases as $firebase) {
                $tokens[] = $firebase->phone_token;
            }
        }
        // API access key from Google API's Console
        $registrationIds = $tokens;
        // prep the bundle
        $msg = ['title'=> $request['title'] , 'body'=> $request['body']];

        $fields = array
        (
            'registration_ids' => $registrationIds,
            'notification' => array("title"=>"title" ,"body"=>"body" ,"mutable_content"=>true),
            'data' => $msg
        );
        $headers = array
        (
            'Authorization: key=' . config('credentials.firebase_key'),
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);

        curl_close($ch);
        if($result){
            toastr()->success(trans('main.Message_success'), trans('main.Message_title_congratulation'));

            return redirect(route('admin.dashboard'));
        }else{
            toastr()->error(trans('main.Message_title_attention'), trans('main.Message_fail'));

            return redirect(route('admin.dashboard'));
        }
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

    public function send(Request $request)
    {
    }





}
