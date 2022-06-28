<?php

namespace App\Http\Controllers\Api;

use App\Bank;
use App\SiteText;
use App\Slider;
use App\Social;
use App\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{

    /*================All socials ==================*/

    public  function all_social () {
        $all_socials=Social::all(['title','link']);

        $arr=array();
        if($all_socials->count()==0){
            return response('no data in the table', 404);

        }


        foreach ($all_socials as $social) {
            $arr[$social->title]= $social->link;


        }
        return response($arr, 200);
    }
    /*================All socials ==================*/

    /*================ About Us ==================*/

    public  function about_us (Request $request)
    {




            $data = SiteText::all();
            if(!$data->count()!=null){
                return response( "this index not exists", 404);

            }

           $data = SiteText::get()->toArray();
            $i=0;
            $newData=array();

            foreach ($data as $datum){


                $val=$datum['link'];

                $newData[$val]=$datum;


            }

            return response( ['data'=>$newData], 200);


    }

    /*================About Us===================*/


    /*================all Setting===================*/

    public function setting(){

        //social
        $newData=array();
        $all_socials=Social::all(['title','link']);

        $arr=array();



        foreach ($all_socials as $social) {
            $newData[$social->title]= $social->link;

        }


        //site text

        $data = SiteText::get()->toArray();
        $i=0;


        foreach ($data as $datum){


            $val=$datum['link'];

            $newData[$val]=$datum;


        }
        $setting = Setting::first();
        $newData['delay_order_sub_limit'] = $setting->delay_order_sub_limit;
        $newData['tax_per'] = $setting->tax_per;


        return response( $newData, 200);

    }
    /*================all Setting===================*/

    /*================Start Slider ======================*/


    public function slider(){


        $sliders=Slider::all();


        if($sliders->count()!=0){

            return response(['data'=>$sliders],200);


        }else{
            return response('no sliders have founds',404);

        }



    }// Slider
    /*================End Slider======================*/




}//end class
