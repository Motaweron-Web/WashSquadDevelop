<?php

namespace App\Http\Controllers\Api;

use DB;
use App\Visit;
use App\UserTokens;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class VisitsController extends Controller

{
    /*=============================================*/

    public function store(Request $request)
    {

        $rules = [
            'date' => 'required|date_format:"Y-m-d"',
            'software_type' => 'required|in:1,2'
        ];
        $validate = Validator::make(request()->all(), $rules);

        if ($validate->fails()) {

            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);

        } else {
            $visits = DB::table('visits')->pluck('date')->toArray();
                $date=strtotime ($request->date);
            if (!in_array($date, $visits)) {

                $visit = New Visit();
                $visit->date = $date;
                if ($request->software_type == 1) {
                    $visit->android = 1;
                }
                if ($request->software_type == 2) {
                    $visit->ios = 1;
                }
                $visit->save();
                return response(['data' => $visit], 200);
            }if (in_array($date, $visits)) {
                switch ($request->software_type) {
                    case 1:
                        DB::table('visits')->where('date', $date)->increment('android', 1);
                        break;
                    case 2:
                        DB::table('visits')->where('date', $date)->increment('ios', 1);
                        break;
                }///check for date found
                $data = DB::table('visits')->where('date', $date)->first();
                return response(['data' => $data], 200);

            }
        }
    }

    /*=============================*/



}//end class
